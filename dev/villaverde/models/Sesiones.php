<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "Sesiones".
 *
 * @property int $id
 * @property int $idTalon
 * @property int $idUsuario
 * @property string $createdAt
 *
 * @property Talones $idTalon0
 * @property Usuarios $idUsuario0
 */
class Sesiones extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'Sesiones';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idTalon', 'idUsuario'], 'required'],
            [['idTalon', 'idUsuario'], 'integer'],
            [['createdAt'], 'safe'],
            [['idTalon'], 'exist', 'skipOnError' => true, 'targetClass' => Talones::class, 'targetAttribute' => ['idTalon' => 'id']],
            [['idUsuario'], 'exist', 'skipOnError' => true, 'targetClass' => Usuarios::class, 'targetAttribute' => ['idUsuario' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'idTalon' => 'Id Talon',
            'idUsuario' => 'Id Usuario',
            'createdAt' => 'Created At',
        ];
    }

    /**
     * Gets query for [[IdTalon0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIdTalon0()
    {
        return $this->hasOne(Talones::class, ['id' => 'idTalon']);
    }

    /**
     * Gets query for [[IdUsuario0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIdUsuario0()
    {
        return $this->hasOne(Usuarios::class, ['id' => 'idUsuario']);
    }

}
