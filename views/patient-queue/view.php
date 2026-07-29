<?php

use yii\helpers\Html;

$this->title = "Patient Queue Profile";

$patient = $model->patient;

$status = strtolower($model->status);

?>

<style>

.queue-profile{
    padding:30px;
    background:#f4f8fb;
    min-height:100vh;
    font-family:'Segoe UI',sans-serif;
}


.profile-header{

    display:flex;
    justify-content:space-between;
    align-items:center;
    margin-bottom:30px;

}


.profile-header h1{

    color:#004d40;
    font-size:32px;
    font-weight:800;

}


.back{

    background:white;
    padding:12px 20px;
    border-radius:15px;
    text-decoration:none;
    color:#37474f;
    font-weight:bold;
    box-shadow:0 8px 20px rgba(0,0,0,.08);

}



.grid{

    display:grid;
    grid-template-columns:repeat(3,1fr);
    gap:25px;

}



.card{

    background:white;
    padding:25px;
    border-radius:25px;
    box-shadow:0 12px 30px rgba(0,0,0,.08);

}


.card h3{

    color:#00695c;
    margin-bottom:20px;

}



.info{

    display:flex;
    justify-content:space-between;
    padding:12px 0;
    border-bottom:1px solid #eee;

}



.label{

    color:#78909c;

}


.value{

    font-weight:bold;
    color:#263238;

}



.status{

    padding:8px 18px;
    border-radius:20px;
    font-weight:bold;

}



.waiting{

    background:#fff3cd;
    color:#856404;

}



.consulting{

    background:#cffafe;
    color:#155e75;

}



.completed{

    background:#dcfce7;
    color:#166534;

}



.waiting-message{

    margin-top:30px;
    background:#fff8e1;
    padding:25px;
    border-radius:20px;
    color:#795548;
    font-weight:600;
    line-height:1.8;

}



@media(max-width:1000px){

.grid{

grid-template-columns:1fr;

}

}

</style>



<div class="queue-profile">


<div class="profile-header">


<div>

<h1>
👤 Patient Queue Profile
</h1>

<p>
Patient waiting management
</p>

</div>



<?=Html::a(
"← Back Queue",
['index'],
[
'class'=>'back'
]
)?>


</div>




<div class="grid">



<!-- PATIENT INFORMATION -->

<div class="card">


<h3>
👤 Patient Information
</h3>



<div class="info">

<span class="label">
Name
</span>


<span class="value">

<?=Html::encode(
$patient->fullName ?? 'Unknown'
)?>

</span>

</div>



<div class="info">

<span class="label">
Gender
</span>


<span class="value">

<?=Html::encode(
$patient->gender ?? '-'
)?>

</span>

</div>



<div class="info">

<span class="label">
Phone
</span>


<span class="value">

<?=Html::encode(
$patient->phone ?? '-'
)?>

</span>

</div>



<div class="info">

<span class="label">
Patient ID
</span>


<span class="value">

#<?=$patient->id?>

</span>

</div>



</div>







<!-- QUEUE INFORMATION -->


<div class="card">


<h3>
🎫 Queue Information
</h3>



<div class="info">

<span class="label">
Queue Number
</span>


<span class="value">

<?=$model->queue_number?>

</span>

</div>




<div class="info">

<span class="label">
Status
</span>


<span class="status <?=$status?>">

<?=ucfirst($model->status)?>

</span>


</div>




<div class="info">

<span class="label">
Created
</span>


<span class="value">

<?=$model->created_at?>

</span>


</div>



</div>







<!-- DOCTOR -->


<div class="card">


<h3>
🩺 Doctor Assignment
</h3>



<div class="info">

<span class="label">
Doctor
</span>


<span class="value">

<?=

$model->doctor

?

Html::encode($model->doctor->full_name)

:

'Not Assigned'

?>

</span>

</div>




<div class="info">

<span class="label">
Department
</span>


<span class="value">

<?=$model->department ?? 'General'?>

</span>

</div>




<div class="info">

<span class="label">
Workflow
</span>


<span class="value">

Waiting

</span>

</div>



</div>



</div>







<!-- WAITING MESSAGE -->


<div class="card">


<h3>
🕒 Current Status
</h3>


<div class="waiting-message">


✅ Patient has been registered successfully and added to queue.


<br><br>


The patient is currently waiting for doctor consultation.


<br><br>


🩺 Doctor will view this patient from the Doctor Dashboard and call the patient when ready.


</div>



</div>



</div>