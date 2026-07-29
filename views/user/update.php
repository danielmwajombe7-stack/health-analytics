<?php

use yii\widgets\ActiveForm;
use yii\helpers\Html;

$this->title = "Update User";

?>


<div class="container-fluid">


<div class="card shadow border-0">


<div class="card-header text-white"
style="
background:linear-gradient(135deg,#0f766e,#22c55e);
border-radius:10px 10px 0 0;
">

<h3>
✏️ Update User
</h3>

</div>



<div class="card-body">


<?php $form = ActiveForm::begin(); ?>


<div class="row">


<div class="col-md-6">

<?= $form->field($model,'username')
->textInput([
'class'=>'form-control'
]) ?>

</div>



<div class="col-md-6">

<?= $form->field($model,'full_name')
->textInput([
'class'=>'form-control'
]) ?>

</div>


</div>




<div class="row">


<div class="col-md-6">

<?= $form->field($model,'email')
->textInput([
'class'=>'form-control'
]) ?>

</div>



<div class="col-md-6">

<?= $form->field($model,'role_id')
->textInput([
'class'=>'form-control'
]) ?>

</div>


</div>



<div class="mt-4">


<?= Html::submitButton(
'💾 Save Changes',
[
'class'=>'btn btn-success px-4'
]
) ?>


<?= Html::a(
'Cancel',
['view','id'=>$model->id],
[
'class'=>'btn btn-secondary px-4'
]
) ?>


</div>



<?php ActiveForm::end(); ?>


</div>


</div>


</div>s