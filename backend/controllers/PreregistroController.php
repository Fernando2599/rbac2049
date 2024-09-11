<?php

namespace backend\controllers;

use common\models\Preregistro;
use common\models\User;
use common\models\PerfilEstudiante;
use common\models\Expediente;
use backend\models\search\PreregistroSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
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
     * Updates an existing Preregistro model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {

            if($model->estado_registro_id == 4)
            {
                $this->insertarUsuario($id);
                $idEstudiante = $this->getEstudianteId($model->matricula);
                $this->asignarRolEstudiante($idEstudiante);
                $this->insertarPerfilEstudiante($id, $idEstudiante);
                $idPerfilEstudiante = $this->getPerfilEstudianteId($model->matricula);
                $this->crearExpediente($idPerfilEstudiante);
            }else{

                $this->sendEmail($model);
            }


            return $this->redirect(['view', 'id' => $model->id]);
        }

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
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Preregistro model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Preregistro the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Preregistro::findOne(['id' => $id])) !== null) {
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
                ['html' => 'cambioEstado-html'],
                ['preregistro' => $preregistro]
            )
            ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name . ' robot'])
            ->setTo($preregistro->email)
            ->setSubject('El estado de tu Pre-registro para el ' . Yii::$app->name . ' ha cambiado')
            ->send();
    }

    public function insertarUsuario($id)
    {
        $model = $this->findModel($id);
        $user = new User();
        $user->username = $model->matricula;
        $user->email = $model->email;
        $bytes = openssl_random_pseudo_bytes(4);
        $pass = bin2hex($bytes);
        $user->setPassword($pass);
        $user->generateAuthKey();
        $user->status = 10;

        return $user->save() && $this->sendEmailNewUser($user, $model, $pass);
    }

    public function asignarRolEstudiante($id)
    {
        $auth = \Yii::$app->authManager;
        $authorRole = $auth->getRole('estudiante');
        $auth->assign($authorRole, $id);
    }

    public function insertarPerfilEstudiante($id, $idEstudiante)
    {
        $model = $this->findModel($id);
        $perfil_estudiante = new PerfilEstudiante();
        $perfil_estudiante->user_id = $idEstudiante;
        $perfil_estudiante->nombre = $model->nombre;
        $perfil_estudiante->matricula = $model->matricula;
        $perfil_estudiante->ingenieria_id = $model->ingenieria_id;

        return $perfil_estudiante->save();
    }

    public function crearExpediente($idPerfilEstudiante)
    {
        $expediente = new Expediente();
        $expediente->perfil_estudiante_id = $idPerfilEstudiante;

        return $expediente->save();
    }

    public static function getEstudianteId($matricula)
    {
        $user = User::find('id')
        ->where(['username' => $matricula])
        ->one();
        return isset($user->id) ? $user->id : false;
    }

    public static function getPerfilEstudianteId($matricula)
    {
        $perfilEstudiante = PerfilEstudiante::find('id')
        ->where(['matricula' => $matricula])
        ->one();
        return isset($perfilEstudiante->id) ? $perfilEstudiante->id : false;
    }

    /**
     * Sends confirmation email to user
     * @param User $user user model to with email should be send
     * @return bool whether the email was sent
     */
    protected function sendEmailNewUser($user, $preregistro, $pass)
    {
        return Yii::$app
            ->mailer
            ->compose(
                ['html' => 'nuevo-estudiante-html'],
                ['user' => $user, 'preregistro' => $preregistro, 'pass' => $pass]
            )
            ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name . ' robot'])
            ->setTo($user->email)
            ->setSubject('Bienvenido a ' . Yii::$app->name)
            ->send();
    }
}
