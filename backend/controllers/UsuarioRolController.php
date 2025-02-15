<?php

namespace backend\controllers;

use backend\models\UsuarioRol;
use backend\models\search\UsuarioRolSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\PermisosHelpers;

/**
 * UsuarioRolController implements the CRUD actions for UsuarioRol model.
 */
class UsuarioRolController extends Controller
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
     * Lists all UsuarioRol models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new UsuarioRolSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single UsuarioRol model.
     * @param int $id ID
     * @param int $user_id User ID
     * @param int $rol_id Rol ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id, $user_id, $rol_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id, $user_id, $rol_id),
        ]);
    }

    /**
     * Creates a new UsuarioRol model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new UsuarioRol();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id, 'user_id' => $model->user_id, 'rol_id' => $model->rol_id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing UsuarioRol model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @param int $user_id User ID
     * @param int $rol_id Rol ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id, $user_id, $rol_id)
    {
        $model = $this->findModel($id, $user_id, $rol_id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id, 'user_id' => $model->user_id, 'rol_id' => $model->rol_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing UsuarioRol model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @param int $user_id User ID
     * @param int $rol_id Rol ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id, $user_id, $rol_id)
    {
        $this->findModel($id, $user_id, $rol_id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the UsuarioRol model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @param int $user_id User ID
     * @param int $rol_id Rol ID
     * @return UsuarioRol the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id, $user_id, $rol_id)
    {
        if (($model = UsuarioRol::findOne(['id' => $id, 'user_id' => $user_id, 'rol_id' => $rol_id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
