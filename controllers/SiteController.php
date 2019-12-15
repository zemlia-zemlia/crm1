<?php

namespace app\controllers;
use app\models\client\Client;
use app\models\client\ClientPayment;
use app\models\client\Payments;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\User;
use app\models\SignupForm;
use app\models\PasswordResetRequestForm;
use app\models\ResetPasswordForm;


class SiteController extends Controller
{



    public function actionSignup()
    {
        $model = new SignupForm();

        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                if (Yii::$app->getUser()->login($user)) {
                    return $this->goHome();
                }
            }
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }


    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Проверьте ваш email для дальнейших инструкций.');
                return $this->goHome();
            } else {
                Yii::$app->session->setFlash('error', 'Извините! На данный момент пароль восстановить не удалось.');
            }
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'Новый пароль сохранен. Теперь Вы можете войти под новыми данными.');
            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
            ]);

      }




    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        if (Yii::$app->user->isGuest)  return $this->actionLogin();

        return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {

        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect('index.php?r=site/login', 301);

        }else{
            return $this->render('about');


        }

    }
    /**
     * Displays account page.
     *
     * @return string
     */
    public function actionAccount()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect('index.php?r=site/login', 301);

        }else{
            return $this->render('account');


        }

    }
    /**
     * Displays balance page.
     *
     * @return string
     */
    public function actionBalance()
    {
        return $this->render('balance');
    }

    /**
     * Displays privacy policy page.
     *
     * @return string
     */
    public function actionPolicy()
    {
        return $this->render('privacyPolicy');
    }
    /**
     * Displays help  page.
     *
     * @return string
     */
    public function actionHelp()
    {
        return $this->render('help');
    }

    /**
     * Displays privacy policy page.
     *
     * @return string
     */
    public function actionAgreement()
    {
        return $this->render('agreement');
    }


    /**
     * Displays privacy policy page.
     *
     * @return string
     */
    public function actionDemo()
    {
        return $this->render('demo');
    }
    /**
     * Displays privacy policy page.
     *
     * @return string
     */
    public function actionUsers()
    {
        return $this->render('users');
    }
    public function actionPay()
    {
        return $this->render('pay');
    }

    public function actionShow($data)
    {
        return $this->renderAjax('_modelview', [
            'data' => $data,
        ]);
    }
    /**
     * Displays privacy policy page.
     *
     * @return string
     */
    public function actionTariff()
    {
        return $this->render('tariff');
    }

    /**
     * Displays receive page.
     *
     * @return string
     */
    public function beforeAction($action) {
        if ($action->id === 'receive') {
            $this->enableCsrfValidation = false; //отключаем CSRF, так извне вызываем наш скрипт джастом
        }
        $this->enableCsrfValidation = false;
        return parent::beforeAction($action);
    }

    public function actionReceive()
    {
        $this->enableCsrfValidation = false; //отключаем CSRF, так извне вызываем наш скрипт джастом

     //  $_POST['notification_type']='0';

        $secret_key = 'nuvpdjAV4fcBr8WGp7vFDij1'; // секретное слово, которое мы получили в предыдущем шаге.

        // возможно некоторые из нижеперечисленных параметров вам пригодятся
        // $_POST['operation_id'] - номер операция
        // $_POST['amount'] - количество денег, которые поступят на счет получателя
        // $_POST['withdraw_amount'] - количество денег, которые будут списаны со счета покупателя
        // $_POST['datetime'] - тут понятно, дата и время оплаты
        // $_POST['sender'] - если оплата производится через Яндекс Деньги, то этот параметр содержит номер кошелька покупателя
        // $_POST['label'] - лейбл, который мы указывали в форме оплаты
        // $_POST['email'] - email покупателя (доступен только при использовании https://)

        $sha1 = sha1( $_POST['notification_type'] . '&'. $_POST['operation_id']. '&' . $_POST['amount'] . '&643&' . $_POST['datetime'] . '&'. $_POST['sender'] . '&' . $_POST['codepro'] . '&' . $secret_key. '&' . $_POST['label'] );

        if ($sha1 != $_POST['sha1_hash'] ) {
            // тут содержится код на случай, если верификация не пройдена
            Yii::$app->mailer->compose()
                ->setTo('rent-scanner@yandex.ru')
                ->setFrom(['rent-scanner@yandex.ru' => 'Оплата подписки'])
                ->setSubject('Подписка не оплачена')
                ->setTextBody("E-mail: ".$_POST['operation_id']."\n Телефон: ".$_POST['label'])
                ->send();


// создаем экземпляр класса
$model = new Payments;
//$model->id_user = Yii::$app->user->identity->id;
$model->notification_type = $_POST['notification_type'];
$model->operation_id = $_POST['operation_id'];
$model->amount = $_POST['amount'];
$model->datetime = $_POST['datetime'];
$model->sender = $_POST['sender'];
$model->label = $_POST['label'];


  $model->save();



    
            exit();
        }

        // тут код на случай, если проверка прошла успешно
        Yii::$app->mailer->compose()
            ->setTo('rent-scanner@yandex.ru')
            ->setFrom(['rent-scanner@yandex.ru' => 'Оплата подписки'])
            ->setSubject('Успешная оплата подписки')
            ->setTextBody("дата и время оплаты: ".Yii::$app->request->post('datetime', null).
                "/n/rномер операции: ".Yii::$app->request->post('operation_id', null).
                "/n/rколичество денег, которые поступят на счет получателя: ".Yii::$app->request->post('amount', null).
                "/n/rколичество денег, которые будут списаны со счета покупателя: ".Yii::$app->request->post('withdraw_amount', null).
                "/n/rномер кошелька покупателя: ".Yii::$app->request->post('sender', null).
                "/n/rлейбл, который мы указывали в форме оплаты: ".Yii::$app->request->post('label', null).
                "/n/remail покупателя: ".Yii::$app->request->post('email', null))


            ->send();






           //     $model = User::find()->where(['username' => 'admin3'])->one();
$model = new Payments;
//$model->id_user = Yii::$app->user->identity->id;
$model->id_user = $_POST['label'];
$model->notification_type = $_POST['notification_type'];
$model->operation_id = $_POST['operation_id'];
$model->amount = $_POST['amount'];
$model->datetime = $_POST['datetime'];
$model->sender = $_POST['sender'];
$model->label = $_POST['label'];

$model->save();

        $client_payment = new ClientPayment;
        $client_payment->client_id = $model->id;
        $client_payment->payment_id = $model->id_user;
        $client_payment->staff_id = 0;
        $client_payment->date = $model->datetime;
        $client_payment->status = 2;
        $client_payment->summ = $model->amount;
        $client_payment->type = 3;
        $client_payment->comment = $model->sender ;
        $client_payment->save();


 $balance = User::findOne($_POST['label']);
 $balance_sum = $balance->balance;
$balance->balance = $balance_sum + $_POST['withdraw_amount'];

 $balance->save();


        exit();
    }
    /**
     * Displays account page.
     *
     * @return string
     */

    public function actionPayments(){
        $payments = Payments::find()->where(['id_user' => Yii::$app->user->identity->id])->all();
        return $this->render('payments',['payments'=>$payments]);
    }

    /**
     * Displays account page.
     *
     * @return string
     */

    public function actionAddBalance($new){

        $balance = User::findOne(Yii::$app->user->identity->id);
        $today = time();
        $balance_sum = Yii::$app->user->identity->balance;

      //  $new =int($new);

        if($new == '99'){ $timestamp = 86400;}
        if($new == '249'){ $timestamp = 604800;}
        if($new == '600'){ $timestamp = 2592000;}
        if($new == '1049'){ $timestamp = 5184000;}
        if($new == '1499'){ $timestamp = 7776000;}


        if($new!='demo'){
            if($balance_sum>=$new){
                if($new == '99' OR $new == '249' OR $new == '600' OR $new == '1049' OR $new == '1499'){
                    if(Yii::$app->user->identity->access_to>$today){
                        $today = Yii::$app->user->identity->access_to + $timestamp;
                    }else{
                        $today = $today + $timestamp;
                    }
                }
                // $newbalance = $balance - $new;
                $balance->balance = Yii::$app->user->identity->balance - $new;
                $balance->access_to = $today;
                $balance->save();
                Yii::$app->session->setFlash('success', "Тариф успешно продлен");
            }else{
                Yii::$app->session->setFlash('danger', "Недостаточно средств для продления тарифа. ");

            }

        }else{
            $demo = Yii::$app->user->identity->demo;

            if($demo!='1'){
                $today = $today + 86400;
                $balance->access_to = $today;
                $balance->demo = 1;

                $balance->save();
                Yii::$app->session->setFlash('success', "Демо доступ успешно активировался.");
                return $this->redirect('account', 301);


            }else{
                Yii::$app->session->setFlash('danger', "К сожалению демо - доступом можно воспользоваться один раз.");
                return $this->redirect('tariff', 301);

            }

        }


      //  $new = Yii::$app->request->get('id');

      //  $payments = Payments::find()->where(['id_user' => Yii::$app->user->identity->id])->all();
      //  return $this->render('payments',['payments'=>$payments]);
     //   return $this->render('user/account');
      //  return $this->redirect('index.php?r=site%2Faccount', 301);
        return $this->redirect('tariff', 301);

    }
// Экшен добавления админа
/*


    $model = User::find()->where(['username' => 'admin'])->one();
    if (empty($model)) {
        $user = new User();
        $user->username = 'admin';
        $user->email = 'admin@кодер.укр';
        $user->setPassword('admin');
        $user->generateAuthKey();
        if ($user->save()) {
            echo 'good';
        }
    }

*/

public function actionAddAdmin() {
Yii::$app->mailer->compose()
    ->setFrom('rent-scanner@yandex.ru')
    ->setTo('m.sokirkin@yandex.ru')
    ->setSubject('Уведемление с сайта <yourDomain>') // тема письма
    ->setTextBody('Текстовая версия письма (без HTML)')
    ->setHtmlBody('<p>HTML версия письма</p>')
    ->send();

}



}
