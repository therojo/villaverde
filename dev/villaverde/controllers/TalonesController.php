<?php

namespace app\controllers;

use Yii;
use app\models\Talones;
use app\models\TalonesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\components\Alertas;

/**
 * TalonesController implements the CRUD actions for Talones model.
 */
class TalonesController extends Controller
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
     * Lists all Talones models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TalonesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Talones model.
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
     * Creates a new Talones model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Talones();
        $siguienteNumeroDeTalon = (new Talones())->siguienteConsecutivo();
        $model->numero = $siguienteNumeroDeTalon;

        if ($model->load(Yii::$app->request->post())) {
            
            $connection = \Yii::$app->db;
            $transaction = $connection-> beginTransaction();
            
            try {
                $model->ejercicio = date("Y");
                $model->estatus = Talones::_CERRADO;
                // $model->fechaRegistro = date('Y-m-d');
                
                if ($model->save()) {
                    $transaction->commit();
                    Alertas::setFlash("success", "create");
                    return $this->redirect(['index']);
                }

            } catch (\Exception $e) {
                Alertas::setFlash("error", "create");
                $transaction->rollBack();
                throw $e;
            } catch (\Throwable $e) {
                Alertas::setFlash("error", "create");
                $transaction->rollBack();
            }
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Talones model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Alertas::setFlash("success", "update");
            return $this->redirect(['index']);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Talones model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }


    public function actionAbrir($id) {
        $model = $this->findModel($id); //->estatus=Talones::_ABIERTO;
        
        $model->estatus=Talones::_ABIERTO;
        $model->save();

        return $this->redirect(['index']);
    }
    /**
     * Finds the Talones model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Talones the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Talones::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
