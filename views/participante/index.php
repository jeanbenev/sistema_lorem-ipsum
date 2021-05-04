<?php

use yii\helpers\Html;
use yii\grid\GridView;
use kartik\dialog\Dialog;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ParticipanteSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Participantes';
$this->params['breadcrumbs'][] = $this->title;

Dialog::widget();

$this->registerJs('if(window.location.search.search("equipe=true") === 1){
    krajeeDialog.alert("Esse registro não pode ser excluído pois está associado a algum projeto.", function (result) {
        if (result) {
            window.location = window.location.pathname;
        }
    });
}');

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
