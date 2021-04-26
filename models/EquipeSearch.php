<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Equipe;

/**
 * EquipeSearch represents the model behind the search form of `app\models\Equipe`.
 */
class EquipeSearch extends Equipe
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_equipe', 'fk_id_projeto', 'fk_id_participante'], 'integer'],
            [['data_cadastro'], 'safe'],
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
        $query = Equipe::find();

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
            'id_equipe' => $this->id_equipe,
            'data_cadastro' => $this->data_cadastro,
            'fk_id_projeto' => $this->fk_id_projeto,
            'fk_id_participante' => $this->fk_id_participante,
        ]);

        return $dataProvider;
    }
}
