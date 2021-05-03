<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ParticipanteSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Participantes';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="participante-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Criar Participante', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'data_cadastro',
            'nome_participante',
            'cargo',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
