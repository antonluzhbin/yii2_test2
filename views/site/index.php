<?php
/* @var $this yii\web\View */
use yii\helpers\Html;
$this->title = 'Главная страница';
?>
<table class="table table-striped table-hover">
    <tr>
        <td>Название</td>
        <td>Вложенность</td>
    </tr>
    <tr>
            <td>
                <?php echo Html::a('Все категории', array('site/index')); ?>
            </td>
            <td>Нет</td>
        </tr>
    <?php foreach ($category as $cat): ?>
        <?php if($cat->active) : ?>
        <tr>
            <td>
                <?php echo Html::a($cat->name, array('site/index', 'cat'=>$cat->id)); ?>
            </td>
            <td><?php echo $cpath[$cat->id]; ?></td>
        </tr>
        <?php endif; ?>
    <?php endforeach; ?>
</table>

<br><br>
<table class="table table-striped table-hover">
    <tr>
        <td>Заголовок</td>
        <td>Изображение</td>
        <td>Описание</td>
        <td>Дата</td>
        <td>Ссылка</td>
    </tr>
    <?php foreach ($news as $nw): ?>
        <?php if($nw->active) : ?>
        <tr>
            <td><?php echo $nw->title; ?></td>
            <td><?php echo Html::img($nw->image); ?></td>
            <td><?php echo $nw->description; ?></td>
            <td><?php echo $nw->date; ?></td>
            <td>
                <?php echo Html::a('Ссылка', array('site/news', 'id'=>$nw->id)); ?>
            </td>
        </tr>
        <?php endif; ?>
    <?php endforeach; ?>
</table>