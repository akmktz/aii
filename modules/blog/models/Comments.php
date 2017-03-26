<?php

namespace app\modules\blog\models;

use Yii;
use yii\behaviors\AttributeBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "blog_comments".
 *
 * @property integer $id
 * @property integer $post_id
 * @property string $name
 * @property string $email
 * @property string $text
 * @property string $date
 * @property integer $status
 *
 * @property BlogPosts $post
 */
class Comments extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'blog_comments';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['post_id', 'name', 'email'], 'required'],
            [['post_id', 'status'], 'integer'],
            [['date'], 'safe'],
            [['email'], 'email'],
            [['name', 'text'], 'string', 'min' => 3, 'max' => 255],
            [['post_id'], 'exist', 'skipOnError' => true, 'targetClass' => Posts::className(), 'targetAttribute' => ['post_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Id',
            'post_id' => 'Пост',
            'postName' => 'Пост',
            'name' => 'Имя',
            'email' => 'E-Mail',
            'text' => 'Текст',
            'date' => 'Дата',
            'status' => 'Опубликовано',
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
     * @return \yii\db\ActiveQuery
     */
    public function getPost()
    {
        return $this->hasOne(Posts::className(), ['id' => 'post_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPostName()
    {
        return $this->post->name;
    }

}
