<?php

namespace frontend\controllers;

use Yii;
use common\models\PerfilEstudiante;
use common\models\Especialidades;
use frontend\models\search\PerfilEstudianteSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\PermisosHelpers;
use common\models\RegistrosHelpers;
use yii\helpers\Json;

/**
 * PerfilEstudianteController implements the CRUD actions for PerfilEstudiante model.
 */
class PerfilEstudianteController extends Controller
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
     * Lists all PerfilEstudiante models.
     *
     * @return string
     */
    public function actionIndex()
    {

        if ($ya_existe = RegistrosHelpers::userTiene('perfil_estudiante')) {
            return $this->render('view', [
                'model' => $this->findModel($ya_existe),
            ]);
        } else {
            return $this->redirect(['create']);
        }
    }

    /**
     * Displays a single PerfilEstudiante model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView()
    {
        if ($ya_existe = RegistrosHelpers::userTiene('perfil_estudiante')) {
            return $this->render('view', [
                'model' => $this->findModel($ya_existe),
            ]);
        } else {
            return $this->redirect(['create']);
        }
    }

    /**
     * Creates a new PerfilEstudiante model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new PerfilEstudiante;
            
        $model->user_id = \Yii::$app->user->identity->id;      
        
        if ($ya_existe = RegistrosHelpers::userTiene('perfil_estudiante')) {

            return $this->render('view', [

                    'model' => $this->findModel($ya_existe),

                ]);
        
        } elseif ($model->load(Yii::$app->request->post()) && $model->save()){
                            
            return $this->redirect(['view']);
                            
        } else {
                    
            return $this->render('create', [

                    'model' => $model,

                    ]);
        }
    }

    /**
     * Updates an existing PerfilEstudiante model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate()
    {
            
        if($model =  PerfilEstudiante::find()->where(['user_id' => 
            Yii::$app->user->identity->id])->one()) {
            
            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                
                return $this->redirect(['view']);
            
            } else {
                
            return $this->render('update', [
                    'model' => $model, 
                ]);
            }
        
        } else {
                
            throw new NotFoundHttpException('No Existe el Perfil.');
                
        }
    }

    /**
     * Deletes an existing PerfilEstudiante model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete()
    {
            
        $model =  Perfil::find()->where(['user_id' => Yii::$app->user->identity->id])->one();
                
        $this->findModel($model->id)->delete();
            
        return $this->redirect(['site/index']);
    }

    /**
     * Finds the PerfilEstudiante model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return PerfilEstudiante the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = PerfilEstudiante::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionEspecialidadesList() {
        $out = [];
        if (isset($_POST['depdrop_parents'])) {
        $parents = $_POST['depdrop_parents'];

        if ($parents != null) {
        $ingenieria_id = $parents[0];
        $out = \common\models\PerfilEstudiante::getEspecialidades($ingenieria_id);
        echo Json::encode(['output'=>$out, 'selected'=>'']);
        return;
        }
        }
        echo Json::encode(['output'=>'', 'selected'=>'']);
    }
}
