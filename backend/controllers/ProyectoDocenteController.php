<?php

namespace backend\controllers;

use common\models\ProyectoDocente;
use backend\models\search\ProyectoDocenteSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use Yii;

/**
 * ProyectoDocenteController implements the CRUD actions for ProyectoDocente model.
 */
class ProyectoDocenteController extends Controller
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
     * Lists all ProyectoDocente models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new ProyectoDocenteSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ProyectoDocente model.
     * @param int $id ID
     * @param int $proyecto_id Proyecto ID
     * @param int $docente_id Docente ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id, $proyecto_id, $docente_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id, $proyecto_id, $docente_id),
        ]);
    }

    /**
     * Creates a new ProyectoDocente model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new ProyectoDocente();
        if ($model->load(Yii::$app->request->post()) && $model->saveDocenteArray()) {
            return $this->redirect(['index']);
        }
        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing ProyectoDocente model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @param int $proyecto_id Proyecto ID
     * @param int $docente_id Docente ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id,$proyecto_id,$docente_id)
    {
        $model = $this->findModel($id,$proyecto_id,$docente_id);
        $model->getArrayValue();  // En caso de que no se ponga el afterfind y utilicemos la otra variante
        if ($model->load(Yii::$app->request->post()) && $model->saveDocenteArray()) {
            return $this->redirect(['index']);
        }
        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing ProyectoDocente model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @param int $proyecto_id Proyecto ID
     * @param int $docente_id Docente ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id, $proyecto_id, $docente_id)
    {
        $this->findModel($id, $proyecto_id, $docente_id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the ProyectoDocente model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @param int $proyecto_id Proyecto ID
     * @param int $docente_id Docente ID
     * @return ProyectoDocente the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id, $proyecto_id, $docente_id)
    {
        if (($model = ProyectoDocente::findOne(['id' => $id, 'proyecto_id' => $proyecto_id, 'docente_id' => $docente_id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
