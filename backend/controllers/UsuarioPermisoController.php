<?php

namespace backend\controllers;

use backend\models\UsuarioPermiso;
use backend\models\search\UsuarioPermisoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use common\models\PermisosHelpers;
/**
 * UsuarioPermisoController implements the CRUD actions for UsuarioPermiso model.
 */
class UsuarioPermisoController extends Controller
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
                                if (!(PermisosHelpers::requerirMinimoRol(['Admin']) && PermisosHelpers::requerirEstado('Activo'))) {
                                    throw new \yii\web\ForbiddenHttpException('No tienes los permisos necesarios para acceder a esta página.');
                                }
                                return true;
                            }
                        ],
                        [
                            'actions' => ['create', 'update', 'delete'],
                            'allow' => true,
                            'roles' => ['@'],
                            'matchCallback' => function ($rule, $action) {
                                if (!(PermisosHelpers::requerirMinimoRol(['SuperUsuario']) && PermisosHelpers::requerirEstado('Activo'))) {
                                    throw new \yii\web\ForbiddenHttpException('No tienes los permisos necesarios para actualizar o eliminar contenido.');
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
     * Lists all UsuarioPermiso models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new UsuarioPermisoSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single UsuarioPermiso model.
     * @param int $id ID
     * @param int $user_id User ID
     * @param int $permiso_id Permiso ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id, $user_id, $permiso_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id, $user_id, $permiso_id),
        ]);
    }

    /**
     * Creates a new UsuarioPermiso model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new UsuarioPermiso();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id, 'user_id' => $model->user_id, 'permiso_id' => $model->permiso_id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing UsuarioPermiso model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @param int $user_id User ID
     * @param int $permiso_id Permiso ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id, $user_id, $permiso_id)
    {
        $model = $this->findModel($id, $user_id, $permiso_id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id, 'user_id' => $model->user_id, 'permiso_id' => $model->permiso_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing UsuarioPermiso model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @param int $user_id User ID
     * @param int $permiso_id Permiso ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id, $user_id, $permiso_id)
    {
        $this->findModel($id, $user_id, $permiso_id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the UsuarioPermiso model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @param int $user_id User ID
     * @param int $permiso_id Permiso ID
     * @return UsuarioPermiso the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id, $user_id, $permiso_id)
    {
        if (($model = UsuarioPermiso::findOne(['id' => $id, 'user_id' => $user_id, 'permiso_id' => $permiso_id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
