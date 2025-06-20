<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Pagos;

/**
 * PagosSearch represents the model behind the search form of `app\models\Pagos`.
 */
class PagosSearch extends Pagos
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'folio','idUsuario', 'idCondonacion'], 'integer'],
            [
                [
                    'fecha', 'estatus', 'observaciones', 
                    'idEjercicio','idColono','idMes',
                    'idInmuebleColono', 'idTalon',
                    'idPartida',
                    'numeroMensualidades'
                ], 'safe'],
            [['total'], 'number'],
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
        
        $query = Pagos::find()->joinWith(
            [
                'idInmuebleColono0.idColono0',
                'idInmuebleColono0.idInmueble0.idCalle0',
                'idPartida0']
        )->orderBy(
            [
                'Pagos.fecha' => SORT_DESC
            ]
        )->orderBy('Pagos.fecha desc, Pagos.id desc');

        // $query = Pagos::find()->joinWith(
        //     [
        //         'idEjercicio0'
        //     ]
        // );

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
            'fecha' => $this->fecha,
            'folio' => $this->folio,
            'total' => $this->total,
            'createdAt' => $this->createdAt,
            'updatedAt' => $this->updatedAt,
            'idTalon' => $this->idTalon,
            'idUsuario' => $this->idUsuario,
            'idCondonacion' => $this->idCondonacion,
            // 'idInmuebleColono' => $this->idInmuebleColono,
        ]);

        $query->andFilterWhere(['like', 'observaciones', $this->observaciones])
        ->andFilterWhere(['like', 'estatus', $this->estatus])
        ->andFilterWhere(['like', 'Calles.nombre', $this->idInmuebleColono])
        ->andFilterWhere(['like', 'Partidas.nombre', $this->idPartida])
        ->andFilterWhere(['like', 'Colonos.nombre', $this->idColono]); 
        

        return $dataProvider;
    }
}



