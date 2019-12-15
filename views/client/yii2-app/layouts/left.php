<aside class="main-sidebar">

    <section class="sidebar">

        <!-- Sidebar user panel -->




<?php


if (!Yii::$app->user->isGuest) {
        ?>





        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu tree', 'data-widget'=> 'tree'],
                'items' => [
                    ['label' => 'Разделы', 'options' => ['class' => 'header']],
                    ['label' => 'Объекты', 'icon' => 'building-o', 'url' => '/realty-object',

                    'items' => [
        ['label' => 'Аренда - Жилая',  'url' => '/realty-object',],
        ['label' => 'Продажа - Жилая', 'url' => ['/realty-object#sell_info_tab'],],
        ['label' => 'Аренда - Коммерческая',  'url' => ['/realty-object#rent_commercial_info_tab'],],
        ['label' => 'Продажа - Коммерческая', 'url' => ['/realty-object#sell_commercial_info_tab'],],



                    ],

],

                    ['label' => 'Новые бъекты', 'icon' => 'building-o', 'url' => ['/rooms']],

                    ['label' => 'Клиенты', 'icon' => 'users', 'url' => ['/client/client']],
                    ['label' => 'Сотрудники', 'icon' => 'user-o', 'url' => ['/client/staff']],
                    ['label' => 'Экспорт в YML', 'icon' => 'share', 'url' => '/client/realty-object',],
                    ['label' => 'Отправить SMS', 'icon' => 'paper-plane', 'url' => ['/client/user-sms/send-anyone'],],
                    ['label' => 'Черный список', 'icon' => 'circle-o', 'url' => '/black',],
                    ['label' => 'Статистика', 'icon' => 'bar-chart', 'url' => ['/client/staff/stat'],],

                    [
                        'label' => 'Настройки',
                        'icon' => 'share',
                        'url' => '#',
                        'items' => [

                            ['label' => 'Роли пользователей', 'icon' => 'dashboard', 'url' => ['/client/role'],],
                            ['label' => 'Регионы', 'icon' => 'circle-o', 'url' => '/client/list-region',],
                            ['label' => 'Города', 'icon' => 'circle-o', 'url' => '/client/list-city',],
                            ['label' => 'Районы', 'icon' => 'circle-o', 'url' => '/client/list-district',],
                            ['label' => 'Типы недвижимости', 'icon' => 'circle-o', 'url' => '/client/type-property',],
                            ['label' => 'Офисы', 'icon' => 'circle-o', 'url' => '/client/office',],





                            ],
                        ],
                    ],
                ]

        ) ; }?>

    </section>

</aside>
