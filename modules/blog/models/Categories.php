<?php

namespace app\modules\blog\models;

use Yii;

/**
 * This is the model class for table "blog_categories".
 *
 * @property integer $id
 * @property string $name
 * @property string $alias
 * @property string $text
 * @property integer $published
 * @property string $publish_date
 *
 * @property BlogPosts[] $blogPosts
 */
class Categories extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'blog_categories';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'alias'], 'required'],
            [['text'], 'string'],
            [['published'], 'integer'],
            [['publish_date'], 'safe'],
            [['name'], 'string', 'max' => 255],
            [['alias'], 'string', 'max' => 50],
            [['alias'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Id',
            'name' => 'Наименование',
            'alias' => 'Алиас',
            'text' => 'Описание',
            'published' => 'Опубликовано',
            'publish_date' => 'Дата публикации',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBlogPosts()
    {
        return $this->hasMany(BlogPosts::className(), ['category' => 'id']);
    }
}
