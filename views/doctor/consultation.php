<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = "Medical Consultation EMR";

?>


<div class="emr-wrapper">


<!-- =========================
HEADER
========================= -->

<div class="emr-top">

<div>

<h1>
🩺 Clinical EMR Consultation Room
</h1>

<p>
MYLES Health Analytics System
</p>

</div>



<div class="queue-box">

<div>
🎫 Queue Number
</div>


<strong>
<?= Html::encode($queue->queue_number ?? 'N/A') ?>
</strong>


<br>


<span class="status">
<?= Html::encode($queue->status ?? 'Waiting') ?>
</span>


</div>


</div>









<!-- =========================
PATIENT PROFILE
========================= -->

<div class="emr-card patient-banner">


<div class="avatar">
👤
</div>



<div class="patient-main">


<h2>

<?= Html::encode($patient->first_name ?? '') ?>

<?= Html::encode($patient->last_name ?? '') ?>

</h2>


<p>

<?= Html::encode($patient->gender ?? 'N/A') ?>

|

Blood:
<?= Html::encode($patient->blood_group ?? 'N/A') ?>


|

Phone:
<?= Html::encode($patient->phone ?? 'N/A') ?>

</p>


</div>




<div class="risk-box">

Risk Level

<br>

<strong>

<?= Html::encode($patient->risk_level ?? 'Normal') ?>

</strong>


</div>



</div>









<!-- =========================
VITAL SIGNS
========================= -->


<div class="emr-card">


<h3>
❤️ Triage & Vital Signs
</h3>



<?php if($vitals): ?>


<div class="vitals-grid">



<div>

🌡 Temperature

<strong>

<?= Html::encode($vitals->temperature ?? '--') ?> °C

</strong>

</div>




<div>

💓 Blood Pressure

<strong>

<?= Html::encode($vitals->blood_pressure ?? '--') ?>

</strong>

</div>




<div>

🫀 Pulse

<strong>

<?= Html::encode($vitals->pulse_rate ?? '--') ?>

</strong>

</div>




<div>

🫁 Oxygen

<strong>

<?= Html::encode($vitals->oxygen_saturation ?? '--') ?> %

</strong>

</div>




<div>

⚖ BMI

<strong>

<?= Html::encode($vitals->bmi ?? '--') ?>

</strong>

</div>




<div>

🚨 Triage

<strong>

<?= Html::encode($vitals->triage_level ?? 'Normal') ?>

</strong>

</div>



</div>





<div class="nurse-panel">


<h4>
👩‍⚕️ Nurse Clinical Notes
</h4>


<p>

<?= Html::encode(
$vitals->nurse_notes ?? 'No nurse notes available'
) ?>

</p>


</div>



<?php else: ?>


<div class="alert alert-warning">

No vital information available

</div>


<?php endif; ?>


</div>









<!-- =========================
MEDICAL HISTORY
========================= -->


<div class="emr-card">


<h3>
📚 Previous Medical History
</h3>



<?php if(!empty($history)): ?>


<?php foreach($history as $record): ?>


<div class="history-box">


<strong>

<?= Html::encode($record->created_at ?? '') ?>

</strong>


<p>

<?= Html::encode($record->notes ?? 'No notes') ?>

</p>


</div>


<?php endforeach; ?>


<?php else: ?>


<p>
No previous medical records
</p>


<?php endif; ?>


</div>









<!-- =========================
PREVIOUS DIAGNOSIS
========================= -->


<div class="emr-card">


<h3>
🧬 Previous Diagnosis
</h3>



<?php if(!empty($previousDiagnoses)): ?>


<div class="chips">


<?php foreach($previousDiagnoses as $diagnosis): ?>


<span>


<?= Html::encode(
$diagnosis->diagnosis 
?? 
$diagnosis->name 
?? 
'Diagnosis'
) ?>


</span>


<?php endforeach; ?>


</div>


<?php else: ?>


<p>
No previous diagnosis found
</p>


<?php endif; ?>


</div>









<!-- =========================
LAB RESULTS
========================= -->


<div class="emr-card">


<h3>
🧪 Laboratory Results
</h3>



<?php if(!empty($labResults)): ?>


<table class="emr-table">


<tr>

<th>
Test
</th>


<th>
Result
</th>


<th>
Date
</th>


</tr>




<?php foreach($labResults as $lab): ?>


<tr>


<td>

<?= Html::encode(
$lab->test_name ?? 'Laboratory Test'
) ?>

</td>



<td>

<?= Html::encode(
$lab->result ?? '--'
) ?>

</td>



<td>

<?= Html::encode(
$lab->created_at ?? ''
) ?>

</td>


</tr>


<?php endforeach; ?>


</table>



<?php else: ?>


<p>
No laboratory results available
</p>


<?php endif; ?>


</div>









<!-- =========================
PRESCRIPTION HISTORY
========================= -->


<div class="emr-card">


<h3>
💊 Previous Prescription History
</h3>



<?php if(!empty($prescriptions)): ?>


<table class="emr-table">


<tr>

<th>
Medicine
</th>


<th>
Dosage
</th>


<th>
Frequency
</th>


<th>
Duration
</th>


<th>
Status
</th>


</tr>




<?php foreach($prescriptions as $item): ?>


<tr>


<td>

<?= Html::encode(
$item->drug_name ?? 'Medicine'
) ?>

</td>



<td>

<?= Html::encode(
$item->dosage ?? '--'
) ?>

</td>



<td>

<?= Html::encode(
$item->frequency ?? '--'
) ?>

</td>



<td>

<?= Html::encode(
$item->duration ?? '--'
) ?>

</td>



<td>

<?= Html::encode(
$item->status ?? 'Pending'
) ?>

</td>


</tr>


<?php endforeach; ?>


</table>



<?php else: ?>


<p>
No previous prescriptions
</p>


<?php endif; ?>


</div>
<!-- =========================
CLINICAL MANAGEMENT
========================= -->


<div class="emr-card">


<h3>
🩺 Clinical Management
</h3>



<div class="management-grid">







<!-- =========================
NEW DIAGNOSIS
========================= -->


<div class="box diagnosis">


<h4>
🧬 New Diagnosis
</h4>



<?php $form = ActiveForm::begin([
    'options'=>[
        'novalidate'=>true
    ]
]); ?>



<?= $form->field(
$diagnosisModel,
'diagnosis'
)

->textarea([
    'rows'=>4,
    'placeholder'=>'Enter doctor diagnosis...'
])

->label(false)

?>





<button
type="submit"
name="save_diagnosis"
class="mini-btn">

🧬 Save Diagnosis

</button>



<?php ActiveForm::end(); ?>


</div>









<!-- =========================
PRESCRIPTION
========================= -->


<div class="box prescription">


<h4>
💊 New Prescription
</h4>



<?php $form = ActiveForm::begin([
    'options'=>[
        'novalidate'=>true
    ]
]); ?>




<?= $form->field(
$prescriptionModel,
'drug_name'
)

->textInput([
    'placeholder'=>'Medicine name'
])

->label(false)

?>





<?= $form->field(
$prescriptionModel,
'medicine_id'
)

->textInput([
    'placeholder'=>'Medicine ID'
])

->label(false)

?>





<?= $form->field(
$prescriptionModel,
'quantity'
)

->input(
'number',
[
'value'=>1,
'min'=>1
]

)

->label(false)

?>






<?= $form->field(
$prescriptionModel,
'dosage'
)

->textInput([
    'placeholder'=>'Dosage e.g 500mg'
])

->label(false)

?>






<?= $form->field(
$prescriptionModel,
'frequency'
)

->textInput([
    'placeholder'=>'Frequency e.g Twice daily'
])

->label(false)

?>







<?= $form->field(
$prescriptionModel,
'duration'
)

->textInput([
    'placeholder'=>'Duration e.g 5 days'
])

->label(false)

?>







<?= $form->field(
$prescriptionModel,
'instructions'
)

->textarea([
    'rows'=>2,
    'placeholder'=>'Special instructions'
])

->label(false)

?>






<button
type="submit"
name="save_prescription"
class="mini-btn">


💊 Add Prescription


</button>




<?php ActiveForm::end(); ?>


</div>









<!-- =========================
LAB REQUEST
========================= -->


<div class="box laboratory">


<h4>
🧪 Laboratory Request
</h4>



<?php $form = ActiveForm::begin([
    'options'=>[
        'novalidate'=>true
    ]
]); ?>





<?= $form->field(
$labRequestModel,
'test_name'
)

->textInput([
    'placeholder'=>'Laboratory test name'
])

->label(false)

?>







<?= $form->field(
$labRequestModel,
'priority'
)

->dropDownList([

'Normal'=>'Normal',

'Urgent'=>'Urgent',

'Critical'=>'Critical'

])

->label(false)

?>







<?= $form->field(
$labRequestModel,
'clinical_notes'
)

->textarea([
    'rows'=>3,
    'placeholder'=>'Reason for laboratory request'
])

->label(false)

?>







<button
type="submit"
name="save_lab"
class="mini-btn">


🧪 Send Lab Request


</button>





<?php ActiveForm::end(); ?>


</div>






</div>


</div>













<!-- =========================
FINAL CONSULTATION NOTES
========================= -->


<div class="emr-card">


<h3>
📝 Doctor Final Clinical Notes
</h3>




<?php $form = ActiveForm::begin([
    'options'=>[
        'novalidate'=>true
    ]
]); ?>







<?= $form->field(
$model,
'symptoms'
)

->textarea([

'rows'=>4,

'placeholder'=>
'Chief complaint / patient symptoms'

])

->label(false)

?>








<?= $form->field(
$model,
'diagnosis'
)

->textarea([

'rows'=>3,

'placeholder'=>
'Final diagnosis summary'

])

->label(false)

?>








<?= $form->field(
$model,
'notes'
)

->textarea([

'rows'=>5,

'placeholder'=>
'Doctor clinical notes, treatment plan and recommendations'

])

->label(false)

?>








<button

type="submit"

name="save_consultation"

class="save-btn">


💾 Complete Consultation


</button>





<?php ActiveForm::end(); ?>


</div>







</div>









<style>


.emr-wrapper{

background:#f1f8f6;

padding:30px;

font-family:
Inter,
Segoe UI,
sans-serif;

}




.emr-top{

background:white;

padding:30px;

border-radius:30px;

display:flex;

justify-content:space-between;

align-items:center;

box-shadow:
0 20px 50px rgba(0,0,0,.12);

}





.emr-top h1{

color:#087f5b;

font-weight:900;

}




.queue-box{

background:#ecfdf5;

padding:20px;

border-radius:25px;

text-align:center;

}




.status{

background:#dcfce7;

padding:8px 15px;

border-radius:20px;

font-weight:700;

}





.emr-card{

background:white;

padding:30px;

border-radius:30px;

margin-top:25px;

box-shadow:
0 15px 35px rgba(0,0,0,.08);

}





.patient-banner{

display:flex;

align-items:center;

gap:25px;

}





.avatar{

font-size:60px;

}





.risk-box{

margin-left:auto;

background:#fff7ed;

padding:20px;

border-radius:20px;

}




.vitals-grid{

display:grid;

grid-template-columns:
repeat(6,1fr);

gap:15px;

}





.vitals-grid div{

background:#f0fdfa;

padding:20px;

border-radius:20px;

}





.vitals-grid strong{

display:block;

font-size:22px;

color:#087f5b;

}





.nurse-panel{

background:#fff7ed;

padding:20px;

border-radius:20px;

margin-top:20px;

}





.history-box{

background:#f8fafc;

padding:20px;

border-radius:20px;

margin-bottom:15px;

}





.chips span{

display:inline-block;

background:#dbeafe;

padding:10px 20px;

border-radius:20px;

margin:5px;

}





.emr-table{

width:100%;

border-collapse:collapse;

}





.emr-table th{

background:#ecfdf5;

padding:15px;

}





.emr-table td{

padding:15px;

border-bottom:
1px solid #eee;

}





.management-grid{

display:grid;

grid-template-columns:
repeat(3,1fr);

gap:25px;

}





.box{

padding:25px;

border-radius:25px;

background:#f8fafc;

}





.diagnosis{

border-top:
6px solid #2563eb;

}





.prescription{

border-top:
6px solid #7c3aed;

}





.laboratory{

border-top:
6px solid #0891b2;

}





.mini-btn{

border:none;

padding:12px 25px;

border-radius:25px;

font-weight:800;

background:#087f5b;

color:white;

cursor:pointer;

}





.save-btn{

background:#065f46;

color:white;

border:none;

padding:18px 40px;

border-radius:30px;

font-weight:900;

cursor:pointer;

}





.save-btn:hover,
.mini-btn:hover{

opacity:.85;

}





@media(max-width:1200px){


.vitals-grid,
.management-grid{

grid-template-columns:1fr;

}


}




</style>