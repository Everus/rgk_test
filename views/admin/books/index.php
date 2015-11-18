<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\data\ActiveDataProvider;
use app\models\Books;

/* @var $this yii\web\View */
/* @var $searchModel app\models\BooksSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Книги';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="books-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <p>
        <?= Html::a('Добавить книгу', ['create'], ['class' => 'btn btn-success btn-sm']) ?>
    </p>

    <?php echo $this->render('_search', ['model' => $searchModel]); ?>
    <?= GridView::widget([
        'dataProvider' => $searchModel->search(Yii::$app->getRequest()->getQueryParams()),
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name:ntext',
            [
                'label' =>  $searchModel->getAttributeLabel( 'preview' ),
                'format' => 'raw',
                'value' => function(Books $data)
                {
                    return Html::a(Html::img($data->getPreviewThumbURL()), $data->getPreviewURL(), ['rel' => 'fancybox']);
                }
            ],
            'author.fullName',
            'date',
            'date_create',
            //'date_update',

            [
                'class' => \yii\grid\ActionColumn::className(),
                'template'=>'{view} {update} {delete}',
                'buttons' => [
                    'update' => function ($url, $model, $key) {
                        $options = [
                            'title' => Yii::t('yii', 'Update'),
                            'aria-label' => Yii::t('yii', 'Update'),
                            'data-pjax' => '0',
                            'target' => '_blank',
                        ];
                        return Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url, $options);
                    },
                ]
            ],
        ],
    ]); ?>

</div>
<?= $this->render('modal'); ?>