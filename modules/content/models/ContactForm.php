<?php

namespace app\modules\content\models;

use himiklab\yii2\recaptcha\ReCaptchaValidator;
use Yii;
use yii\base\Model;
use yii\helpers\HtmlPurifier;

/**
 * ContactForm is the model behind the contact form.
 */
class ContactForm extends Model
{
    public $name;
    public $email;
    public $phone;
    public $text;
    public $reCaptcha;


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['name', 'email', 'phone', 'text'], 'required'],
            ['name', 'match', 'pattern' => '/^[А-я\w][А-я\w\s]*$/u'],
            ['name', 'string', 'min' => 2, 'max' => 50],
            ['email', 'email'],
            ['phone', 'match', 'pattern' => '/^\+38\(\d{3}\)\d{3}-\d{2}-\d{2}$/',
                            'message' => 'Введите номер телефона в формате: +38(xxx)xxx-xx-xx'],
            ['phone', 'string'],
            ['text', 'string', 'min' => 10],
            [['reCaptcha'], ReCaptchaValidator::className(), 'secret' => '6Lce8hoUAAAAAIyRqPV93o2wUIBptpcL5xHvYdPa']
        ];
    }

    /**
     * @return array customized attribute labels
     */
    public function attributeLabels()
    {
        return [
            'name'  => 'Имя',
            'email' => 'E-Mail',
            'phone' => 'Телефон',
            'text'  => 'Сообщение',
            'reCaptcha' => 'Капча',
        ];
    }

    /**
     * Sends an email to the specified email address using the information collected by this model.
     * @param string $email the target email address
     * @return bool whether the model passes validation
     */
    public function contact($email)
    {
        if ($this->validate()) {
            $site = Yii::$app->name . ' - ' . $_SERVER['HTTP_HOST'];
            $text = HtmlPurifier::process($this->text, ['HTML.Allowed' => '']);
            $message = "Сообщение из контактной формы сайта: $site\nИмя: $this->name\nE-Mail: $this->email\nТелефон: $this->phone\nТекст: $text";
            Yii::$app->mailer->compose()
                ->setTo($email)
                ->setFrom(['wztmpml@mail.ru' => $this->name . " ($this->email)"])
                ->setSubject("Сообщение из контактной формы сайта: $site")
                ->setTextBody($message)
                ->send();

            return true;
        }
        return false;
    }
}
