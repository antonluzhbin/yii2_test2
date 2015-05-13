<?php 

use yii\helpers\Html;
use yii\widgets\ActiveForm;    
use yii\db\Expression;

$form = ActiveForm::begin([
    'id' => 'ride-form',
    'enableClientValidation'=>false,
    'validateOnSubmit' => true
    ]); ?>

<?php echo $form->field($model, 'id')->textInput(array('class' => 'span8', 'readonly' => 'true'))->label('ID'); ?>
<?php echo $form->field($model, 'active')->dropDownList(Array(0 => 'Не активна', 1 => 'Aктивна'))->label('Активность'); ?>
<?php echo $form->field($model, 'title')->textInput(array('class' => 'span8'))->label('Заголовок'); ?>
<?php echo $form->field($model, 'image')->textInput(array('class' => 'span8'))->label('Картинка'); ?>
<?php echo $form->field($model, 'description')->textArea()->label('Описание'); ?>
<?php echo $form->field($model, 'text')->textArea()->label('Текст'); ?>
<?php echo $form->field($model, 'date')->textInput(array('class' => 'span8'))->label('Дата'); ?>
<?php echo $form->field($model, 'category')->dropDownList($category)->label('Категория'); ?>


    <div class="form-actions">
        <?php echo Html::submitButton('Submit', null, null, array('class' => 'btn btn-primary')); ?>
    </div>

<?php ActiveForm::end(); ?>
