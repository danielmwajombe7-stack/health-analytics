<?php

use yii\helpers\Html;
use yii\helpers\Url;

$this->title="Nurse Patient Worklist";

?>


<style>


body{

background:#020617;

}


/* HEADER */

.worklist-header{

background:
linear-gradient(
135deg,
#064e3b,
#0f766e,
#0284c7
);

padding:35px;

border-radius:25px;

color:white;

margin-bottom:30px;

box-shadow:
0 15px 40px rgba(0,0,0,.45);

}



.worklist-header h2{

font-weight:800;

}



/* MAIN CARD */


.queue-card{


background:#0f172a;

border-radius:25px;

padding:30px;

box-shadow:
0 15px 40px rgba(0,0,0,.4);

overflow-x:auto;

}




.table{

color:white;

}



.table thead{


background:#1e293b;

}



.table th{

padding:18px;

font-size:14px;

color:#cbd5e1;

}



.table td{

padding:18px;

vertical-align:middle;

}




.table tbody tr{

transition:.3s;

}



.table tbody tr:hover{

background:#1e293b;

transform:scale(1.01);

}





/* PATIENT */


.patient-box{

display:flex;

align-items:center;

gap:15px;

}



.avatar{


width:50px;

height:50px;

border-radius:50%;


display:flex;

align-items:center;

justify-content:center;


background:#0ea5e9;

font-size:25px;


}




.patient-name{

font-weight:700;

color:white;

}




.patient-id{

font-size:12px;

color:#94a3b8;

}





/* BADGES */


.priority{


padding:7px 14px;

border-radius:20px;

font-size:13px;

font-weight:bold;

}



.priority-high{

background:#dc2626;

color:white;

}



.priority-normal{

background:#16a34a;

color:white;

}



.priority-urgent{

background:#991b1b;

color:white;

}




.status{

padding:7px 15px;

border-radius:20px;

background:#f59e0b;

color:white;

font-weight:bold;

font-size:13px;

}





.triage-btn{


background:#10b981;

border:none;

padding:10px 20px;

border-radius:20px;

color:white;

font-weight:bold;

transition:.3s;


}



.triage-btn:hover{


background:#059669;

transform:translateY(-3px);

color:white;

}




.search-box{


background:#1e293b;

border:none;

color:white;

padding:12px 20px;

border-radius:20px;


}



</style>






<div class="container-fluid">






<!-- HEADER -->

<div class="worklist-header">


<h2>

🩺 Nurse Patient Queue

</h2>


<p>

Clinical assessment and triage management center

</p>


</div>









<div class="queue-card">



<div class="d-flex justify-content-between align-items-center mb-4">


<h4 style="color:white">

📋 Waiting For Assessment

</h4>



<input 
type="text"
class="search-box"
placeholder="🔍 Search patient...">


</div>









<table class="table table-hover">


<thead>

<tr>


<th>
Queue
</th>


<th>
Patient
</th>


<th>
Gender
</th>


<th>
Priority
</th>


<th>
Status
</th>


<th>
Action
</th>



</tr>


</thead>







<tbody>



<?php if(count($patients)>0): ?>



<?php foreach($patients as $patient): ?>



<tr>




<td>


<strong>

<?= $patient->queue_number ?>

</strong>


</td>








<td>


<div class="patient-box">


<div class="avatar">

👤

</div>



<div>


<div class="patient-name">


<?=

$patient->patient->first_name
.' '.
$patient->patient->last_name

?>


</div>



<div class="patient-id">


Patient ID:
<?= $patient->patient_id ?>


</div>



</div>



</div>



</td>








<td>


<?=

$patient->patient->gender ?? '-'

?>


</td>








<td>


<?php 

$priority=$patient->priority;


if($priority=="Urgent"):

?>


<span class="priority priority-urgent">

🚨 Urgent

</span>



<?php elseif($priority=="High"): ?>



<span class="priority priority-high">

⚠ High

</span>



<?php else: ?>



<span class="priority priority-normal">

Normal

</span>



<?php endif; ?>


</td>









<td>


<span class="status">


⏳ <?= $patient->status ?>

</span>


</td>








<td>



<?= Html::a(

"🩺 Start Triage",

[
'triage',
'id'=>$patient->id
],

[

'class'=>'triage-btn'

]

) ?>



</td>





</tr>



<?php endforeach; ?>



<?php else: ?>


<tr>

<td colspan="6" class="text-center">


<h4>

✅ No patients waiting

</h4>


</td>

</tr>



<?php endif; ?>



</tbody>


</table>




</div>




</div>