<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "Parametros".
 *
 * @property int $id
 * @property int|null $cuota
 * @property string|null $estatus
 * @property string $createdAt
 * @property string $updatedAt
 */
class Parametros extends \yii\db\ActiveRecord
{

    /**
     * ENUM field values
     */
    const ESTATUS_ACTIVO = 'activo';
    const ESTATUS_INACTIVO = 'inactivo';

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'Parametros';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['cuota', 'estatus'], 'default', 'value' => null],
            [['cuota'], 'integer'],
            [['estatus'], 'string'],
            [['createdAt', 'updatedAt'], 'safe'],
            ['estatus', 'in', 'range' => array_keys(self::optsEstatus())],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'cuota' => 'Cuota',
            'estatus' => 'Estatus',
            'createdAt' => 'Created At',
            'updatedAt' => 'Updated At',
        ];
    }


    /**
     * column estatus ENUM value labels
     * @return string[]
     */
    public static function optsEstatus()
    {
        return [
            self::ESTATUS_ACTIVO => 'activo',
            self::ESTATUS_INACTIVO => 'inactivo',
        ];
    }

    /**
     * @return string
     */
    public function displayEstatus()
    {
        return self::optsEstatus()[$this->estatus];
    }

    /**
     * @return bool
     */
    public function isEstatusActivo()
    {
        return $this->estatus === self::ESTATUS_ACTIVO;
    }

    public function setEstatusToActivo()
    {
        $this->estatus = self::ESTATUS_ACTIVO;
    }

    /**
     * @return bool
     */
    public function isEstatusInactivo()
    {
        return $this->estatus === self::ESTATUS_INACTIVO;
    }

    public function setEstatusToInactivo()
    {
        $this->estatus = self::ESTATUS_INACTIVO;
    }
}
