<?php

namespace frontend\controllers;

use common\models\DocumentoExpediente;
use frontend\models\search\DocumentoExpedienteSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\RegistrosHelpers;
use common\models\RecordHelpers;
use yii\web\UploadedFile;
use Yii;

/**
 * DocumentoExpedienteController implements the CRUD actions for DocumentoExpediente model.
 */
class DocumentoExpedienteController extends Controller
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
     * Lists all DocumentoExpediente models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new DocumentoExpedienteSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single DocumentoExpediente model.
     * @param int $documento_id Documento ID
     * @param int $expediente_id Expediente ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($documento_id, $expediente_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($documento_id, $expediente_id),
        ]);
    }

    /**
     * Creates a new DocumentoExpediente model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate($documento_id)
    {
        $model = new DocumentoExpediente();
        $model->documento_id = $documento_id;
        $ya_existe = RegistrosHelpers::buscarExpediente();
        $model->expediente_id = $ya_existe;

        $this->subirArchivo($model);

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing DocumentoExpediente model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $documento_id Documento ID
     * @param int $expediente_id Expediente ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($documento_id, $expediente_id)
    {
        $model = $this->findModel($documento_id, $expediente_id);

        $this->subirArchivo($model);

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing DocumentoExpediente model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $documento_id Documento ID
     * @param int $expediente_id Expediente ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($documento_id, $expediente_id)
    {
        $this->findModel($documento_id, $expediente_id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the DocumentoExpediente model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $documento_id Documento ID
     * @param int $expediente_id Expediente ID
     * @return DocumentoExpediente the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($documento_id, $expediente_id)
    {
        if (($model = DocumentoExpediente::findOne(['documento_id' => $documento_id, 'expediente_id' => $expediente_id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    protected function subirArchivo(DocumentoExpediente $model)
    {
        $conexion = \Yii::$app->db;
        $userid = Yii::$app->user->identity->id;
        $username = RecordHelpers::getUserName($userid);
        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {

                $model->archivo = UploadedFile::getInstance($model,'archivo');

                if($model->validate())
                {
                    if(($model->archivo))
                    {
                        if(file_exists($model->ruta))
                        {
                            unlink($model->ruta);
                        }

                        if (!file_exists('uploads/expedientes/' . $username)) {

                            mkdir('uploads/expedientes/' . $username, 0777, true);
                        
                        }

                        $rutaArchivo = "uploads/expedientes/". $username . "/" .time()."_".$model->archivo->basename.".".$model->archivo->extension;

                        if(($model->archivo->saveAs($rutaArchivo)))
                        {
                            $model->ruta = $rutaArchivo;
                        }
                    }
                }

                $model->archivo = null;

                if($model->save(false))
                {
                    return $this->redirect(['view', 'documento_id' => $model->documento_id, 'expediente_id' => $model->expediente_id]);
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
}
