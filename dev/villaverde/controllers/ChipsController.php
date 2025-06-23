<?php

namespace app\controllers;

use Yii;
use app\models\Chips;
use app\models\ChipsSearch;
use app\models\Colonos;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\components\Alertas;
use app\models\InmueblesColonos;

/**
 * ChipsController implements the CRUD actions for Chips model.
 */
class ChipsController extends Controller
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
     * Lists all Chips models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ChipsSearch();
        if (isset($_GET['idColono'])) {

        }
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Creates a new Chips model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Chips();
        $model->estatus=Chips::_ACTIVO;

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            
            $model->save();

            $mensaje="Se registro el chip ".$model->numero;

            Alertas::setFlash("success", "create", $mensaje);

            return $this->redirect(
                ['index']
            );
        }

        return $this->render('create', [
            'model' => $model,
            'arrColonos' => []
        ]);
    }

    /**
     * Updates an existing Chips model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $model->idColono= $model->idInmuebleColono0->idColono;
        $model->idInmuebleColono= $model->idInmuebleColono;

        $arrColonos=(new Colonos())->listaUnico($model->idInmuebleColono0->idColono);
        $arrInmueblesColono=(new InmueblesColonos())->listaColono($model->idInmuebleColono0->idColono);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            
            $colono =(new Colonos())->getFullName($model->idInmuebleColono0->idColono0->id);

            $mensaje="Se actualizo el chip de ".$colono;

            Alertas::setFlash("success", "update", $mensaje);
            return $this->redirect(['index']);
        }

        return $this->render('update', [
            'model' => $model,
            'arrColonos' => $arrColonos,
            'arrInmueblesColono' =>$arrInmueblesColono
        ]);
    }

    /**
     * Deletes an existing Chips model.
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
     * Finds the Chips model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Chips the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Chips::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
