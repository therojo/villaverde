<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\InmueblesColonos;
use app\models\Calles;
use app\models\Inmuebles;

/**
 * InmueblesColonosSearch represents the model behind the search form of `app\models\InmueblesColonos`.
 */
class InmueblesColonosSearch extends InmueblesColonos
{
    
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'idUsuario'], 'integer'],
            [
                [
                    'idColono',
                    'createdAt', 'fechaSalidaColonia',
                    'estatus',
                    'nombreDelColono',
                    'alCorriente','idInmueble','idCalle'
                ], 'safe'],
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
    public function search($params){
        // $query->joinWith(['idAtajo0','idCuentaContable0']);
        // $query->where='Integradas.estatus="activa" and Integradas.idAtajo='.$this->idAtajo;


        $query = InmueblesColonos::find()->
            joinWith(
                ['idInmueble0.idCalle0', 'idColono0']
            );

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
            'createdAt' => $this->createdAt,
            'fechaSalidaColonia' => $this->fechaSalidaColonia,
            'idColono' => $this->idColono,
            // 'idInmueble' => $this->idInmueble,
            'idUsuario' => $this->idUsuario,
        ]);

        $query->andFilterWhere(['like', 'estatus', $this->estatus])
            ->andFilterWhere(['like', 'alCorriente', $this->alCorriente])
            ->andFilterWhere(['like', 'Calles.id', $this->idCalle])
            ->andFilterWhere(['like', 'Colonos.nombre', $this->nombreDelColono]);
        
        // echo "<pre>".print_r($dataProvider, true)."</pre>";
        // die();
            
        return $dataProvider;
    }


    public function searchOnlyInmueble($idInmueble){
        $query = InmueblesColonos::find()->where(
            [
                'idInmueble'=>$idInmueble
            ]
        )->joinWith(
                ['idInmueble0.idCalle0']
        )->orderBy(['InmueblesColonos.id' => SORT_DESC]);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);


        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'createdAt' => $this->createdAt,
            'fechaSalidaColonia' => $this->fechaSalidaColonia,
            'idColono' => $this->idColono,
            // 'idInmueble' => $this->idInmueble,
            'idUsuario' => $this->idUsuario,
        ]);

        $query->andFilterWhere(['like', 'estatus', $this->estatus])
            ->andFilterWhere(['like', 'alCorriente', $this->alCorriente])
            ->andFilterWhere(['like', 'Calles.nombre', $this->idCalle]);
        
        return $dataProvider;
    }
}
