<?php if(Yii::$app->session->hasFlash('CategoryParentError')): ?>
<div class="alert alert-error">
    Не правильный предок (категория не может быть вложена в себя)!
</div>
<?php endif; ?>

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
<?php echo $form->field($model, 'name')->textInput(array('class' => 'span8'))->label('Название'); ?>
<?php echo $form->field($model, 'active')->dropDownList(Array(0 => 'Не активна', 1 => 'Aктивна'))->label('Активность'); ?>
<?php echo $form->field($model, 'parent')->dropDownList($category)->label('Предок'); ?>

    <div class="form-actions">
        <?php echo Html::submitButton('Submit', null, null, array('class' => 'btn btn-primary')); ?>
    </div>

<?php ActiveForm::end(); ?>
