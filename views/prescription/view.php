<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

$this->title = 'Prescription Details';

?>

<div class="container-fluid">

<div class="card shadow border-0 rounded-4">

<div class="card-header bg-success text-white">

<h3>

<i class="fa fa-prescription-bottle"></i>

Prescription Details

</h3>

</div>

<div class="card-body">

<?= DetailView::widget([

    'model'=>$model,

    'attributes'=>[

        'id',

        [
            'label'=>'Patient',
            'value'=>$model->patient ? $model->patient->fullName : 'N/A',
        ],

        [
            'label'=>'Doctor',
            'value'=>$model->doctor ? $model->doctor->username : 'N/A',
        ],

        'drug_name',

        'dosage',

        'frequency',

        'duration',

        'instructions:ntext',

        'status',

    ],

]); ?>

</div>

<div class="card-footer">

<?= Html::a(
    '<i class="fa fa-edit"></i> Update',
    ['update','id'=>$model->id],
    ['class'=>'btn btn-warning']
) ?>

<?= Html::a(
    '<i class="fa fa-arrow-left"></i> Back',
    ['index'],
    ['class'=>'btn btn-secondary']
) ?>

</div>

</div>

</div>