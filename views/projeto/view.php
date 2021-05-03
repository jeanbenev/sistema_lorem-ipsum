<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Projeto */

$this->title = 'Visualizar Projeto: '.$model->nome_projeto;
$this->params['breadcrumbs'][] = ['label' => 'Projetos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="projeto-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Alterar', ['update', 'id' => $model->id_projeto], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Deletar', ['delete', 'id' => $model->id_projeto], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Você realmente deseja deletar esse item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id_projeto',
            'data_cadastro',
            'nome_projeto',
            'data_inicio',
            'data_termino',
            [
                'label' => 'Valor do Projeto',
                'value' => $model->valorProjetoFormatado(),            
            ],
            [
                'label' => 'Número de Dias',
                'value' => $model->calcularQuantidadeDiasEntreDuasDatas()." dia(s)",
            ],
            [
                'label' => 'Risco',
                'value' => $model->getRiscoText(),            
            ],
            [
                'label' => 'Participantes',
                'value' => implode($model->getNomeParticipantesDoProjeto()," | "),            
            ],
        ],
    ]) ?>

</div>
