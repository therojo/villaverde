<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Inmuebles;

/**
 * InmueblesSearch represents the model behind the search form of `app\models\Inmuebles`.
 */
class InmueblesSearch extends Inmuebles
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id','idUsuario'], 'integer'],
            [['numeroInterior', 'created_at', 'observaciones','asignado','tipo','idCalle','numero'],'safe'],
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
        $query = Inmuebles::find()->joinWith(
            ['idCalle0']
        )->orderBy('Calles.nombre, numero');
        //$query->where('asignado="si"');
        
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
            'created_at' => $this->created_at,
            'idUsuario' => $this->idUsuario,
        ]);

        $query->andFilterWhere(['like', 'numeroInterior', $this->numeroInterior])
            ->andFilterWhere(['like', 'Calles.nombre', $this->idCalle])
            ->andFilterWhere(['like', 'numero', $this->numero])
            ->andFilterWhere(['like', 'observaciones', $this->observaciones]);

        return $dataProvider;
    }
}
