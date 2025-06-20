<?php

namespace app\controllers;

use Yii;
use app\models\Inmuebles;
use app\models\InmueblesSearch;
use app\models\Calles;
use app\models\Colonos;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\components\Alertas;
use app\models\InmueblesColonos;

/**
 * InmueblesController implements the CRUD actions for Inmuebles model.
 */
class InmueblesController extends Controller
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
     * Lists all Inmuebles models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new InmueblesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Inmuebles model.
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
     * Creates a new Inmuebles model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Inmuebles();
        $model->asignado="no";
        $model->idUsuario=Yii::$app->session->get('idUsuario');
        // $model->fechaRegistro=date('Y-m-d');

        $arrCalles=(new Calles())->lista();

        if ($model->load(Yii::$app->request->post())) {
            
            if ($model->save()) {
                Alertas::setFlash("success", "create");
                return $this->redirect(['index']);
            }
        }

        return $this->render('create', [
            'model' => $model,
            'arrCalles' => $arrCalles,
        ]);
    }

    /**
     * Updates an existing Inmuebles model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $arrCalles = (new Calles())->lista();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Alertas::setFlash("success", "update");
            return $this->redirect(['index']);
        }

        return $this->render('update', [
            'model' => $model,
            'arrCalles' => $arrCalles,
        ]);
    }

    /**
    * Marcar como cancelado un inmueble
    * siempre y cuando no tenga movimientos
    * @author Rojo <guillermo.rojo@sazacatecas.gob.mx>
    *
    * @return void
    */
    public function actionCancelar()
    {
        $id=$_GET['id'];
        $model = $this->findModel($id);
        
        // Buscamos si existe en InmueblesColonos
        $existe=(new InmueblesColonos())->existe($model->id);

        if (!$existe) {
            $model->estatus=Inmuebles::_INACTIVO;
            $model->save();
            $msg="Inmueble marcado como cancelado";
            Alertas::setFlash("success", "update", $msg);
        } else {
            $msg="Este inmueble tiene registros asociados, no se cancelo";
            Alertas::setFlash("error", "update");
        }

        return $this->redirect(['index']);
    }

    /**
     * Lista de Inmuebles filtrados por Calle
     * @return Array
     */
    public function actionListaAjax($id)
    {
        $countInmuebles = Inmuebles::find()->where(['idCalle' => $id])->count();
        $inmuebles = Inmuebles::find()->where(['idCalle' => $id])->all();

        if ($countInmuebles > 0) {
            echo "<option value='0'>Seleccione</option>";
            foreach ($inmuebles as $casa) {
                echo "<option value='" . $casa->id . "'>" . $casa->numero . "</option>";
            }
        } else {
            echo "<option>-</option>";
        }
    }


    /**
     * Lista de Inmuebles filtrados por Calle
     * @return Array
     */
    public function actionNoAsignadosAjax($idCalle)
    {
        $countInmuebles = Inmuebles::find()->where(
            [
                'idCalle' => $idCalle,
                'asignado'=>"no"
            ]
        )->count();

        $inmuebles = Inmuebles::find()->where(
            [
                'idCalle' => $idCalle,
                'asignado'=>'no'
            ]
        )->all();

        if ($countInmuebles > 0) {
            echo "<option value='0'>Seleccione</option>";
            foreach ($inmuebles as $casa) {
                echo "<option value='" . $casa->id . "'>" . $casa->numero . "</option>";
            }
        } else {
            echo "<option>-</option>";
        }
    }
    /**
     * Lista de Inmuebles filtrados por Calle
     * @return Array
     */
    public function actionListaAjax2($id)
    {
        $countInmuebles = Inmuebles::find()->where(['idCalle' => $id])->count();
        $inmuebles = Inmuebles::find()->where(['idCalle' => $id])->all();

        if ($countInmuebles > 0) {
            echo "<option value='0'>Seleccione</option>";
            foreach ($inmuebles as $casa) {
                echo "<option value='" . $casa->id . "'>" . $casa->numero . "</option>";
            }
        } else {
            echo "<option>-</option>";
        }
    }

    /**
     * Lista de Inmuebles filtrados por Calle
     * Se obtienen solo los que estan sin asignar
     * @return Array
     */
    public function actionListaAjax1($id)
    {
        $countInmuebles = Inmuebles::find()->where(['idCalle' => $id])->count();
        $inmuebles = Inmuebles::find()->where(
            [
                'idCalle' => $id
            ]
        )->all();

        if ($countInmuebles > 0) {
            echo "<option value='0'>Seleccione</option>";
            foreach ($inmuebles as $casa) {
                echo "<option value='" . $casa->id . "'>" . $casa->numero . "</option>";
            }
        } else {
            echo "<option>-</option>";
        }
    }



    /**
     * Finds the Inmuebles model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Inmuebles the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Inmuebles::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
