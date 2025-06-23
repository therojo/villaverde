<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "Partidas".
 *
 * @property int $id
 * @property string|null $nombre
 * @property string|null $descripcion
 * @property string $createdAt
 *
 * @property Pagos[] $pagos
 */
class Partidas extends \yii\db\ActiveRecord
{

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'Partidas';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nombre', 'descripcion'], 'default', 'value' => null],
            [['createdAt'], 'safe'],
            [['nombre'], 'string', 'max' => 100],
            [['descripcion'], 'string', 'max' => 250],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nombre' => 'Nombre',
            'descripcion' => 'Descripcion',
            'createdAt' => 'Created At',
        ];
    }

    public function lista(){
        $arr = ArrayHelper::map(
            Partidas::find()
            // ->where(['idEstado'=>$idEstado])
            ->select(['id', 'nombre'])
            ->orderBy('nombre')
            ->all(),
            'id',
            'nombre'
        );

        return $arr;
    }
    /**
     * Gets query for [[Pagos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPagos()
    {
        return $this->hasMany(Pagos::class, ['idPartida' => 'id']);
    }

}
