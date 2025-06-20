<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Chips;

/**
 * ChipsSearch represents the model behind the search form of `app\models\Chips`.
 */
class ChipsSearch extends Chips
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'modelo', 'idInmuebleColono'], 'integer'],
            [
                [
                    'numero', 'estatus', 'placas', 'color',
                    'createdAt', 'observaciones'
                ],
                'safe'
            ],
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
        $query = Chips::find();

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
            'modelo' => $this->modelo,
            'createdAt' => $this->createdAt,
            'idInmuebleColono' => $this->idInmuebleColono,
        ]);

        $query->andFilterWhere(['like', 'numero', $this->numero])
            ->andFilterWhere(['like', 'estatus', $this->estatus])
            ->andFilterWhere(['like', 'placas', $this->placas])
            ->andFilterWhere(['like', 'color', $this->color])
            ->andFilterWhere(['like', 'observaciones', $this->observaciones]);

        return $dataProvider;
    }
}
