<?php

namespace backend\controllers;

use common\models\ProyectoAsignatura;
use backend\models\search\ProyectoAsignaturaSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use Yii;

/**
 * ProyectoAsignaturaController implements the CRUD actions for ProyectoAsignatura model.
 */
class ProyectoAsignaturaController extends Controller
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
     * Lists all ProyectoAsignatura models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new ProyectoAsignaturaSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ProyectoAsignatura model.
     * @param int $id ID
     * @param int $proyecto_id Proyecto ID
     * @param int $asignatura_id Asignatura ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id, $proyecto_id, $asignatura_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id, $proyecto_id, $asignatura_id),
        ]);
    }

    /**
     * Creates a new ProyectoAsignatura model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate($proyecto_id)
    {
        $model = new ProyectoAsignatura();
        $model -> proyecto_id = $proyecto_id;
        if ($model->load(Yii::$app->request->post()) && $model->saveAsignaturaArray()) {
            return $this->redirect(['proyecto/view', 'id' => $proyecto_id]);
        }
        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing ProyectoAsignatura model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @param int $proyecto_id Proyecto ID
     * @param int $asignatura_id Asignatura ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($proyecto_id)
    {
        $model = $this->findModel($proyecto_id);

        if ($model !== null) {
            
            $model->getArrayValue();  // En caso de que no se ponga el afterfind y utilicemos la otra variante
            if ($model->load(Yii::$app->request->post()) && $model->saveAsignaturaArray()) {
                return $this->redirect(['proyecto/view', 'id' => $proyecto_id]);
            }
            return $this->render('update', [
                'model' => $model,
            ]);

        } else {

            return $this->redirect(['create', 'proyecto_id' => $proyecto_id]);
        }
        
    }

    /**
     * Deletes an existing ProyectoAsignatura model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @param int $proyecto_id Proyecto ID
     * @param int $asignatura_id Asignatura ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id, $proyecto_id, $asignatura_id)
    {
        $this->findModel($id, $proyecto_id, $asignatura_id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the ProyectoAsignatura model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @param int $proyecto_id Proyecto ID
     * @param int $asignatura_id Asignatura ID
     * @return ProyectoAsignatura the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($proyecto_id)
    {
        if (($model = ProyectoAsignatura::findOne(['proyecto_id' => $proyecto_id])) !== null) {
            return $model;
        }

        
    }
}
