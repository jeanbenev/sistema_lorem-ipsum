<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "participante".
 *
 * @property int $id_participante Id do participante (inteiro)
 * @property string $data_cadastro Data de cadastro do registro (data)
 * @property string $nome_participante Nome do participante (texto) 
 * @property string $cargo Cargo do participante (texto)
 * @property string $ingresso Data de ingresso na empresa (data)
 * @property float $salario Valor do salário (numérico)
 * @property int $grau_eficiencia Capacidade tecnica do participante (inteiro) o Podendo ser: 0 - baixo, 1 - médio, 2 – alto 
 *
 * @property Equipe[] $equipes
 */
class Participante extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'participante';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['data_cadastro', 'ingresso'], 'safe'],
            [['nome_participante', 'cargo', 'ingresso', 'salario', 'grau_eficiencia'], 'required'],
            [['salario'], 'number'],
            [['grau_eficiencia'], 'integer'],
            [['nome_participante'], 'string', 'max' => 100],
            [['cargo'], 'string', 'max' => 30],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_participante' => 'Id Participante',
            'data_cadastro' => 'Data Cadastro',
            'nome_participante' => 'Nome Participante',
            'cargo' => 'Cargo',
            'ingresso' => 'Ingresso',
            'salario' => 'Salario',
            'grau_eficiencia' => 'Grau Eficiencia',
        ];
    }

    /**
     * Gets query for [[Equipes]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEquipes()
    {
        return $this->hasMany(Equipe::className(), ['fk_id_participante' => 'id_participante']);
    }
}
