<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\client\ClientPayment */

$this->title = 'Update Client Payment: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Client Payments', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="client-payment-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
