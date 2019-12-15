<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Black */

$this->title = 'Добавить номер';

?>
    <section id="intro" class="section">
        <div class="container">
            <div class="row">


<div class="black-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
</div>
</div>
</section>