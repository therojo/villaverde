<?php

namespace app\controllers;

use Yii;
use app\models\InmueblesColonos;
use app\models\Colonos;
use app\models\InmueblesColonosSearch;
use app\models\Inmuebles;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\Calles;
use app\components\Alertas;

/**
 * InmueblesColonosController implements the CRUD actions for InmueblesColonos model.
 */
class InmueblesColonosController extends Controller
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
     * Lists all InmueblesColonos models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new InmueblesColonosSearch();
        $colono=new Colonos();
        $arrCalles=(new Calles())->lista();

        // Viene de colonos/index
        if (isset($_GET['idColono'])) {
            $idColono= $_GET['idColono'];
            $searchModel->idColono= $idColono;
            $colono=Colonos::findOne($idColono);
        }

        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render(
            'index',
            [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
                'colono' => $colono,
                'arrCalles' => $arrCalles,
            ]
        );
    }

    /**
     * Displays a single InmueblesColonos model.
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
     * Creates a new InmueblesColonos model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $idColono=$_GET['idColono'];

        $model = new InmueblesColonos();
        
        //$model->fechaRegistro=date('Y-m-d');
        $model->estatus=InmueblesColonos::_ACTIVO;
        $model->alCorriente='si';
        $model->fechaInicio=date('Y-m-d');
        $model->idUsuario=Yii::$app->session->get('idUsuario');
        
        $inmueble=new Inmuebles();
        $inmueble->idUsuario=Yii::$app->session->get('idUsuario');

        $arrColonos=[];
        $arrCalles=(new Calles())->lista();

        if (isset($_GET['idColono'])) {
            $model->idColono= $_GET['idColono'];
            $arrColonos=(new Colonos())->listaSoloColono($_GET['idColono']);
        } else {
            $arrColonos = (new Colonos())->lista();
        }
        
        if ($model->load(Yii::$app->request->post())) {
            $connection = \Yii::$app->db;
            $transaction = $connection-> beginTransaction();
            
            try {
                if (!$model->save()) {
                    echo '<pre>'.print_r($model->getErrors(), true).'</pre>';
                    die();
                }
                $inmueble = $model->idInmueble0;
                $inmueble->asignado="si";
                $inmueble->save();
                
                $transaction->commit();
                Alertas::setFlash("success", "create");
            } catch (\Exception $e) {
                Alertas::setFlash("error", "create");
                $transaction->rollBack();
                throw $e;
            } catch (\Throwable $e) {
                $transaction->rollBack();
            }
            

            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render(
            'create',
            [
                'model' => $model,
                'arrColonos' => $arrColonos,
                'inmueble' => $inmueble,
                'arrCalles' => $arrCalles,
                'idColono' => $idColono,
            ]
        );
    }
    
    /**
     * Updates an existing InmueblesColonos model.
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

        return $this->render(
            'update', 
            [
                'model' => $model,
            ]
        );
    }


    public function actionBitacora()
    {
        
        $idInmueble=$_GET['idInmueble'];
        $model=Inmuebles::findOne($idInmueble);
        
        $searchModel = new InmueblesColonosSearch(
            [
                'idInmueble'=>$idInmueble
            ]
        );

        $dataProvider = $searchModel->searchOnlyInmueble(Yii::$app->request->queryParams);

        return $this->render(
            'bitacora',
            [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
                'model'=>$model
            ]
        );
    }

    /**
     * Lista de Inmuebles filtrados por Colono
     * @return Array
     */
    public function actionListaAjax($idColono)
    {
        $countInmuebles = InmueblesColonos::find()->where(['idColono' => $idColono])->count();
        
        $arrInmuebles = InmueblesColonos::find()->where(
            [
                'idColono' => $idColono,
                // Tambien verificar estatus
            ]
        )->all();
        
        if ($countInmuebles > 0) {
            
            if($countInmuebles >= 1) {
                echo "<option value='0'>Seleccione inmueble</option>";
            }

            foreach ($arrInmuebles as $id=>$inmuebleColono) {
                $direccion= $inmuebleColono->idInmueble0->idCalle0->nombre;
                $direccion .= " ".$inmuebleColono->idInmueble0->numero;
                
                echo "<option value='" . $inmuebleColono->id . "'>" . $direccion . "</option>";
            }
        } else {
            echo "<option>Sin inmuebles registrados</option>";
        }
    }

    /**
     * Deletes an existing InmueblesColonos model.
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
     * Finds the InmueblesColonos model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return InmueblesColonos the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = InmueblesColonos::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
