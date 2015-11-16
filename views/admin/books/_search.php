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
    ]); ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'dateFrom')->widget(\yii\jui\DatePicker::className(),['dateFormat' => 'yyyy-MM-dd']) ?>

    <?= $form->field($model, 'dateTo')->widget(\yii\jui\DatePicker::className(),['dateFormat' => 'yyyy-MM-dd']) ?>

    <?= $form->field($model, 'author_id')->DropDownList(ArrayHelper::map(Authors::find()->all(), 'id', 'fullName'), ['prompt' => '']) ?>

    <?php // echo $form->field($model, 'date') ?>


    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
