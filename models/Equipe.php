<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "equipe".
 *
 * @property int $id_equipe Id da equipe (inteiro)
 * @property string $data_cadastro Data de cadastro do registro (data)
 * @property int $fk_id_projeto Id do projeto da tabela projeto
 * @property int $fk_id_participante Id do participante da tabela participante
 *
 * @property Participante $fkIdParticipante
 * @property Projeto $fkIdProjeto
 */
class Equipe extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'equipe';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['data_cadastro'], 'safe'],
            [['fk_id_projeto', 'fk_id_participante'], 'required'],
            [['fk_id_projeto', 'fk_id_participante'], 'integer'],
            [['fk_id_participante'], 'exist', 'skipOnError' => true, 'targetClass' => Participante::className(), 'targetAttribute' => ['fk_id_participante' => 'id_participante']],
            [['fk_id_projeto'], 'exist', 'skipOnError' => true, 'targetClass' => Projeto::className(), 'targetAttribute' => ['fk_id_projeto' => 'id_projeto']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_equipe' => 'Id Equipe',
            'data_cadastro' => 'Data Cadastro',
            'fk_id_projeto' => 'Fk Id Projeto',
            'fk_id_participante' => 'Fk Id Participante',
        ];
    }

    /**
     * Gets query for [[FkIdParticipante]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getParticipantes()
    {
        return $this->hasMany(Participante::className(), ['id_participante' => 'fk_id_participante']);
    }

    /**
     * Gets query for [[FkIdProjeto]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFkIdProjeto()
    {
        return $this->hasOne(Projeto::className(), ['id_projeto' => 'fk_id_projeto']);
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
