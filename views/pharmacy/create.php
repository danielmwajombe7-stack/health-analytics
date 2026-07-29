<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;


$this->title = "New Prescription";

?>

<div class="update-page">


<div class="update-header">

<h1>
<i class="bi bi-capsule"></i>
New Prescription
</h1>

<p>
Create patient medication prescription
</p>

</div>


<div class="update-card">


<?php if($model->hasErrors()): ?>

<div class="alert alert-danger">

<?= Html::errorSummary($model); ?>

</div>

<?php endif; ?>



<?php $form = ActiveForm::begin([
'enableClientValidation'=>true
]); ?>



<?= $form->field($model,'visit_id')
->textInput([
'class'=>'form-control',
'placeholder'=>'Enter Visit ID'
])
->label('Visit ID')
?>



<?= $form->field($model,'patient_id')
->textInput([
'class'=>'form-control',
'placeholder'=>'Enter Patient ID'
])
->label('Patient ID')
?>



<?= $form->field($model,'medicine_id')
->textInput([
'class'=>'form-control',
'placeholder'=>'Enter Medicine ID'
])
->label('Medicine')
?>



<?= $form->field($model,'quantity')
->textInput([
'type'=>'number',
'class'=>'form-control',
'value'=>1
])
?>



<?= $form->field($model,'dosage')
->textInput([
'class'=>'form-control',
'placeholder'=>'Example: 500mg'
])
?>



<?= $form->field($model,'frequency')
->textInput([
'class'=>'form-control',
'placeholder'=>'Example: Twice daily'
])
?>



<?= $form->field($model,'duration')
->textInput([
'class'=>'form-control',
'placeholder'=>'Example: 7 days'
])
?>



<?= $form->field($model,'instructions')
->textarea([
'class'=>'form-control',
'rows'=>4,
'placeholder'=>'Medicine instructions'
])
?>



<?= $form->field($model,'status')
->dropDownList(
[
'Active'=>'Active',
'Dispensed'=>'Dispensed',
'Cancelled'=>'Cancelled'
],
[
'class'=>'form-select'
]
)

?>



<div class="buttons">


<?= Html::submitButton(

'<i class="bi bi-save"></i> Save Prescription',

[
'class'=>'save-btn'
]

) ?>



<?= Html::a(

'<i class="bi bi-arrow-left"></i> Cancel',

['prescriptions'],

[
'class'=>'cancel-btn'
]

) ?>


</div>


<?php ActiveForm::end(); ?>


</div>


</div>





<style>


.update-page{

padding:35px;

background:linear-gradient(
135deg,
#ecfeff,
#f0fdf4
);

min-height:100vh;

}



.update-header{

background:linear-gradient(
135deg,
#065f46,
#14b8a6
);

color:white;

padding:35px;

border-radius:30px;

margin-bottom:30px;

}


.update-header h1{

font-size:36px;

font-weight:900;

}



.update-card{

background:white;

padding:40px;

border-radius:30px;

max-width:800px;

box-shadow:
0 20px 50px rgba(0,0,0,.1);

}



.form-control,
.form-select{

padding:15px;

border-radius:15px;

}



.buttons{

margin-top:30px;

display:flex;

gap:15px;

}



.save-btn{

background:#0f766e;

color:white;

padding:15px 30px;

border-radius:15px;

border:none;

font-weight:800;

}



.cancel-btn{

background:#64748b;

color:white;

padding:15px 30px;

border-radius:15px;

font-weight:800;

text-decoration:none;

}


</style>