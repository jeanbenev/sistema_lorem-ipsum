<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Projetos;

/**
 * ProjetosSearch represents the model behind the search form of `app\models\Projetos`.
 */
class ProjetosSearch extends Projetos
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_projeto', 'risco'], 'integer'],
            [['data_cadastro', 'nome_projeto', 'data_inicio', 'data_termino'], 'safe'],
            [['valor_projeto'], 'number'],
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
        $query = Projetos::find();

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
            'id_projeto' => $this->id_projeto,
            'data_cadastro' => $this->data_cadastro,
            'data_inicio' => $this->data_inicio,
            'data_termino' => $this->data_termino,
            'valor_projeto' => $this->valor_projeto,
            'risco' => $this->risco,
        ]);

        $query->andFilterWhere(['like', 'nome_projeto', $this->nome_projeto]);

        return $dataProvider;
    }
}
