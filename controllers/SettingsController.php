<?php

namespace wartron\yii2account\billing\controllers;

use yii\filters\AccessControl;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Response;

use wartron\yii2uuid\helpers\Uuid;
use wartron\yii2account\models\Account;
use wartron\yii2account\billing\models\Payment;
use wartron\yii2account\billing\models\BillingAccount;
use wartron\yii2account\billing\models\search\Payment as PaymentSearch;
use Yii;

class SettingsController extends Controller
{

    /** @inheritdoc */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }


    public function actionIndex()
    {

        $account = $this->findAccount();
        $paymentSearch  = Yii::createObject(PaymentSearch::className());
        $paymentDp = $paymentSearch->search(Yii::$app->request->get());
        $paymentDp->sort = false;

        $billingAccount = BillingAccount::findOne(['account_id' =>  $account->id]);


        return $this->render('index', [
            'account'           =>  $account,
            'paymentSearch'     =>  $paymentSearch,
            'paymentDp'         =>  $paymentDp,
            'billingAccount'    =>  $billingAccount,
        ]);
    }

    public function actionNewCard()
    {
        return $this->render('new-card', [
        ]);
    }

    protected function findAccount()
    {
        $account = Account::findOne(Yii::$app->user->identity->getId());
        if ($account === null) {
            throw new NotFoundHttpException('The requested page does not exist');
        }
        return $account;
    }

}
