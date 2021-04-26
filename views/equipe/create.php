<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Equipe */

$this->title = 'Create Equipe';
$this->params['breadcrumbs'][] = ['label' => 'Equipes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="equipe-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
