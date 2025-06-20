<?php

namespace app\controllers;

use Yii;
use app\models\Ejercicios;
use app\models\EjerciciosSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\components\Alertas;

/**
 * EjerciciosController implements the CRUD actions for Ejercicios model.
 */
class EjerciciosController extends Controller
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
     * Lists all Ejercicios models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new EjerciciosSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionActivar()
    {
        $id=$_GET['id'];
        $model=$this->findModel($id);

        $activoActual=Ejercicios::activoActual();
        
        $connection = \Yii::$app->db;
        $transaction = $connection-> beginTransaction();
        
        try {
            $activoActual->estatus=Ejercicios::_INACTIVO;
            $activoActual->save();

            $model->estatus=Ejercicios::_ACTIVO;
            $model->save();
            
            $transaction->commit();

            $msg="Se establecio el ejercicio ".$model->numero." como activo";
            Alertas::setFlash("success", "create", $msg);
        } catch (\Exception $e) {
            $transaction->rollBack();
            throw $e;
        } catch (\Throwable $e) {
            $transaction->rollBack();
        }

        return $this->redirect(['index']);
    }

    /**
     * Creates a new Ejercicios model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Ejercicios();

        if ($model->load(Yii::$app->request->post())) {
            $model->estatus=Ejercicios::_INACTIVO;
            $model->idUsuario=Yii::$app->session->get('idUsuario');

            $model->save();
            $msg="Se registro el ejercicio ".$model->numero;
            Alertas::setFlash("success", "create", $msg);
            return $this->redirect(['index']);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Ejercicios model.
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
     * Deletes an existing Ejercicios model.
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
     * Finds the Ejercicios model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Ejercicios the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Ejercicios::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
