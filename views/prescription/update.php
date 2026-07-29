<?php

use yii\helpers\Html;

$this->title = 'Update Prescription';

?>

<div class="container-fluid">

<h2 class="mb-4">
    <i class="fa fa-edit text-warning"></i>
    Update Prescription
</h2>

<?= $this->render('create', [
    'model' => $model,
]) ?>

</div>