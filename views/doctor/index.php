<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\LinkPager;


$this->title = 'Doctor Clinical Command Center';

?>


<div class="doctor-dashboard">


<!-- ===============================
     DOCTOR HEADER COMMAND CENTER
================================ -->


<div class="doctor-header-card">


<div class="doctor-brand">


<div>

<h2>
🏥 MYLES Health Analytics System
</h2>


<p>
Smart Hospital Clinical Command Center
</p>


</div>



<div class="doctor-profile">


<div class="doctor-avatar">
👨‍⚕️
</div>


<div>

<h5>
Dr. Myles
</h5>


<span class="online-status">
● Online
</span>


<small>
Doctor Account
</small>


</div>


</div>


</div>





<!-- SEARCH BAR -->


<div class="search-container">


<span>
🔍
</span>


<input
type="text"
placeholder="Search patient, queue, laboratory, medical record..."
>


</div>



</div>









<!-- ===============================
     QUICK CLINICAL ACTIONS
================================ -->


<div class="section-title">

<h3>
⚡ Clinical Quick Actions
</h3>

</div>



<div class="quick-actions">



<a href="<?=Url::to(['/doctor/lab-results'])?>"
class="action-card">

<div class="action-icon">
🧪
</div>

<div>
<h6>
Lab Results
</h6>

<small>
View laboratory reports
</small>

</div>

</a>





<a href="<?=Url::to(['/medical-records/index'])?>"
class="action-card">


<div class="action-icon">
📋
</div>


<div>

<h6>
Medical Records
</h6>

<small>
Patient history
</small>

</div>


</a>






<a href="<?=Url::to(['/pharmacy/index'])?>"
class="action-card">


<div class="action-icon">
💊
</div>


<div>

<h6>
Pharmacy
</h6>


<small>
Prescription management
</small>


</div>


</a>







<a href="<?=Url::to(['/doctor/notifications'])?>"
class="action-card">


<div class="action-icon">
🔔
</div>


<div>

<h6>
Notifications
</h6>


<small>
Clinical alerts
</small>


</div>


</a>







<a href="<?=Url::to(['/doctor/index'])?>"
class="action-card">


<div class="action-icon">
👥
</div>


<div>

<h6>
Today's Patients
</h6>


<small>
Queue monitoring
</small>


</div>


</a>







<a href="<?=Url::to(['/doctor/consultation'])?>"
class="action-card">


<div class="action-icon">
🩺
</div>


<div>

<h6>
Consultation
</h6>


<small>
Open consultation
</small>


</div>


</a>




</div>









<!-- ===============================
     SMART STATISTICS
================================ -->


<div class="stats-row">



<div class="stat-card">

<div class="stat-icon">
👥
</div>


<div>

<h2>
<?=$todayPatients?>
</h2>


<p>
Today's Patients
</p>


</div>


</div>








<div class="stat-card">


<div class="stat-icon">
⏳
</div>


<div>

<h2>
<?=$waitingCount?>
</h2>


<p>
Waiting Queue
</p>


</div>


</div>








<div class="stat-card">


<div class="stat-icon">
🩺
</div>


<div>

<h2>
<?=$consultingCount?>
</h2>


<p>
Consulting Patients
</p>


</div>


</div>








<div class="stat-card">


<div class="stat-icon">
🔔
</div>


<div>

<h2>
<?=$notificationCount?>
</h2>


<p>
Notifications
</p>


</div>


</div>



</div>

<style>


.doctor-dashboard{

background:#f4f8f7;

min-height:100vh;

padding:25px;

font-family:'Inter','Segoe UI',sans-serif;

}




.doctor-header-card{

background:
linear-gradient(
135deg,
#ffffff,
#e8faf4
);


border-radius:30px;

padding:30px;


box-shadow:

0 25px 50px rgba(0,0,0,.12);

margin-bottom:30px;

}




.doctor-brand{

display:flex;

justify-content:space-between;

align-items:center;

}



.doctor-brand h2{

font-size:30px;

font-weight:900;

color:#087f5b;

}



.doctor-brand p{

color:#64748b;

font-size:16px;

}




.doctor-profile{

display:flex;

align-items:center;

gap:15px;

background:white;

padding:15px 25px;

border-radius:25px;


box-shadow:

0 10px 25px rgba(0,0,0,.08);

}



.doctor-avatar{

font-size:45px;

}



.online-status{

display:block;

color:#16a34a;

font-weight:700;

}



.doctor-profile small{

color:#64748b;

}




.search-container{


margin-top:25px;


display:flex;


align-items:center;


gap:15px;


background:white;


padding:18px 25px;


border-radius:20px;


box-shadow:

inset 0 2px 10px rgba(0,0,0,.05);


}



.search-container input{


border:none;


outline:none;


width:100%;


font-size:16px;


}






.section-title h3{

font-weight:800;

color:#065f46;

margin-bottom:20px;

}






.quick-actions{


display:grid;


grid-template-columns:
repeat(6,1fr);


gap:18px;


margin-bottom:30px;


}




.action-card{


background:white;


height:125px;


border-radius:25px;


display:flex;


flex-direction:column;


justify-content:center;


align-items:center;


text-decoration:none;


color:#334155;


box-shadow:

0 15px 35px rgba(0,0,0,.10);


transition:.35s;


}



.action-card:hover{


transform:
translateY(-10px)
scale(1.02);


box-shadow:

0 25px 50px rgba(0,0,0,.18);


}





.action-icon{


font-size:38px;

margin-bottom:8px;

}




.action-card h6{


font-weight:800;

margin:0;

}



.action-card small{


color:#64748b;

font-size:12px;

}








.stats-row{


display:grid;


grid-template-columns:
repeat(4,1fr);


gap:20px;


margin-bottom:35px;


}





.stat-card{


background:white;


border-radius:28px;


padding:25px;


display:flex;


align-items:center;


gap:20px;


box-shadow:


0 20px 45px rgba(0,0,0,.12);


transition:.3s;


}



.stat-card:hover{


transform:
translateY(-8px);


}




.stat-icon{


font-size:45px;


}



.stat-card h2{


margin:0;


font-size:38px;


font-weight:900;


color:#087f5b;


}



.stat-card p{


margin:0;


color:#64748b;


}



@media(max-width:1200px){


.quick-actions{

grid-template-columns:
repeat(3,1fr);

}


.stats-row{

grid-template-columns:
repeat(2,1fr);

}


}



</style>





<!-- ===============================
     PART 2 STARTS HERE
     PATIENT QUEUE TABLE
================================ -->

<!-- ===============================
     PATIENT CLINICAL WORKLIST
================================ -->


<div class="queue-container">



<div class="queue-header">


<div>

<h3>
🎫 Today's Patient Worklist
</h3>


<p>
Live Clinical Queue Management
</p>


</div>



<div>

<span class="live-badge">

● LIVE

</span>

</div>



</div>








<div class="table-responsive">


<table class="modern-table">



<thead>


<tr>

<th>
Queue
</th>


<th>
Patient
</th>


<th>
Clinical Information
</th>


<th>
Department
</th>


<th>
Priority
</th>


<th>
Status
</th>


<th>
Arrival
</th>


<th>
Clinical Action
</th>


</tr>


</thead>





<tbody>



<?php foreach($dataProvider->getModels() as $queue): ?>



<tr>



<!-- QUEUE -->


<td>


<div class="queue-number">


<?=Html::encode(
$queue->queue_number
)?>


</div>


</td>







<!-- PATIENT -->


<td>


<div class="patient-info">


<div class="patient-avatar">

👤

</div>



<div>


<strong>

<?php if($queue->patient): ?>


<?=Html::encode(
$queue->patient->fullName
)?>


<?php else: ?>


Unknown Patient


<?php endif; ?>


</strong>



<br>


<small>

<?=

$queue->patient->gender ?? 'N/A'

?>

</small>


</div>


</div>


</td>








<!-- CLINICAL INFORMATION -->


<td>


<div class="clinical-box">


📝

<?=Html::encode(

$queue->notes ?: 
'Awaiting clinical assessment'

)?>



</div>



<?php if($queue->doctor): ?>


<small class="doctor-tag">

👨‍⚕️
<?=$queue->doctor->username?>


</small>


<?php endif; ?>


</td>









<!-- DEPARTMENT -->


<td>


<span class="department">


<?=Html::encode(
$queue->department
)?>

</span>


</td>










<!-- PRIORITY -->


<td>


<?php if($queue->priority=="Emergency"): ?>


<span class="priority emergency">

🚨 Emergency

</span>



<?php elseif($queue->priority=="Urgent"): ?>


<span class="priority urgent">

⚠ Urgent

</span>



<?php else: ?>


<span class="priority normal">

Normal

</span>



<?php endif; ?>


</td>









<!-- STATUS -->


<td>


<?php

$status =
strtolower(
str_replace(
' ',
'-',
$queue->status
));

?>


<span class="status <?=$status?>">


<?=$queue->status?>


</span>


</td>









<!-- ARRIVAL -->


<td>


<div class="arrival-time">


<?=Yii::$app->formatter->asDatetime(

$queue->arrival_time,

'short'

)?>


</div>


</td>


<td class="text-center">


<button 
class="press-button"
onclick="openClinicalPanel(
'<?=$queue->id?>',
'<?=Html::encode($queue->patient->fullName ?? "Unknown Patient")?>'
)"
>

<span>
🩺
</span>

PRESS

</button>


</td>






</tr>



<?php endforeach; ?>

<!-- ===============================
 CLINICAL ACTION OVERLAY
================================ -->


<div id="clinicalOverlay" class="clinical-overlay">


<div class="clinical-panel">


<button 
class="close-panel"
onclick="closeClinicalPanel()">
✕
</button>


<h3>
🩺 Clinical Command
</h3>


<p id="patientName">
</p>



<div class="clinical-actions">


<a id="callPatient">
📢 Call Patient
</a>


<a id="consultPatient">
🩺 Start Consultation
</a>


<a id="clinicalNotes">
📝 Clinical Notes
</a>


<a id="diagnosis">
🧬 Diagnosis
</a>


<a id="labRequest">
🧪 Request Lab Test
</a>


<a id="labResults">
📄 View Lab Result
</a>


<a id="pharmacy">
💊 Send To Pharmacy
</a>


<a id="profile">
👤 Patient Profile
</a>


<a id="followUp">
📅 Follow Up
</a>


<a id="complete"
class="danger">
✔ Complete Consultation
</a>



</div>


</div>


</div>

<script>

function openClinicalPanel(id,name){


document.getElementById("clinicalOverlay").style.display="flex";


document.getElementById("patientName").innerHTML =
"Patient: <b>"+name+"</b>";



document.getElementById("callPatient").href =
"<?=Url::to(['/doctor/call'])?>?id="+id;



document.getElementById("consultPatient").href =
"<?=Url::to(['/doctor/medical-record'])?>?id="+id;



document.getElementById("clinicalNotes").href =
"<?=Url::to(['/doctor/add-notes'])?>?id="+id;



document.getElementById("diagnosis").href =
"<?=Url::to(['/doctor/diagnosis'])?>?id="+id;



document.getElementById("labRequest").href =
"<?=Url::to(['/doctor/request-lab'])?>?id="+id;



document.getElementById("labResults").href =
"<?=Url::to(['/doctor/lab-results'])?>?id="+id;



document.getElementById("pharmacy").href =
"<?=Url::to(['/doctor/send-pharmacy'])?>?id="+id;



document.getElementById("profile").href =
"<?=Url::to(['/patients/view'])?>?id="+id;



document.getElementById("followUp").href =
"<?=Url::to(['/doctor/follow-up'])?>?id="+id;



document.getElementById("complete").href =
"<?=Url::to(['/doctor/complete'])?>?id="+id;


}




function closeClinicalPanel(){


document.getElementById("clinicalOverlay").style.display="none";


}


</script>


</script>
</tbody>



</table>


</div>



</div>







<!-- ===============================
     PAGINATION
================================ -->


<div class="pagination-box">


<?=LinkPager::widget([

'pagination'=>$dataProvider->pagination,

'options'=>[

'class'=>'pagination justify-content-center'

]

]);?>


</div>





</div>








<style>


/* ===============================
   ADVANCED QUEUE TABLE 3D UI
================================ */


.queue-container{


background:white;


border-radius:30px;


padding:30px;


box-shadow:

0 25px 60px rgba(0,0,0,.12);


}




.queue-header{


display:flex;


justify-content:space-between;


align-items:center;


margin-bottom:25px;


}



.queue-header h3{


font-weight:900;


color:#087f5b;


}



.queue-header p{


color:#64748b;


}





.live-badge{


background:#dcfce7;


color:#15803d;


padding:10px 18px;


border-radius:20px;


font-weight:800;


}








.modern-table{


width:100%;


border-collapse:separate;


border-spacing:0 12px;


}





.modern-table thead th{


background:#ecfdf5;


padding:18px;


font-size:13px;


color:#065f46;


}



.modern-table tbody tr{


background:#ffffff;


box-shadow:

0 10px 25px rgba(0,0,0,.06);


transition:.3s;


}



.modern-table tbody tr:hover{


transform:

translateY(-5px);


box-shadow:

0 20px 40px rgba(0,0,0,.12);


}





.modern-table td{


padding:18px;


border:none;


}







.queue-number{


background:#ccfbf1;


color:#047857;


padding:10px 15px;


border-radius:15px;


font-weight:900;


}








.patient-info{


display:flex;


align-items:center;


gap:12px;


}



.patient-avatar{


width:45px;


height:45px;


border-radius:50%;


background:#e0f2fe;


display:flex;


align-items:center;


justify-content:center;


font-size:22px;


}







.clinical-box{


font-size:14px;


max-width:220px;


}



.doctor-tag{


color:#64748b;


}







.department{


background:#dbeafe;


color:#1d4ed8;


padding:8px 15px;


border-radius:20px;


font-weight:700;


font-size:12px;


}







.priority{


padding:8px 15px;


border-radius:20px;


font-weight:800;


font-size:12px;


}



.priority.emergency{


background:#fee2e2;


color:#b91c1c;


}



.priority.urgent{


background:#ffedd5;


color:#c2410c;


}



.priority.normal{


background:#dcfce7;


color:#166534;


}









.status{


padding:8px 15px;


border-radius:20px;


font-weight:800;


font-size:12px;


}



.status.waiting{


background:#fef9c3;


color:#854d0e;


}



.status.consulting{


background:#dbeafe;


color:#1d4ed8;


}



.status.completed{


background:#dcfce7;


color:#166534;


}









.action-buttons{


display:flex;


gap:8px;


}




.table-action{


width:38px;


height:38px;


border-radius:14px;


display:flex;


align-items:center;


justify-content:center;


color:white;


text-decoration:none;


font-size:18px;


box-shadow:


0 8px 18px rgba(0,0,0,.18);


transition:.3s;


}



.table-action:hover{


transform:

translateY(-6px)
scale(1.1);


color:white;


}




.table-action.call{

background:#16a34a;

}


.table-action.consult{

background:#2563eb;

}


.table-action.profile{

background:#0f766e;

}


.table-action.lab{

background:#ea580c;

}


.table-action.pharmacy{

background:#9333ea;

}


.table-action.done{

background:#dc2626;

}







.pagination-box{


margin-top:30px;


}

.table-responsive{

overflow-x:auto;

}

.press-button{


background:
linear-gradient(
135deg,
#0f766e,
#14b8a6
);


border:none;

color:white;

font-weight:900;

padding:12px 25px;

border-radius:30px;

cursor:pointer;

box-shadow:
0 10px 25px rgba(15,118,110,.35);

transition:.3s;

}



.press-button:hover{

transform:
translateY(-4px)
scale(1.05);

}




.clinical-overlay{


position:fixed;

top:0;

left:0;

width:100%;

height:100%;

background:
rgba(0,0,0,.45);

backdrop-filter:blur(5px);

display:none;

align-items:center;

justify-content:center;

z-index:9999;


}




.clinical-panel{


width:380px;

background:white;

border-radius:30px;

padding:30px;

box-shadow:
0 30px 80px rgba(0,0,0,.35);

animation:
popup .3s ease;


}



@keyframes popup{

from{

transform:scale(.7);

opacity:0;

}

to{

transform:scale(1);

opacity:1;

}

}




.close-panel{


float:right;

border:none;

background:#fee2e2;

color:#dc2626;

width:35px;

height:35px;

border-radius:50%;

}




.clinical-actions a{


display:block;

padding:14px;

margin:8px 0;

background:#f0fdfa;

border-radius:15px;

text-decoration:none;

font-weight:700;

color:#065f46;

transition:.2s;


}



.clinical-actions a:hover{


background:#ccfbf1;

padding-left:25px;


}



.clinical-actions .danger{


background:#fee2e2;

color:#b91c1c;

}

<!-- ===============================
 CLINICAL ACTION OVERLAY
================================ -->


<div id="clinicalOverlay" class="clinical-overlay">


<div class="clinical-panel">


<button 
class="close-panel"
onclick="closeClinicalPanel()">
✕
</button>


<h3>
🩺 Clinical Command
</h3>


<p id="patientName">
</p>



<div class="clinical-actions">


<a id="callPatient">
📢 Call Patient
</a>


<a id="consultPatient">
🩺 Start Consultation
</a>


<a id="clinicalNotes">
📝 Clinical Notes
</a>


<a id="diagnosis">
🧬 Diagnosis
</a>


<a id="labRequest">
🧪 Request Lab Test
</a>


<a id="labResults">
📄 View Lab Result
</a>


<a id="pharmacy">
💊 Send To Pharmacy
</a>


<a id="profile">
👤 Patient Profile
</a>


<a id="followUp">
📅 Follow Up
</a>


<a id="complete"
class="danger">
✔ Complete Consultation
</a>



</div>


</div>


</div>
</style>