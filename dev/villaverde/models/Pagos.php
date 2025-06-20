<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "Pagos".
 *
 * @property int $id
 * @property string $fecha
 * @property double $total
 * @property int $folio
 * @property string $estatus
 * @property int $numeroMensualidades
 * @property string|null $observaciones
 * @property string $createdAt
 * @property string $updatedAt
 * @property int $idTalon
 * @property int $idPartida
 * @property int $idMes
 * @property int $idUsuario
 * @property int|null $idCondonacion
 * @property int $idInmuebleColono
 *
 * @property InmueblesColonos $inmuebleColono
 * @property Talones $talon
 * @property Meses $mes
 * @property Usuarios $usuario
 
 * @property DetallePagos[] $detallePagos
 * @property Condonaciones $idCondonacion0
 * @property Ejercicios $idEjercicio0 
 * @property InmueblesColonos $idInmuebleColono0
 * @property idPartidas $idPartida0
 * @property Talones $idTalon0
 * @property Usuarios $idUsuario0
 */
class Pagos extends \yii\db\ActiveRecord
{
    const _VIGILANCIA =1;
    
    public $idColono;
    public $idCalle;
    public $ejercicio;
    public $idInmueble;
    public $idMes;

    /**
	* ENUM field values
	*/
	const ESTATUS_ACTIVO = 'activo';
	const ESTATUS_CANCELADO = 'cancelado';

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'Pagos';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['observaciones', 'idCondonacion'], 'default', 'value' => null],
            [['estatus'], 'default', 'value' => 'activo'],
            [['fecha', 'folio', 'total', 'idPartida','idTalon', 'idUsuario', 'idInmuebleColono'], 'required'],
            [
                [
                    'folio', 'idPartida','idTalon', 'idUsuario',
                    'idCondonacion', 'idInmuebleColono','numeroMensualidades'
                ],
                'integer'
            ],
            [['fecha', 'createdAt', 'updatedAt'], 'safe'],
            [['total'], 'number'],

            [['idInmueble'], 'integer'],
            [['observaciones'], 'string', 'max' => 100],

            ['estatus', 'in', 'range' => array_keys(self::optsEstatus())],

            [['idCondonacion'], 'exist', 'skipOnError' => true, 'targetClass' => Condonaciones::class, 'targetAttribute' => ['idCondonacion' => 'id']],
            [['idInmuebleColono'], 'exist', 'skipOnError' => true, 'targetClass' => InmueblesColonos::class, 'targetAttribute' => ['idInmuebleColono' => 'id']],
            [['idTalon'], 'exist', 'skipOnError' => true, 'targetClass' => Talones::class, 'targetAttribute' => ['idTalon' => 'id']],
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
            'monto' => 'Total',
            'folio' => 'Folio',
            'estatus' => 'Estatus', 
		    'total' => 'Total', 
            'observaciones' => 'Observaciones',
            'numeroMensualidades' => '# Mensualidades',
            
            'createdAt' => 'Created At',
		    'updatedAt' => 'Updated At',
		    'idTalon' => 'Talón',
		    'idPartida' => 'Partida',
            'idMes' => 'Mes',
            'idColono' => 'Colono',
            'idEjercicio' => 'Ejercicio',
            'idCondonacion' => 'Condonacion',
		    'idInmuebleColono' => 'Inmueble',
        ];
    }

    /**
     * Obtener el ultimo recibo usado de un determinado Talon
     * si no hay ninguno, entonces seria el # 1
     */
    public function siguienteFolio($talon){
        
        $folioActual = (new Pagos())->find()->where([
            'idTalon' => $talon->id
        ])->max('folio');
        
        $siguiente =  !$folioActual?1:$folioActual+1;

        return $siguiente;
    }
    /**
     * Obtener el numero de recibos usados 
     * de un determinado talon
     */
    public function recibosPorTalon($talon) {
        $usados = Pagos::find()->where(['idTalon' => $talon->id])->count();

        return $usados;
    }

    /**
    * Gets query for [[DetallePagos]].
    *
    * @return \yii\db\ActiveQuery
    */
    public function getDetallePagos()
    {
        return $this->hasMany(DetallePagos::class, ['idPago' => 'id']);
    }

    /**
    * Gets query for [[IdCondonacion0]].
    *
    * @return \yii\db\ActiveQuery
    */
    public function getIdCondonacion0()
    {
        return $this->hasOne(Condonaciones::class, ['id' => 'idCondonacion']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdMes0()
    {
        return $this->hasOne(Meses::className(), ['id' => 'idMes']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdInmuebleColono0()
    {
        return $this->hasOne(InmueblesColonos::className(), ['id' => 'idInmuebleColono']);
    }

     /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdPartida0()
    {
        return $this->hasOne(Partidas::className(), ['id' => 'idPartida']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdTalon0()
    {
        return $this->hasOne(Talones::className(), ['id' => 'idTalon']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdUsuario0()
    {
        return $this->hasOne(Usuarios::className(), ['id' => 'idUsuario']);
    }


    /**
     * column estatus ENUM value labels
     * @return string[]
     */
    public static function optsEstatus()
    {
        return [
            self::ESTATUS_ACTIVO => 'activo',
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
    public function isEstatusCancelado()
    {
        return $this->estatus === self::ESTATUS_CANCELADO;
    }

    public function setEstatusToCancelado()
    {
        $this->estatus = self::ESTATUS_CANCELADO;
    }
}
