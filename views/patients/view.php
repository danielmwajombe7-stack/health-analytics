<?php

use yii\helpers\Html;

$this->title = "Patient Profile";

?>


<style>

.patient-page{

    background:#f4f8fb;
    padding:30px;
    min-height:100vh;

}


.profile-card{

    background:white;
    border-radius:25px;
    padding:30px;
    margin-bottom:25px;
    box-shadow:0 10px 30px rgba(0,0,0,.08);

}



.patient-header{

    display:flex;
    justify-content:space-between;
    align-items:center;
}



.avatar{

    width:90px;
    height:90px;
    border-radius:50%;
    background:#00897b;
    color:white;
    display:flex;
    align-items:center;
    justify-content:center;
    font-size:40px;

}



.patient-name{

    font-size:30px;
    font-weight:bold;
    color:#004d40;

}



.status{

    background:#e8f5e9;
    color:#2e7d32;
    padding:8px 20px;
    border-radius:20px;

}



.grid{

display:grid;
grid-template-columns:repeat(3,1fr);
gap:20px;

}



.info-box{

background:#fafafa;
padding:20px;
border-radius:15px;

}



.info-box h5{

color:#00695c;

}



.section-title{

font-size:22px;
font-weight:bold;
color:#00695c;
margin-bottom:20px;

}



.table-card{

background:#fafafa;
border-radius:15px;
padding:15px;

}



.badge{

padding:7px 12px;
border-radius:15px;

}



.pending{

background:#fff3cd;
color:#856404;

}


.completed{

background:#d4edda;
color:#155724;

}


.processing{

background:#cce5ff;
color:#004085;

}




.action-btn{

padding:12px 18px;
border-radius:15px;
text-decoration:none;
font-weight:bold;
margin-right:10px;

}


.lab-btn{

background:#e1bee7;
color:#6a1b9a;

}


.queue-btn{

background:#e0f2f1;
color:#00695c;

}



@media(max-width:900px){

.grid{

grid-template-columns:1fr;

}

}


</style>





<div class="patient-page">





<!-- HEADER -->

<div class="profile-card">


<div class="patient-header">


<div style="display:flex;gap:20px;align-items:center;">


<div class="avatar">

👤

</div>



<div>


<h1 class="patient-name">

<?= Html::encode($model->fullName) ?>

</h1>


<p>

Patient Number:

<b>

<?= Html::encode($model->patient_number) ?>

</b>

</p>


</div>



</div>



<span class="status">

<?= Html::encode($model->status ?? 'Active') ?>

</span>



</div>


</div>










<!-- PERSONAL INFORMATION -->

<div class="profile-card">


<div class="section-title">

👤 Personal Information

</div>


<div class="grid">


<div class="info-box">

<h5>
Gender
</h5>

<?= Html::encode($model->gender) ?>

</div>



<div class="info-box">

<h5>
Date Of Birth
</h5>

<?= Html::encode($model->date_of_birth) ?>

</div>



<div class="info-box">

<h5>
Phone
</h5>

<?= Html::encode($model->phone) ?>

</div>




<div class="info-box">

<h5>
Blood Group
</h5>

<?= Html::encode($model->blood_group) ?>

</div>



<div class="info-box">

<h5>
Insurance
</h5>

<?= Html::encode($model->insurance_type) ?>

</div>



</div>


</div>









<!-- ACTIONS -->

<div class="profile-card">


<div class="section-title">

🏥 Clinical Actions

</div>




   




<?= Html::a(

'🎫 Add Queue',

[

'/patient-queue/create',

'patient_id'=>$model->id

],

[

'class'=>'action-btn queue-btn'

]

) ?>




</div>









<!-- LAB REQUESTS -->


<div class="profile-card">


<div class="section-title">

🧪 Laboratory Requests

</div>




<div class="table-card">


<table class="table table-hover">


<thead>

<tr>

<th>
Test
</th>


<th>
Priority
</th>


<th>
Status
</th>


<th>
Date
</th>

</tr>

</thead>



<tbody>



<?php if(!empty($labRequests)): ?>


<?php foreach($labRequests as $lab): ?>


<tr>


<td>

<?= Html::encode($lab->test_name) ?>

</td>


<td>

<?= Html::encode($lab->priority ?? 'Normal') ?>

</td>



<td>


<?php if($lab->status=="Completed"): ?>

<span class="badge completed">
✅ Completed
</span>


<?php elseif($lab->status=="Processing"): ?>

<span class="badge processing">
🔬 Processing
</span>


<?php else: ?>

<span class="badge pending">
⏳ Pending
</span>


<?php endif; ?>


</td>



<td>

<?= Html::encode($lab->created_at) ?>

</td>


</tr>


<?php endforeach; ?>


<?php else: ?>


<tr>

<td colspan="4">

No laboratory request available

</td>


</tr>


<?php endif; ?>


</tbody>


</table>


</div>


</div>









<!-- MEDICAL RECORDS -->


<div class="profile-card">


<div class="section-title">

📝 Medical Records

</div>


<?php if(!empty($medicalRecords)): ?>


<?php foreach($medicalRecords as $record): ?>


<div class="table-card mb-3">


<b>
Diagnosis:
</b>

<?= Html::encode($record->diagnosis ?? '-') ?>


<br>


<b>
Notes:
</b>

<?= Html::encode($record->notes ?? '-') ?>


</div>


<?php endforeach; ?>


<?php else: ?>


<p>
No medical records yet.
</p>


<?php endif; ?>


</div>









<!-- QUEUE -->


<div class="profile-card">


<div class="section-title">

🎫 Queue Status

</div>



<?php if(!empty($queues)): ?>


<?php foreach($queues as $queue): ?>


<div class="table-card">


Queue Number:

<b>

<?= Html::encode($queue->queue_number) ?>

</b>


<br>


Department:

<?= Html::encode($queue->department) ?>


<br>


Status:

<?= Html::encode($queue->status) ?>


</div>


<?php endforeach; ?>


<?php else: ?>


<p>
Patient is not in queue.
</p>


<?php endif; ?>


</div>









<!-- PRESCRIPTION -->


<div class="profile-card">


<div class="section-title">

💊 Prescription

</div>


<?php if(!empty($prescriptions)): ?>


<table class="table">


<tr>

<th>
Medicine
</th>

<th>
Dosage
</th>

</tr>



<?php foreach($prescriptions as $pres): ?>


<tr>


<td>

<?= Html::encode($pres->medicine_name ?? '-') ?>

</td>


<td>

<?= Html::encode($pres->dosage ?? '-') ?>

</td>


</tr>


<?php endforeach; ?>


</table>



<?php else: ?>


<p>
No prescription available.
</p>


<?php endif; ?>


</div>










<!-- VISITS -->


<div class="profile-card">


<div class="section-title">

📅 Patient Visits

</div>



<?php if(!empty($visits)): ?>


<?php foreach($visits as $visit): ?>


<div class="table-card">


Visit Date:

<?= Html::encode($visit->visit_date) ?>


<br>


Reason:

<?= Html::encode($visit->reason ?? '-') ?>


</div>


<?php endforeach; ?>


<?php else: ?>


<p>
No visits recorded.
</p>


<?php endif; ?>



</div>





</div>