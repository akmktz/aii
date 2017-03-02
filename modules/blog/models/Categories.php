<?php

namespace app\modules\blog\models;

use \yii\db\ActiveRecord;
use yii\behaviors\AttributeBehavior;

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
class Categories extends ActiveRecord
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
            [['status'], 'integer'],
            [['date'], 'datetime', 'format' => 'php:d.m.Y H:i:s'],
            [['name'], 'string', 'max' => 255],
            [['alias'], 'string', 'max' => 50],
            [['alias'], 'unique'],
        ];
    }

    public function behaviors()
    {
        return [
            [
                'class' => AttributeBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => 'date',
                    ActiveRecord::EVENT_BEFORE_UPDATE => 'date',
                    ActiveRecord::EVENT_AFTER_FIND => 'date',
                ],
                'value' => function ($event) {
                    if ($event->name == 'afterFind') {
                        return \DateTime::createFromFormat('Y-m-d H:i:s',$event->sender->attributes['date'])
                            ->format('d.m.Y H:i:s');
                    } else {
                        return \DateTime::createFromFormat('d.m.Y H:i:s',$event->sender->attributes['date'])
                            ->format('Y-m-d H:i:s');
                    }
                },
            ],
        ];
    }

    public function getDate() {
        return \DateTime::createFromFormat('Y-m-d H:i:s', $this->date)->format('d.m.Y H:i:s');
    }

    public function setDate($date) {
        $this->date = \DateTime::createFromFormat('d.m.Y H:i:s', $date)->format('Y-m-d H:i:s');
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
            'status' => 'Опубликовано',
            'date' => 'Дата публикации',
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
