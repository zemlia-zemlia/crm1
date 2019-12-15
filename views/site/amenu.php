<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;

?>

    <?php echo Yii::$app->session->getFlash('success'); ?>

    <div class="col-md-8"><div class="box-style-1 white-bg object-non-visible animated object-visible fadeInUpSmall main-container gray-bg" data-animation-effect="fadeInUpSmall" data-effect-delay="200"><h3>Личный кабинет</h3>
             <?=Html::beginForm(['/site/logout'], 'post')
                                                . Html::submitButton(
                                                    'Выход',
                                                    ['class' => 'btn btn-light-gray btn-sm']
                                                )
                                                . Html::endForm();?>
        Ваш логин: <?=Yii::$app->user->identity->username?><br>
        Ваш баланс: <?=Yii::$app->user->identity->balance?> руб.
        <?= Html::a('Пополнить баланс', ['/site/about'], ['class' => 'btn btn-light-gray btn-sm']); ?>
        <?= Html::a('Продлить подписку', ['site/tariff'] , ['class' => 'btn btn-light-gray btn-sm']); ?>
    </div>

    </div>
    <div class="col-md-4">

        <p>



            <?
            $access_to = Yii::$app->user->identity->access_to;
            ?>
            <?php if($access_to >= time()){ ?>

                Оплачен до: <?=Yii::$app->formatter->asDate(Yii::$app->user->identity->access_to) ?>

            <?}else{
            ?>
            <div class="alert alert-warning">
        <p>
            У вас закрыт доступ к контактным данным объявлений, т.к у вас не выбран тарифный план. <br>
            Выберите тариф или воспользуйтесь <?= Html::a('демо - доступом', ['site/demo']); ?>
        </p>
    </div>
    <?
    } ?>


    </p>

    </div>
</div>




    <?
NavBar::begin();

$menuItems = [
    ['label' => 'Профиль', 'url' => ['/site/account']],
    ['label' => 'Платежи', 'url' => ['/site/payments']],
    ['label' => 'Черный список', 'url' => ['/black/index']],
    ['label' => 'Пополнить баланс', 'url' => ['/site/about']],
    ['label' => 'Корпоративный доступ', 'url' => ['/site/users']],

];

echo Nav::widget([
    'options' => ['class' => 'nav nav-tabs'],
    'items' => $menuItems,
]);
NavBar::end();
