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
            [['id', 'status', 'type' , 'created_at', 'created_by', 'updated_at', 'updated_by'], 'integer'],
            [['name', 'status', 'type'], 'safe'],
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
            // uncomment the following line if you do not want to any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'created_by' => $this->created_by,
            'updated_at' => $this->updated_at,
            'updated_by' => $this->updated_by,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name]);

        return $dataProvider;
    }

}