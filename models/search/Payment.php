<?php

namespace wartron\yii2account\billing\models\search;

use Exception;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use wartron\yii2account\billing\models\Payment as BasePayment;

class Payment extends BasePayment
{
  /**
    * @inheritdoc
    */
    public function rules()
    {
        return [
            [['id', 'status', 'amount', 'created_at',  ], 'integer'],
            [['status', 'description', 'created_by'], 'safe'],
        ];
    }

    /**
    * @inheritdoc
    */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
    * Creates data provider instance with search query applied
    *
    * @param array $params
    *
    * @return ActiveDataProvider
    */
    public function search($params)
    {
        $query = BasePayment::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => array('pageSize' => 10),
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'status' => $this->status,
            'amount' => $this->amount,
            'created_at' => $this->created_at,
            'created_by' => $this->created_by,
        ]);

        $query->andFilterWhere(['like', 'description', $this->description]);

        return $dataProvider;
    }

}