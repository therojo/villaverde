<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "Colonos".
 *
 * @property int $id
 * @property string $nombre
 * @property string $apellido1
 * @property string $apellido2
 * @property string $telefono
 * @property string $email
 * @property string $createdAt
 * @property string $fechaSalida
 * @property string $estatus
 *
 * @property InmueblesColonos[] $InmueblesColonos
 */
class Colonos extends \yii\db\ActiveRecord
{
    const _ACTIVO = 'activo';
    const _INACTIVO = 'inactivo';
    
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'Colonos';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nombre', 'apellido1', 'estatus'], 'required'],
            [['createdAt', 'fechaSalida'], 'safe'],
            [['estatus'], 'string'],
            [['nombre', 'apellido1', 'apellido2'], 'string', 'max' => 45],
            // El campo nombre recibe el mensaje si nombre y apellidos ya existen
            // Se puede poner que aparezca en uno o mas campos, primera parte o array
            [
                ['nombre'],
                'unique', 
                'message' => 'El Colono ya esta registrado',
                'targetAttribute' => ['nombre', 'apellido1','apellido2']
            ],
            [['telefono'], 'string', 'max' => 20],
            [['email'], 'string', 'max' => 80],
            [['email'], 'email'],
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
            'apellido1' => 'Apellido1',
            'apellido2' => 'Apellido2',
            'telefono' => 'Telefono',
            'email' => 'Email',
            'createdAt' => 'Fecha de creacion ',
            'fechaSalida' => 'Fecha Salida',
            'estatus' => 'Estatus',
        ];
    }

    public function getFullName($id)
    {
        $model=Colonos::findOne($id);
        $nombreCompleto= $model->nombre.' '.$model->apellido1.' '.$model->apellido2;

        return $nombreCompleto;
    }

    public function lista(){
        $arr = ArrayHelper::map(
            Colonos::find()
            // ->where(['idEstado'=>$idEstado])
            ->select(['id', 'concat(nombre," ", apellido1," ", apellido2) nombre'])
            ->orderBy('nombre')
            ->all(),
            'id',
            'nombre'
        );

        return $arr;
    }

    public function listaUnico($idColono){
        $arr = ArrayHelper::map(
            Colonos::find()
            ->where(['id'=>$idColono])
            ->select(['id', 'concat(nombre," ", apellido1," ", apellido2) nombre'])
            ->orderBy('nombre')
            ->all(),
            'id',
            'nombre'
        );

        return $arr;
    }

    /**
    * Obtendremos la lista d ids de colono que no tienen usuario creado
    * @author Rojo <guillermo.rojo@sazacatecas.gob.mx>
    *
    * @return void
    */
    public function listaColonosSinUsuario()
    {
        $arrColonosSinUsuario = (new Usuarios)->colonosConUsuario();
        
        $arr = ArrayHelper::map(
            Colonos::find()->where(
                [
                    'not',
                    [
                        'id' => $arrColonosSinUsuario
                    ]
                ]
            )->all(),
            'id',
            'nombre'
        );
        
        return $arr;
    }


    /**
    * Solo mostrar el colono solicitado en formato arr  para el combo
    * @author Rojo <guillermo.rojo@sazacatecas.gob.mx>
    *
    * @return void
    */
    public function listaSoloColono($id)
    {
        $arr = ArrayHelper::map(
            Colonos::find($id)
                ->where(['id'=>$id])
                ->select(['id', 'concat(nombre," ", apellido1," ", apellido2) nombre'])
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
    public function getInmueblesColonos()
    {
        return $this->hasMany(InmueblesColonos::className(), ['idColono' => 'id']);
    }
}
