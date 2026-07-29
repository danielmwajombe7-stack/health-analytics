<?php

$this->title = "Health Analytics Dashboard";

?>


<style>


.dashboard-container{

    background:#f4f8fb;

    min-height:100vh;

    padding:25px;

}



.cards{

    display:grid;

    grid-template-columns:repeat(4,1fr);

    gap:20px;

}



.card{

    background:white;

    padding:25px;

    border-radius:20px;

    box-shadow:0 10px 25px rgba(0,0,0,.08);

    transition:.3s;

}



.card:hover{

    transform:translateY(-5px);

}



.card-icon{

    font-size:35px;

}



.card-title{

    margin-top:15px;

    color:#607d8b;

    font-size:15px;

}



.card-value{

    font-size:40px;

    font-weight:800;

    margin:10px 0;

    color:#00695c;

}



.card-footer{

    color:#00897b;

    font-size:14px;

}





.ai-box{

    margin-top:30px;

    background:

    linear-gradient(
        135deg,
        #009688,
        #004d40
    );

    color:white;

    padding:30px;

    border-radius:25px;

}



.ai-box h2{

    font-size:24px;

}



.risk{

    font-size:42px;

    font-weight:800;

    margin:20px 0;

}






.info-grid{

    display:grid;

    grid-template-columns:repeat(3,1fr);

    gap:20px;

    margin-top:30px;

}



.info{

    background:white;

    padding:25px;

    border-radius:20px;

    box-shadow:0 10px 20px rgba(0,0,0,.06);

}



.info h3{

    color:#004d40;

}



.info p{

    color:#455a64;

}





@media(max-width:900px){

.cards{

grid-template-columns:1fr;

}


.info-grid{

grid-template-columns:1fr;

}

}



</style>





<div class="dashboard-container">





<div class="cards">





<div class="card">

<div class="card-icon">
👥
</div>


<div class="card-title">
Registered Patients
</div>


<div class="card-value">
<?=$totalPatients?>
</div>


<div class="card-footer">
Total patients in system
</div>

</div>







<div class="card">

<div class="card-icon">
🩺
</div>


<div class="card-title">
Active Patients
</div>


<div class="card-value">

<?=

$waitingPatients
+
$calledPatients
+
$consultingPatients

?>

</div>


<div class="card-footer">
Currently receiving services
</div>

</div>








<div class="card">

<div class="card-icon">
🚨
</div>


<div class="card-title">
Critical Alerts
</div>


<div class="card-value">

<?=$critical?>

</div>


<div class="card-footer">
Immediate attention required
</div>

</div>








<div class="card">

<div class="card-icon">
🧠
</div>


<div class="card-title">
AI Risk Flags
</div>


<div class="card-value">

<?=$riskFlags?>

</div>


<div class="card-footer">
AI patient monitoring
</div>


</div>








<div class="card">

<div class="card-icon">
⏳
</div>


<div class="card-title">
Waiting Queue
</div>


<div class="card-value">

<?=$waitingPatients?>

</div>


<div class="card-footer">
Patients waiting consultation
</div>


</div>








<div class="card">

<div class="card-icon">
🩺
</div>


<div class="card-title">
Consulting
</div>


<div class="card-value">

<?=$consultingPatients?>

</div>


<div class="card-footer">
Currently with doctors
</div>


</div>








<div class="card">

<div class="card-icon">
✅
</div>


<div class="card-title">
Completed Visits
</div>


<div class="card-value">

<?=$completedPatients?>

</div>


<div class="card-footer">
Completed consultations
</div>


</div>








<div class="card">

<div class="card-icon">
🧪
</div>


<div class="card-title">
Pending Laboratory
</div>


<div class="card-value">

<?=$pendingLab?>

</div>


<div class="card-footer">
Waiting results
</div>


</div>






</div>









<div class="ai-box">


<h2>
🧠 AI Health Intelligence
</h2>



<div class="risk">

<?=$riskLevel?>

</div>



<p>

<?=$warning?>

</p>



<hr>



<p>

<b>
AI Recommendation:
</b>

Review critical patients, pending laboratory results and consultation workflow.

</p>



</div>









<div class="info-grid">





<div class="info">


<h3>
📅 Today's Overview
</h3>


<p>

New Patients Today:

<strong>

<?=$todayPatients?>

</strong>


</p>



<p>

Male Patients:

<strong>

<?=$male?>

</strong>


</p>



<p>

Female Patients:

<strong>

<?=$female?>

</strong>


</p>



</div>









<div class="info">


<h3>
🧪 Laboratory
</h3>



<p>

Pending Tests:

<strong>

<?=$pendingLab?>

</strong>

</p>



<p>

Completed Tests:

<strong>

<?=$completedLab?>

</strong>

</p>


</div>









<div class="info">


<h3>
🏥 Patient Monitoring
</h3>



<p>

Recovery Score:

<strong>

<?=$recoveryScore?>%

</strong>


</p>



<p>

Real-time hospital activities tracking

</p>


</div>







</div>






</div>