<?php

namespace app\CMS;

use app\modules\blog\models\Categories;
use app\modules\blog\models\Comments;
use app\modules\blog\models\Posts;
use yii\helpers\Url;
use yii\web\Controller;

class CController extends Controller
{
    public $_menu;
    public $_subMenu;
    public $_mainPosts;
    public $_mainComments;
    public $_mainTags;

    public function beforeAction($action)
    {
        // Menu
        $this->_menu = [
            ['label' => 'Категории', 'url' => '/'],
            ['label' => 'О проекте', 'url' => '/site/about'],
            ['label' => 'Контакты', 'url' => '/site/contact'],
            ['label' => 'Админка', 'url' => '/admin'],
        ];

        foreach ($this->_menu as &$obj) {
            $obj['active'] =
                (strpos($_SERVER['REQUEST_URI'], Url::to($obj['url'])) !== false && Url::to($obj['url']) != '/')
                || (Url::to($obj['url']) == '/' && $_SERVER['REQUEST_URI'] == '/');
        }
        unset($obj);

        // Categories
        $result = Categories::find()
            ->where('status = 1')
            ->andWhere('date <= now()')
            ->limit(8)
            ->orderBy('name')
            ->all();
        foreach ($result as $obj) {
            $url = ['group', 'groupAlias' => $obj->alias];
            $this->_subMenu[] = [
                'label' => $obj->name,
                'url' => $url,
                'active' => strpos($_SERVER['REQUEST_URI'], Url::to($url)) !== false,
            ];
        }

        // Posts
        $result = Posts::find()
            ->with('category')
            ->where('status = 1')
            ->andWhere('date <= now()')
            ->limit(6)
            ->orderBy('Rand()')
            ->all();
        foreach ($result as $obj) {
            $url = ['post', 'groupAlias' => $obj->category->alias, 'postAlias' => $obj->alias];
            $this->_mainPosts[] = [
                'label' => $obj->name,
                'date' => $obj->date,
                'url' => $url,
                'active' => strpos($_SERVER['REQUEST_URI'], Url::to($url)) !== false,
            ];
        }

        // Comments
        $result = Comments::find()
            ->with('post')
            ->where('status = 1')
            ->andWhere('date <= now()')
            ->limit(6)
            ->orderBy('Rand()')
            ->all();
        foreach ($result as $obj) {
            $this->_mainComments[] = [
                'name' => $obj->name,
                'text' => \yii\helpers\StringHelper::truncate($obj->text, 27, '...'),
            ];
        }

        // Tags
        $result = Posts::find()
            ->where('status = 1')
            ->andWhere('date <= now()')
            ->andWhere('TRIM(IFNULL(tags, "")) > ""')
            ->orderBy('Rand()')
            ->limit(20)
            ->all();
        $tags = '';
        foreach ($result as $obj) {
            $tags .= ' ' . $obj->tags;
        }
        $tags =  array_slice(explode(' ', trim($tags)), 0, 20);
        $this->_mainTags = $tags;

        return parent::beforeAction($action);
    }

}
