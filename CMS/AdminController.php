<?php

namespace app\CMS;

use dosamigos\tinymce\TinyMce;
use Yii;
use yii\web\Controller;

class AdminController extends Controller
{
    public function beforeAction($action)
    {
        if (\Yii::$app->user->isGuest) {
            if ($action->id != 'login' || $action->controller->id != 'default' || $action->controller->module->id != 'admin') {
                return $this->redirect(['/admin/login']);
                die;
            }
        }

        \Yii::$app->homeUrl = '/admin/';

        $this->layout = '/admin/main';


        // Tiny MCE

        Yii::$container->set(TinyMce::className(), [
            'options' => ['rows' => 20],
            'language' => 'ru',
            'clientOptions' => [
                'class' => 'form-control',
                'classes' => 'form-control',
                'plugins' => [
                    "advlist autolink lists charmap print preview anchor link pagebreak",
                    "searchreplace wordcount textcolor visualblocks visualchars code nonbreaking",
                    "save insertdatetime media table contextmenu paste image imagetools responsivefilemanager filemanager"
                ],
                'toolbar' => "undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image",
                'external_filemanager_path' => '/admins/plugins/responsivefilemanager/filemanager/',
                'filemanager_title' => 'Менеджер файлов',
                'external_plugins' => [
                    'filemanager' => '/admins/plugins/responsivefilemanager/filemanager/plugin.min.js',
                    'responsivefilemanager' => '/admins/plugins/responsivefilemanager/tinymce/plugins/responsivefilemanager/plugin.min.js',
                ],
            ]
        ]);

        return parent::beforeAction($action);
    }

}
