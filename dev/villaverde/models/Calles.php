<?php
namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "Calles".
 *
 * @property int $id
 * @property string $nombre
 *
 * @property Inmuebles[] $inmuebles
 */
class Calles extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'Calles';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nombre'], 'required'],
            [['nombre'], 'string', 'max' => 100],
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
        ];
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    public function lista()
    {
        $arr = ArrayHelper::map(
            Calles::find()
                // ->where(['idEstado'=>$idEstado])
                ->orderBy('nombre')
                ->all(),
            'id',
            'nombre'
        );

        return $arr;
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInmuebles()
    {
        return $this->hasMany(Inmuebles::className(), ['idCalle' => 'id']);
    }
}
