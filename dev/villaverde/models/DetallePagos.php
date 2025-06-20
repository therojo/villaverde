<?php

namespace app\models;

use Yii;
use app\models\Pagos;
use Mpdf\Tag\Details;

/**
 * This is the model class for table "DetallePagos".
 *
 * @property int $id
 * @property float|null $monto
 * @property string|null $estatus
 * @property string|null $observaciones
 * @property int $idPago
 * @property int $idMes
 * @property int $idEjercicio
 *
 * @property Ejercicios $idEjercicio0
 * @property Meses $idMes0
 * @property Pagos $idPago0
 */
class DetallePagos extends \yii\db\ActiveRecord
{

    public $fecha;
    public $idColono;
    public $idInmuebleColono;

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
        return 'DetallePagos';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['monto', 'estatus', 'observaciones'], 'default', 'value' => null],
            [['monto'], 'number'],
            [['estatus'], 'string'],
            [['idPago', 'idMes', 'idEjercicio'], 'required'],
            [['idPago', 'idMes', 'idEjercicio'], 'integer'],
            [['observaciones'], 'string', 'max' => 255],
            ['estatus', 'in', 'range' => array_keys(self::optsEstatus())],
            [['idEjercicio'], 'exist', 'skipOnError' => true, 'targetClass' => Ejercicios::class, 'targetAttribute' => ['idEjercicio' => 'id']],
            [['idMes'], 'exist', 'skipOnError' => true, 'targetClass' => Meses::class, 'targetAttribute' => ['idMes' => 'id']],
            [['idPago'], 'exist', 'skipOnError' => true, 'targetClass' => Pagos::class, 'targetAttribute' => ['idPago' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'monto' => 'Monto',
            'estatus' => 'Estatus',
            'observaciones' => 'Observaciones',
            'idPago' => 'Pago',
            'idMes' => 'Mes',
            'idEjercicio' => 'Ejercicio',
        ];
    }
    
    // Obtner el ultimo pago registrado para un inmueble dado
    public function ultimaPagoRegistrado($idInmuebleColono) {
        
        $model = null;

        $connection = Yii::$app->getDb();

        $ultimoPago = DetallePagos::find()->joinWith('idPago0')->where([
            'idInmuebleColono' => $idInmuebleColono,
            
        ])->orderBy('idEjercicio desc, id desc')->one();

        $sql = "select d.id, d.idPago, p.idInmuebleColono from Pagos  p
            left join DetallePagos d on p.id = d.idPago
            where p.idInmuebleColono = :idInmuebleColono
            and p.estatus ='activo'
            and d.estatus ='activo'
            order by d.idEjercicio desc, d.idMes desc
            limit 1";


        $command = $connection->createCommand($sql)->bindValue(':idInmuebleColono', $idInmuebleColono);

        $data = $command->queryOne();

        if($data) {
            $model = (new DetallePagos())->findOne($data['id']);
        }

        return $model;
    }

    //TODO: Este metodo no lo uso, numero ya no existe en detalle pagos

    public function siguienteFolioDeTalon($numero){
        $folioActual = (new DetallePagos())->find()->where([
            'numero' => $numero
        ])->max('numero');
        
        $siguiente =  !$folioActual?1:$folioActual+1;

        return $siguiente;
    }

    /**
     * Gets query for [[IdEjercicio0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIdEjercicio0()
    {
        return $this->hasOne(Ejercicios::class, ['id' => 'idEjercicio']);
    }

    /**
     * Gets query for [[IdMes0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIdMes0()
    {
        return $this->hasOne(Meses::class, ['id' => 'idMes']);
    }

    /**
     * Gets query for [[IdPago0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIdPago0()
    {
        return $this->hasOne(Pagos::class, ['id' => 'idPago']);
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
