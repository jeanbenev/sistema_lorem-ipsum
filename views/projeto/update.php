<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Projeto */

$this->title = 'Alterar Projeto: ' . $model->nome_projeto;
$this->params['breadcrumbs'][] = ['label' => 'Projetos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_projeto, 'url' => ['view', 'id' => $model->id_projeto]];
$this->params['breadcrumbs'][] = 'Alterar';
?>
<div class="projeto-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
