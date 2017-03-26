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
            'asc' => ['blog_posts.name' => SORT_ASC],
            'desc' => ['blog_posts.name' => SORT_DESC],
            'label' => 'Пост'
        ];

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'post_id' => $this->post_id,
            'date' => $this->date,
            'status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'text', $this->text]);
        $query->joinWith(['post' => function ($q) {
            $q->where('blog_posts.name LIKE "%' . $this->postName . '%"');
        }]);

        return $dataProvider;
    }
}
