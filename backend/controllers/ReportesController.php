<?php

namespace backend\controllers;

use yii\web\Controller;
use yii\filters\VerbFilter;
use kartik\mpdf\Pdf;
use common\models\PermisosHelpers;
use common\models\Preregistro;
use Yii;

class ReportesController extends Controller
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
                            'actions' => ['index', 'view', 'create', 'update'],
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
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionEstudiantesReport()
    {
        //Consulta de los estudiantes en la base de datos
        $totalStudents = Preregistro::find()
            ->where(['estado_registro_id' => 4])
            ->all();
        // get your HTML raw content without any layouts or scripts
        $content = $this->renderPartial('_reportView', [
            'estudiantes' => $totalStudents
        ]);

        $pdf = Yii::$app->pdf;
        $pdf->content = $content;
        return $pdf->render();
    }
}
