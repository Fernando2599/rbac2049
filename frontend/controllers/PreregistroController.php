<?php

namespace frontend\controllers;

use common\models\Preregistro;
use common\models\BuscarPreregistro;
use frontend\models\search\PreregistroSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use Yii;

/**
 * PreregistroController implements the CRUD actions for Preregistro model.
 */
class PreregistroController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Preregistro models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new PreregistroSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Preregistro model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Preregistro model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Preregistro();

        if($this->subirArchivo($model))
        {
            $this->sendEmail($model);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Preregistro model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        $this->subirArchivo($model);

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Preregistro model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);

        if(file_exists($model->kardex) && file_exists($model->constancia_ingles) && file_exists($model->cv) && file_exists($model->constancia_creditos_complementarios))
        {
            unlink($model->kardex);
            unlink($model->constancia_ingles);
            unlink($model->cv);
            unlink($model->constancia_creditos_complementarios);
        }

        $model->delete();

        Yii::$app->session->setFlash('warning', 'Tu Pre-registro ha sido eliminado');

        return $this->redirect(['site/index']);
    }

    /**
     * Finds the Preregistro model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Preregistro the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function findModel($id)
    {
        if (($model = Preregistro::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    protected function subirArchivo(Preregistro $model)
    {
        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {

                // Obtener los archivos subidos
                $model->archivoKardex = UploadedFile::getInstance($model, 'archivoKardex');
                $model->archivoConstancia_ingles = UploadedFile::getInstance($model, 'archivoConstancia_ingles');
                $model->archivoCv = UploadedFile::getInstance($model, 'archivoCv');
                $model->archivoConstancia_creditos_complementarios = UploadedFile::getInstance($model, 'archivoConstancia_creditos_complementarios');

                // Validar el modelo
                if ($model->validate()) {

                    // Manejar la subida de cada archivo
                    $this->guardarArchivo($model, 'archivoKardex', 'kardex', 'uploads/preregistro/kardex/');
                    $this->guardarArchivo($model, 'archivoConstancia_ingles', 'constancia_ingles', 'uploads/preregistro/ingles/');
                    $this->guardarArchivo($model, 'archivoCv', 'cv', 'uploads/preregistro/cv/');
                    $this->guardarArchivo($model, 'archivoConstancia_creditos_complementarios', 'constancia_creditos_complementarios', 'uploads/preregistro/creditos_complementarios/');
                }

                // Limpiar los archivos en el modelo
                $model->archivoKardex = null;
                $model->archivoConstancia_ingles = null;
                $model->archivoCv = null;
                $model->archivoConstancia_creditos_complementarios = null;

                // Verificar si todos los archivos se han subido
                if ($model->kardex == null || $model->constancia_ingles == null || $model->cv == null || $model->constancia_creditos_complementarios == null) {
                    Yii::$app->session->setFlash('error', 'Debes cargar los documentos solicitados');
                } else {
                    if ($model->save()) {
                        return $this->redirect(['view', 'id' => $model->id]);
                    }
                }
            }
        } else {
            $model->loadDefaultValues();
        }
    }

    /**
     * Guarda el archivo subido y actualiza el modelo.
     * 
     * @param Preregistro $model
     * @param string $attribute Nombre del atributo de archivo en el modelo.
     * @param string $field Campo en el modelo para almacenar la ruta del archivo.
     * @param string $directory Directorio donde se guardará el archivo.
     */
    protected function guardarArchivo($model, $attribute, $field, $directory)
    {
        $archivo = $model->$attribute;
        if ($archivo) {
            // Verificar si ya existe un archivo y eliminarlo
            if ($model->$field && file_exists($model->$field)) {
                unlink($model->$field);
            }

            // Guardar el nuevo archivo
            $rutaArchivo = $directory . time() . "_" . $archivo->basename . "." . $archivo->extension;
            if ($archivo->saveAs($rutaArchivo)) {
                $model->$field = $rutaArchivo;
            }
        }
    }


    public function actionDownload($filename)
    {
        $path = Yii::getAlias('@frontend') . '/web/' . $filename;
        if(file_exists($path))
        {
            return Yii::$app->response->sendFile($path);
        }
    }

    /**
     * Displays a single Preregistro model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionConsulta()
    {
        $model = new BuscarPreregistro();
        $preregistro = new Preregistro();

        if ($model->load(Yii::$app->request->post())) {
            //return $this->goBack();
            return $this->render('/preregistro/view', [
                'model' => $this->findModelByMatricula($model->matricula),
            ]);
        }

        return $this->render('consulta', [
            'model' => $model,
        ]);
    }

    /**
     * Finds the Preregistro model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param String $matricula ID
     * @return Preregistro the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function findModelByMatricula($matricula)
    {
        if (($model = Preregistro::findOne(['matricula' => $matricula])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('Aún no has hecho tu Preregistro');
    }

    /**
     * Sends confirmation email to user
     * @param Preregistro $preregistro preregistro model to with email should be send
     * @return bool whether the email was sent
     */
    protected function sendEmail($preregistro)
    {
        return Yii::$app
            ->mailer
            ->compose(
                ['html' => 'registro-preregistro-html'],
                ['preregistro' => $preregistro]
            )
            ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name . ' robot'])
            ->setTo($preregistro->email)
            ->setSubject('Te has Pre-registrado para el ' . Yii::$app->name)
            ->send();
    }
}
