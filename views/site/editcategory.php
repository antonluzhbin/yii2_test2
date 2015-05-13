<?php
/* @var $this yii\web\View */
use yii\helpers\Html;
$this->title = 'Список категорий';
?>
<table class="table table-striped table-hover">
    <tr>
        <td>#</td>
        <td>Название</td>
        <td>Активность</td>
        <td>Вложенность</td>
        <td></td>
    </tr>
    <?php foreach ($category as $cat): ?>
        <tr>
            <td><?php echo $cat->id; ?></td>
            <td><?php echo $cat->name; ?></td>
            <td><?php echo ($cat->active ? 'Активна' : 'Не активна'); ?></td>
            <td><?php echo $cpath[$cat->id]; ?></td>
            <td><?php echo Html::a(NULL, array('site/updatecategory', 'id'=>$cat->id), array('class'=>'icon icon-edit')); ?></td>
        </tr>
    <?php endforeach; ?>
</table>