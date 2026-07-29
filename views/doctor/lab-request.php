<?php

use yii\widgets\ActiveForm;
use yii\helpers\Html;


?>


<div class="card shadow">


<div class="card-header bg-info text-white">

<h3>
Send Laboratory Request
</h3>

</div>



<div class="card-body">


<?php $form=ActiveForm::begin(); ?>



<?= $form->field($model,'test_name')
->textInput([
'placeholder'=>'Blood Test, X-Ray'
]) ?>


<?= $form->field($model,'priority')
->dropDownList([

'Normal'=>'Normal',

'Urgent'=>'Urgent',

'Critical'=>'Critical'

]) ?>


<?= $form->field($model,'doctor_note')
->textarea([
'rows'=>5
]) ?>



<?= Html::submitButton(
'Send To Laboratory',
[
'class'=>'btn btn-primary'
]
) ?>


<?php ActiveForm::end(); ?>


</div>


</div>