<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "Talones".
 *
 * @property int $id
 * @property int $numero
 * @property string $nombre
 * @property int $folioInicial
 * @property int $folioFinal
 * @property string $estatus
 * @property string $created_at
 *
 * @property Pagos[] $pagos
 */
class Talones extends \yii\db\ActiveRecord
{
    
    const _ABIERTO='abierto';
    const _CERRADO='cerrado';

    public $disponibles;
    
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'Talones';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['numero', 'folioInicial', 'folioFinal'], 'required'],
            [['numero', 'folioInicial', 'folioFinal'], 'integer'],
            [['estatus'], 'string'],
            [['created_at'], 'safe'],
            [['nombre'], 'string', 'max' => 150],
            [['numero'], 'unique','message'=>'Este {attribute} de talon ya existe'],
            [['disponibles'], 'integer'], // Informativo, talones  aun disponibles

            ['folioFinal', 'compare', 'compareAttribute' => 'folioInicial', 'operator' => '>'],
            [['folioInicial', 'folioFinal'], 'compare', 'compareValue' => 0, 'operator' => '>'],
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
            'nombre' => 'Nombre ó descripción',
            'folioInicial' => 'Folio Inicial',
            'folioFinal' => 'Folio Final',
            'estatus' => 'Estatus',
            'disponibles'=>'Folios disponibles',
            'created_at' => 'Fecha de Registro',
        ];
    }

    /**
    * Lista de Talones de pago activos
    * @author Rojo <guillermo.rojo@sazacatecas.gob.mx>
    *
    * @return void
    */
    public function lista()
    {
        $arr = ArrayHelper::map(
            Talones::find()
                ->where(['estatus'=>'abierto'])
                ->orderBy('numero')
                ->all(),
            'id',
            'numero'
        );

        return $arr;
    }

     /**
     * Obtener el ultimo consecutivo utilizado
     * para formar el numero de Contrato
     *
     * @return void
     */
    public static function siguienteConsecutivo()
    {
        $consecutivoActual = (new Talones())->find()->max('numero');
        
        $siguiente=  !$consecutivoActual?1:$consecutivoActual+1;

        return $siguiente;
    }

     /**
     * Obtener el ultimo consecutivo utilizado
     * para formar el numero de Contrato
     *
     * @return void
     */
    public static function siguienteConsecutivos()
    {
        $model = (new Talones())->find()->where([
            'estatus' =>Talones::_ABIERTO
        ]);
        
        $siguiente=  $model->id;

        return $siguiente;
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPagos()
    {
        return $this->hasMany(Pagos::className(), ['idTalon' => 'id']);
    }
}
