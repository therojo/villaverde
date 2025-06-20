<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "Usuarios".
 *
 * @property int $id
 * @property string $username
 * @property string $createdAt
 * @property string $estatus
 * @property string $password
 * @property string $tipo
 * @property int $idColono
 *
 * @property InmueblesColonos[] $InmueblesColonos
 * @property Inmuebles[] $inmuebles
 * @property Pagos[] $pagos
 * @property Colonos $colono
 */
class Usuarios extends \yii\db\ActiveRecord
{
    
    const _COLONO='colono';
    const _ADMIN='admin';

    const _ACTIVO='activo';
    const _INACTIVO='inactivo';
    
    public $confirmPassword;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'Usuarios';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['username', 'createdAt', 'estatus', 'password', 'tipo', 'idColono'], 'required'],
            [['estatus', 'tipo'], 'string'],
            [['idColono'], 'integer'],
            [['username', 'createdAt'], 'string', 'max' => 45],
            [['password'], 'string', 'max' => 70],
            [['username'], 'unique'],
            [['idColono'], 'exist', 'skipOnError' => true, 'targetClass' => Colonos::className(), 'targetAttribute' => ['idColono' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'createdAt' => 'Fecha Registro',
            'estatus' => 'Estatus',
            'password' => 'Password',
            'tipo' => 'Tipo',
            'idColono' => Yii::t('app', 'idColono')
        ];
    }

    public function colonosConUsuario()
    {
        $colonos = Usuarios::find()
        // ->where(['idEstado'=>$idEstado])
            ->select(['idColono'])
            ->asArray()->all();
        $arr = [];

        foreach ($colonos as $colono) {
            $arr[] = $colono['idColono'];
        }

        return $arr;
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInmueblesColonos()
    {
        return $this->hasMany(InmueblesColonos::className(), ['idUsuario' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInmuebles()
    {
        return $this->hasMany(Inmuebles::className(), ['idUsuario' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPagos()
    {
        return $this->hasMany(Pagos::className(), ['idUsuario' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdColono0()
    {
        return $this->hasOne(Colonos::className(), ['id' => 'idColono']);
    }
}
