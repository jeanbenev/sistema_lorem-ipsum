<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Participante */

$this->title = 'Alterar Participante: '.$model->nome_participante;
$this->params['breadcrumbs'][] = ['label' => 'Participantes', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_participante, 'url' => ['view', 'id' => $model->id_participante]];
$this->params['breadcrumbs'][] = 'Alterar';
?>
<div class="participante-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
