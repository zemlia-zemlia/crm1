<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use kartik\date\DatePicker;
use yii\widgets\MaskedInput;

/* @var $this yii\web\View */
/* @var $model app\models\client\Staff */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="staff-form">

    <?php $form = ActiveForm::begin();

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
        <div class="col-lg-4">

            <?= $form->field($model, 'birthday')->widget(DatePicker::className(),[
                'name' => 'check_issue_date',
                'value' => date('d-M-Y', strtotime('+2 days')),
                'options' => ['placeholder' => 'Выберите дату рождения ...'],
                'pluginOptions' => [
                    'format' => 'dd-M-yyyy',
                    'todayHighlight' => true
                ]
            ]);
            ?>

            <?= $form->field($model, 'passport')->textarea(['rows' => 6]) ?>
            <?= $form->field($model, 'parent_info')->textarea(['rows' => 6]) ?>

        </div>
        <div class="col-lg-4">
            <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'password')->passwordInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'role')->dropDownList(\app\models\Role::getRoleList()) ?>
            <?= $form->field($model, 'office')->dropDownList(\app\models\client\Office::getOfficeList()) ?>
        </div>
        <div class="col-lg-4">

            <?= $form->field($model, 'status')->dropDownList(\app\models\client\Staff::getStatusList()) ?>
            <div class="form-group"><br>
                <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
            </div>

        </div>



    </div>



    <?php ActiveForm::end(); ?>

</div>
