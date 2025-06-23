<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "Egresos".
 *
 * @property int $id
 * @property string|null $fecha
 * @property float|null $total
 * @property string|null $descripcion
 * @property string|null $estatus
 * @property string $createdAt
 * @property int $idPartida
 * @property int $idUsuario
 *
 * @property Partidas $idPartida0
 * @property Usuarios $idUsuario0
 */
class Egresos extends \yii\db\ActiveRecord
{

    const _PAGADO ='pagado';
    const _CANCELADO ='cancelado';
    /**
     * ENUM field values
     */
    const ESTATUS_PAGADO = 'pagado';
    const ESTATUS_CANCELADO = 'cancelado';

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'Egresos';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['fecha', 'total', 'descripcion'], 'default', 'value' => null],
            [['estatus'], 'default', 'value' => 'pagado'],
            [['fecha', 'createdAt'], 'safe'],
            [['total'], 'number'],
            [['estatus'], 'string'],
            [['idPartida', 'idUsuario'], 'required'],
            [['idPartida', 'idUsuario'], 'integer'],
            [['descripcion'], 'string', 'max' => 250],
            ['estatus', 'in', 'range' => array_keys(self::optsEstatus())],
            [['idPartida'], 'exist', 'skipOnError' => true, 'targetClass' => Partidas::class, 'targetAttribute' => ['idPartida' => 'id']],
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
            'fecha' => 'Fecha',
            'total' => 'Total',
            'descripcion' => 'Descripcion',
            'estatus' => 'Estatus',
            'createdAt' => 'Created At',
            'idPartida' => 'Partida',
            'idUsuario' => 'Usuario',
        ];
    }

    /**
     * Gets query for [[IdPartida0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIdPartida0()
    {
        return $this->hasOne(Partidas::class, ['id' => 'idPartida']);
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


    /**
     * column estatus ENUM value labels
     * @return string[]
     */
    public static function optsEstatus()
    {
        return [
            self::ESTATUS_PAGADO => 'pagado',
            self::ESTATUS_CANCELADO => 'cancelado',
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
    public function isEstatusPagado()
    {
        return $this->estatus === self::ESTATUS_PAGADO;
    }

    public function setEstatusToPagado()
    {
        $this->estatus = self::ESTATUS_PAGADO;
    }

    /**
     * @return bool
     */
    public function isEstatusCancelado()
    {
        return $this->estatus === self::ESTATUS_CANCELADO;
    }

    public function setEstatusToCancelado()
    {
        $this->estatus = self::ESTATUS_CANCELADO;
    }
}
