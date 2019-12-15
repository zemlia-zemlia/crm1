<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Nav;

$this->title = 'Личный кабинет';
if (Yii::$app->user->isGuest) {
   //$this->redirect('site/login', 301);
    $form = ActiveForm::begin([
        'action' => 'site/login'
    ]);
}else{
?>
    <section id="intro" class="section">
        <div class="container">
            <div class="row">

    <?= $this->render('amenu'); ?>

<h1>Активация демо доступа</h1>

    <p>Чтобы протестировать полный функционал сканера недвижимости, воспользуйтесь 24 часовым демо - доступом</p>

    <?= Html::a('Активировать', ['site/add-balance', 'new'=>'demo'], ['class' => 'btn radius btn-success']); ?>



    <?
    //return $this->redirect('site/login', 301);

} ?>

</div>
</div>
</section>