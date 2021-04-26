<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\EquipeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Equipes';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="equipe-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Equipe', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id_equipe',
            'data_cadastro',
            'fk_id_projeto',
            'fk_id_participante',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
