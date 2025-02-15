<?php

namespace backend\controllers;

use common\models\Ajuste;
use common\models\Membrete;
use backend\models\search\AjusteSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use Yii;

use common\models\PermisosHelpers;

/**
 * AjusteController implements the CRUD actions for Ajuste model.
 */
class AjusteController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(parent::behaviors(), [
            'access' => [
                'class' => \yii\filters\AccessControl::className(),
                'only' => ['index', 'view', 'update'],
                'rules' => [
                    [
                        'actions' => ['index', 'view'],
                        'allow' => true,
                        'roles' => ['@'],
                        'matchCallback' => function ($rule, $action) {
                            if (!(PermisosHelpers::requerirMinimoRol(['Subdirector']) && PermisosHelpers::requerirEstado('Activo'))) {
                                throw new \yii\web\ForbiddenHttpException('No tienes los permisos necesarios para acceder a esta página.');
                            }
                            return true;
                        }
                    ],
                    [
                        'actions' => ['index', 'view', 'update'],
                        'allow' => true,
                        'roles' => ['@'],
                        'matchCallback' => function ($rule, $action) {
                            // Permitir acceso si el rol es 'Admin', 'SuperUsuario' o 'Subdirector' y el estado es 'Activo'
                            if (!((PermisosHelpers::requerirMinimoRol(['Admin', 'SuperUsuario']) && PermisosHelpers::requerirEstado('Activo')))) {
                                throw new \yii\web\ForbiddenHttpException('Ups, necesita un rol en especifico para esta accion');
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
        ]);
    }


    /**
     * Lists all Ajuste models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $claves = ['header', 'footer'];

        // Inicializar las rutas predeterminadas
        $rutasImagenes = [
            'header' => 'assets/images/logo-dark.png',
            'footer' => 'assets/images/logo-dark.png',
        ];

        // Obtener los modelos que coincidan con las claves
        $modelos = Membrete::find()->where(['clave' => $claves])->all();

        foreach ($modelos as $model) {
            if (isset($rutasImagenes[$model->clave])) {
                $rutasImagenes[$model->clave] = Yii::getAlias('@web/') . $model->ruta;
            }
        }

        // Acceder a las rutas finales
        $rutaHeader = $rutasImagenes['header'];
        $rutaFooter = $rutasImagenes['footer'];

        return $this->render('view', [
            'model' => $this->findModel(1),
            'rutaHeader' => $rutaHeader,
            'rutaFooter' => $rutaFooter,
        ]);
    }


    /**
     * Displays a single Ajuste model.
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
     * Creates a new Ajuste model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Ajuste();

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
     * Updates an existing Ajuste model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Ajuste model.
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
     * Finds the Ajuste model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Ajuste the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Ajuste::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionGetMembrete() {}
}
