<?php

namespace backend\controllers;

use common\models\Membrete;
use yii\web\UploadedFile;
use Yii;

class MembreteController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }



    public function actionCreateHeader()
    {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        // Obtén la instancia del archivo
        $archivo = UploadedFile::getInstanceByName('Membrete[archivo]');

        if ($archivo) {
            // Define el nombre fijo y la ubicación del archivo
            $nombreArchivo = 'header';
            $rutaCarpeta = Yii::getAlias('@webroot/uploads/membrete/');
            $rutaCompleta = $rutaCarpeta . $nombreArchivo;

            if (!is_dir($rutaCarpeta)) {
                mkdir($rutaCarpeta, 0777, true);
            }

            // Busca el registro actual en la base de datos
            $registroExistente = Membrete::findOne(['clave' => $nombreArchivo]);

            // Elimina el archivo físico si ya existe
            if ($registroExistente && file_exists(Yii::getAlias('@webroot/') . $registroExistente->ruta)) {
                unlink(Yii::getAlias('@webroot/') . $registroExistente->ruta);
            }

            // Si hay un registro existente, actualízalo; de lo contrario, crea uno nuevo
            $model = $registroExistente ?: new Membrete();

            // Guarda el nuevo archivo en la carpeta destino
            if ($archivo->saveAs($rutaCompleta)) {
                // Actualiza los datos en el modelo
                $model->clave = $nombreArchivo;
                $model->ruta = 'uploads/membrete/' . $nombreArchivo;

                if ($model->save()) {
                    return [
                        'success' => true,
                        'message' => 'Imagen subida y guardada correctamente.',
                        'ruta' => $model->ruta,
                    ];
                } else {
                    return [
                        'success' => false,
                        'message' => 'Error al guardar en la base de datos.',
                    ];
                }
            } else {
                return [
                    'success' => false,
                    'message' => 'No se pudo guardar el archivo en el servidor.',
                ];
            }
        }

        return [
            'success' => false,
            'message' => 'No se recibió ningún archivo válido.',
        ];
    }

    public function actionCreateFooter()
    {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        // Obtén la instancia del archivo
        $archivo = UploadedFile::getInstanceByName('Membrete[archivo]');

        if ($archivo) {
            // Define el nombre fijo y la ubicación del archivo
            $nombreArchivo = 'footer';
            $rutaCarpeta = Yii::getAlias('@webroot/uploads/membrete/');
            $rutaCompleta = $rutaCarpeta . $nombreArchivo;

            if (!is_dir($rutaCarpeta)) {
                mkdir($rutaCarpeta, 0777, true);
            }

            // Busca el registro actual en la base de datos
            $registroExistente = Membrete::findOne(['clave' => $nombreArchivo]);

            // Elimina el archivo físico si ya existe
            if ($registroExistente && file_exists(Yii::getAlias('@webroot/') . $registroExistente->ruta)) {
                unlink(Yii::getAlias('@webroot/') . $registroExistente->ruta);
            }

            // Si hay un registro existente, actualízalo; de lo contrario, crea uno nuevo
            $model = $registroExistente ?: new Membrete();

            // Guarda el nuevo archivo en la carpeta destino
            if ($archivo->saveAs($rutaCompleta)) {
                // Actualiza los datos en el modelo
                $model->clave = $nombreArchivo;
                $model->ruta = 'uploads/membrete/' . $nombreArchivo;

                if ($model->save()) {
                    return [
                        'success' => true,
                        'message' => 'Imagen subida y guardada correctamente.',
                        'ruta' => $model->ruta,
                    ];
                } else {
                    return [
                        'success' => false,
                        'message' => 'Error al guardar en la base de datos.',
                    ];
                }
            } else {
                return [
                    'success' => false,
                    'message' => 'No se pudo guardar el archivo en el servidor.',
                ];
            }
        }

        return [
            'success' => false,
            'message' => 'No se recibió ningún archivo válido.',
        ];
    }
}
