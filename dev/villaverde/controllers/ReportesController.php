<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\Reportes;
use app\models\Calles;
use app\models\Chips;
use app\models\Pagos;
use app\models\Consultas;
use app\models\InmueblesColonos;
use yii\filters\VerbFilter;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class ReportesController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors() {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
            'access' => [
                'class' => \yii\filters\AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

     public function actionGeneral(){

        $model=new Reportes;
        $consultas = new Consultas();

        $meses = (new Reportes())->meses();

        // En la columna P pondremos el total del inmueble

        $totalesPorMes = (new Reportes())->matrizTotalesPorMes();


        $listaCalles = (new Calles())->find()->all();
        // $lista= $consultas->porCalle(1,1);

        // El 13 es el gran Total

        $spreadsheet = new Spreadsheet();
        $spreadsheet->getProperties()->setCreator("Villa Verde 2025")->setDescription("Reporte de Ingresos");
        $sheet = $spreadsheet->getActiveSheet();

        // $sheet->getStyle("A6:J6")->getAlignment()->setHorizontal('center');
        
        $sheet->getColumnDimension('A')->setWidth(30); //Definir el ancho de la columna
        $sheet->setCellValue('A1', 'Calle');

        $sheet->getColumnDimension('B')->setWidth(10);
        $sheet->setCellValue('B1', 'Número');
        
        $sheet->getColumnDimension('C')->setWidth(35);
        $sheet->setCellValue('C1', 'Colono');
        
        $sheet->getColumnDimension('D')->setWidth(15);
        $sheet->setCellValue('D1', 'Enero');
        
        $sheet->getColumnDimension('E')->setWidth(15);
        $sheet->setCellValue('E1', 'Febrero');
        
        $sheet->getColumnDimension('F')->setWidth(15);
        $sheet->setCellValue('F1', 'Marzo');
        
        $sheet->getColumnDimension('G')->setWidth(15);
        $sheet->setCellValue('G1', 'Abril');
        
        $sheet->getColumnDimension('H')->setWidth(15);
        $sheet->setCellValue('H1', 'Mayo');
        
        $sheet->getColumnDimension('I')->setWidth(15);
        $sheet->setCellValue('I1', 'Junio');
        
        $sheet->getColumnDimension('J')->setWidth(15);
        $sheet->setCellValue('J1', 'Julio');

        $sheet->getColumnDimension('K')->setWidth(15);
        $sheet->setCellValue('K1', 'Agosto');

        $sheet->getColumnDimension('L')->setWidth(15);
        $sheet->setCellValue('L1', 'Septiembre');

        $sheet->getColumnDimension('M')->setWidth(15);
        $sheet->setCellValue('M1', 'Octubre');

        $sheet->getColumnDimension('N')->setWidth(15);
        $sheet->setCellValue('N1', 'Noviembre');

        $sheet->getColumnDimension('O')->setWidth(15);
        $sheet->setCellValue('O1', 'Diciembre');

        $sheet->getColumnDimension('P')->setWidth(15);
        $sheet->setCellValue('P1', 'Total');

        $renglon = 2;
        $consecutivo = 1;
        
        $idColono = 0;
        $totalColono =0;

        /* foreach($listaCalles as $id => $calle) {
            $casas= (new InmueblesColonos())->inmueblesPorCalle($calle->id);

            foreach($casas as $id => $inmuebleColono) {
                $pagos = (new Consultas())->pagosPorInmueble($inmuebleColono["idInmuebleColono"], 1);
                
                echo "<pre>".print_r($pagos, true)."</pre>";
                die();
                
            }
        } */

        foreach($listaCalles as $id => $calle) {
            $casas= (new InmueblesColonos())->inmueblesPorCalle($calle->id);
            
            foreach($casas as $id => $inmuebleColono) {
                
                $sheet->setCellValue('A'.$renglon, $inmuebleColono['calle']);
                $sheet->setCellValue('B'.$renglon, $inmuebleColono['numero']);
                $sheet->setCellValue('C'.$renglon, $inmuebleColono['colono']);

                $pagos = (new Consultas())->pagosPorInmueble($inmuebleColono["idInmuebleColono"], 1);
                
                for($mes=1; $mes<=12; $mes++) {
                    
                    if(array_key_exists($mes, $pagos)) {
                        $sheet->setCellValue($meses[$pagos[$mes]["idMes"]].$renglon, $pagos[$mes]['monto']);   
                        $totalColono = $totalColono + $pagos[$mes]['monto'];
                    } else {
                          $sheet->setCellValue($meses[$mes].$renglon, 0);   
                    }
                }

                $sheet->setCellValue("P".$renglon, $totalColono);   
                $renglon ++;
                $totalColono = 0;
            }
            
        }
       
        $fileName="ingresos_2025".date("d_m_Y").".xlsx";

        $writer = new Xlsx($spreadsheet);
        $writer->save($fileName);
        $mostrar = $this->sendToBrowser($fileName, $fileName);
        
        die(); // Cerramos el Buffer o enviara un error de xls dañado
        
     }

     public function actionBloqueos(){
        
        $model = new Reportes();
        $dataProvider=null;

        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {
                
                $model=new Reportes;
                $consultas = new Consultas();

                $meses = (new Reportes())->meses();

                // En la columna P pondremos el total del inmueble

                $totalesPorMes = (new Reportes())->matrizTotalesPorMes();

                $listaCalles = (new Calles())->find()->all();
                // $lista= $consultas->porCalle(1,1);

                $inmueblesABloquear=[];
                $idInmueblesColonos=[];

                foreach($listaCalles as $id => $calle) {
                    $casas= (new InmueblesColonos())->inmueblesPorCalle($calle->id);
                    
                    foreach($casas as $id => $inmuebleColono) {
                        
                        $pagos = (new Consultas())->pagosPorInmueble($inmuebleColono["idInmuebleColono"], 1);
                        $mesesFaltantes = 0;

                        for($mes=1; $mes<=12; $mes++) {
                            
                            if(!array_key_exists($mes, $pagos)) {
                                $mesesFaltantes =$mesesFaltantes +1;
                            }

                        }

                        if($mesesFaltantes >= $model->mesesParaBloqueo){
                            $lista = (new Chips())->listaPorInmueble($inmuebleColono["idInmuebleColono"]);
                            
                            $inmueblesABloquear[$inmuebleColono["idInmuebleColono"]]=$lista;
                            $idInmueblesColonos[]=$inmuebleColono["idInmuebleColono"];
                        }
                        
                    }
                    
                }            
                
            }

            $dataProvider = (new Chips())->listaPorBloquear($idInmueblesColonos);
        }

        return $this->render('bloqueos', [
            'model' => $model,
            'dataProvider' =>$dataProvider
        ]);
    }

        public function actionBloqueosV1(){
            
            $lista = (new Chips())->listaPorInmueble(1);

            $model = new Reportes();

            if ($this->request->isPost) {
                if ($model->load($this->request->post())) {
                    
                    $model=new Reportes;
                    $consultas = new Consultas();

                    $meses = (new Reportes())->meses();

                    // En la columna P pondremos el total del inmueble

                    $totalesPorMes = (new Reportes())->matrizTotalesPorMes();

                    $listaCalles = (new Calles())->find()->all();
                    // $lista= $consultas->porCalle(1,1);

                    // El 13 es el gran Total

                    $spreadsheet = new Spreadsheet();
                    $spreadsheet->getProperties()->setCreator("Villa Verde 2025")->setDescription("Chips bloqueables");
                    $sheet = $spreadsheet->getActiveSheet();

                    // $sheet->getStyle("A6:J6")->getAlignment()->setHorizontal('center');
                    
                    $sheet->getColumnDimension('A')->setWidth(30); //Definir el ancho de la columna
                    $sheet->setCellValue('A1', 'Calle');

                    $sheet->getColumnDimension('B')->setWidth(10);
                    $sheet->setCellValue('B1', 'Número');
                    
                    $sheet->getColumnDimension('C')->setWidth(35);
                    $sheet->setCellValue('C1', 'Colono');
                    
                    $sheet->getColumnDimension('D')->setWidth(15);
                    $sheet->setCellValue('D1', 'Enero');
                    
                    $sheet->getColumnDimension('E')->setWidth(15);
                    $sheet->setCellValue('E1', 'Febrero');
                    
                    $sheet->getColumnDimension('F')->setWidth(15);
                    $sheet->setCellValue('F1', 'Marzo');
                    
                    $sheet->getColumnDimension('G')->setWidth(15);
                    $sheet->setCellValue('G1', 'Abril');
                    
                    $sheet->getColumnDimension('H')->setWidth(15);
                    $sheet->setCellValue('H1', 'Mayo');
                    
                    $sheet->getColumnDimension('I')->setWidth(15);
                    $sheet->setCellValue('I1', 'Junio');
                    
                    $sheet->getColumnDimension('J')->setWidth(15);
                    $sheet->setCellValue('J1', 'Julio');

                    $sheet->getColumnDimension('K')->setWidth(15);
                    $sheet->setCellValue('K1', 'Agosto');

                    $sheet->getColumnDimension('L')->setWidth(15);
                    $sheet->setCellValue('L1', 'Septiembre');

                    $sheet->getColumnDimension('M')->setWidth(15);
                    $sheet->setCellValue('M1', 'Octubre');

                    $sheet->getColumnDimension('N')->setWidth(15);
                    $sheet->setCellValue('N1', 'Noviembre');

                    $sheet->getColumnDimension('O')->setWidth(15);
                    $sheet->setCellValue('O1', 'Diciembre');

                    $sheet->getColumnDimension('P')->setWidth(15);
                    $sheet->setCellValue('P1', 'Total');

                    $sheet->getColumnDimension('Q')->setWidth(15);
                    $sheet->setCellValue('Q1', 'Chips a bloquear');

                    $renglon = 2;
                    $consecutivo = 1;
                    
                    $idColono = 0;
                    $totalColono =0;

                    /* foreach($listaCalles as $id => $calle) {
                        $casas= (new InmueblesColonos())->inmueblesPorCalle($calle->id);

                        foreach($casas as $id => $inmuebleColono) {
                            $pagos = (new Consultas())->pagosPorInmueble($inmuebleColono["idInmuebleColono"], 1);
                            
                            echo "<pre>".print_r($pagos, true)."</pre>";
                            die();
                            
                        }
                    } */
                    $inmueblesABloquear=[];

                    foreach($listaCalles as $id => $calle) {
                        $casas= (new InmueblesColonos())->inmueblesPorCalle($calle->id);
                        
                        foreach($casas as $id => $inmuebleColono) {
                            
                            $sheet->setCellValue('A'.$renglon, $inmuebleColono['calle']);
                            $sheet->setCellValue('B'.$renglon, $inmuebleColono['numero']);
                            $sheet->setCellValue('C'.$renglon, $inmuebleColono['colono']);

                            $pagos = (new Consultas())->pagosPorInmueble($inmuebleColono["idInmuebleColono"], 1);
                            $mesesFaltantes = 0;

                            for($mes=1; $mes<=12; $mes++) {
                                
                                if(array_key_exists($mes, $pagos)) {
                                    $sheet->setCellValue($meses[$pagos[$mes]["idMes"]].$renglon, $pagos[$mes]['monto']);   
                                    $totalColono = $totalColono + $pagos[$mes]['monto'];
                                } else {
                                    $mesesFaltantes =$mesesFaltantes +1;

                                    $sheet->setCellValue($meses[$mes].$renglon, 0);
                                    
                                    // $inmueblesABloquear[$inmuebleColono["idInmuebleColono"]]=$lista;
                                }

                            }

                            $sheet->setCellValue("P".$renglon, $totalColono);   

                            if($mesesFaltantes >= $model->mesesParaBloqueo){
                                $lista = (new Chips())->listaPorInmueble($inmuebleColono["idInmuebleColono"]);
                                $sheet->setCellValue("Q".$renglon, $lista);   
                            }
                            
                            $sheet->setCellValue("P".$renglon, $totalColono);   
                            $renglon ++;
                            $totalColono = 0;
                        }
                        
                    }
                
                    $fileName="chips_a_bloquear".date("d_m_Y").".xlsx";

                    $writer = new Xlsx($spreadsheet);
                    $writer->save($fileName);
                    $mostrar = $this->sendToBrowser($fileName, $fileName);
                    
                    die(); // Cerramos el Buffer o enviara un error de xls dañado
                }
            }

            return $this->render('_porBloquear', [
                'model' => $model,
            ]);
        }

       public function sendToBrowser($fullPath, $fileName) {
        // Doc generated on the fly, may change so do not cache it; mark as public or
        // private to be cached.
        header('Pragma: no-cache');
        // Mark file as already expired for cache; mark with RFC 1123 Date Format up to
        // 1 year ahead for caching (ex. Thu, 01 Dec 1994 16:00:00 GMT)
        header('Expires: 0');
        // Forces cache to re-validate with server
        header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
        // DocX Content Type
        header('Content-type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        // Tells browser we are sending file
        header('Content-Disposition: attachment; filename='.$fileName.';');
        // Tell proxies and gateways method of file transfer
        header('Content-Transfer-Encoding: binary');
        // Indicates the size to receiving browser
        header('Content-Length: '.filesize($fullPath));

        // Send the file:
        readfile($fullPath);

        // Delete the file if you so choose. BE CAREFULE; YOU MAY NEED TO DO THIS
        // THROUGH YOUR FRAMEWORK:
        unlink($fullPath);

        return true;
    }
}