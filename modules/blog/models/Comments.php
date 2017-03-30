<?php

namespace app\modules\blog\models;

use Yii;
use yii\behaviors\AttributeBehavior;
use yii\db\ActiveRecord;
use yii\helpers\HtmlPurifier;

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
            [['post_id', 'name', 'text', 'email'], 'required'],
            [['post_id', 'status'], 'integer'],
            [['date'], 'safe'],
            [['email'], 'email'],
            [['name', 'text'], 'string', 'min' => 3, 'max' => 1024],
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

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            $purifier = new HtmlPurifier();
            $this->name  = $purifier->process($this->name, ['HTML.Allowed' => '']);
            $this->text  = $purifier->process($this->text, ['HTML.Allowed' => '']);
            return true;
        } else {
            return false;
        }
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
