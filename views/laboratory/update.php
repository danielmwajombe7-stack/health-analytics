<?php

use yii\widgets\ActiveForm;
use yii\helpers\Html;

/* @var $model app\models\LabRequests */

$this->title = 'Update Laboratory Result';

?>

<div class="container-fluid">

    <h2 class="mb-4">
        🧪 Update Laboratory Result
    </h2>

    <div class="card shadow">

        <div class="card-body">

            <?php $form = ActiveForm::begin(); ?>

            <?= $form->field($model, 'result')->textarea([
                'rows' => 6,
                'placeholder' => 'Enter laboratory findings...'
            ]) ?>

            <?= $form->field($model, 'status')->dropDownList([
                'Pending' => 'Pending',
                'Completed' => 'Completed',
            ]) ?>

            <div class="mt-3">

                <?= Html::submitButton(
                    '💾 Save Result',
                    [
                        'class' => 'btn btn-success'
                    ]
                ) ?>

                <?= Html::a(
                    '← Back',
                    ['index'],
                    [
                        'class' => 'btn btn-secondary'
                    ]
                ) ?>

            </div>

            <?php ActiveForm::end(); ?>

        </div>

    </div>

</div>