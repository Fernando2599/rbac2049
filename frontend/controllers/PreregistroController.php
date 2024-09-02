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

                $model->archivoKardex = UploadedFile::getInstance($model,'archivoKardex');
                $model->archivoConstancia_ingles = UploadedFile::getInstance($model,'archivoConstancia_ingles');
                $model->archivoCv = UploadedFile::getInstance($model,'archivoCv');
                $model->archivoConstancia_creditos_complementarios = UploadedFile::getInstance($model,'archivoConstancia_creditos_complementarios');


                if($model->validate())
                {
                    if(($model->archivoKardex))
                    {
                        if(file_exists($model->kardex))
                        {
                            unlink($model->kardex);
                        }

                        $rutaArchivoKardex = "uploads/preregistro/kardex/".time()."_".$model->archivoKardex->basename.".".$model->archivoKardex->extension;

                        if(($model->archivoKardex->saveAs($rutaArchivoKardex)))
                        {
                            $model->kardex = $rutaArchivoKardex;
                        }
                    }

                    if(($model->archivoConstancia_ingles))
                    {
                        if(file_exists($model->constancia_ingles) )
                        {
                            unlink($model->constancia_ingles);
                        }

                        $rutaArchivoConstancia_ingles = "uploads/preregistro/ingles/".time()."_".$model->archivoConstancia_ingles->basename.".".$model->archivoConstancia_ingles->extension;

                        if(($model->archivoConstancia_ingles->saveAs($rutaArchivoConstancia_ingles)))
                        {
                            $model->constancia_ingles = $rutaArchivoConstancia_ingles;
                        }
                    }

                    if(($model->archivoCv))
                    {
                        if(file_exists($model->cv) )
                        {
                            unlink($model->cv);
                        }

                        $rutaArchivoCv = "uploads/preregistro/cv/".time()."_".$model->archivoCv->basename.".".$model->archivoCv->extension;

                        if(($model->archivoCv->saveAs($rutaArchivoCv)))
                        {
                            $model->cv = $rutaArchivoCv;
                        }
                    }

                    if(($model->archivoConstancia_creditos_complementarios))
                    {
                        if(file_exists($model->constancia_creditos_complementarios) )
                        {
                            unlink($model->constancia_creditos_complementarios);
                        }
                        
                        $rutaArchivoConstancia_creditos_complementarios = "uploads/preregistro/creditos_complementarios/".time()."_".$model->archivoConstancia_creditos_complementarios->basename.".".$model->archivoConstancia_creditos_complementarios->extension;

                        if(($model->archivoConstancia_creditos_complementarios->saveAs($rutaArchivoConstancia_creditos_complementarios)))
                        {
                            $model->constancia_creditos_complementarios = $rutaArchivoConstancia_creditos_complementarios;
                        }

                    }
                }

                $model->archivoKardex = null;
                $model->archivoConstancia_ingles = null;
                $model->archivoCv = null;
                $model->archivoConstancia_creditos_complementarios = null;

                if($model->kardex == NULL || $model->constancia_ingles == NULL || $model->cv == NULL || $model->constancia_creditos_complementarios == NULL)
                {
                    Yii::$app->session->setFlash('error', 'Debes cargar los documentos solicitados');
                }else{
                    if($model->save())
                    {
                        return $this->redirect(['view', 'id' => $model->id]);
                    }
                }
            }
        } else {
            $model->loadDefaultValues();
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
