<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
?>

<div class="modal fade" id="bookModal" tabindex="-1" role="dialog" aria-labelledby="bookModalTitle">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content" data-default-content='<div style="text-align:center"><?= Html::img('@web/images/loading_spinner.gif')?></div>'>
        </div>
    </div>
</div>
<?php $this->registerJsFile('@web/js/modal.js', ['depends' => '\yii\web\JqueryAsset']) ?>