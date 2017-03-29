<?php

namespace app\modules\blog\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\blog\models\Comments;

/**
 * CommentsSearch represents the model behind the search form about `app\modules\blog\models\Comments`.
 */
class CommentsSearch extends Comments
{
    public $postName;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'post_id', 'status'], 'integer'],
            [['postName', 'name', 'email', 'text', 'date'], 'safe'],
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
        $query = Comments::find()->with('post');

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

        $dataProvider->sort->attributes['postName'] = [
            'asc' => [Posts::tableName() . '.name' => SORT_ASC],
            'desc' => [Posts::tableName() . '.name' => SORT_DESC],
            'label' => 'Пост'
        ];

        // grid filtering conditions
        $table = Comments::tableName();

        $query->andFilterWhere([
            $table . '.id' => $this->id,
            'post_id' => $this->post_id,
            $table . '.status' => $this->status,
        ]);

        $this->date = trim($this->date);

        if (preg_match('/^\d{1,2}\.\d{1,2}\.\d{2,4}$/', $this->date)
            && $date = \DateTime::createFromFormat('d.m.Y', $this->date))
        {
            $query->andFilterWhere(['>=', $table . '.date', $date->format('Y-m-d')])
                ->andFilterWhere(['<=', $table . '.date', $date->format('Y-m-d')]);
        }
        if (preg_match('/^\d{1,2}\.\d{1,2}\.\d{2,4}\s*-\s*\d{1,2}\.\d{1,2}\.\d{2,4}$/', $this->date)
            && count($date = explode('-', $this->date, 2)) == 2)
        {
            if (($date1 = \DateTime::createFromFormat('d.m.Y', trim($date[0])))
                && ($date2 = \DateTime::createFromFormat('d.m.Y', trim($date[1]))))
            {
                $query->andFilterWhere(['>=', $table . '.date', $date1->format('Y-m-d')])
                    ->andFilterWhere(['<=', $table . '.date', $date2->format('Y-m-d')]);
            }
        }

        $query->andFilterWhere(['like', $table . '.name', $this->name])
            ->andFilterWhere(['like', $table . '.email', $this->email])
            ->andFilterWhere(['like', $table . '.text', $this->text]);
        $query->joinWith(['post' => function ($q) {
            $q->where(Posts::tableName() . '.name LIKE "%' . $this->postName . '%"');
        }]);

        return $dataProvider;
    }
}
