<?php

namespace app\CMS;

use app\modules\blog\models\Categories;
use yii\helpers\Url;
use yii\web\Controller;

class CController extends Controller
{
    public $_menu;
    public $_subMenu;

    public function beforeAction($action)
    {
        // Menu
        $this->_menu = [
            ['label' => 'Категории', 'url' => '/'],
            ['label' => 'О проекте', 'url' => '/site/about'],
            ['label' => 'Контакты', 'url' => '/site/contact'],
        ];
        if (!\Yii::$app->user->isGuest) {
            $this->_menu[] =  ['label' => 'Админка', 'url' => '/admin'];
            //$this->_menu[] = ['label' => 'Logout', 'url' => ['/site/logout']];
        } else {
            //$this->_menu[] =  ['label' => 'Login', 'url' => ['/site/login']];
        }

        foreach ($this->_menu as &$obj) {
            $obj['active'] =
                (strpos($_SERVER['REQUEST_URI'], Url::to($obj['url'])) !== false && Url::to($obj['url']) != '/')
                || (Url::to($obj['url']) == '/' && $_SERVER['REQUEST_URI'] == '/');
        }

        // Categories
        $result = Categories::find()->where('status = 1')->andWhere('date <= now()')->limit(8)->orderBy('name')->all();
        unset($obj);
        foreach ($result as $obj) {
            $this->_subMenu[] = [
                $url = ['group', 'groupAlias' => $obj->alias],
                'label' => $obj->name,
                'url' => $url,
                'active' => strpos($_SERVER['REQUEST_URI'], Url::to($url)) !== false,
            ];
        }


        $result = parent::beforeAction($action);
        return $result;
    }

}
