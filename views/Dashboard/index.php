<?php

use yii\helpers\Html;

$this->title = "Health Analytics Dashboard";

?>


<style>

/* ===================================
GLOBAL
=================================== */

@import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap');


body{

font-family:'Inter',sans-serif;

background:#f4f9f8;

}





.dashboard-wrapper{

padding:35px;

min-height:100vh;

}



/* ===================================
ADVANCED HORIZONTAL HEADER
=================================== */


.dashboard-header{


background:

linear-gradient(
135deg,
#004d40,
#009688
);


padding:25px 35px;

border-radius:28px;

margin-bottom:35px;


display:flex;

align-items:center;

justify-content:space-between;


color:white;


box-shadow:

0 20px 45px rgba(0,105,92,.25);


gap:25px;


}




/* PROFILE LEFT */

.profile{


display:flex;

align-items:center;

gap:18px;

min-width:280px;


}



.avatar{


width:75px;

height:75px;


border-radius:50%;


background:white;


color:#00695c;


display:flex;

align-items:center;

justify-content:center;


font-size:32px;

font-weight:900;


box-shadow:

0 10px 25px rgba(0,0,0,.25);


}




.profile h1{


font-size:26px;

font-weight:800;

margin:0;


}



.profile p{


margin-top:8px;

font-size:14px;

opacity:.9;


}







/* STATUS AREA */


.system-status{


display:flex;

gap:15px;


}



.status-box{


background:

rgba(255,255,255,.15);


border:

1px solid rgba(255,255,255,.25);


padding:12px 18px;


border-radius:18px;


text-align:center;


backdrop-filter:blur(15px);


font-size:12px;


}



.status-box i{


font-size:22px;


display:block;


margin-bottom:5px;


}



.status-box strong{


display:block;


font-size:18px;


}








/* ACTIONS */


.quick-actions{


display:flex;

gap:12px;


}




.action-btn{


width:48px;

height:48px;


background:white;


color:#00695c;


border-radius:50%;


display:flex;

align-items:center;

justify-content:center;


font-size:21px;


box-shadow:

0 10px 25px rgba(0,0,0,.15);


transition:.3s;


}



.action-btn:hover{


transform:translateY(-5px);


}







/* ===================================
STATISTICS CARDS
=================================== */


.stats-grid{


display:grid;


grid-template-columns:

repeat(4,1fr);


gap:22px;


margin-bottom:40px;


}





.stat-card{


background:white;


padding:25px;


border-radius:25px;


box-shadow:

0 15px 35px rgba(0,0,0,.08);


position:relative;


overflow:hidden;


transition:.3s;


border:

1px solid #e0f2f1;


}




.stat-card:hover{


transform:translateY(-8px);


box-shadow:

0 25px 45px rgba(0,105,92,.18);


}




.stat-card::after{


content:"";


position:absolute;


width:100px;

height:100px;


right:-30px;

top:-30px;


background:#e0f2f1;


border-radius:50%;


}




.stat-icon{


font-size:40px;


position:relative;


z-index:2;


}



.stat-number{


font-size:40px;


font-weight:900;


color:#00695c;


margin-top:10px;


position:relative;


z-index:2;


}



.stat-title{


color:#607d8b;


font-weight:600;


position:relative;


z-index:2;


}







/* ===================================
SECTION TITLE
=================================== */


.section-title{


font-size:26px;


font-weight:900;


color:#004d40;


margin-bottom:25px;


}







/* RESPONSIVE */


@media(max-width:1200px){


.dashboard-header{


flex-direction:column;


align-items:flex-start;


}



.stats-grid{


grid-template-columns:repeat(2,1fr);


}


}



@media(max-width:600px){


.dashboard-wrapper{


padding:15px;


}



.stats-grid{


grid-template-columns:1fr;


}



.system-status{


flex-wrap:wrap;


}


}


</style>





<div class="dashboard-wrapper">





<!-- ===============================
ADVANCED HEADER
================================ -->


<div class="dashboard-header">



<!-- USER PROFILE -->


<div class="profile">


<div class="avatar">


<?= strtoupper(
substr($user->username,0,1)
) ?>


</div>




<div>


<h1>

Welcome,

<?= Html::encode(
$user->username
) ?>

👋


</h1>



<p>

Health Analytics Smart Hospital Management System

</p>


</div>


</div>







<!-- SYSTEM STATUS -->


<div class="system-status">


<div class="status-box">


<i class="bi bi-hospital-fill"></i>


<strong>

MHAS

</strong>


Hospital


</div>




<div class="status-box">


<i class="bi bi-activity"></i>


<strong>

ONLINE

</strong>


System


</div>




<div class="status-box">


<i class="bi bi-people-fill"></i>


<strong>

<?= $totalPatients ?? 0 ?>

</strong>


Patients


</div>



</div>








<!-- QUICK ACTION -->


<div class="quick-actions">


<div class="action-btn">

<i class="bi bi-bell-fill"></i>

</div>


<div class="action-btn">

<i class="bi bi-calendar-check-fill"></i>

</div>


<div class="action-btn">

<i class="bi bi-gear-fill"></i>

</div>


</div>



</div>








<!-- ===============================
STATISTICS
================================ -->


<div class="stats-grid">



<div class="stat-card">


<div class="stat-icon">

👥

</div>


<div class="stat-number">

<?= $totalPatients ?? 0 ?>

</div>


<div class="stat-title">

Total Patients

</div>


</div>







<div class="stat-card">


<div class="stat-icon">

🆕

</div>


<div class="stat-number">

<?= $todayPatients ?? 0 ?>

</div>


<div class="stat-title">

Today's Registration

</div>


</div>







<div class="stat-card">


<div class="stat-icon">

⏳

</div>


<div class="stat-number">

<?= $waitingPatients ?? 0 ?>

</div>


<div class="stat-title">

Waiting Queue

</div>


</div>







<div class="stat-card">


<div class="stat-icon">

🧪

</div>


<div class="stat-number">

<?= $pendingLab ?? 0 ?>

</div>


<div class="stat-title">

Pending Laboratory

</div>


</div>




</div>



<!-- PART 2 CONTINUES WITH MODULE CARDS -->
<!-- ===============================
HOSPITAL MODULES
================================ -->


<h2 class="section-title">

Hospital Modules

</h2>





<div class="module-grid">





<!-- PATIENT MANAGEMENT -->

<div class="module-card">


<div class="module-icon">

👤

</div>


<h3>

Patient Management

</h3>


<p>

Register, update and manage patient records, visits and medical information.

</p>



<a href="<?= Yii::$app->urlManager->createUrl(['/patients']) ?>"

class="btn-modern green">

<i class="bi bi-people-fill"></i>

Open Patients

</a>



</div>









<!-- DOCTOR -->

<div class="module-card">


<div class="module-icon">

🩺

</div>



<h3>

Doctor Consultation

</h3>



<p>

Manage patient queue, diagnosis, treatment and clinical decisions.

</p>




<a href="<?= Yii::$app->urlManager->createUrl(['/doctor']) ?>"

class="btn-modern blue">


<i class="bi bi-heart-pulse-fill"></i>


Doctor Panel


</a>



</div>









<!-- LAB -->

<div class="module-card">


<div class="module-icon">

🧪

</div>



<h3>

Laboratory

</h3>



<p>

Process laboratory requests, tests and upload patient results.

</p>




<a href="<?= Yii::$app->urlManager->createUrl(['/lab-request']) ?>"

class="btn-modern teal">


<i class="bi bi-eyedropper"></i>


Laboratory


</a>



</div>









<!-- PHARMACY -->

<div class="module-card">


<div class="module-icon">

💊

</div>



<h3>

Pharmacy

</h3>



<p>

Manage medicines, stock, prescriptions and dispensing.

</p>




<a href="<?= Yii::$app->urlManager->createUrl(['/pharmacy']) ?>"

class="btn-modern purple">


<i class="bi bi-capsule"></i>


Pharmacy


</a>



</div>









<!-- MEDICAL RECORD -->

<div class="module-card">


<div class="module-icon">

📋

</div>



<h3>

Medical Records

</h3>



<p>

Access patient history, diagnosis and clinical documentation.

</p>




<a href="<?= Yii::$app->urlManager->createUrl(['/medical-records']) ?>"

class="btn-modern orange">


<i class="bi bi-file-medical"></i>


Records


</a>



</div>









<!-- BILLING -->

<div class="module-card">


<div class="module-icon">

💰

</div>



<h3>

Billing & Payments

</h3>



<p>

Manage invoices, payments and hospital financial reports.

</p>




<a href="<?= Yii::$app->urlManager->createUrl(['/billing']) ?>"

class="btn-modern red">


<i class="bi bi-cash-stack"></i>


Billing


</a>



</div>









<!-- AI MODULE -->

<div class="module-card">


<div class="module-icon">

🤖

</div>



<h3>

AI Risk Prediction

</h3>



<p>

Predict patient health risks using analytics and artificial intelligence.

</p>




<a href="<?= Yii::$app->urlManager->createUrl(['/ai-risk']) ?>"

class="btn-modern green">


<i class="bi bi-cpu-fill"></i>


AI Analytics


</a>



</div>









<!-- REPORT MODULE -->

<div class="module-card">


<div class="module-icon">

📊

</div>



<h3>

Analytics Reports

</h3>



<p>

Generate hospital performance reports and data insights.

</p>




<a href="<?= Yii::$app->urlManager->createUrl(['/report']) ?>"

class="btn-modern blue">


<i class="bi bi-bar-chart-fill"></i>


Reports


</a>



</div>





</div>








<style>


/* ===============================
MODULE GRID
================================ */


.module-grid{


display:grid;


grid-template-columns:

repeat(3,1fr);


gap:25px;


}







.module-card{


background:white;


padding:30px;


border-radius:28px;


box-shadow:

0 15px 35px rgba(0,0,0,.08);


border:

1px solid #e0f2f1;


transition:.3s;


}



.module-card:hover{


transform:translateY(-10px);


box-shadow:

0 25px 50px rgba(0,105,92,.18);


}






.module-icon{


width:80px;


height:80px;


border-radius:22px;


background:#e0f2f1;


display:flex;


align-items:center;


justify-content:center;


font-size:42px;


margin-bottom:20px;


}




.module-card h3{


font-size:22px;


font-weight:800;


color:#004d40;


}



.module-card p{


color:#607d8b;


line-height:1.6;


min-height:55px;


}






.btn-modern{


display:inline-flex;


align-items:center;


gap:8px;


padding:12px 22px;


border-radius:15px;


color:white;


text-decoration:none;


font-weight:700;


margin-top:15px;


transition:.3s;


}



.btn-modern:hover{


transform:translateY(-3px);


color:white;


}




.green{

background:#00897b;

}



.blue{

background:#1976d2;

}



.teal{

background:#009688;

}



.purple{

background:#7b1fa2;

}



.orange{

background:#fb8c00;

}



.red{

background:#e53935;

}






@media(max-width:1200px){


.module-grid{


grid-template-columns:repeat(2,1fr);


}


}



@media(max-width:700px){


.module-grid{


grid-template-columns:1fr;


}


}




</style>






</div>

<!-- END DASHBOARD WRAPPER -->