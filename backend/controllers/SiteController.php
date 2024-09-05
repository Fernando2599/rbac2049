<?php

namespace backend\controllers;
use common\models\PermisosHelpers;
use common\models\Proyecto;
use common\models\AsesorInterno;
use common\models\LoginForm;
use backend\models\SignupForm;
use backend\models\VerifyEmailForm;

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
                        'actions' => ['login', 'error'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['index'],
                        'allow' => true,
                        'roles' => ['@'],
                        'matchCallback' => function ($rule, $action) {
                            return PermisosHelpers::requerirMinimoRol('Admin') 
                            && PermisosHelpers::requerirEstado('Activo');
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
        // Consulta del numero de proyectos por estado
        $projectCounts = Proyecto::find()
            ->select(['estado_proyecto_id', 'COUNT(*) AS count'])
            ->groupBy('estado_proyecto_id')
            ->asArray()
            ->all();

        //Consulta de los numeros de docentes en la base de datos
        $totalTeachers = AsesorInterno::find()->count();

        //Paginancion para los resultados obtenidos de docente
        $pageSize = 5;

        $paginationTeachers = new Pagination([
            'defaultPageSize' => $pageSize,
            'totalCount' => $totalTeachers,
        ]);

        //Consulta de los docentes en la base de datos
        $teachers = AsesorInterno::find()
            ->select(['asesor_interno.*', 'ingenieria.nombre AS nombre_ingenieria'])
            ->leftJoin('ingenieria', 'asesor_interno.ingenieria_id = ingenieria.id')
            ->offset($paginationTeachers->offset)
            ->limit($paginationTeachers->limit)
            ->asArray() //Para trabajar con arrays en lugar de objetos
            ->all(); //Obtienen todo  los registros

        // Procesar resultados para la vista
        $statusCounts = [];
        foreach ($projectCounts as $projectCount) {
            //Cuenta los resultados dependiendo el estado
            $statusCounts[$projectCount['estado_proyecto_id']] = $projectCount['count'];
        }

        return $this->render('index', [
            'totalProjects' => $totalProjects,
            'totalTeachers' => $totalTeachers,
            'statusCounts' => $statusCounts,
            'teachers' => $teachers,
            'paginationTeachers' => $paginationTeachers,
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
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
}
