<?php
/* @var $this yii\web\View */
use yii\helpers\Html;
$this->title = 'Список новостей';
?>

<br><br>
<table class="table table-striped table-hover">
    <tr>
        <td>#</td>
        <td>Активность</td>
        <td>Заголовок</td>
        <td>Изображение</td>
        <td>Описание</td>
        <td>Текст</td>
        <td>Дата</td>
        <td>Категория</td>
        <td></td>
    </tr>
    <?php foreach ($news as $nw): ?>
        <tr>
            <td><?php echo $nw->id; ?></td>
            <td><?php echo ($nw->active ? "Активна" : "Не активна"); ?></td>
            <td><?php echo $nw->title; ?></td>
            <td><?php echo $nw->image; ?></td>
            <td><?php echo $nw->description; ?></td>
            <td><?php echo $nw->text; ?></td>
            <td><?php echo $nw->date; ?></td>
            <td><?php echo (isset($category[$nw->category]) ? $category[$nw->category] : 'нет данных'); ?></td>
            <td><?php echo Html::a(NULL, array('site/updatenews', 'id'=>$nw->id), array('class'=>'icon icon-edit')); ?></td>
        </tr>
    <?php endforeach; ?>
</table>