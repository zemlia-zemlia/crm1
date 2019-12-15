<?php

use yii\helpers\Html;
use yii\bootstrap\Tabs;

/* @var $this yii\web\View */
/* @var $model app\models\client\Staff */

$this->title = 'Статистика сотрудников';
$this->params['breadcrumbs'][] = ['label' => 'Сотрудники', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);



echo Tabs::widget([
    'items' => [
        [
            'label' => 'По сотрудникам',
//

            'url' => '/client/staff/stat',
        ],
        [
            'label' => 'По офисам',
            'url' => '#',

            'active' => true,

        ],

    ],
]);







?>






<div class="staff-stat">


    <div style="margin: 20px" class="btn-group btn-group-sm" role="group" aria-label="Выбор периода">
        <button type="button" class="btn btn-secondary"><a href="/client/staff/stat-office?period=86400">Сегодня</a></button>
        <button type="button" class="btn btn-secondary"><a href="/client/staff/stat-office?period=259200">3 дня</a></button>
        <button type="button" class="btn btn-secondary"><a href="/client/staff/stat-office?period=604800">Неделя</a></button>
        <button type="button" class="btn btn-secondary"><a href="/client/staff/stat-office?period=2592000">Месяц</a></button>
        <button type="button" class="btn btn-secondary"><a href="/client/staff/stat-office?period=31536000">Год</a></button>

    </div>

    <div class="row">
        <div class="col-lg-12">
        <p>


            период с <b><?= \Yii::$app->formatter->asTime(time() - $period, "php:d F Y") . '</b> по <b>' . \Yii::$app->formatter->asTime(time() , "php:d F Y") . '</b>' ?>
        </p>

    </div>
    </div>


    <table class="table table-bordered">


        <thead>
        <tr>
            <th scope="col">Офис</th>
            <th scope="col">Новые клиенты</th>
            <th scope="col">Редактирование клиентов</th>
            <th scope="col">Добавление платежа</th>
            <th scope="col">Изменение статуса</th>
            <th scope="col">Добавление объекта</th>
        </tr>
        </thead>
        <tbody>


<?php



foreach ($office as $off){

    $staffs =  \app\models\client\Staff::find()->select('user_id')->where(['office' => $off->id])->asArray()->all();
    $staff = [];
    foreach ($staffs as $st) $staff[] = (int)$st['user_id'];

    $newPayment = \app\models\client\StaffLog::find()
        ->where(['type' => 3 ])
        ->andWhere(['in', 'staff_id' , $staff])
        ->andWhere([ '>', 'created_at', time() - $period ])
        ->count();


    $newClient = \app\models\client\StaffLog::find()
        ->where(['type' => 2 ])
        ->andWhere(['in', 'staff_id' , $staff])
        ->andWhere([ '>', 'created_at', time() - $period ])
        ->count();

    $editClient = \app\models\client\StaffLog::find()
        ->where(['type' => 1 ])
        ->andWhere(['in', 'staff_id' , $staff])
        ->andWhere([ '>', 'created_at', time() - $period ])
        ->count();

    $changeStatus = \app\models\client\StaffLog::find()
        ->where(['type' => 6 ])
        ->andWhere(['in', 'staff_id' , $staff])
        ->andWhere([ '>', 'created_at', time() - $period ])
        ->count();

    $addObject = \app\models\ObjectLog::find()
        ->where(['log_description' => 'Добавление объекта' ])
        ->andWhere(['in', 'log_user_id' , $staff])
        ->andWhere([ '>', 'created_at', time() - $period ])
        ->count();

?>

    <tr>
        <td><?= $off->officeCity . ' / ' . $off->name?></td>
        <td><?= $newClient ?></td>
        <td><?= $editClient  ?></td>
        <td><?= $newPayment ?></td>
        <td><?=  $changeStatus ?></td>
        <td><?=  $addObject ?></td>

    </tr>












    <?php

}





?>



        </tbody>
    </table>




</div>
