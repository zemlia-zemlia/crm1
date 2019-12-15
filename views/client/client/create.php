<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\client\Client */

$this->title = 'Создать клиента';
$this->params['breadcrumbs'][] = ['label' => 'Clients', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="client-create">



    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
