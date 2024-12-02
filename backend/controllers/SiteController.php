<?php

namespace backend\controllers;

use common\models\PermisosHelpers;
use common\models\Proyecto;
use common\models\Preregistro;
use common\models\AsesorInterno;
use common\models\Expediente;
use common\models\LoginForm;
use backend\models\SignupForm;
use backend\models\VerifyEmailForm;

use frontend\models\ResendVerificationEmailForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;

use Yii;
use yii\data\Pagination;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;

use kartik\mpdf\Pdf;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'actions' => ['login', 'error', 'signup', 'verify-email', 'nuevo-usuario', 'request-password-reset', 'reset-password'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['index'],
                        'allow' => true,
                        'roles' => ['@'],
                        'matchCallback' => function ($rule, $action) {
                            if (!(PermisosHelpers::requerirMinimoRol(['Admin', 'SuperUsuario', 'Coordinador', 'Subdirector']) && PermisosHelpers::requerirEstado('Activo'))) {
                                throw new \yii\web\ForbiddenHttpException('Ups, necesita un rol en especifico para esta accion');
                            }
                            return true;
                        }
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],

                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => \yii\web\ErrorAction::class,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        //Consulta de los proyectos en la base de datos
        $totalProjects = Proyecto::find()->count();

        //Consulta de los estudiantes en la base de datos
        $totalStudents = Preregistro::find()
            ->where(['estado_registro_id' => 4])
            ->limit(8)
            ->count();

        // Consulta del numero de proyectos por estado
        $statusCounts = Proyecto::find()
            ->select(['estado_proyecto_id', 'estado_proyecto.nombre', 'COUNT(*) AS count'])
            ->joinWith('estadoProyecto') // Relación con el modelo EstadoProyecto
            ->groupBy(['estado_proyecto_id', 'estado_proyecto.nombre'])
            ->asArray()
            ->all();

        //Consulta de los numeros de docentes en la base de datos
        $totalTeachers = AsesorInterno::find()->count();

        $totalTeachersGrafica = AsesorInterno::find()
            ->select(['capacitacion', 'COUNT(*) AS total'])
            ->groupBy('capacitacion')
            ->asArray()
            ->all();
        
        // Consulta de los docentes en la base de datos
        $teachers = AsesorInterno::find()
            ->select(['asesor_interno.*', 'ingenieria.nombre AS nombre_ingenieria'])
            ->leftJoin('ingenieria', 'asesor_interno.ingenieria_id = ingenieria.id')
            ->asArray() // Para trabajar con arrays en lugar de objetos
            ->all();

        //Consulta de los expediente 
        $totalFiles = Expediente::find()
            ->select([
                'perfil_estudiante.nombre AS nombre_estudiante',
                'expediente.created_at',
                'estado_expediente_id',
                'estado_expediente.nombre AS nombre_estado',
                'COALESCE(motivo_cierre.nombre, "Sin motivo") AS nombre_motivo'
            ])
            ->joinWith('perfilEstudiante') // LEFT JOIN con perfil_estudiante
            ->joinWith('estadoExpediente') // LEFT JOIN con estado_expediente
            ->leftJoin('motivo_cierre', 'expediente.motivo_cierre_id = motivo_cierre.id') // LEFT JOIN manual
            ->limit(8)
            ->asArray()
            ->all();


        return $this->render('index', [
            'totalProjects' => $totalProjects,
            'totalTeachers' => $totalTeachers,
            'totalTeachersGrafica' => $totalTeachersGrafica,
            'totalStudents' => $totalStudents,
            'statusCounts' => $statusCounts,
            'totalFiles' => $totalFiles,
            'teachers' => $teachers,
        ]);
    }

    /**
     * Login action.
     *
     * @return string|Response
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $this->layout = 'blank';

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->loginAdmin()) {
            return $this->goBack();
        }

        $model->password = '';

        return $this->render('login', [
            'model' => $model,
        ]);
    }
    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionSignup()
    {
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post()) && $model->signup()) {
            Yii::$app->session->setFlash('success', 'Gracias por registrarse. Por favor revise su bandeja de entrada para el correo electrónico de verificación.');
            return $this->render('nuevo-usuario');
        }

        $this->layout = 'blank';

        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    /**
     * Verify email address
     *
     * @param string $token
     * @throws BadRequestHttpException
     * @return yii\web\Response
     */
    public function actionVerifyEmail($token)
    {
        try {
            $model = new VerifyEmailForm($token);
        } catch (InvalidArgumentException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }
        if (($user = $model->verifyEmail()) && Yii::$app->user->login($user)) {
            Yii::$app->session->setFlash('success', '¡Tu correo ha sido confirmado! En breve el administrador te asignará un rol...');
            return $this->render('nuevo-usuario');
        }

        Yii::$app->session->setFlash('error', 'Lo sentimos, no podemos verificar su cuenta con el token proporcionado.');
        return $this->render('nuevo-usuario');
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            }

            Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for the provided email address.');
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }
    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidArgumentException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'New password saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }
}
