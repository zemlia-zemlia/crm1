<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\BlackSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Черный список';


?>

    <section id="intro" class="section">
        <div class="container">
            <div class="row">

<div class="black-index">


    <p>
        <?= Html::a('Добавить номер', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?php Pjax::begin(); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['attribute' => 'date2', 'format' => ['dateTime', 'php:d M Y H:i']],

             'phone',

            ['class' => 'yii\grid\ActionColumn','template' => '{delete}' ],

        ],
    ]); ?>
    <?php Pjax::end(); ?>

</div>
</div>
</div>
</section>