<?php

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = "Nurse Clinical Dashboard";

?>


<style>

body{
background:#020617;
}


.nurse-header{

background:
linear-gradient(135deg,#065f46,#0f766e,#0284c7);

padding:35px;

border-radius:25px;

color:white;

box-shadow:0 15px 40px rgba(0,0,0,.5);

}



.cards{

display:flex;

gap:25px;

margin-top:30px;

}



.card-box{

flex:1;

background:#0f172a;

padding:25px;

border-radius:20px;

color:white;

border:1px solid #1e293b;

}



.icon{

font-size:40px;

}



.number{

font-size:35px;

font-weight:bold;

}



.label{

color:#94a3b8;

}





.actions{

margin-top:35px;

background:#0f172a;

padding:30px;

border-radius:25px;

}



.btn-action{

display:inline-block;

padding:15px 25px;

margin-right:15px;

border-radius:15px;

background:#0284c7;

color:white;

text-decoration:none;

font-weight:bold;

}



.btn-action:hover{

background:#0369a1;

color:white;

}



</style>



<div class="container-fluid">



<div class="nurse-header">


<h2>

🩺 Nurse Clinical Command Center

</h2>


<p>

Patient assessment, vital signs monitoring and triage management

</p>


</div>





<div class="cards">



<div class="card-box">


<div class="icon">
⏳
</div>


<div class="number">

<?= $waitingPatients ?>

</div>


<div class="label">

Waiting Patients

</div>



<a href="<?=Url::to(['/nurse/worklist'])?>"
class="btn btn-sm btn-primary mt-3">

Open Queue

</a>


</div>







<div class="card-box">


<div class="icon">
🩺
</div>


<div class="number">

<?= $triagePatients ?>

</div>


<div class="label">

Pending Triage

</div>



<a href="<?=Url::to(['/nurse/worklist'])?>"
class="btn btn-sm btn-success mt-3">

Start Assessment

</a>


</div>








<div class="card-box">


<div class="icon">
✅
</div>


<div class="number">

<?= $completedTriage ?>

</div>


<div class="label">

Completed Assessment

</div>



<a href="<?=Url::to(['/nurse/worklist'])?>"
class="btn btn-sm btn-warning mt-3">

View Completed

</a>


</div>





</div>







<div class="actions">


<h3 style="color:white">

⚡ Nurse Actions

</h3>


<br>


<a class="btn-action"
href="<?=Url::to(['/nurse/worklist'])?>">

👥 Patient Queue

</a>




<a class="btn-action"
href="<?=Url::to(['/nurse/worklist'])?>">

🩺 Start Triage

</a>




<a class="btn-action"
href="<?=Url::to(['/nurse/worklist'])?>">

📋 Assessment History

</a>



</div>







</div>