<?php

namespace app\controllers;

use Yii;
use app\models\Meses;
use app\models\Pagos;
use app\models\Partidas;
use app\models\Calles;
use app\models\Colonos;
use app\models\Talones;
use yii\web\Controller;
use app\models\Inmuebles;
use app\models\Ejercicios;
use app\components\Alertas;

use app\models\DetallePagos;
use app\models\PagosSearch;
use yii\filters\VerbFilter;
use app\models\InmueblesColonos;
use yii\web\NotFoundHttpException;

/**
 * PagosController implements the CRUD actions for Pagos model.
 */
class PagosController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Pagos models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PagosSearch();
        $inmuebleColono=new InmueblesColonos();
        $colono=new Colonos();
        $arrMeses=Meses::lista();
        $arrEjercicios=Ejercicios::lista();
        
        if (isset($_GET['idInmuebleColono'])) {
            $searchModel->idInmuebleColono= $_GET['idInmuebleColono'];
            $inmuebleColono=InmueblesColonos::findOne($_GET['idInmuebleColono']);
            $colono=colonos::findOne($inmuebleColono->idColono);
        }

        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'inmuebleColono'=>$inmuebleColono,
            'colono'=>$colono,
            'arrMeses'=>$arrMeses,
            'arrEjercicios'=>$arrEjercicios,
        ]);
    }

    /**
     * Displays a single Pagos model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Pagos model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $ultimoPago = (new DetallePagos())->ultimaPagoRegistrado(1);
        
        $talonActivo = (new Talones())->findOne(Yii::$app->session->get('idTalon'));

        $idInmuebleColono=0;

        $model = new Pagos();
        $model->idPartida = Pagos::_VIGILANCIA;
        $model->numeroMensualidades = 1;
        $model->fecha = date('Y-m-d');
        $model->idUsuario=Yii::$app->session->get('idUsuario');

        $siguienteFolio = (new Pagos())->siguienteFolio($talonActivo);
        
        if($siguienteFolio > $talonActivo->folioFinal ){
            $siguienteFolio = 0; // Cero indicara que ya se usaron todos los folios del talon
            // Cerramos ese bloque, se han terminado los talones/folios
            $talonActivo->estatus=Talones::_CERRADO;
            $talonActivo->save();
            
        } else {
            $model->idTalon = $talonActivo->id;
        }

        $model->folio = $siguienteFolio;

        $colono=new Colonos();

        $arrColonos=(new Colonos())->lista();

        $arrInmuebles=[];

        $arrTalones=(new Talones())->lista();

        $arrMeses = [];

        if (isset($_GET['idInmuebleColono']) && $_GET['idInmuebleColono'] > 0) {
            $idInmuebleColono= $_GET['idInmuebleColono'];
            $inmuebleColono=InmueblesColonos::findOne($idInmuebleColono);

            $colono=Colonos::findOne($inmuebleColono->idColono);
            $arrColonos=(new Colonos())->listaSoloColono($colono->id);
            $arrInmuebles=(new InmueblesColonos())->infoInmueble($idInmuebleColono);
        }

        if ($model->load(Yii::$app->request->post())) {
            $connection = \Yii::$app->db;
            $transaction = $connection-> beginTransaction();
            
            try {
                $model->idUsuario=Yii::$app->session->get('idUsuario');

                // Registrar pago

                if(!$model->validate()) {
                   $mensaje = "Complete los datos del recibo de pago"; 
                   Alertas::setFlash("error", "create", $mensaje);
                } else {
                    
                    $model->save();

                    $montoPorMensualidad = $model->total / $model->numeroMensualidades;

                    for ($i=1; $i <=$model->numeroMensualidades ; $i++) { 
                        $detallePago = new DetallePagos();
                        
                        $ultimoPagoRealizado = (new DetallePagos())->ultimaPagoRegistrado($model->idInmuebleColono);

                        if($ultimoPagoRealizado ){
                            // Retorna [idMes, ejercicio]
                            
                            $siguientePeriodoAPagar = (new Meses())->getNextMonthAndExercise(
                                $ultimoPagoRealizado->idMes,
                                $ultimoPagoRealizado->idEjercicio0->numero
                            );

                        } else {

                            $mesInicioEnColonia = date("n",strtotime($model->idInmuebleColono0->fechaInicio));
                            $anioInicioEnColonia=date("Y",strtotime($model->idInmuebleColono0->fechaInicio));

                            // Se parte a partir de la fecha de inicio del colono en el inmueble en proceso

                            $siguientePeriodoAPagar = [
                                "mes" =>$mesInicioEnColonia,
                                "ejercicio" =>$anioInicioEnColonia
                            ];
                        }

                        $ejercicio = (new Ejercicios())->find()->where([
                            'numero' => $siguientePeriodoAPagar['ejercicio']
                        ])->one();

                        if(!$ejercicio) {
                            $ejercicio = (new Ejercicios())->crear(
                                $siguientePeriodoAPagar['ejercicio']
                            );
                        }

                        $detallePago->idPago=$model->id;
                        $detallePago->idMes=$siguientePeriodoAPagar['mes'];
                        $detallePago->idEjercicio=$ejercicio->id;

                        $detallePago->monto=$montoPorMensualidad;
                        $detallePago->estatus=DetallePagos::ESTATUS_ACTIVO;
                        $detallePago->observaciones=$model->observaciones;
                        
                        if(!$detallePago->validate()){
                           $fp=fopen("log.txt", "a+");
                           fwrite($fp, print_r($detallePago->getErrors(), true));
                           fclose($fp);
                        }
                        $detallePago->save();
                    }
                }

                // Dividir total recibido entre numero meses pagados

                // Registrar los detalles de pago

                $model->save();

                $transaction->commit();
                
                $msg="Pago registrado";
                Alertas::setFlash("success", "create", $msg);

            } catch (\Exception $e) {
                $msg="Ocurrio un error al intentar registrar el pago";
                Alertas::setFlash("error", "create", $msg);
                $transaction->rollBack();
                throw $e;
            } catch (\Throwable $e) {
                $transaction->rollBack();
            }
            
            if (isset($inmuebleColono->id)) {
                return $this->redirect(['index', 'idInmuebleColono' => $inmuebleColono->id]);
            } else {
                return $this->redirect(['index']);
            }

        }

        return $this->render('create', [
            'model' => $model,
            'idInmuebleColono' => $idInmuebleColono,
            'arrColonos' => $arrColonos,
            'colono' => $colono,
            'arrTalones' => $arrTalones,
            'talonActivo' =>$talonActivo,
            'siguienteFolio' =>$siguienteFolio,
            'arrInmuebles' => $arrInmuebles,
            'arrMeses' => $arrMeses
        ]);
    }

    /**
     * Updates an existing Pagos model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Pagos model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Pagos model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Pagos the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Pagos::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionUltimoPago($idInmuebleColono){

        $ultimoPago = (new Pagos())->find()->where(
            [
                'idInmuebleColono'=>$idInmuebleColono,
                'estatus' => Pagos::ESTATUS_ACTIVO
            ]
        )->orderBy('fecha desc')->one();

        if($ultimoPago){
            // Obtener ultima mensualidad de este pago

            $ultimaMensualidad = (new DetallePagos())->find()->where([
                'idPago' => $ultimoPago->id,
                'estatus'=> DetallePagos::ESTATUS_ACTIVO
            ])->orderBy('idEjercicio desc, idMes desc')->one();

            $mes  = (new Meses())->texto($ultimaMensualidad->idMes);
            $ejercicio =  (new Ejercicios())->findOne($ultimaMensualidad->idEjercicio);
            $fecha = date('d-M-Y',strtotime($ultimaMensualidad->idPago0->fecha));

            $data = $fecha . " ".$mes. " de ".$ejercicio->numero." $ ".$ultimaMensualidad->monto;

            echo $data;
        } else {
            echo "Sin pagos";
        }

    }

    public function actionMesesPorPagar($idInmuebleColono) {
        // Obtener ultimo registro de pago
        
        $inmuebleColono = (new InmueblesColonos())->findOne($idInmuebleColono);
        $arrMesesPorPagar=[];

        $fechaBase = null;

        $ultimoPago = (new Pagos())->find()->where(
            [
                'idInmuebleColono'=>$idInmuebleColono
            ]
        )->one();

        // Si no existe ningun registro, entonces traemos el registro de inmuebleColono y nos basamos
        // en la fecha de inicio

        if(!$ultimoPago) {
            $model = (new InmueblesColonos())->findOne($idInmuebleColono);
            $fechaBase = $model->fechaInicio;
            
            $arrMeses= (new InmueblesColonos())->generarListaDeMeses($fechaBase,"iniciar");

        } else {
            
            // Para saber que mes pago, obtenemos
            // [idEjercicio] => 1
            // [idMes] => 1
            
            $fechaBase = (new InmueblesColonos())->formarFechaBase(
                $ultimoPago->idMes,
                $ultimoPago->idEjercicio
            );
            $arrMeses= (new InmueblesColonos())->generarListaDeMeses($fechaBase,"continuar");
        }

        echo "<option value='0'>Seleccione mes a pagar</option>";

        if (count($arrMeses) > 0) {

            foreach ($arrMeses as $id => $mes) {
                $mesTexto = (new Meses())->texto($mes);

                echo "<option value='" . $arrMeses[$id] . "'>" . $mesTexto . "</option>";
            }
        } else {
            echo "<option>-</option>";
        }

        // de ahi en adelante mostrar los meses restantes del año del ultimo registro de pago
    }

   
}
