<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Event */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="event-form">
    $form = ActiveForm::begin();
...
// получаем всех авторов
    $authors = Author::find()->all();
// формируем массив, с ключем равным полю 'id' и значением равным полю 'name' 
    $items = ArrayHelper::map($authors,'id','name');
    $params = [
        'prompt' => 'Укажите автора записи'
    ];
    echo $form->field($model, 'author')->dropDownList($items,$params);
...
    ActiveForm::end();
    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>
    <? $rooms = Author::find()->all();
    $items = ArrayHelper::map($rooms,'id','name');
    $params = [
        'prompt' => 'Укажите автора записи'
    ];
    echo $form->field($model, 'room_id')->dropDownList($items,$params);
    ?>


    <?= $form->field($model, 'room_id')->textInput() ?>

    <?= $form->field($model, 'type')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'time_start')->textInput() ?>

    <?= $form->field($model, 'time_end')->textInput() ?>

    <?= $form->field($model, 'date')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
