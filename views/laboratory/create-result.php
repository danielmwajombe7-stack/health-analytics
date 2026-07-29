<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = "Create Laboratory Result";

?>

<style>

/* KEEP YOUR EXISTING CSS HERE */

</style>


<div class="lab-result-page">

<div class="result-wrapper">


<div class="result-header">

<h1>
🧪 Laboratory Result Entry
</h1>

<p>
Complete examination results and update patient medical record
</p>

</div>



<div class="card-box">


<h3 class="section-title">
📋 Laboratory Request Information
</h3>


<div class="patient-grid">


<div class="info-item">

<span class="info-label">
Patient
</span>

<span class="info-value">

<?= Html::encode(
$request->patient->fullName 
?? 
$request->patient->first_name 
?? 
'Unknown'
) ?>

</span>

</div>



<div class="info-item">

<span class="info-label">
Patient ID
</span>

<span class="info-value">

<?= Html::encode($request->patient_id) ?>

</span>

</div>



<div class="info-item">

<span class="info-label">
Requested Test
</span>

<span class="info-value">

🧪

<?= Html::encode(
$request->test_name 
?? 
'Laboratory Test'
) ?>

</span>

</div>



<div class="info-item">

<span class="info-label">
Doctor
</span>

<span class="info-value">

👨‍⚕️

<?= Html::encode(
$request->doctor->username 
?? 
'Not Assigned'
) ?>

</span>

</div>



<div class="info-item">

<span class="info-label">
Priority
</span>

<span class="info-value">

<?= Html::encode(
$request->priority 
??
'Normal'
) ?>

</span>

</div>



<div class="info-item">

<span class="info-label">
Current Status
</span>


<span class="status <?= strtolower($request->status ?? 'pending') ?>">

<?= Html::encode(
$request->status ?? 'Pending'
) ?>

</span>


</div>


</div>


</div>






<div class="card-box">


<h3 class="section-title">
📝 Enter Laboratory Findings
</h3>



<?php $form = ActiveForm::begin([

'action'=>[
'laboratory/create-result',
'request_id'=>$request->id
],

'method'=>'post',

'enableClientValidation'=>true,

'options'=>[
'enctype'=>'multipart/form-data'
]

]); ?>



<?= $form->errorSummary($model); ?>



<!-- Hidden Relationship Data -->

<?php if($model->hasAttribute('request_id')): ?>

<?= $form->field($model,'request_id')
->hiddenInput([
'value'=>$request->id
])
->label(false)
?>

<?php endif; ?>



<?php if($model->hasAttribute('patient_id')): ?>

<?= $form->field($model,'patient_id')
->hiddenInput([
'value'=>$request->patient_id
])
->label(false)
?>

<?php endif; ?>



<?php if($model->hasAttribute('doctor_id')): ?>

<?= $form->field($model,'doctor_id')
->hiddenInput([
'value'=>$request->doctor_id
])
->label(false)
?>

<?php endif; ?>



<?php if($model->hasAttribute('status')): ?>

<?= $form->field($model,'status')
->hiddenInput([
'value'=>'Completed'
])
->label(false)
?>

<?php endif; ?>





<?= $form->field($model,'result')->textarea([

'rows'=>6,

'placeholder'=>
'Enter laboratory result details...'

]) ?>





<?= $form->field($model,'findings')->textarea([

'rows'=>6,

'placeholder'=>
'Clinical findings and interpretation...'

]) ?>





<?= $form->field($model,'normal_range')->textInput([

'placeholder'=>
'Example: 70 - 100 mg/dL'

]) ?>





<?php if($model->hasAttribute('attachment')): ?>


<div class="attachment-box">

<h5>
📎 Attach Laboratory Document
</h5>


<?= $form->field($model,'attachment')
->fileInput()
?>

</div>


<?php endif; ?>






<div class="result-actions">



<?= Html::submitButton(

'💾 Save Laboratory Result',

[
'class'=>'btn-save',
'name'=>'save-result'
]

) ?>





<?= Html::a(

'← Back To Request',

[
'laboratory/view',
'id'=>$request->id
],

[
'class'=>'btn-back'
]

) ?>


</div>




<?php ActiveForm::end(); ?>


</div>





<div class="card-box" style="text-align:center;">


<h4 style="color:#00695c;">

🏥 Health Analytics Laboratory

</h4>


<p style="color:#78909c;">

Digital Laboratory Result Management System

</p>


</div>



</div>

</div>