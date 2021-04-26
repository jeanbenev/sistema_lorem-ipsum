<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Participante;

/**
 * ParticipanteSearch represents the model behind the search form of `app\models\Participante`.
 */
class ParticipanteSearch extends Participante
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_participante', 'grau_eficiencia'], 'integer'],
            [['data_cadastro', 'nome_participante', 'cargo', 'ingresso'], 'safe'],
            [['salario'], 'number'],
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
        $query = Participante::find();

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
            'id_participante' => $this->id_participante,
            'data_cadastro' => $this->data_cadastro,
            'ingresso' => $this->ingresso,
            'salario' => $this->salario,
            'grau_eficiencia' => $this->grau_eficiencia,
        ]);

        $query->andFilterWhere(['like', 'nome_participante', $this->nome_participante])
            ->andFilterWhere(['like', 'cargo', $this->cargo]);

        return $dataProvider;
    }
}
