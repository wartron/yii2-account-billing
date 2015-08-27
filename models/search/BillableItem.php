<?php

namespace wartron\yii2account\billing\models\search;

use Exception;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use wartron\yii2account\billing\models\BillableItem as BaseBillableItem;

class BillableItem extends BaseBillableItem
{
  /**
    * @inheritdoc
    */
    public function rules()
    {
        return [
            [['id', 'status', 'type', 'amount', 'created_at', 'updated_at', ], 'integer'],
            [['name', 'status', 'type', 'description','data', 'updated_by', 'created_by'], 'safe'],
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
        $query = BaseBillableItem::find();

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
            'type' => $this->type,
            'amount' => $this->amount,
            'created_at' => $this->created_at,
            'created_by' => $this->created_by,
            'updated_at' => $this->updated_at,
            'updated_by' => $this->updated_by,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name]);
        $query->andFilterWhere(['like', 'description', $this->description]);

        return $dataProvider;
    }

}