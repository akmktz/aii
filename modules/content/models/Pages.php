<?php

namespace app\modules\content\models;

use Yii;

/**
 * This is the model class for table "content_pages".
 *
 * @property integer $id
 * @property string $name
 * @property string $alias
 * @property integer $status
 * @property string $h1
 * @property string $title
 * @property string $description
 * @property string $keywords
 * @property string $text
 */
class Pages extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'content_pages';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'alias'], 'required'],
            [['name', 'alias'], 'string', 'min' => 3, 'max' => 50],
            [['alias'], 'unique'],
            [['text'], 'string'],
            [['h1', 'title', 'description', 'keywords'], 'string', 'max' => 255],
            [['status'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Название',
            'alias' => 'Алиас',
            'status' => 'Опубликовано',
            'h1' => 'H1',
            'title' => 'Title',
            'description' => 'Description',
            'keywords' => 'Keywords',
            'text' => 'Текст',
        ];
    }
}
