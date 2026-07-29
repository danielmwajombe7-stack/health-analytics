<?php

use yii\helpers\Html;

$this->title = "Health Analytics Intelligence Report";

?>


<div class="container-fluid report-page">


<!-- HEADER -->

<div class="report-header d-flex justify-content-between align-items-center mb-4">


<div>

<h2 class="fw-bold">
📈 Health Analytics Intelligence Center
</h2>


<p class="text-muted">
AI powered hospital performance monitoring and decision support
</p>


</div>



<div>

<span class="system-status">

🟢 System Online

</span>


</div>


</div>






<!-- KPI SECTION -->


<div class="row g-4 mb-4">



<div class="col-xl-3 col-md-6">

<div class="analytics-card">


<div class="icon">
👥
</div>


<div>

<h6>Total Patients</h6>


<h2>
<?= $totalPatients ?>
</h2>


<p>
Registered patients
</p>


</div>


</div>

</div>






<div class="col-xl-3 col-md-6">


<div class="analytics-card">


<div class="icon">
💰
</div>


<div>

<h6>Total Revenue</h6>


<h2>
TZS <?= number_format($totalRevenue) ?>
</h2>


<p>
Hospital financial activity
</p>


</div>


</div>


</div>







<div class="col-xl-3 col-md-6">


<div class="analytics-card">


<div class="icon">
🧪
</div>


<div>


<h6>Laboratory Requests</h6>


<h2>

<?= $totalLabRequests ?>

</h2>


<p>
Diagnostic workload
</p>



</div>


</div>


</div>








<div class="col-xl-3 col-md-6">


<div class="analytics-card">


<div class="icon">
🎫
</div>


<div>


<h6>Completed Appointments</h6>


<h2>

<?= $completedAppointments ?>

</h2>


<p>
Consultations completed
</p>


</div>


</div>


</div>




</div>










<!-- CHARTS -->


<div class="row g-4">



<div class="col-xl-4">


<div class="chart-card">


<div class="card-title">

👥 Patient Gender Distribution

</div>



<div class="chart-box">


<canvas id="genderChart"></canvas>


</div>



</div>


</div>







<div class="col-xl-8">


<div class="chart-card">


<div class="card-title">

📊 Patient Growth Trend

</div>


<div class="chart-large">


<canvas id="growthChart"></canvas>


</div>


</div>


</div>



</div>









<br>







<!-- FINANCE QUEUE -->


<div class="row g-4">



<div class="col-xl-6">


<div class="chart-card">


<div class="card-title">

💳 Financial Intelligence

</div>



<div class="chart-large">

<canvas id="financeChart"></canvas>

</div>


</div>


</div>







<div class="col-xl-6">


<div class="chart-card">


<div class="card-title">

🎫 Queue Performance

</div>



<div class="chart-large">

<canvas id="queueChart"></canvas>

</div>



</div>


</div>



</div>










<br>










<!-- AI INSIGHTS -->


<div class="chart-card">


<div class="card-title">

🧠 AI Healthcare Insights

</div>




<div class="row g-4">



<div class="col-md-3">


<h6>
Critical Monitoring
</h6>


<div class="progress">

<div class="progress-bar bg-danger"
style="width:70%">

70%

</div>

</div>


</div>







<div class="col-md-3">


<h6>
Revenue Collection
</h6>


<div class="progress">

<div class="progress-bar bg-success"
style="width:40%">

40%

</div>

</div>


</div>








<div class="col-md-3">


<h6>
Laboratory Load
</h6>


<div class="progress">

<div class="progress-bar bg-info"
style="width:60%">

60%

</div>

</div>


</div>








<div class="col-md-3">


<h6>
Queue Efficiency
</h6>


<div class="progress">

<div class="progress-bar bg-warning"
style="width:80%">

80%

</div>

</div>


</div>




</div>


</div>








</div>










<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


<script>


// GENDER CHART


new Chart(
document.getElementById('genderChart'),

{


type:'doughnut',


data:{


labels:[

'Male',

'Female'

],


datasets:[{

data:

<?= json_encode($genderChart) ?>


}]


},


options:{


responsive:true,

maintainAspectRatio:false,


plugins:{


legend:{


position:'bottom'


}


}



}



}

);









// PATIENT GROWTH


new Chart(

document.getElementById('growthChart'),

{


type:'line',


data:{


labels:

<?= json_encode($months) ?>,


datasets:[{


label:'Patients',


data:

<?= json_encode($patientCounts) ?>


}]


},


options:{


responsive:true,

maintainAspectRatio:false


}


}

);









// FINANCE


new Chart(

document.getElementById('financeChart'),

{


type:'bar',


data:{


labels:[

'Revenue',

'Paid',

'Pending'

],


datasets:[{


label:'TZS',


data:[


<?= $totalRevenue ?>,


<?= $paidAmount ?>,


<?= $pendingAmount ?>


]


}]


},


options:{


responsive:true,

maintainAspectRatio:false


}



}

);









// QUEUE


new Chart(

document.getElementById('queueChart'),

{


type:'polarArea',


data:{


labels:[

'Waiting',

'Consulting'

],


datasets:[{


data:[


<?= $waitingPatients ?>,


<?= $consultingPatients ?>


]


}]


},


options:{


responsive:true,

maintainAspectRatio:false


}



}

);



</script>










<style>


.report-page{

padding:10px;

}



/* HEADER */


.system-status{


background:#e8f5e9;

color:#2e7d32;

padding:14px 22px;

border-radius:30px;

font-weight:700;

}





/* KPI */


.analytics-card{


background:white;

border-radius:22px;

padding:25px;

display:flex;

gap:20px;

align-items:center;

box-shadow:
0 10px 25px rgba(0,0,0,.08);

transition:.3s;


}



.analytics-card:hover{

transform:translateY(-5px);

}



.analytics-card .icon{


font-size:35px;

background:#e0f2f1;

width:65px;

height:65px;

display:flex;

align-items:center;

justify-content:center;

border-radius:18px;


}



.analytics-card h2{

font-size:32px;

font-weight:800;

}



.analytics-card p{

color:#777;

font-size:14px;

}









/* CHART CARDS */


.chart-card{


background:white;

padding:25px;

border-radius:22px;

box-shadow:

0 10px 30px rgba(0,0,0,.08);


}



.card-title{


font-size:18px;

font-weight:700;

margin-bottom:20px;

color:#00695c;


}




.chart-box{


height:260px;

display:flex;

justify-content:center;

}




.chart-large{

height:300px;

}









.progress{


height:22px;

border-radius:20px;

}



.progress-bar{


font-weight:bold;

}




</style>