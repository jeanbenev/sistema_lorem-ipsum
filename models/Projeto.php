<?php

namespace app\models;

use Yii;
use yii\i18n\Formatter;
use yii\helpers\Json;

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
    public $participantes = Array();
    public $valor_investimento_simulacao;

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
            [['data_cadastro', 'data_inicio', 'data_termino', 'participantes'], 'safe'],
            [['nome_projeto', 'data_inicio', 'data_termino', 'valor_projeto', 'risco', 'participantes'], 'required'],
            [['valor_investimento_simulacao'], 'required', 'on'=>'simular_investimento'],
            [['valor_projeto'], 'number'],
            [['risco'], 'integer'],
            [['nome_projeto'], 'string', 'max' => 60],
            [['valor_projeto'], 'number', 'max' => 10000000, 'min' => 1000, 'tooBig' => 'O valor máximo de projeto é R$10.000.00,00', 'tooSmall' => 'O valor mínimo de projeto é R$1.000,00'],
            ['data_inicio', 'compare', 'compareAttribute' => 'data_termino', 'operator' => '<', 'type' => 'number','enableClientValidation' => false],
            ['data_termino', 'compare', 'compareAttribute' => 'data_inicio', 'operator' => '>', 'type' => 'number', 'enableClientValidation' => false],
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
            'participantes' => 'Participantes do Projeto'
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

    /**
     * @uses Usado para buscar todos os participantes com seus respectivos cargos
     */
    public function getParticipantes()
    {
        $participantes = array();
        foreach(Participante::find()->asArray()->all() as $participante){
            $participantes[ $participante['id_participante'] ] = $participante['nome_participante'].' - '.$participante['cargo'];
        }
        return $participantes;
    
    }

    /**
     * @uses Usada para pegar os participantes do projeto
     */
    public function getNomeParticipantesDoProjeto()
    {
        $participantes_cadastrados = $this->getParticipantes();
        $participantes = array();
        foreach($this->equipes as $participante){
            array_push($participantes, $participantes_cadastrados[ $participante['fk_id_participante'] ] );
        }
        return $participantes;
    }

    /**
     * @uses Usada para calcular a quantidade de dias entre duas datas
     */
    public function calcularQuantidadeDiasEntreDuasDatas()
    {
        $data1 = $this->data_inicio;
        $data2 = $this->data_termino;
        
        $partesData1 = explode('/', $data1);
        $data1 = $partesData1['2']. '-' . $partesData1['1']. '-' .  $partesData1['0'];
        $partesData2 = explode('/', $data2);
        $data2 = $partesData2['2']. '-' . $partesData2['1']. '-' .  $partesData2['0'];
    
        // Usa a função strtotime() e pega o timestamp das duas datas:
        $time_inicial = strtotime($data1);
        $time_final = strtotime($data2);
    
        // Calcula a diferença de segundos entre as duas datas:
        $diferenca = $time_final - $time_inicial; // 19522800 segundos
    
        // Calcula a diferença de dias
        $dias = (int)floor( $diferenca / (60 * 60 * 24)); // 225 dias
    
        // Exibe uma mensagem de resultado:
        return $dias;
           
    }

    /**
     * @uses Usado para criar uma lista array das opções do atributo "risco"
     */
    public function getRiscoOptions()
	{
		return array(
			0 => '0 - Baixo',
            1 => '1 - Mediano',
            2 => '2 - Alto',
		);
	}

    /**
     * @uses Usado para selecionar na lista de array das opções do atributo "risco" o valor correspondente
     */
	public function getRiscoText(){
		$options = $this->getRiscoOptions();
		return $options[$this->risco];
	}

    /**
     * @uses Usado para formatar o atributo "valor do projeto"
     */
    public function valorProjetoFormatado(){
        //Formatação para a moeda R$
        return "R$ ".Yii::$app->formatter->asDecimal($this->valor_projeto);
    }

    /**
     * @uses Usado para formatar uma variavel passada por parametro
     */
    public function formatarValorReal($valor){
        //Formatação para a moeda R$
        return "R$ ".Yii::$app->formatter->asDecimal($valor);
    }
    
    /**
     * @uses Usado para formatar o atributo "data Cadastro"
     */
    public function dataCadastroFormatado(){
        //Formatação para a moeda R$
        return Yii::$app->formatter->asDateTime($this->data_cadastro, "php:d/m/Y H:i:s");
    }

    /**
     * @uses Usado para fazer o tratamento dos dados depois de buscados do MySQL
     */
    public function afterFind(){
        //Tratamento dos campos data do MySQL para o formato legível do usuário
        $this->data_cadastro            = Yii::$app->formatter->asDateTime($this->data_cadastro, "php:d/m/Y H:i:s");
        $this->data_inicio              = Yii::$app->formatter->asDate($this->data_inicio);
        $this->data_termino             = Yii::$app->formatter->asDate($this->data_termino);
        $equipes = Equipe::find()->where(['fk_id_projeto'=>$this->id_projeto])->asArray()->all();
        foreach($equipes as $participante){
            array_push($this->participantes, $participante['fk_id_participante']);
        }
        return parent::afterFind();
    }

    /**
     * @uses Usado para fazer tratamentos antes do salvamento dos dados
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
        //Tratamento dos campos data para o formato aceito pelo MySQL (dd-mm-yyyy)
        $this->data_inicio      = implode("-", explode("/", $this->data_inicio));
        $this->data_termino     = implode("-", explode("/", $this->data_termino));
        $this->data_inicio      = strtotime($this->data_inicio);
        $this->data_termino     = strtotime($this->data_termino);
        $this->data_inicio      = date("Y-m-d", $this->data_inicio);
        $this->data_termino     = date("Y-m-d", $this->data_termino);
        return parent::beforeSave($insert);
    }

    /**
     * @uses Usada para tratar dados ANTES das validações do método rules
     */
    public function beforeValidate(){
        //Formatar "data_inicio" e "data_termino" para timestamp para fazer o "compare" no rule
        if($this->data_inicio)  $this->data_inicio      = implode("-", explode("/", $this->data_inicio));
        if($this->data_termino) $this->data_termino     = implode("-", explode("/", $this->data_termino));
        if($this->data_inicio)  $this->data_inicio      = strtotime($this->data_inicio);
        if($this->data_termino) $this->data_termino     = strtotime($this->data_termino);
        return parent::beforeValidate();
    }

    /**
     * @uses Usada para tratar dados DEPOIS das validações do método rules
     */
    public function afterValidate(){
        //Retornar formatação de usuário para "data_inicio" e "data_termino" de timestamp
        if($this->data_inicio) $this->data_inicio      = date("d/m/Y", $this->data_inicio);
        if($this->data_termino) $this->data_termino     = date("d/m/Y", $this->data_termino);
        return parent::afterValidate();
    }
}
