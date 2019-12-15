<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\widgets\MaskedInput;
use app\validators\PhoneValidator;

/* @var $this yii\web\View */
/* @var $model app\models\client\Client */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="client-form">

    <?php $form = ActiveForm::begin();
    if ($model->city_id) $region = $model->region;
    else $region = "";

    if ($model->district) $city = $model->city_id;
    else $city = "";

//    var_dump($model);die;
    ?>


    <div class="row">
        <div class="col-lg-3"><?= $form->field($model, 'firstname')->textInput(['maxlength' => true]) ?></div>
        <div class="col-lg-3"><?= $form->field($model, 'lastname')->textInput(['maxlength' => true]) ?></div>
        <div class="col-lg-3"><?= $form->field($model, 'middlename')->textInput(['maxlength' => true]) ?></div>
        <div class="col-lg-3"><?= $form->field($model, 'mobile')->textInput()->widget(MaskedInput::className(), [
                'mask' => '+7 (999) 999 99 99',
            ]) ?></div>


    </div>

    <div class="row">
        <div class="col-lg-3"><?= $form->field($model, 'region')->dropDownList(\app\helpers\LocationHelper::regionList(),
                ['id' => 'client_region_selector'])  ?></div>
        <div class="col-lg-3"><?= $form->field($model, 'city_id')->dropDownList(\app\helpers\LocationHelper::cityList($region),
                ['id' => 'client_city_selector']) ?></div>
        <div class="col-lg-3">
            <?php  echo $form->field($model, 'district')->label(false)->widget(Select2::className(), [
                'data' => \app\helpers\LocationHelper::districtList($city),
                'size' => Select2::LARGE,
                'theme' => Select2::THEME_DEFAULT,

                'options' => [
                    'multiple' => true,

                    'placeholder' => '',
                    'label' => true
                ],
                'pluginOptions' => [
                    'tags' => true
                ]
            ])->label('Район');
            ?>

        </div>
        <div class="col-lg-3"> <?= $form->field($model, 'dop_tel')->textInput() ?></div>


    </div>
    <div class="row">


        <style>
           .field-client-typeproperty .input-lg, .field-client-district .input-lg {
               padding: 0;
               font-size: 21px;

           }

            .select2-selection__choice {
                font-size: small;
            }

        </style>



        <div class="col-lg-3">

            <?php  echo $form->field($model, 'typeproperty')->label(false)->widget(Select2::className(), [
                'data' => \app\models\TypeProperty::getList(),
                'size' => Select2::LARGE,
                'theme' => Select2::THEME_DEFAULT,

                'options' => [
                    'multiple' => true,

                    'placeholder' => '',
                    'label' => true
                ],
                'pluginOptions' => [
                    'tags' => true
                ]
            ])->label('Тип недвижимости');
            ?>


        </div>
        <div class="col-lg-3"><?= $form->field($model, 'price_from')->textInput() ?></div>
        <div class="col-lg-3"><?= $form->field($model, 'price_to')->textInput() ?></div>
        <div class="col-lg-3"><?= $form->field($model, 'status')->dropDownList(\app\models\client\Client::getClientStatus()) ?></div>


    </div>
    <div class="row">
        <div class="col-lg-3"><?= $form->field($model, 'client_type')->dropDownList($model->clientTypeName) ?></div>
<!--        --><?php //var_dump($model);die ?>
        <div class="col-lg-3"><?= $form->field($model, 'staff_id')->dropDownList(\app\models\client\Staff::getList()) ?></div>
        <div class="col-lg-3"><?= $form->field($model, 'source')->textInput(['maxlength' => true]) ?></div>
        <div class="col-lg-3">  <div class="form-group">
                <br/>
                <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
            </div>
        </div>


    </div>





    <?php ActiveForm::end(); ?>

</div>
<?php


?>