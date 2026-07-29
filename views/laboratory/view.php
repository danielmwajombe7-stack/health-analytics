<?php

use yii\helpers\Html;


/* @var $model app\models\LabRequest */
/* @var $result app\models\LabResult|null */
/* @var $labTest app\models\LabTest|null */


$this->title = "Laboratory Report";


// ================================
// SAFE DATA
// ================================

$patient = $model->patient ?? null;

$doctor = $model->doctor ?? null;



$patientName = "Unknown Patient";


if($patient)
{

    if($patient->hasAttribute('full_name') && !empty($patient->full_name))
    {

        $patientName = $patient->full_name;

    }
    else
    {

        $patientName = trim(
            ($patient->first_name ?? '')
            .' '.
            ($patient->last_name ?? '')
        );

    }

}




$doctorName = "Not Assigned";


if($doctor)
{

    $doctorName =
        $doctor->username
        ??
        $doctor->first_name
        ??
        "Doctor";

}



$status = $model->status ?? "Pending";


$statusClass = strtolower($status);



$requestId = $model->id ?? null;


?>





<style>


.lab-wrapper{

    background:#f4f8fb;
    min-height:100vh;
    padding:30px;

}



.lab-header{


    background:linear-gradient(
        135deg,
        #00897b,
        #004d40
    );


    padding:35px;

    border-radius:25px;

    color:white;

    margin-bottom:25px;

    box-shadow:
    0 15px 35px rgba(0,0,0,.15);


}



.lab-header h1{

    font-size:32px;

    font-weight:800;

    margin:0;

}



.lab-header p{

    opacity:.9;

}




.status-badge{


    display:inline-block;

    padding:10px 22px;

    border-radius:30px;

    font-weight:bold;

    margin-top:15px;


}



.status-pending{

    background:#ff9800;
    color:white;

}



.status-processing{

    background:#2196f3;
    color:white;

}



.status-completed{

    background:#43a047;
    color:white;

}





.lab-grid{


    display:grid;

    grid-template-columns:
    repeat(2,1fr);

    gap:25px;


}



.card-box{


    background:white;

    padding:25px;

    border-radius:25px;

    box-shadow:
    0 10px 25px rgba(0,0,0,.08);

    margin-bottom:25px;


}



.full-card{

    grid-column:span 2;

}



.section-title{


    color:#00695c;

    font-size:20px;

    font-weight:800;

    margin-bottom:20px;


}



.info-row{


    display:flex;

    justify-content:space-between;

    padding:12px 0;

    border-bottom:1px solid #eee;


}



.info-label{


    color:#607d8b;

    font-weight:600;


}



.info-value{


    color:#263238;

    font-weight:700;


}



.patient-avatar{


    width:70px;

    height:70px;

    border-radius:50%;

    background:#e0f2f1;

    display:flex;

    align-items:center;

    justify-content:center;

    font-size:35px;

    margin-bottom:15px;


}



</style>




<div class="lab-wrapper">



<div class="lab-header">


<h1>
🧪 Laboratory Report
</h1>


<p>
Health Analytics Laboratory Department
</p>



<span class="status-badge status-<?=Html::encode($statusClass)?>">

<?=Html::encode($status)?>

</span>



</div>



<div class="lab-grid">



<div class="card-box">


<h3 class="section-title">

👤 Patient Information

</h3>



<div class="patient-avatar">

👨‍⚕️

</div>



<div class="info-row">

<span class="info-label">
Name
</span>


<span class="info-value">

<?=Html::encode($patientName)?>

</span>

</div>





<div class="info-row">

<span class="info-label">
Patient ID
</span>


<span class="info-value">

<?=Html::encode($model->patient_id)?>

</span>

</div>





<div class="info-row">

<span class="info-label">
Phone
</span>


<span class="info-value">

<?=Html::encode($patient->phone ?? '-')?>

</span>

</div>



</div>
<!-- DOCTOR INFORMATION -->

<div class="card-box">


<h3 class="section-title">

👨‍⚕️ Doctor Request Information

</h3>




<div class="info-row">


<span class="info-label">

Requested By

</span>



<span class="info-value">

<?= Html::encode($doctorName) ?>

</span>


</div>





<div class="info-row">


<span class="info-label">

Request ID

</span>



<span class="info-value">

LAB-<?= Html::encode($requestId ?? '-') ?>

</span>


</div>





<div class="info-row">


<span class="info-label">

Queue Number

</span>



<span class="info-value">

<?= Html::encode(
$model->queue_id ?? '-'
) ?>

</span>


</div>





<div class="info-row">


<span class="info-label">

Priority

</span>



<span class="info-value">

<?= Html::encode(
$model->priority ?? 'Normal'
) ?>

</span>


</div>





<div class="info-row">


<span class="info-label">

Requested Date

</span>



<span class="info-value">


<?= Html::encode(

$model->created_at
??
$model->request_date
??
'-'

) ?>


</span>


</div>



</div>








<!-- LAB TEST INFORMATION -->


<div class="card-box">


<h3 class="section-title">

🧪 Laboratory Investigation

</h3>





<div class="info-row">


<span class="info-label">

Test Name

</span>



<span class="info-value">


<?= Html::encode(

$model->test_name
??
'Laboratory Examination'

) ?>


</span>


</div>





<div class="info-row">


<span class="info-label">

Lab Test ID

</span>



<span class="info-value">


<?php if($labTest): ?>


LAB-TEST-<?= Html::encode($labTest->id) ?>


<?php else: ?>


Pending Creation


<?php endif; ?>


</span>


</div>






<div class="info-row">


<span class="info-label">

Laboratory Department

</span>



<span class="info-value">

Clinical Laboratory

</span>


</div>





<div class="info-row">


<span class="info-label">

Current Status

</span>



<span class="info-value">

<?= Html::encode($status) ?>

</span>


</div>



</div>








<!-- RESULT SECTION -->


<div class="card-box full-card">


<h3 class="section-title">

📄 Laboratory Result

</h3>






<?php if($result): ?>





<div class="info-row">


<span class="info-label">

Result Status

</span>



<span class="info-value">


<span class="status-badge status-completed">

Completed

</span>


</span>


</div>








<div class="info-row">


<span class="info-label">

Result

</span>



<span class="info-value">


<?= nl2br(

Html::encode(

$result->result
??
'-'

)

) ?>


</span>


</div>







<div class="info-row">


<span class="info-label">

Findings

</span>



<span class="info-value">


<?= nl2br(

Html::encode(

$result->findings
??
'-'

)

) ?>


</span>


</div>







<div class="info-row">


<span class="info-label">

Normal Range

</span>



<span class="info-value">


<?= Html::encode(

$result->normal_range
??
'-'

) ?>


</span>


</div>







<?php else: ?>



<div style="
text-align:center;
padding:35px;
color:#78909c;
">


<div style="
font-size:50px;
">

📄

</div>



<h4>

No Laboratory Result Available

</h4>



<p>

Laboratory technician has not uploaded results yet.

</p>



</div>



<?php endif; ?>



</div>








<!-- WORKFLOW TIMELINE -->


<div class="card-box full-card">


<h3 class="section-title">

⏱ Laboratory Workflow Timeline

</h3>



<div class="info-row">


<span class="info-label">

📝 Request Created

</span>



<span class="info-value">


<?= Html::encode(

$model->created_at
??
date('Y-m-d H:i:s')

) ?>


</span>


</div>





<div class="info-row">


<span class="info-label">

🔬 Processing Started

</span>



<span class="info-value">


<?php if($model->hasAttribute('started_at')): ?>


<?= Html::encode(

$model->started_at
??
'Waiting'

) ?>


<?php else: ?>


Waiting


<?php endif; ?>


</span>


</div>






<div class="info-row">


<span class="info-label">

✅ Completed

</span>



<span class="info-value">


<?= Html::encode(

$model->completed_at
??
'Not Completed'

) ?>


</span>


</div>




</div>
<!-- RESULT SUMMARY -->

<div class="card-box">


<h3 class="section-title">

📊 Result Summary

</h3>



<div class="info-row">

<span class="info-label">

Laboratory Test

</span>


<span class="info-value">

<?= Html::encode(

$model->test_name
??
'Laboratory Examination'

) ?>

</span>


</div>




<div class="info-row">

<span class="info-label">

Result Available

</span>


<span class="info-value">

<?= $result ? 'YES ✅' : 'NO ⏳' ?>

</span>


</div>




<div class="info-row">

<span class="info-label">

Request Created

</span>


<span class="info-value">

<?= Html::encode(

$model->created_at
??
'-'

) ?>

</span>


</div>



</div>









<!-- ACTION BUTTONS -->

<div class="card-box full-card">


<h3 class="section-title">

⚡ Actions

</h3>





<?= Html::a(

'⬅ Back To Requests',

[
'/laboratory/requests'
],

[
'class'=>'btn btn-secondary'
]

) ?>







<?php if($requestId): ?>


<?php if($status !== 'Completed'): ?>


<?= Html::a(

'➕ Add Laboratory Result',

[
'/laboratory/create-result',
'id'=>$requestId
],

[
'class'=>'btn btn-success'
]

) ?>


<?php endif; ?>


<?php endif; ?>







<?= Html::a(

'🖨 Print Laboratory Report',

[
'/laboratory/print',
'id'=>$requestId
],

[
'class'=>'btn btn-info',
'target'=>'_blank'
]

) ?>







<?= Html::a(

'👤 Patient Profile',

[
'/patients/view',
'id'=>$model->patient_id
],

[
'class'=>'btn btn-primary'
]

) ?>





</div>









<!-- FOOTER -->

<div class="card-box full-card"
style="
text-align:center;
margin-top:20px;
">


<div style="
font-size:40px;
">

🏥

</div>



<h3 style="
color:#00695c;
">

Health Analytics Hospital

</h3>



<p style="
color:#607d8b;
">

Digital Laboratory Management System

</p>



<small>

Generated:
<?= date('Y-m-d H:i:s') ?>

</small>



</div>






</div>

</div>







<style>


.btn{

padding:12px 25px;

border-radius:15px;

font-weight:700;

margin-right:10px;

}



.btn-success{

background:#00897b;

border:none;

}



.btn-success:hover{

background:#00695c;

}



.btn-info{

background:#0288d1;

color:white;

}



.timeline{

margin-top:20px;

}



@media(max-width:900px){


.lab-grid{

grid-template-columns:1fr;

}


.full-card{

grid-column:span 1;

}



}



@media print{


.btn{

display:none!important;

}



.lab-wrapper{

background:white;

padding:0;

}



.card-box{

box-shadow:none;

border:1px solid #ddd;

}



.lab-header{

-webkit-print-color-adjust:exact;

}



}


</style>