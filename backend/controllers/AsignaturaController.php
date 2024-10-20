<?php

namespace backend\controllers;

use common\models\Asignatura;
use backend\models\search\AsignaturaSearch;
use common\models\Ajuste;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\db\Query;
use yii\helpers\Json;

use common\models\PermisosHelpers;
/**
 * AsignaturaController implements the CRUD actions for Asignatura model.
 */
class AsignaturaController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'access' => [
                    'class' => \yii\filters\AccessControl::className(),
                    'only' => ['index', 'view', 'create', 'update', 'delete'],
                    'rules' => [
                        [
                            'actions' => ['index', 'view'],
                            'allow' => true,
                            'roles' => ['@'],
                            'matchCallback' => function ($rule, $action) {
                                if (!(PermisosHelpers::requerirMinimoRol(['Subdirector']) && PermisosHelpers::requerirEstado('Activo'))) {
                                    throw new \yii\web\ForbiddenHttpException('No tienes el rol necesario');
                                }
                                return true;
                            }
                        ],                        
                        [
                            'actions' => ['index', 'view','create', 'update'],
                            'allow' => true,
                            'roles' => ['@'],
                            'matchCallback' => function ($rule, $action) {
                                if (!(PermisosHelpers::requerirMinimoRol(['Admin']) && PermisosHelpers::requerirEstado('Activo'))) {
                                    throw new \yii\web\ForbiddenHttpException('Ups, necesita un rol en especifico para esta accion');
                                }
                                return true;
                            }
                        ],
                        [
                            'actions' => ['delete'],
                            'allow' => true,
                            'roles' => ['@'],
                            'matchCallback' => function ($rule, $action) {
                                if (!(PermisosHelpers::requerirMinimoRol(['SuperUsuario']) && PermisosHelpers::requerirEstado('Activo'))) {
                                    throw new \yii\web\ForbiddenHttpException('Ups, no tiene permitido eliminar contenido');
                                }
                                return true;
                            }
                        ],
                    ],
                ],

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
     * Lists all Asignatura models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new AsignaturaSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Asignatura model.
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
     * Creates a new Asignatura model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Asignatura();

        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {
                $ajuste = $this->findAjuste(1);
                $model->horas_dedicadas = $model->creditos * $ajuste -> num_semanas_semestre;
                $model -> periodo_desarrollo = $model-> mes_inicio .'-'. $model-> anio_inicio; 
                $model -> periodo_acreditacion = $model-> mes_final .'-'. $model-> anio_final;
                $model->save();
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
     * Updates an existing Asignatura model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) ) {
            $ajuste = $this->findAjuste(1);
            $model->horas_dedicadas = $model->creditos * $ajuste -> num_semanas_semestre;
            $model -> periodo_desarrollo = $model-> mes_inicio .'-'. $model-> anio_inicio; 
            $model -> periodo_acreditacion = $model-> mes_final .'-'. $model-> anio_final; 
            $model->save();
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Asignatura model.
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
     * Finds the Asignatura model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Asignatura the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Asignatura::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function findAjuste($id)
    {
        if (($model = Ajuste::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionAsesoresList() {
        $out = [];
        if (isset($_POST['depdrop_parents'])) {
        $parents = $_POST['depdrop_parents'];

        if ($parents != null) {
        $ingenieria_id = $parents[0];
        $out = \common\models\Asignatura::getAsesores($ingenieria_id);
        echo Json::encode(['output'=>$out, 'selected'=>'']);
        return;
        }
        }
        echo Json::encode(['output'=>'', 'selected'=>'']);
    }

    public function actionEspecialidadList() {
        $out = [];
        if (isset($_POST['depdrop_parents'])) {
        $parents = $_POST['depdrop_parents'];

        if ($parents != null) {
        $ingenieria_id = $parents[0];
        $out = \common\models\Asignatura::getEspecialidades($ingenieria_id);
        echo Json::encode(['output'=>$out, 'selected'=>'']);
        return;
        }
        }
        echo Json::encode(['output'=>'', 'selected'=>'']);
    }

}