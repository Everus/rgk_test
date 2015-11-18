<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Books */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Books', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <h4 class="modal-title" id="bookModalTitle"><?= Html::encode($this->title) ?></h4>
</div>
<div class="modal-body">
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name:ntext',
            'date_create',
            'date_update',
            [
                'label' => 'preview',
                'format' => 'raw',
                'value' => Html::a(Html::img($model->getPreviewThumbURL()), $model->getPreviewURL(), ['rel' => 'fancybox']),
            ],
            'date',
            'author.fullname',
        ],
    ]) ?>
</div>
