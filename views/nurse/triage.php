<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = "Patient Triage";

?>


<style>

body{
    background:#0f172a;
}


.triage-wrapper{

    padding:20px;

}


.glass-card{

    background:#111827;
    border-radius:20px;
    padding:30px;
    color:white;
    box-shadow:0 15px 40px rgba(0,0,0,.3);

}



.patient-header{

    background:linear-gradient(
        135deg,
        #0f766e,
        #0284c7
    );

    border-radius:18px;
    padding:25px;
    margin-bottom:25px;

}



.patient-header h3{

    font-weight:700;

}



.section-title{

    font-size:18px;
    font-weight:700;
    margin:20px 0;

}



.form-control{

    background:#1f2937;
    border:1px solid #374151;
    color:white;
    border-radius:12px;

}


.form-control:focus{

    background:#1f2937;
    color:white;
    border-color:#14b8a6;
    box-shadow:none;

}



label{

    color:#cbd5e1;
    font-weight:600;

}



.btn-triage{

    background:#10b981;
    border:none;
    padding:15px 35px;
    font-weight:700;

}



.btn-triage:hover{

    background:#059669;

}


</style>



<div class="container-fluid triage-wrapper">



<div class="glass-card">



<!-- PATIENT HEADER -->

<div class="patient-header">


<h3>
🩺 Nurse Clinical Assessment
</h3>


<p class="mb-0">

Patient triage and vital signs monitoring

</p>


</div>





<!-- PATIENT INFORMATION -->

<div class="row">


<div class="col-md-6">


<div class="card bg-dark text-white p-3 rounded-4">


<h5>
👤 Patient Information
</h5>


<hr>


<p>

<strong>Name:</strong>

<?= Html::encode(
$queue->patient->first_name.' '.
$queue->patient->last_name
) ?>


</p>



<p>

<strong>Gender:</strong>

<?= 
$queue->patient->gender ?? '-'
?>

</p>



<p>

<strong>Queue:</strong>

<?= 
$queue->queue_number
?>

</p>



</div>


</div>






<div class="col-md-6">


<div class="card bg-dark text-white p-3 rounded-4">


<h5>
📋 Visit Information
</h5>


<hr>


<p>

<strong>Visit Number:</strong>

<?= 
$visit->visit_number
?>

</p>



<p>

<strong>Department:</strong>

<?= 
$queue->department
?>

</p>



<p>

<strong>Status:</strong>

<?= 
$queue->status
?>

</p>



</div>


</div>


</div>






<?php $form = ActiveForm::begin(); ?>



<h5 class="section-title">
❤️ Vital Signs
</h5>




<div class="row">


<div class="col-md-4">

<?=

$form->field($model,'temperature')
->textInput([
'placeholder'=>'Temperature °C'
])

?>

</div>





<div class="col-md-4">

<?=

$form->field($model,'blood_pressure')
->textInput([
'placeholder'=>'120/80'
])

?>

</div>





<div class="col-md-4">

<?=

$form->field($model,'pulse_rate')
->textInput([
'placeholder'=>'Pulse BPM'
])

?>

</div>


</div>







<div class="row">


<div class="col-md-4">


<?=

$form->field($model,'respiratory_rate')
->textInput([
'placeholder'=>'Breaths/min'
])

?>


</div>





<div class="col-md-4">


<?=

$form->field($model,'oxygen_saturation')
->textInput([
'placeholder'=>'SpO2 %'
])

?>


</div>





<div class="col-md-4">


<?=

$form->field($model,'weight')
->textInput([
'placeholder'=>'Weight Kg'
])

?>


</div>



</div>








<?php if($model->hasAttribute('triage_level')): ?>


<h5 class="section-title">
🚨 Patient Priority
</h5>


<?=

$form->field($model,'triage_level')
->dropDownList(

[

'Normal'=>'🟢 Normal',

'Moderate'=>'🟡 Moderate',

'Critical'=>'🔴 Critical'

],

[

'class'=>'form-control'

]

)

?>



<?php endif; ?>







<?php if($model->hasAttribute('nurse_notes')): ?>


<h5 class="section-title">
📝 Nurse Clinical Notes
</h5>


<?=

$form->field($model,'nurse_notes')
->textarea([

'rows'=>5,

'placeholder'=>
'Enter observations, symptoms and clinical notes...'

])

?>



<?php endif; ?>







<br>



<button class="btn btn-triage btn-lg rounded-pill">

✅ Complete Triage & Send To Doctor

</button>





<?php ActiveForm::end(); ?>



</div>


</div>