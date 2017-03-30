<div class="admin-default-index">
    <h1>Админ панель</h1>
    <p>
        Здесь вы можете управлять разделами:
        <ul>
            <li><span>Блог</span></li>
            <ul>
                <li><?= \yii\helpers\Html::a('Категории', '/admin/blog/categories'); ?></li>
                <li><?= \yii\helpers\Html::a('Посты', '/admin/blog/posts'); ?></li>
                <li><?= \yii\helpers\Html::a('Комментарии', '/admin/blog/comments'); ?></li>
            </ul>
            <li><span><?= \yii\helpers\Html::a('Управление страницами сайта', '/admin/content/pages'); ?></span></li>
        </ul>
    </p>
</div>
