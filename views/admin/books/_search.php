<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Authors;

/* @var $this yii\web\View */
/* @var $model app\models\BooksSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="books-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'class' => 'form-inline'
        ]
    ]); ?>

    <div class="row">
        <div class="col-md-4">
            <?= $form->field($model, 'author_id')->DropDownList(ArrayHelper::map(Authors::find()->all(), 'id', 'fullName'), [
                'prompt' => $model->getAttributeLabel( 'author_id' ),
                'class' => 'form-control input-sm',
            ])->label(false) ?>
            <?= $form->field($model, 'name')->textInput([
                'placeholder' => $model->getAttributeLabel( 'name' ),
                'class' => 'form-control input-sm',
            ])->label(false) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-11">
            <?= $form->field($model, 'dateFrom')->widget(\yii\jui\DatePicker::className(),[
                'dateFormat' => 'yyyy-MM-dd',
                'class' => 'form-control',
                'options' => ['class' => 'form-control input-sm']
            ]) ?>
            <?= $form->field($model, 'dateTo')->widget(\yii\jui\DatePicker::className(),[
                'dateFormat' => 'yyyy-MM-dd',
                'options' => ['class' => 'form-control input-sm']
            ]) ?>
        </div>
        <div class="form-group col-md-1">
            <?= Html::submitButton('Искать', ['class' => 'btn btn-primary btn-sm']) ?>
        </div>
    </div>


    <?php // echo $form->field($model, 'date') ?>

    <?php ActiveForm::end(); ?>

</div>
