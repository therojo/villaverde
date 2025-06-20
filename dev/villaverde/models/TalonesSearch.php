<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Talones;

/**
 * TalonesSearch represents the model behind the search form of `app\models\Talones`.
 */
class TalonesSearch extends Talones
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'numero', 'folioInicial', 'folioFinal', 'ejercicio'], 'integer'],
            [['nombre','estatus', 'created_at'], 'safe'],
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
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Talones::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'numero' => $this->numero,
            'folioInicial' => $this->folioInicial,
            'folioFinal' => $this->folioFinal,
            'ejercicio' => $this->ejercicio,
            'created_at' => $this->created_at,
        ]);

        $query->andFilterWhere(['like', 'nombre', $this->nombre])
            ->andFilterWhere(['like', 'estatus', $this->estatus]);

        return $dataProvider;
    }
}
