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
            [['id_participante'], 'integer'],
            [['data_cadastro', 'nome_participante', 'cargo'], 'safe'],
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
        ]);

        $query->andFilterWhere(['like', 'nome_participante', $this->nome_participante])
            ->andFilterWhere(['like', 'cargo', $this->cargo]);

        return $dataProvider;
    }
}
