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
 * @property Posts[] $posts
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
            [['name', 'alias', 'date', 'text'], 'required'],
            [['status'], 'integer'],
            [['date'], 'date', 'format' => 'php:d.m.Y'],
            [['name', 'alias'], 'string', 'min' => 3, 'max' => 255],
            ['text', 'string', 'min' => 3],
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
                    ActiveRecord::EVENT_AFTER_FIND    => 'date',
                ],
                'value' => function ($event) {
                    if ($event->name == 'afterFind') {
                        return \DateTime::createFromFormat('Y-m-d',$event->sender->attributes['date'])->format('d.m.Y');
                    } else {
                        return \DateTime::createFromFormat('d.m.Y',$event->sender->attributes['date'])->format('Y-m-d');
                    }
                },
            ],
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
            'status' => 'Опубликовано',
            'date' => 'Дата публикации',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPosts()
    {
        return $this->hasMany(Posts::className(), ['category' => 'id']);
    }
}
