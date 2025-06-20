<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "Inmuebles".
 *
 * @property int $id
 * @property int $numero
 * @property string $numeroInterior
 * @property string $created_at
 * @property string $observaciones
 * @property string $asignado
 * @property string $tipo
 * @property int $idCalle
 * @property int $idUsuario
 *
 * @property InmueblesColonos[] $InmueblesColonos
 * @property Calles $calle
 * @property Usuarios $usuario
 */
class Inmuebles extends \yii\db\ActiveRecord
{
    
    const _ASIGNADO='si';
    const _NOASIGNADO='no';

    public $idColonoActivo;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'Inmuebles';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['numero', 'idCalle', 'idUsuario'], 'required'],
            [['numero', 'idCalle', 'idUsuario'], 'integer'],
            [['idColonoActivo'], 'integer'], // Solo para mostrar que colono lo habita
            [['created_at'], 'safe'],
            [['asignado'], 'string'],
            [['tipo'], 'string'],
            [['numeroInterior'], 'string', 'max' => 45],
            [['observaciones'], 'string', 'max' => 150],
            [['idCalle'], 'exist', 'skipOnError' => true, 'targetClass' => Calles::className(), 'targetAttribute' => ['idCalle' => 'id']],
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
            'numero' => 'Número',
            'numeroInterior' => 'Número Interior',
            'created_at' => 'Fecha Registro',
            'observaciones' => 'Observaciones',
            'asignado' => 'Asignado',
            'tipo' => 'Tipo',
            'idCalle' => Yii::t('app', 'idCalle'),
            'idUsuario' => Yii::t('app', 'idUsuario'),
        ];
    }

    /**
     * Obtener la direccion completa de un domicilio
     * Ejem Morelos 123 interior 2
     * @return void
     */
    public function fullAddress()
    {
        $domicilio=$this->idCalle0->nombre;
        $domicilio.=" ".$this->numero;

        if (isset($this->numeroInterior)) {
            $domicilio.="( int ".$this->numeroInterior.")";
        }

        return $domicilio;
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInmueblesColonos()
    {
        return $this->hasMany(InmueblesColonos::className(), ['idInmueble' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdCalle0()
    {
        return $this->hasOne(Calles::className(), ['id' => 'idCalle']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdUsuario0()
    {
        return $this->hasOne(Usuarios::className(), ['id' => 'idUsuario']);
    }
}
