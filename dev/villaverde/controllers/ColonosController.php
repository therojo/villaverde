<?php

namespace app\controllers;

use Yii;
use app\models\Colonos;
use app\models\ColonosSearch;

use app\models\InmueblesColonos;
use app\models\InmueblesColonosSearch;

use app\models\Calles;
use app\models\Inmuebles;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ColonosController implements the CRUD actions for Colonos model.
 */
class ColonosController extends Controller
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
     * Lists all Colonos models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ColonosSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Colonos model.
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
     * Creates a new Colonos model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Colonos();
        // $model->fechaRegistro=date('Y-m-d');
        $model->estatus='activo';
        //$model->idUsuario=1;
        
        $inmueble=new Inmuebles();
        // $inmueble->fechaRegistro=date('Y-m-d');
        $inmueble->idUsuario=1;

        if ($model->load(Yii::$app->request->post())) {
            
            if($model->validate()){
                $model->save();
                    return $this->redirect(
                    ['index']
                );
            } else {
                echo "<pre>".print_r($model->getErrors(), true)."</pre>";
                die();
            }
            
        }

        return $this->render(
            'create',
            [
                'model' => $model,
            ]
        );
    }

    /**
     * Updates an existing Colonos model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        }

        return $this->render(
            'update',
            [
                'model' => $model,
            ]
        );
    }

    public function actionListar($q = null, $id = null)
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        $out = ['results' => ['id' => '', 'text' => '', 'nombre' => '']];

        if (!is_null($q)) {
            $select = "id, nombre, apellido1, apellido2, telefono ";
            
            //TODO: Validar si hay que ocultar los inactivos

            $query = Colonos::find()->select($select)->where(
                [
                    'estatus' => Colonos::_ACTIVO
                ]
            );

            $arrayNombre = explode(" ", $q);

            foreach ($arrayNombre as $nombre) {
                $query->andWhere('CONCAT(IFNULL(nombre,""), \' \')  LIKE "%' . $nombre . '%" ');
            }

            $result = $query->all();

            if ($result) {
                //Se concatena el data que se retornará
                foreach ($result as $v) {
                    
                    $inmuebles = (new InmueblesColonos())->find()->where([
                        'idColono' => $v->id
                    ])->all();

                    $listaCasas=[];

                    $casas="";
                    $casas = "<option value='0'>-</option>";

                    foreach($inmuebles as $id => $inmuebleColono) {
                        $direccion = $inmuebleColono->idInmueble0->idCalle0->nombre. ' '.$inmuebleColono->idInmueble0->numero;

                        $casas.= "<option value='" . $inmuebleColono->id . "'>" . $direccion . "</option>";
                    }
                    
                    $data[] = array(
                        'id' => $v->id,
                        'text' => $v->nombre . " " . $v->apellido1. " ".$v->apellido2,
                        'data' => $casas
                    );
                }

                $out['results'] = array_values($data);

            } else {//Si no se encuentran resultados se devuelve un array vacío
                $out['results'] = [];
            }
        } elseif ($id > 0) {
            // $out['results'] = ['id' => $id, 'text' => Beneficiarios::find($id)->nombreCompleto()];
            $out['results'] = [];
        } elseif ($id > 0) {
            $out['results'] = ['id' => $id, 'text' => Colonos::find($id)->nombre()];
        }
        
        $fp=fopen("log.txt", "a+");
        fwrite($fp, print_r($out, true));
        fclose($fp);

        return $out;
    }


    /**
     * Deletes an existing Colonos model.
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
     * Finds the Colonos model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Colonos the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Colonos::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
