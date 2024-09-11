<?php

namespace backend\controllers;

use common\models\Expediente;
use backend\models\search\ExpedienteSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use frontend\models\search\DocumentoExpedienteSearch;
use Yii;
use yii\helpers\Url;
use yii\db\Expression;

/**
 * ExpedienteController implements the CRUD actions for Expediente model.
 */
class ExpedienteController extends Controller
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
     * Lists all Expediente models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new ExpedienteSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Expediente model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $searchModel = new DocumentoExpedienteSearch(); 
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams, $id);
        return $this->render('view', [
            'model' => $this->findModel($id),
            'searchModel' => $searchModel, 
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Creates a new Expediente model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Expediente();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Expediente model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $model->estado_expediente_id = 2;
        $model->fecha_cierre = new Expression('NOW()');

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            $this->completado($id);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    public function actionReabrir($id)
    {
        $model = $this->findModel($id);
        $model->estado_expediente_id = 1;
        $model->fecha_cierre = NULL;
        $model->motivo_cierre_id = NULL;
        $model->comentario = NULL;

        return $model->save() && $this->redirect(['view', 'id' => $model->id]);
    }

    public function completado($id)
    {
        $model = $this->findModel($id);
        if($model->motivo_cierre_id == 1)
        {
            $model->estado_expediente_id = 3;
        }

        return $model->save() && $this->redirect(['view', 'id' => $model->id]);
    }

    /**
     * Deletes an existing Expediente model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Expediente model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Expediente the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Expediente::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionFile($filename)
    {
        $path = Yii::getAlias('@frontend') . '/web/' . $filename;
        if(file_exists($path))
        {
            return $this->redirect(Yii::$app->urlManagerFrontEnd->baseUrl . '/' . $filename);
        }
    }
}
