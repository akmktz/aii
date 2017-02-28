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
            [['id', 'published'], 'integer'],
            [['name', 'alias', 'text', 'publish_date'], 'safe'],
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
            'published' => $this->published,
            //'publish_date' => [$this->publish_date],
        ]);

        $this->publish_date = trim($this->publish_date);

        if (preg_match('/^\d{1,2}\.\d{1,2}\.\d{2,4}$/', $this->publish_date)
            && $date = \DateTime::createFromFormat('d.m.Y', $this->publish_date))
        {
            $query->andFilterWhere(['>=', 'publish_date', $date->format('Y-m-d 00:00:00')])
                  ->andFilterWhere(['<=', 'publish_date', $date->format('Y-m-d 23:59:59')]);
        }
        if (preg_match('/^\d{1,2}\.\d{1,2}\.\d{2,4}\s*-\s*\d{1,2}\.\d{1,2}\.\d{2,4}$/', $this->publish_date)
            && count($date = explode('-', $this->publish_date, 2)) == 2)
        {
            if (($date1 = \DateTime::createFromFormat('d.m.Y', trim($date[0])))
                && ($date2 = \DateTime::createFromFormat('d.m.Y', trim($date[1]))))
            {
                $query->andFilterWhere(['>=', 'publish_date', $date1->format('Y-m-d 00:00:00')])
                    ->andFilterWhere(['<=', 'publish_date', $date2->format('Y-m-d 23:59:59')]);
            }
        }
        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'alias', $this->alias])
            ->andFilterWhere(['like', 'text', $this->text]);

        return $dataProvider;
    }
}
