<?php

use yii\helpers\Html;

$this->title = "Patient Visit Details";


$status = strtolower($model->status);

$statusClass = 'status-default';
$statusIcon = 'fa-circle';


if(str_contains($status,'waiting')){

    $statusClass = 'status-warning';
    $statusIcon = 'fa-clock';

}

elseif(str_contains($status,'completed')){

    $statusClass = 'status-success';
    $statusIcon = 'fa-check-circle';

}

elseif(str_contains($status,'progress')){

    $statusClass = 'status-info';
    $statusIcon = 'fa-spinner';

}

elseif(str_contains($status,'critical')){

    $statusClass = 'status-danger';
    $statusIcon = 'fa-heartbeat';

}



$patientName = $model->patient 
    ? $model->patient->fullName 
    : "Unknown Patient";


$initials = strtoupper(substr($patientName,0,2));


?>


<div class="container-fluid visit-page">


<!-- HEADER -->

<div class="page-header mb-4">

    <div>

        <h2 class="fw-bold">

            <i class="fa fa-notes-medical text-success"></i>

            Patient Visit Details

        </h2>


        <p class="text-muted">

            Complete clinical visit information and workflow record

        </p>

    </div>


</div>





<div class="row g-4">



<!-- PATIENT PROFILE -->

<div class="col-lg-6">


<div class="medical-card">



<div class="card-title-area">


<div class="patient-avatar-large">

<?= $initials ?>

</div>


<div>


<h4 class="mb-1">

<?= Html::encode($patientName) ?>

</h4>


<span class="text-muted">

Patient Profile

</span>


</div>


</div>




<hr>




<div class="info-row">

<i class="fa fa-id-card"></i>

<div>

<strong>Medical Record Number</strong>

<br>

PT-<?= str_pad($model->patient_id,5,"0",STR_PAD_LEFT) ?>

</div>

</div>




<div class="info-row">

<i class="fa fa-calendar"></i>

<div>

<strong>Visit Date</strong>

<br>

<?= Yii::$app->formatter->asDatetime($model->visit_date) ?>

</div>

</div>




<div class="info-row">

<i class="fa fa-hospital"></i>

<div>

<strong>Department</strong>

<br>

General Consultation

</div>

</div>




</div>


</div>







<!-- CLINICAL INFORMATION -->

<div class="col-lg-6">


<div class="medical-card">



<div class="section-title">

<i class="fa fa-stethoscope"></i>

Clinical Information

</div>



<hr>




<div class="info-row">


<i class="fa fa-user-md"></i>


<div>

<strong>Assigned Doctor</strong>


<br>


<?= $model->doctor
?
$model->doctor->username
:
"Not Assigned"
?>


</div>


</div>





<div class="info-row">


<i class="fa fa-heartbeat"></i>


<div>


<strong>Visit Status</strong>


<br>


<span class="status-badge <?= $statusClass ?>">


<i class="fa <?= $statusIcon ?>"></i>


<?= Html::encode($model->status) ?>


</span>


</div>


</div>






<div class="info-row">


<i class="fa fa-hashtag"></i>


<div>

<strong>Visit ID</strong>


<br>

<?= $model->id ?>


</div>


</div>




</div>


</div>



</div>







<!-- ACTIONS -->

<div class="medical-card mt-4 action-card">


<?= Html::a(

'<i class="fa fa-arrow-left"></i> Back',

['index'],

[
'class'=>'btn btn-outline-secondary btn-lg'
]

) ?>



<?= Html::a(

'<i class="fa fa-edit"></i> Edit Visit',

['update','id'=>$model->id],

[
'class'=>'btn btn-success btn-lg ms-2'
]

) ?>


</div>





</div>






<style>


.visit-page{

padding:25px;

font-family:
"Segoe UI",
sans-serif;

}



/* CARD */

.medical-card{


background:white;

border-radius:20px;

padding:25px;

box-shadow:
0 10px 30px rgba(0,0,0,.08);


border:1px solid #e8f5f1;


transition:.3s;


}



.medical-card:hover{


transform:translateY(-3px);


box-shadow:
0 15px 35px rgba(0,0,0,.12);


}





/* TITLE */


.section-title{


font-size:20px;

font-weight:700;

color:#00796b;


}



.card-title-area{


display:flex;

align-items:center;

gap:20px;


}




/* AVATAR */


.patient-avatar-large{


width:90px;

height:90px;

border-radius:50%;


background:
linear-gradient(
135deg,
#009688,
#4caf50
);


color:white;


display:flex;

align-items:center;

justify-content:center;


font-size:32px;

font-weight:700;


}





/* INFO */


.info-row{


display:flex;

gap:18px;

align-items:center;

margin-bottom:20px;


}


.info-row i{


width:40px;

height:40px;

border-radius:12px;


background:#e8f5f1;


color:#00897b;


display:flex;

align-items:center;

justify-content:center;


font-size:18px;


}





/* STATUS */


.status-badge{


padding:8px 16px;

border-radius:50px;

font-size:14px;

font-weight:600;


display:inline-flex;

gap:8px;

align-items:center;


}




.status-success{

background:#d1fae5;

color:#047857;

}



.status-warning{


background:#fef3c7;

color:#92400e;


}



.status-danger{


background:#fee2e2;

color:#b91c1c;


}



.status-info{


background:#cffafe;

color:#0369a1;


}



.status-default{


background:#e5e7eb;

color:#374151;


}





/* BUTTON */


.btn-success{


background:#00897b;

border:none;


}



.btn-success:hover{


background:#00695c;


}





@media(max-width:768px){


.visit-page{

padding:10px;

}


.patient-avatar-large{

width:70px;

height:70px;

font-size:24px;

}



}


</style>