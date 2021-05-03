<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Participante */

$this->title = 'Visualizar Participante: '.$model->nome_participante;
$this->params['breadcrumbs'][] = ['label' => 'Participantes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="participante-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Alterar', ['update', 'id' => $model->id_participante], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Deletar', ['delete', 'id' => $model->id_participante], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Você deseja excluir esse item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id_participante',
            'data_cadastro',
            'nome_participante',
            'cargo',
        ],
    ]) ?>

</div>
