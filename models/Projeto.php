<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "projeto".
 *
 * @property int $id_projeto Id do projeto
 * @property string $data_cadastro Data de cadastro do registro
 * @property string $nome_projeto Nome do projeto
 * @property string $data_inicio Data de início
 * @property string $data_termino Data de término
 * @property float $valor_projeto Valor do projeto
 * @property int $risco Podendo ser: 0 - baixo, 1 - médio, 2 – alto
 *
 * @property Equipe[] $equipes
 */
class Projeto extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'projeto';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['data_cadastro', 'data_inicio', 'data_termino'], 'safe'],
            [['nome_projeto', 'data_inicio', 'data_termino', 'valor_projeto', 'risco'], 'required'],
            [['valor_projeto'], 'number'],
            [['risco'], 'integer'],
            [['nome_projeto'], 'string', 'max' => 60],
            [['valor_projeto'], 'string', 'max' => 10],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_projeto' => 'Projeto ID',
            'data_cadastro' => 'Data Cadastro',
            'nome_projeto' => 'Nome Projeto',
            'data_inicio' => 'Data de Inicio',
            'data_termino' => 'Data de Termino',
            'valor_projeto' => 'Valor do Projeto',
            'risco' => 'Risco do Projeto',
        ];
    }

    /**
     * Gets query for [[Equipes]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEquipes()
    {
        return $this->hasMany(Equipe::className(), ['fk_id_projeto' => 'id_projeto']);
    }
}
