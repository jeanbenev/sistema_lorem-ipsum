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
    public function getFkIdParticipante()
    {
        return $this->hasOne(Participante::className(), ['id_participante' => 'fk_id_participante']);
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
}
