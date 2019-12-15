<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Modal;

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
    <style>
        .tariff{
            height: 100%;
            background-size: cover;
            background-position: bottom;
            background-size: auto 100px;
            background-repeat: no-repeat;
            background-image: url(http://xn--d1aacodqbkfbc.xn--p1ai/images/b3.svg);border: 2px solid #dfdfdf; border-radius: 10px;

        }
    </style>

    <?= $this->render('amenu'); ?>




    <h1>Выберите вариант подписки</h1>

    <?if(Yii::$app->user->identity->balance=='0'){
      ?>

        <div class="alert alert-warning">
            <p>
                У вас недостаточно денежных средств на вашем  балансе, чтобы воспользоваться подпиской. <br>
                Пополните счет в <?= Html::a('данном разделе', ['site/about']); ?>
            </p>
        </div>
        <?
    }
    ?>
    <div class="shortcode-html">
    <div class="row no-gutters align-items-center">



<div class="col-lg-4 col-md-4">

    <div class="property shadow-hover tariff" style="">
        <div class="property-content">
            <center>  <div class="property-title">
                  <h2>24 часа</h2>
                    <h3>99 руб</h3>
                </div>
            <?
            Modal::begin([
                'header' => 'Потвердите действие',
                'toggleButton' => [
                    'label' => 'Выбрать',
                    'tag' => 'button',
                    'class' => 'btn btn-success',
                ],
                'footer' => 'Оформляя подписку Вы автоматически принимаете публичную оферту пользования интернет-сервисом',
            ]);

            echo '<h3>Доступ на 24 часа.</h3>';

            echo '<h4>С основного баланса спишется: 99 руб</h4>';


            echo Html::a('Продлить подписку', ['site/add-balance', 'new'=>'99'], ['class' => 'btn btn-default']);
            ?>
            <?php Modal::end(); ?>

        </center>
            <br>

        </div>

    </div>
</div>

    <div class="col-lg-4 col-md-4">

        <div class="property shadow-hover tariff" style="">
            <div class="property-content">
                <center>  <div class="property-title">
                        <h2>1 неделя</h2>
                        <h3>249 руб</h3>
                    </div>
                    <?
                    Modal::begin([
                        'header' => 'Потвердите действие',
                        'toggleButton' => [
                            'label' => 'Выбрать',
                            'tag' => 'button',
                            'class' => 'btn btn-success',
                        ],
                        'footer' => 'Оформляя подписку Вы автоматически принимаете публичную оферту пользования интернет-сервисом',
                    ]);

                    echo '<h3>Доступ на одну неделю.</h3>';

                    echo '<h4>С основного баланса спишется: 249 руб</h4>';


                    echo Html::a('Продлить подписку', ['site/add-balance', 'new'=>'249'], ['class' => 'btn btn-default']);
                    ?>
                    <?php Modal::end(); ?>

                </center>
                <br>

            </div>

        </div>
    </div>


    <div class="col-lg-4 col-md-4">

        <div class="property shadow-hover tariff" style="">
            <div class="property-content">
                <center>  <div class="property-title">
                        <h2>1 месяц</h2>
                        <h3>600 руб</h3>
                    </div>
                    <?
                    Modal::begin([
                        'header' => 'Потвердите действие',
                        'toggleButton' => [
                            'label' => 'Выбрать',
                            'tag' => 'button',
                            'class' => 'btn btn-success',
                        ],
                        'footer' => 'Оформляя подписку Вы автоматически принимаете публичную оферту пользования интернет-сервисом',
                    ]);

                    echo '<h3>Доступ на 1 месяц.</h3>';

                    echo '<h4>С основного баланса спишется: 600 руб</h4>';


                    echo Html::a('Продлить подписку', ['site/add-balance', 'new'=>'600'], ['class' => 'btn btn-default']);
                    ?>
                    <?php Modal::end(); ?>

                </center>
                <br>

            </div>

        </div>
    </div>





<?



    //return $this->redirect('site/login', 301);

} ?>


</div>
</div>
</section>