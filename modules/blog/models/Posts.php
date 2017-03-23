<?php

namespace app\modules\blog\models;

use Yii;
use yii\behaviors\AttributeBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "blog_posts".
 *
 * @property integer $id
 * @property string $name
 * @property string $alias
 * @property string $text
 * @property integer $status
 * @property string $date
 * @property integer $category
 * @property string $tags
 *
 * @property Categories $category0
 */
class Posts extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'blog_posts';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'alias', 'category', 'date', 'text'], 'required'],
            [['tags'], 'string'],
            [['status', 'category'], 'integer'],
            [['date'], 'date', 'format' => 'php:d.m.Y'],
            [['name', 'alias', 'text'], 'string', 'min' => 3, 'max' => 255],
            [['alias'], 'unique'],
            [['category'], 'exist', 'skipOnError' => true, 'targetClass' => Categories::className(), 'targetAttribute' => ['category' => 'id']],
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
            'text' => 'Текст',
            'status' => 'Публикация',
            'date' => 'Дата публикации',
            'category' => 'Категория',
            'tags' => 'Теги',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory0()
    {
        return $this->hasOne(Categories::className(), ['id' => 'category']);
    }

    public function listCategories()
    {
        $result = [null => '-- Не указана --'];
        $temp = Categories::find()->orderBy('name')->all();
        foreach ($temp as $obj) {
            $result[$obj->id] = $obj->name;
        }

        return $result;
    }
}
