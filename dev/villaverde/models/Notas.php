<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "Notas".
 *
 * @property int $id
 * @property string $fecha
 * @property string $descripcion
 * @property int $idInmuebleColono
 *
 * @property InmueblesColonos $inmuebleColono
 */
class Notas extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'Notas';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['fecha', 'descripcion', 'idInmuebleColono'], 'required'],
            [['fecha'], 'safe'],
            [['idInmuebleColono'], 'integer'],
            [['descripcion'], 'string', 'max' => 100],
            [['idInmuebleColono'], 'exist', 'skipOnError' => true, 'targetClass' => InmueblesColonos::className(), 'targetAttribute' => ['idInmuebleColono' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'fecha' => 'Fecha',
            'descripcion' => 'Descripcion',
            'idInmuebleColono' => 'Id Inmueble Colono',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInmuebleColono()
    {
        return $this->hasOne(InmueblesColonos::className(), ['id' => 'idInmuebleColono']);
    }
}
