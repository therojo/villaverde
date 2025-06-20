<?php

namespace app\components;

use Yii;
use yii\base\Widget;
use kartik\growl\Growl;

class Alertas extends Widget
{
    public $type; //success, error

    public $action; //create, update, delete

    public $body = ''; //cuerpo del mensaje - opcional

    public $data = []; //opciones del widget

    //Mensajes de success
    const SUCESS_CREATE = 'El Registro se Creó correctamente.';
    const SUCESS_UPDATE = 'El Registro se Actualizó correctamente.';
    const SUCESS_DELETE = 'El Registro se cancelo correctamente.';
    const SUCCESS_CUSTOM = 'Operación exitosa';

    //Mensajes de error
    const ERROR_CREATE = 'Ocurrio un error al Crear el registro, comuniquese con el administrador del sistema.';
    const ERROR_UPDATE = 'Ocurrio un error al Actualizar el registro, comuniquese con el administrador del sistema.';
    const ERROR_DELETE = 'Ocurrio un error al Eliminar el registro, comuniquese con el administrador del sistema.';
    const ERROR_EXCEPTION = 'Ocurrio un error inesperado, Comuniquese con el administrador del sistema.';

    public function init()
    {
        parent::init();
    }

    public function run()
    {
        //Contenido del growl
        $this->createFlash();

        //Opciones del growl widget
        $this->initOptions();

        //Registro del widget
        echo Growl::widget($this->data);

    }

    public static function setFlash($type, $action, $body=null)
    {
        Yii::$app->getSession()->setFlash($type, [
            'type' => $type,
            'action' => $action,
            'body' => $body
        ]);
    }

    private function initOptions()
    {
        $this->data = array_merge([
            'showSeparator' => true,
            'delay' => 1, //This delay is how long before the message shows
            'pluginOptions' => [
                'showProgressbar' => true,
                'delay' => 3000, //This delay is how long the message shows for
                'placement' => [
                    'from' => 'top',
                    'align' => 'right',
                ]
            ]
        ], $this->data);
    }

    private function createFlash()
    {
        if ($this->type == 'success') {
            $this->data = [
                'type' => 'success',
                'icon' =>  'glyphicon glyphicon-ok-sign',
                'title' => 'Operacion Exitosa!'
            ];

            if ($this->action == 'create') {
                $this->data['body'] = $this->body==''?SELF::SUCESS_CREATE:$this->body;
            } elseif ($this->action == 'update') {
                $this->data['body'] = $this->body==''?SELF::SUCESS_UPDATE:$this->body;
            } elseif ($this->action == 'delete') {
                $this->data['body'] = $this->body==''?SELF::SUCESS_DELETE:$this->body;
            } elseif ($this->action == 'custom') {
                $this->data['body'] = $this->body==''?SELF::SUCESS_CUSTOM:$this->body;
            }
        } elseif ($this->type == 'error') {
            $this->data = [
                'type' => 'danger',
                'icon' =>  'glyphicon glyphicon-remove-sign',
                'title' => 'Operacion No Válida!'
            ];

            if ($this->action == 'create') {
                $this->data['body'] = $this->body==''?SELF::ERROR_CREATE:$this->body;
            } elseif ($this->action == 'update') {
                $this->data['body'] = $this->body==''?SELF::ERROR_UPDATE:$this->body;
            } elseif ($this->action == 'delete') {
                $this->data['body'] = $this->body==''?SELF::ERROR_DELETE:$this->body;
            } elseif ($this->action == 'exception') {
                $this->data['body'] = $this->body==''?SELF::ERROR_EXCEPTION:$this->body;
            }
        }
    }
}
