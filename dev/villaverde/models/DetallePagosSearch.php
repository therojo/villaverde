<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\DetallePagos;

/**
 * DetallePagosSearch represents the model behind the search form of `app\models\DetallePagos`.
 */
class DetallePagosSearch extends DetallePagos
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'idPago', 'idMes', 'idEjercicio'], 'integer'],
            [['monto'], 'number'],
            [['estatus', 'observaciones'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     * @param string|null $formName Form name to be used into `->load()` method.
     *
     * @return ActiveDataProvider
     */
    public function search($params, $formName = null)
    {
        $query = DetallePagos::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params, $formName);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'monto' => $this->monto,
            'idPago' => $this->idPago,
            'idMes' => $this->idMes,
            'idEjercicio' => $this->idEjercicio,
        ]);

        $query->andFilterWhere(['like', 'estatus', $this->estatus])
            ->andFilterWhere(['like', 'observaciones', $this->observaciones]);

        return $dataProvider;
    }
}
