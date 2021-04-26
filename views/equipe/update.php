<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Equipe */

$this->title = 'Update Equipe: ' . $model->id_equipe;
$this->params['breadcrumbs'][] = ['label' => 'Equipes', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_equipe, 'url' => ['view', 'id' => $model->id_equipe]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="equipe-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
