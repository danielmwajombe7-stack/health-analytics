<?php

use yii\helpers\Html;
use yii\helpers\Url;


$this->title = "Pharmacy Intelligence Center";


$total = $total ?? 0;
$pending = $waiting ?? 0;
$dispensed = $dispensed ?? 0;
$lowStock = $lowStockCount ?? 0;
$cancelled = $cancelled ?? 0;
$expiredMedicine = $expiredMedicine ?? 0;
$todayPrescription = $todayPrescription ?? 0;

?>


<div class="pharmacy-dashboard">


<!-- HERO SECTION -->

<div class="pharmacy-hero">


<div class="hero-content">


<div class="system-badge">

<i class="bi bi-shield-check"></i>
SMART PHARMACY SYSTEM

</div>



<h1>

<i class="bi bi-capsule-pill"></i>

Pharmacy Intelligence Center

</h1>



<p>

AI-powered medication management,
smart inventory analytics and
automated dispensing workflow.

</p>



<div class="ai-status">

<span></span>

AI Monitoring Active

</div>



</div>





<div class="hero-buttons">


<?= Html::a(

'<i class="bi bi-file-medical"></i>
Prescription Center',

['prescriptions'],

[
'class'=>'modern-btn primary'
]

) ?>




<?= Html::a(

'<i class="bi bi-box-seam"></i>
Inventory',

['inventory'],

[
'class'=>'modern-btn glass'
]

) ?>


</div>


</div>







<!-- KPI CARDS -->


<div class="row g-4 mt-4">



<div class="col-xl-3 col-md-6">


<div class="stat-card teal-card">


<div class="stat-icon">

<i class="bi bi-file-medical"></i>

</div>



<div>

<small>
Total Prescriptions
</small>


<h2>

<?= $total ?>

</h2>


<p>
All pharmacy records
</p>


</div>


</div>


</div>






<div class="col-xl-3 col-md-6">


<div class="stat-card orange-card">


<div class="stat-icon">

<i class="bi bi-hourglass-split"></i>

</div>



<div>

<small>
Pending Dispensing
</small>


<h2>

<?= $pending ?>

</h2>


<p>
Waiting pharmacist action
</p>


</div>


</div>


</div>








<div class="col-xl-3 col-md-6">


<div class="stat-card green-card">


<div class="stat-icon">

<i class="bi bi-check-circle"></i>

</div>



<div>

<small>
Dispensed Today
</small>


<h2>

<?= $dispensed ?>

</h2>


<p>
Completed orders
</p>


</div>


</div>


</div>







<div class="col-xl-3 col-md-6">


<div class="stat-card red-card">


<div class="stat-icon">

<i class="bi bi-exclamation-triangle"></i>

</div>



<div>

<small>
Stock Alerts
</small>


<h2>

<?= $lowStock ?>

</h2>


<p>
Medicine attention
</p>


</div>


</div>


</div>



</div>








<!-- MODULE SECTION -->


<div class="section-title">

<h3>

<i class="bi bi-grid"></i>

Pharmacy Operations

</h3>


<p>
Access intelligent pharmacy modules
</p>

</div>






<div class="row g-4">



<div class="col-lg-4">


<a href="<?=Url::to(['prescriptions'])?>"

class="module-box">


<div class="module-icon">

<i class="bi bi-file-medical"></i>

</div>



<h4>
Prescription Management
</h4>



<p>
Manage patient medication orders,
doctor prescriptions and dispensing.
</p>



<span>

Open Module →

</span>


</a>


</div>







<div class="col-lg-4">


<a href="<?=Url::to(['inventory'])?>"

class="module-box">


<div class="module-icon">

<i class="bi bi-box-seam"></i>

</div>



<h4>
Medicine Inventory
</h4>



<p>
Monitor stock quantity,
expiry dates and availability.
</p>



<span>

Open Module →

</span>


</a>


</div>







<div class="col-lg-4">


<div class="module-box ai-box">


<div class="module-icon">

<i class="bi bi-robot"></i>

</div>



<h4>
AI Pharmacy Assistant
</h4>



<p>
Predict medicine shortage,
usage patterns and stock risks.
</p>



<span class="active">

● AI Active

</span>


</div>


</div>




</div>
<style>

/* ===============================
   PHARMACY PREMIUM DASHBOARD
================================ */

.pharmacy-dashboard{

    padding:30px;

    min-height:100vh;

    background:
    radial-gradient(circle at top left,#134e4a,#022c22 45%,#020617);

    font-family:
    'Inter',
    'Poppins',
    sans-serif;

    color:#e2e8f0;

}


/* ===============================
 HERO SECTION
================================ */

.pharmacy-hero{


    background:
    linear-gradient(
    135deg,
    rgba(20,184,166,.95),
    rgba(15,118,110,.85)
    );


    padding:45px;


    border-radius:35px;


    display:flex;


    justify-content:space-between;


    align-items:center;


    gap:30px;


    color:white;


    box-shadow:

    0 25px 60px rgba(0,0,0,.35);


    position:relative;


    overflow:hidden;


}



.pharmacy-hero::before{


content:"";


position:absolute;


width:400px;


height:400px;


background:
rgba(255,255,255,.12);


border-radius:50%;


right:-120px;


top:-120px;


}





.hero-content{


position:relative;


z-index:2;


}



.system-badge{


display:inline-flex;


align-items:center;


gap:8px;


background:
rgba(255,255,255,.18);


padding:8px 18px;


border-radius:30px;


font-size:12px;


font-weight:700;


letter-spacing:1px;


margin-bottom:20px;


}




.pharmacy-hero h1{


font-size:38px;


font-weight:900;


margin-bottom:15px;


}



.pharmacy-hero p{


max-width:600px;


font-size:16px;


opacity:.9;


line-height:1.7;


}




.ai-status{


margin-top:20px;


display:flex;


align-items:center;


gap:10px;


font-weight:600;


}



.ai-status span{


width:12px;


height:12px;


background:#22c55e;


border-radius:50%;


box-shadow:
0 0 15px #22c55e;


}



/* ===============================
 BUTTONS
================================ */



.hero-buttons{


display:flex;


gap:15px;


position:relative;


z-index:2;


}



.modern-btn{


padding:15px 28px;


border-radius:18px;


font-weight:700;


text-decoration:none;


display:flex;


align-items:center;


gap:10px;


transition:.3s;


}



.modern-btn.primary{


background:white;


color:#0f766e;


}



.modern-btn.glass{


background:
rgba(255,255,255,.15);


border:
1px solid rgba(255,255,255,.4);


color:white;


backdrop-filter:blur(15px);


}



.modern-btn:hover{


transform:translateY(-5px);


box-shadow:

0 15px 30px rgba(0,0,0,.25);


}





/* ===============================
 KPI CARDS
================================ */



.stat-card{


padding:28px;


border-radius:28px;


display:flex;


align-items:center;


gap:20px;


background:

rgba(255,255,255,.08);


border:

1px solid rgba(255,255,255,.12);


backdrop-filter:

blur(20px);


box-shadow:

0 20px 40px rgba(0,0,0,.25);


transition:.35s;


}



.stat-card:hover{


transform:
translateY(-8px);


}




.stat-icon{


width:70px;


height:70px;


border-radius:22px;


display:flex;


align-items:center;


justify-content:center;


font-size:32px;


background:
rgba(255,255,255,.15);


}




.stat-card small{


color:#cbd5e1;


font-size:14px;


}




.stat-card h2{


font-size:38px;


font-weight:900;


margin:5px 0;


color:white;


}



.stat-card p{


margin:0;


font-size:13px;


color:#94a3b8;


}





.teal-card .stat-icon{

color:#5eead4;

}



.orange-card .stat-icon{

color:#fbbf24;

}



.green-card .stat-icon{

color:#4ade80;

}



.red-card .stat-icon{

color:#f87171;

}







/* ===============================
 SECTION TITLE
================================ */


.section-title{


margin-top:50px;


margin-bottom:25px;


}



.section-title h3{


font-size:26px;


font-weight:800;


color:white;


}



.section-title p{


color:#94a3b8;


}






/* ===============================
 MODULE CARDS
================================ */



.module-box{


display:block;


height:100%;


padding:35px;


border-radius:30px;


text-decoration:none;


color:white;


background:


linear-gradient(

145deg,

rgba(255,255,255,.12),

rgba(255,255,255,.04)

);


border:

1px solid rgba(255,255,255,.15);



backdrop-filter:

blur(20px);



transition:.35s;



box-shadow:

0 20px 40px rgba(0,0,0,.25);



}




.module-box:hover{


transform:

translateY(-10px);


border-color:#14b8a6;


}




.module-icon{


width:80px;


height:80px;


border-radius:25px;


background:

rgba(20,184,166,.2);


display:flex;


align-items:center;


justify-content:center;


font-size:40px;


color:#5eead4;


margin-bottom:25px;


}




.module-box h4{


font-size:22px;


font-weight:800;


}



.module-box p{


color:#cbd5e1;


line-height:1.6;


}



.module-box span{


color:#5eead4;


font-weight:800;


}



.module-box .active{


color:#22c55e;


}




/* ===============================
 RESPONSIVE
================================ */


@media(max-width:992px){


.pharmacy-hero{


flex-direction:column;


align-items:flex-start;


}



.hero-buttons{


width:100%;


flex-direction:column;


}



.modern-btn{


justify-content:center;


}



}




@media(max-width:576px){


.pharmacy-dashboard{


padding:15px;


}



.pharmacy-hero{


padding:25px;


}



.pharmacy-hero h1{


font-size:28px;


}



.stat-card{


padding:20px;


}



}


</style>