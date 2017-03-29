<?php

namespace app\modules\blog\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\blog\models\Posts;

/**
 * PostsSearch represents the model behind the search form about `app\modules\blog\models\Posts`.
 */
class PostsSearch extends Posts
{
    public $categories = [];

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'status', 'category_id'], 'integer'],
            [['name', 'alias', 'text', 'date', 'tags'], 'safe'],
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
        $query = Posts::find()->with('category');

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
            'id' => $this->id,
            'status' => $this->status,
            'category_id' => $this->category_id,
        ]);

        $this->date = trim($this->date);

        if (preg_match('/^\d{1,2}\.\d{1,2}\.\d{2,4}$/', $this->date)
            && $date = \DateTime::createFromFormat('d.m.Y', $this->date))
        {
            $query->andFilterWhere(['>=', 'date', $date->format('Y-m-d')])
                ->andFilterWhere(['<=', 'date', $date->format('Y-m-d')]);
        }
        if (preg_match('/^\d{1,2}\.\d{1,2}\.\d{2,4}\s*-\s*\d{1,2}\.\d{1,2}\.\d{2,4}$/', $this->date)
            && count($date = explode('-', $this->date, 2)) == 2)
        {
            if (($date1 = \DateTime::createFromFormat('d.m.Y', trim($date[0])))
                && ($date2 = \DateTime::createFromFormat('d.m.Y', trim($date[1]))))
            {
                $query->andFilterWhere(['>=', 'date', $date1->format('Y-m-d')])
                    ->andFilterWhere(['<=', 'date', $date2->format('Y-m-d')]);
            }
        }

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'alias', $this->alias])
            ->andFilterWhere(['like', 'text', $this->text])
            ->andFilterWhere(['like', 'tags', $this->tags]);

        return $dataProvider;
    }

    public function getCategoriesList() {
        $result = [];
        $temp = Posts::find()->with('category')->all();
        if (count($temp)) {
            foreach ($temp as $obj) {
                if (!$obj->category && is_object($obj->category)) {
                    continue;
                }
                $result[$obj->category->id] = $obj->category->name;
            }
        }

        return $result;
    }
}
