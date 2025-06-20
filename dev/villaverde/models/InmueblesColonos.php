<?php

namespace app\models;

use yii\helpers\ArrayHelper;

use Yii;

/**
 * This is the model class for table "InmueblesColonos".
 *
 * @property int $id
 * @property string $createdAt
 * @property string $fechaInicio
 * @property string $fechaSalidaColonia
 * @property string $estatus
 * @property string $alCorriente
 * @property int $idColono
 * @property int $idInmueble
 * @property int $idUsuario
 *
 * @property Autos[] $autos
 * @property Colonos $colono
 * @property Inmuebles $inmueble
 * @property Usuarios $usuario
 * @property Notas[] $notas
 * @property Pagos[] $pagos
 */
class InmueblesColonos extends \yii\db\ActiveRecord
{
    const _ACTIVO='activo';
    const _INACTIVO='inactivo';
    
    public $idCalle;
    public $numero;
    public $numeroInterior;
    public $nombreDelColono;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'InmueblesColonos';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['createdAt', 'fechaSalidaColonia'], 'safe'],
            [['fechaInicio','estatus', 'alCorriente', 'idColono', 'idInmueble', 'idUsuario'], 'required'],
            [['estatus', 'alCorriente'], 'string'],
            [['nombreDelColono'], 'string'], // usado para busqueda solamente
            [['idColono', 'idInmueble', 'idUsuario','idCalle'], 'integer'],
            [['idColono'], 'exist', 'skipOnError' => true, 'targetClass' => Colonos::className(), 'targetAttribute' => ['idColono' => 'id']],
            [['idInmueble'], 'exist', 'skipOnError' => true, 'targetClass' => Inmuebles::className(), 'targetAttribute' => ['idInmueble' => 'id']],
            [['idUsuario'], 'exist', 'skipOnError' => true, 'targetClass' => Usuarios::className(), 'targetAttribute' => ['idUsuario' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'fechaInicio' => 'Fecha de inicio',
            'createdAt' => 'Fecha de Registro',
            'fechaSalidaColonia' => 'Fecha Salida Colonia',
            'estatus' => 'Estatus',
            'alCorriente' => 'Al Corriente',
            'nombreDelColono' => 'Colono',
            'idColono' => Yii::t('app', 'idColono'),
            'idInmueble' => Yii::t('app', 'idInmueble'),
            'idUsuario' => 'Id Usuario',
            'idCalle' => Yii::t('app', 'idCalle'),
        ];
    }

    public function listaColono($idColono)
    {

        $arr= ArrayHelper::map(
            InmueblesColonos::find()->joinWith([
            'idColono0', 'idInmueble0.idCalle0'
            ])->select(
                [
                    'InmueblesColonos.id, 
                    concat(Calles.nombre, " ",Inmuebles.numero) idCalle'
                ]
            )->where(
                [
                    'idColono' => $idColono,
                    'InmueblesColonos.estatus' => InmueblesColonos::_ACTIVO
                ]
            )
            ->orderBy('Calles.nombre')
            ->all(),
            'id',
            'idCalle'
        );

       
        return $arr;
    }

    public function inmueblesPorCalle($idCalle){
        $sql="select 
            inmucol.id as idInmuebleColono, c.nombre as calle, inmu.numero, colo.nombre as colono
            from InmueblesColonos inmucol
            left join Colonos colo on inmucol.idColono =  colo.id
            left join Inmuebles inmu on inmucol.idInmueble = inmu.id
            left join Calles c on inmu.idCalle = c.id
            where inmu.idCalle = $idCalle
            and inmucol.estatus ='activo' 
            order by numero            
        ";

        $data= Yii::$app->db->createCommand($sql)->queryAll();

        return $data;
        
    }

    /**
    * Informacion especifica de un inmueble dado
    * @author Rojo <guillermo.rojo@sazacatecas.gob.mx>
    *
    * @return void
    */
    public function infoInmueble($idInmuebleColono)
    {
        $arr= ArrayHelper::map(
            InmueblesColonos::find()->joinWith([
            'idColono0', 'idInmueble0.idCalle0'
            ])->select(
                [
                    'InmueblesColonos.id, 
                    concat(Calles.nombre, " ",Inmuebles.numero) idCalle'
                ]
            )->where(
                [
                    'InmueblesColonos.id'=> $idInmuebleColono,
                    'InmueblesColonos.estatus' => InmueblesColonos::_ACTIVO
                ]
            )->all(),
            'id',
            'idCalle'
        );

        return $arr;
    }
    /**
    * Ver si un inmueble esta registrado en inmueble colonos
    * es decir asociado a un colono
    * @author Rojo <guillermo.rojo@sazacatecas.gob.mx>
    *
    * @return void
    */
    public function existe($idInmueble)
    {
        $model=InmueblesColonos::findOne($idInmueble);

        if ($model) {
            return true;
        }

        return false;
    }

    /**
     * Ver si un  inmueble esta asignado y traer
     * los datos del colono actual en ese inmueble
     */
    public function buscarColonoActivo($idInmueble) {
        
        $model = new InmueblesColonos();

        $model=InmueblesColonos::find($idInmueble)->where([
            'idInmueble' => $idInmueble,
            'estatus'=>InmueblesColonos::_ACTIVO
        ])->one();

        return $model;
        
    }
    
    public function formarFechaBase($idMes, $idEjercicio){
        $modelMes = (new Meses())->findOne($idMes);
        $modelEjercicio = (new Ejercicios())->findOne($idEjercicio);

        $mes=$modelMes->id;

        if($modelMes->id <=9) {
            $mes = "0".$mes;
        }        
        
        $fecha = $modelEjercicio->numero."-".$mes."-01";

        return $fecha;
    }

    /**
     * Accion = iniciar => inicio de colono, , continuar=> al menos tiene un registro de pago
     * Base de calculo de meses que puede pagar
     */
    function generarListaDeMeses($fechaBase, $accion){
        if($accion=="iniciar"){
            $mesBase=date("m",strtotime($fechaBase)) * 1;
        }else {
            $mesBase=(date("m",strtotime($fechaBase)) * 1) + 1;
        }

        $ejercicio=date("Y",strtotime($fechaBase)) * 1;

        $meses=[];

        for ($i=$mesBase; $i <= 12; $i++) { 
            $meses[$ejercicio.$i] = $i;
        }

        return $meses;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAutos()
    {
        return $this->hasMany(Autos::className(), ['idInmuebleColono' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdColono0()
    {
        return $this->hasOne(Colonos::className(), ['id' => 'idColono']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdInmueble0()
    {
        return $this->hasOne(Inmuebles::className(), ['id' => 'idInmueble']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdUsuario0()
    {
        return $this->hasOne(Usuarios::className(), ['id' => 'idUsuario']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNotas()
    {
        return $this->hasMany(Notas::className(), ['idInmuebleColono' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPagos()
    {
        return $this->hasMany(Pagos::className(), ['idInmuebleColono' => 'id']);
    }
}
