<?php

namespace app\modules\blog\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\blog\models\Categories;

/**
 * CategoriesSearch represents the model behind the search form about `app\modules\blog\models\Categories`.
 */
class CategoriesSearch extends Categories
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'status'], 'integer'],
            [['name', 'alias', 'text', 'date'], 'safe'],
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
        $query = Categories::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id'        => $this->id,
            'status' => $this->status,
            //'date' => [$this->date],
        ]);

        $this->date = trim($this->date);

        if (preg_match('/^\d{1,2}\.\d{1,2}\.\d{2,4}$/', $this->date)
            && $date = \DateTime::createFromFormat('d.m.Y', $this->date))
        {
            $query->andFilterWhere(['>=', 'date', $date->format('d-m-Y 00:00:00')])
                  ->andFilterWhere(['<=', 'date', $date->format('d-m-Y 23:59:59')]);
        }
        if (preg_match('/^\d{1,2}\.\d{1,2}\.\d{2,4}\s*-\s*\d{1,2}\.\d{1,2}\.\d{2,4}$/', $this->date)
            && count($date = explode('-', $this->date, 2)) == 2)
        {
            if (($date1 = \DateTime::createFromFormat('d.m.Y', trim($date[0])))
                && ($date2 = \DateTime::createFromFormat('d.m.Y', trim($date[1]))))
            {
                $query->andFilterWhere(['>=', 'date', $date1->format('d-m-Y 00:00:00')])
                    ->andFilterWhere(['<=', 'date', $date2->format('d-m-Y 23:59:59')]);
            }
        }
        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'alias', $this->alias])
            ->andFilterWhere(['like', 'text', $this->text]);

        return $dataProvider;
    }
}
