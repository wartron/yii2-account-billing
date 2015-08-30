<?php


namespace wartron\yii2account\billing\controllers;

use wartron\yii2account\billing\models\BillableItem;
use wartron\yii2account\billing\models\search\BillableItem as BillableItemSearch;
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


class AdminBillableController extends Controller
{

    /** @inheritdoc */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete'  => ['post'],
                ],
            ],
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                        'matchCallback' => function () {
                            return Yii::$app->user->identity->getIsAdmin();
                        },
                    ],
                ],
            ],
        ];
    }



    /**
     * Lists all Account models.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        Url::remember('', 'actions-redirect');
        $searchModel  = Yii::createObject(BillableItemSearch::className());
        $dataProvider = $searchModel->search(Yii::$app->request->get());

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'searchModel'  => $searchModel,
        ]);
    }

    /**
     * Creates a new BillableItem model.
     * If creation is successful, the browser will be redirected to the 'index' page.
     *
     * @return mixed
     */
    public function actionCreate()
    {
        /** @var BillableItem $billable */
        $billable = Yii::createObject([
            'class'    => BillableItem::className(),
        ]);

        $this->performAjaxValidation($billable);

        if ($billable->load(Yii::$app->request->post()) && $billable->save()) {
            Yii::$app->getSession()->setFlash('success', Yii::t('account-billing', 'BillableItem has been created'));

            return $this->redirect(['update', 'id' => Uuid::uuid2str($billable->id)]);
        }

        return $this->render('create', [
            'model' => $billable,
        ]);
    }

    /**
     * Updates an existing BillableItem model.
     *
     * @param int $id
     *
     * @return mixed
     */
    public function actionUpdate($id)
    {
        Url::remember('', 'actions-redirect');
        $billable = $this->findModel($id);

        $this->performAjaxValidation($billable);

        if ($billable->load(Yii::$app->request->post()) && $billable->save()) {
            Yii::$app->getSession()->setFlash('success', Yii::t('account-billing', 'BillableItem details have been updated'));

            return $this->refresh();
        }

        return $this->render('update', [
            'model' => $billable,
        ]);
    }


    /**
     * Shows information about BillableItem.
     *
     * @param int $id
     *
     * @return string
     */
    public function actionView($id)
    {
        Url::remember('', 'actions-redirect');
        $billable = $this->findModel($id);

        return $this->render('view', [
            'model' => $billable,
        ]);
    }


    /**
     * Finds the Account model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     *
     * @param int $id
     *
     * @return Account the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        $id = Uuid::str2uuid($id);
        $billable = BillableItem::findOne($id);
        if ($billable === null) {
            throw new NotFoundHttpException('The requested page does not exist');
        }

        return $billable;
    }

    /**
     * Performs AJAX validation.
     *
     * @param array|Model $model
     *
     * @throws ExitException
     */
    protected function performAjaxValidation($model)
    {
        if (Yii::$app->request->isAjax && !Yii::$app->request->isPjax) {
            if ($model->load(Yii::$app->request->post())) {
                Yii::$app->response->format = Response::FORMAT_JSON;
                echo json_encode(ActiveForm::validate($model));
                Yii::$app->end();
            }
        }
    }
}
