<?php

namespace wartron\yii2account\billing\controllers;

use wartron\yii2account\billing\models\Payment;
use wartron\yii2account\billing\models\search\Payment as PaymentSearch;
use Yii;
use yii\base\ExitException;
use yii\base\Model;
use yii\base\Module as Module2;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Response;
use yii\widgets\ActiveForm;
use wartron\yii2uuid\helpers\Uuid;
use yii\data\ActiveDataProvider;


class PaymentController extends Controller
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
        Url::remember('', 'actions-redirect');
        $searchModel  = Yii::createObject(PaymentSearch::className());
        $dataProvider = $searchModel->search(Yii::$app->request->get());

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'searchModel'  => $searchModel,
        ]);
    }

    public function actionView($id)
    {
        Url::remember('', 'actions-redirect');
        $payment = $this->findModel($id);

        $itemDp = new ActiveDataProvider([
            'query' => $payment->getItems()
        ]);

        return $this->render('view', [
            'model'     =>  $payment,
            'itemDp'    =>  $itemDp
        ]);
    }


    protected function findModel($id)
    {
        $id = Uuid::str2uuid($id);
        $payment = Payment::findOne($id);
        if ($payment === null) {
            throw new NotFoundHttpException('The requested page does not exist');
        }

        return $payment;
    }
}
