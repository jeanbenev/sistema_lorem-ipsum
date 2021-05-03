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
            [['data_cadastro'], 'safe'],
            [['nome_participante', 'cargo'], 'required'],
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

    /**
     * @uses Usado para fazer o tratamento dos dados depois de buscados do MySQL
     */
    public function afterFind(){
        //Tratamento dos campos data do MySQL para o formato legível do usuário
        $this->data_cadastro            = Yii::$app->formatter->asDateTime($this->data_cadastro, "php:d/m/Y H:i:s");
        return parent::afterFind();
    }

    /**
     * @uses Usado para tratar dados e definir valores automaticos antes de salvar os dados da instancia do model
     */
    public function beforeSave($insert){
        //Se for scenario de insert
        if($insert){
            //Tratamento do campo data para o formato aceito pelo MySQL
            $this->data_cadastro            = date("Y-m-d H:i:s");
        }
        //Se for scenario de update
        else{
            //Pegar a data do tratada pelo Yii no método afterFind (dd/mm/yyyy h:i:s) e formatar para o formato PHP (yyyy-mm-dd h:i:s)
            $data_mysql_formatada = substr($this->data_cadastro, 6, 4) . '-' . substr($this->data_cadastro, 3, 2) . '-' . substr($this->data_cadastro, 0, 2) . ' ' . substr($this->data_cadastro, 11, 8);
            $date = date_create($data_mysql_formatada);
            //Pequeno hack para ajustar a formatação de data quando entra nesse scenario de não insert mesmo no create projeto
            if(!$date){
                $data_mysql_formatada = substr($this->data_cadastro, 0, 4) . '-' . substr($this->data_cadastro, 5, 2) . '-' . substr($this->data_cadastro, 8, 2) . ' ' . substr($this->data_cadastro, 11, 8);
                $date = date_create($data_mysql_formatada);
            }
            //Enviar a mesma data só que formatada no formato aceito pelo MySQL
            $this->data_cadastro    = date_format($date, 'Y-m-d H:i:s');
        }
        return parent::beforeSave($insert);
    }
}
