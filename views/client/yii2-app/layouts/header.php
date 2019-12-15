<?php
use yii\helpers\Html;

/* @var $this \yii\web\View */
/* @var $content string */
?>

<header class="main-header">

    <?= Html::a('<span class="logo-mini">APP</span><span class="logo-lg">' . Yii::$app->name . '</span>', Yii::$app->homeUrl, ['class' => 'logo']) ?>
    <style>.</style>
    <nav class="navbar navbar-static-top" role="navigation">

        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>

        <div class="navbar-custom-menu">

            <ul class="nav navbar-nav">

                <!-- Messages: style can be found in dropdown.less-->


                <!-- Tasks: style can be found in dropdown.less -->

                <!-- User Account: style can be found in dropdown.less -->

                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">

                        <span class="hidden-xs">



                            <?php
                            if (!Yii::$app->user->isGuest) {
                                if (Yii::$app->user->identity->type == 1)
                                    $user = Yii::$app->user->identity->staff;
                                else
                                    $user = Yii::$app->user->identity->client;



                                echo $user->fullName;

                            }

                            ?>



                        </span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- User image -->
                        <li class="user-header">
                            <style>.navbar-nav>.user-menu>.dropdown-menu>li.user-header{
                                    height: 60px;
                                }
                            </style>

                            <p>

                                <?php
                                if ((!Yii::$app->user->isGuest) )
                               echo  Yii::$app->user->identity->position->description
                                ?>
<!--                                <small>Member since Nov. 2012</small>-->
                            </p>
                        </li>
                        <!-- Menu Body -->

                        <!-- Menu Footer-->
                        <li class="user-footer">

                            <?php $login = Yii::$app->user->isGuest ? 'Вход' : 'Выход'; ?>

                            <div class="pull-right">
                                <?= Html::a(
                                    $login,
                                    ['/site/logout'],
                                    ['data-method' => 'post', 'class' => 'btn btn-default btn-flat']
                                ) ?>
                            </div>
                        </li>
                    </ul>
                </li>

                <!-- User Account: style can be found in dropdown.less -->
                <li>

                </li>
            </ul>
        </div>
    </nav>
</header>
