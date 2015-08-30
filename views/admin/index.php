<?php



use wartron\yii2account\billing\models\search\BillableItem;
use yii\data\ActiveDataProvider;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\jui\DatePicker;
use yii\helpers\Html;
use wartron\yii2uuid\helpers\Uuid;

/**
 * @var View $this
 * @var ActiveDataProvider $dataProvider
 * @var AccountSearch $searchModel
 */

$this->title = Yii::t('account-billing', 'Billing Admin');
$this->params['breadcrumbs'][] = $this->title;

