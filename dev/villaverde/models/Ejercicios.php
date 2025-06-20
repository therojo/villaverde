<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "Ejercicios".
 *
 * @property int $id
 * @property string $numero
 * @property string $observaciones
 * @property string $estatus
 * @property int $idUsuario
 *
 * @property Usuarios $usuario
 * @property Pagos[] $pagos
 */
class Ejercicios extends \yii\db\ActiveRecord
{
    
    const _ACTIVO='activo';
    const _INACTIVO='inactivo';
    
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'Ejercicios';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['estatus', 'idUsuario'], 'required'],
            [['numero'], 'required','message'=>"Capture el ejercicio que desea dar de alta"],
            [['estatus'], 'string'],
            [['idUsuario'], 'integer'],
            [['numero'], 'string', 'max' => 45],
            [['observaciones'], 'string', 'max' => 100],
            [['numero'], 'unique','message'=>'Este ejercicio ya existe'],
            [['idUsuario'], 'exist', 'skipOnError' => true, 'targetClass' => Usuarios::className(), 'targetAttribute' => ['idUsuario' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'numero' => 'Numero',
            'observaciones' => 'Observaciones',
            'estatus' => 'Estatus',
            'idUsuario' => Yii::t('app', 'Usuario')
        ];
    }

    /**
     * Crear un ejercicio determinado
     * 
     */
    public function crear($ejercicio){
        $model = new Ejercicios();
        $model->numero = $ejercicio;
        $model->estatus='activo';
        $model->idUsuario = 1;

        $model->save();

        return $model;

    }

    /**
     * Undocumented function
     *
     * @return void
     */
    public function lista()
    {
        $arr = ArrayHelper::map(
            Ejercicios::find()
            // ->where(['idEstado'=>$idEstado])
                ->orderBy(['numero'=>SORT_DESC])
                ->all(),
            'id',
            'numero'
        );

        return $arr;
        
    }

    /**
     * Obtener el ejercicio activo al momento
     *
     * @return void
     */
    public function activoActual()
    {
        $activoActual= new Ejercicios();

        $activoActual = Ejercicios::find()->where(
            [
                'estatus' => Ejercicios::_ACTIVO
            ]
        )->one();

        return $activoActual;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdUsuario0()
    {
        return $this->hasOne(Usuarios::className(), ['id' => 'idUsuario']);
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPagos()
    {
        return $this->hasMany(Pagos::className(), ['idEjercicio' => 'id']);
    }
}
