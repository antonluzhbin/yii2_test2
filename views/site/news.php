<?php
/* @var $this yii\web\View */
$this->title = $data->title;
?>
<div class="site-about">
    <h2><?php echo $data->title; ?></h1>
    <h3><?php echo $data->date; ?></h3><br>
    <p>
        <?php echo $data->text; ?>
    </p>
    
</div>
