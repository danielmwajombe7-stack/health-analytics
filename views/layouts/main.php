<?php

use yii\helpers\Html;
use yii\helpers\Url;

$this->beginPage();

?>

<!DOCTYPE html>

<html lang="<?= Yii::$app->language ?>">

<head>

<meta charset="<?= Yii::$app->charset ?>">

<meta name="viewport" content="width=device-width, initial-scale=1">


<?= Html::csrfMetaTags() ?>


<title>
<?= Html::encode(
    $this->title ?? 'myles health analytics dashboard'
) ?>
</title>


<!-- ICONS -->
<link 
href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css"
rel="stylesheet">


<!-- FONT -->
<link 
href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap"
rel="stylesheet">


<?php

$this->registerCssFile(
'https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css'
);

$this->head();

?>


<style>


/* ==============================
GLOBAL DESIGN
============================== */


*{

margin:0;
padding:0;
box-sizing:border-box;
font-family:'Inter',sans-serif;

}



body{

background:#f1f5f9;
color:#1e293b;
overflow-x:hidden;

}



/* ==============================
SIDEBAR
============================== */


.sidebar{


position:fixed;

top:0;
left:0;

width:285px;

height:100vh;

background:

linear-gradient(
180deg,
#064e3b,
#022c22
);


padding:25px 18px;

color:white;

overflow-y:auto;

z-index:1000;


box-shadow:

15px 0 40px rgba(0,0,0,.18);


}



.sidebar::-webkit-scrollbar{

width:5px;

}



.sidebar::-webkit-scrollbar-thumb{

background:#14b8a6;

border-radius:20px;

}





/* BRAND */


.brand{

display:flex;

align-items:center;

gap:15px;

margin-bottom:28px;


}



.brand-logo{


width:65px;

height:65px;


background:white;


border-radius:22px;


display:flex;

justify-content:center;

align-items:center;


font-size:34px;


box-shadow:

0 15px 35px rgba(0,0,0,.25);


}



.brand-text h2{


font-size:20px;

font-weight:900;

line-height:1.1;


}



.brand-text span{


display:block;

margin-top:5px;

font-size:11px;

font-weight:700;

letter-spacing:1.5px;

color:#5eead4;


}





/* USER CARD */


.user-profile{


background:

rgba(255,255,255,.08);


border:

1px solid rgba(255,255,255,.15);


border-radius:22px;


padding:18px;


margin-bottom:25px;


backdrop-filter:blur(15px);


}



.user-avatar{


width:55px;

height:55px;


border-radius:50%;


background:white;


color:#047857;


display:flex;


justify-content:center;

align-items:center;


font-size:26px;


margin-bottom:10px;


}



.user-name{


font-size:16px;

font-weight:800;


}



.user-role{


margin-top:5px;


font-size:13px;

color:#99f6e4;


}





/* MENU */


.menu-section{


font-size:11px;


font-weight:800;


letter-spacing:1.5px;


color:#5eead4;


margin:

25px 10px 12px;


}




.menu a{


display:flex;


align-items:center;


gap:14px;


padding:13px 15px;


margin-bottom:7px;


border-radius:15px;


text-decoration:none;


color:#ecfeff;


font-size:14px;


font-weight:600;


transition:.3s;


}



.menu a:hover{


background:

rgba(255,255,255,.12);


transform:translateX(6px);


}



.menu a.active{


background:white;


color:#047857;


box-shadow:

0 10px 25px rgba(0,0,0,.18);


}



.menu-icon{


width:28px;

font-size:20px;

}




.menu-badge{


margin-left:auto;


background:#ef4444;


padding:4px 10px;


border-radius:30px;


font-size:10px;


font-weight:900;


}





/* LOGOUT */


.logout-btn{


width:100%;


border:none;


background:transparent;


color:white;


display:flex;


align-items:center;


gap:14px;


padding:13px 15px;


border-radius:15px;


font-weight:700;


cursor:pointer;


}



.logout-btn:hover{


background:

rgba(255,255,255,.15);


}





/* ==============================
MAIN AREA
============================== */


.main{


margin-left:285px;


min-height:100vh;


background:#f8fafc;


padding-top:105px;


}




/* ==============================
ADVANCED TOPBAR
============================== */


.topbar{


position:fixed;


top:0;


right:0;


left:285px;


height:95px;


background:

rgba(255,255,255,.88);


backdrop-filter:

blur(18px);


border-bottom:

1px solid #e2e8f0;


display:flex;


align-items:center;


justify-content:space-between;


padding:0 30px;


z-index:900;


}





/* SYSTEM BRAND */


.system-title{


display:flex;


align-items:center;


gap:15px;


}



.hospital-logo{


width:55px;

height:55px;


border-radius:18px;


background:

linear-gradient(
135deg,
#10b981,
#0f766e
);


display:flex;


align-items:center;


justify-content:center;


color:white;


font-size:25px;


box-shadow:

0 10px 25px rgba(16,185,129,.35);


}



.system-text h2{


font-size:19px;


font-weight:900;


color:#0f172a;


}



.system-status{


margin-top:4px;


font-size:12px;


font-weight:600;


color:#64748b;


display:flex;


align-items:center;


gap:7px;


}



.system-status span{


width:8px;

height:8px;


border-radius:50%;


background:#22c55e;


box-shadow:

0 0 10px #22c55e;


}
/* ==============================
SEARCH BOX
============================== */


.search-area{


flex:1;


display:flex;


justify-content:center;


margin:0 35px;


}



.search-box{


width:100%;


max-width:420px;


height:48px;


background:#f8fafc;


border:1px solid #e2e8f0;


border-radius:16px;


display:flex;


align-items:center;


padding:0 15px;


gap:12px;


transition:.3s;


}



.search-box:focus-within{


border-color:#10b981;


box-shadow:

0 0 0 4px rgba(16,185,129,.12);


}



.search-box i{


font-size:18px;


color:#64748b;


}



.search-box input{


border:none;


outline:none;


background:none;


flex:1;


font-size:13px;


}



.search-box kbd{


background:#e2e8f0;


padding:5px 9px;


border-radius:8px;


font-size:11px;


font-weight:700;


color:#475569;


}



/* ==============================
TOP ACTIONS
============================== */


.top-actions{


display:flex;


align-items:center;


gap:15px;


}




.quick-btn{


width:42px;


height:42px;


border:none;


border-radius:14px;


background:#10b981;


color:white;


font-size:18px;


cursor:pointer;


box-shadow:

0 8px 20px rgba(16,185,129,.25);


transition:.3s;


}



.quick-btn:hover{


transform:translateY(-3px);


}




.date-card{


height:42px;


padding:0 15px;


display:flex;


align-items:center;


gap:8px;


background:#f8fafc;


border-radius:14px;


font-size:13px;


font-weight:700;


color:#334155;


}



.date-card i{


color:#059669;


}





.notification{


position:relative;


width:42px;


height:42px;


border-radius:14px;


background:#f8fafc;


display:flex;


align-items:center;


justify-content:center;


font-size:18px;


cursor:pointer;


}



.notification span{


position:absolute;


top:-5px;


right:-5px;


background:#ef4444;


color:white;


font-size:10px;


font-weight:800;


width:20px;


height:20px;


border-radius:50%;


display:flex;


align-items:center;


justify-content:center;


}





/* PROFILE */


.profile-card{


display:flex;


align-items:center;


gap:12px;


padding:8px 14px;


border-radius:18px;


background:white;


border:1px solid #e2e8f0;


cursor:pointer;


transition:.3s;


}



.profile-card:hover{


box-shadow:

0 10px 25px rgba(0,0,0,.08);


}



.profile-avatar{


width:42px;


height:42px;


border-radius:50%;


background:

linear-gradient(
135deg,
#10b981,
#047857
);


display:flex;


align-items:center;


justify-content:center;


color:white;


font-size:18px;


}



.profile-info{


display:flex;


flex-direction:column;


}



.profile-info strong{


font-size:13px;


font-weight:800;


}



.profile-info small{


font-size:11px;


color:#64748b;


}





/* ==============================
PAGE CONTENT
============================== */


.content{


padding:30px;


}



/* RESPONSIVE */


@media(max-width:1100px){


.sidebar{


width:80px;


}



.brand-text,
.user-profile,
.menu-section,
.menu a:not(.active) span:not(.menu-icon){


display:none;


}



.main{


margin-left:80px;


}



.topbar{


left:80px;


}



.system-text{


display:none;


}



.search-area{


margin:0 10px;


}


}




</style>


</head>


<body>


<?php $this->beginBody(); ?>


<?php if(!Yii::$app->user->isGuest): ?>


<?php

$user = Yii::$app->user->identity;

$role = "User";


if($user && $user->role)
{

    $role=$user->role->role_name;

}

?>



<!-- SIDEBAR -->

<div class="sidebar">


<div class="brand">

<div class="brand-logo">

🏥

</div>


<div class="brand-text">

<h2>
MYLES Health
</h2>

<h2>
Analytics System
</h2>


<span>
MHAS SMART HOSPITAL
</span>

</div>

</div>



<div class="user-profile">


<div class="user-avatar">

<i class="bi bi-person-fill"></i>

</div>


<div class="user-name">

<?= Html::encode(
$user->full_name ?? $user->username
) ?>

</div>


<div class="user-role">

<i class="bi bi-shield-check"></i>

<?= Html::encode($role) ?>

</div>


</div>



<div class="menu">


<div class="menu-section">
MAIN
</div>


<a href="<?=Url::to(['/dashboard/index'])?>">
<span class="menu-icon">
<i class="bi bi-grid-fill"></i>
</span>
Dashboard
</a>



<div class="menu-section">
PATIENT MANAGEMENT
</div>


<a href="<?=Url::to(['/patients/index'])?>">
<span class="menu-icon">
<i class="bi bi-people-fill"></i>
</span>
Patients
</a>


<a href="<?=Url::to(['/patients/create'])?>">
<span class="menu-icon">
<i class="bi bi-person-plus-fill"></i>
</span>
Register Patient
</a>


<a href="<?=Url::to(['/patient-visits/index'])?>">
<span class="menu-icon">
<i class="bi bi-calendar-check-fill"></i>
</span>
Patient Visits
</a>




<div class="menu-section">
CLINICAL SERVICES
</div>


<a href="<?=Url::to(['/nurse/index'])?>">

<span class="menu-icon">

<i class="bi bi-person-badge-fill"></i>

</span>

Nurse Dashboard

</a>




<a href="<?=Url::to(['/doctor/index'])?>">

<span class="menu-icon">

<i class="bi bi-heart-pulse-fill"></i>

</span>

Doctor Dashboard

</a>




<a href="<?=Url::to(['/patient-queue/index'])?>">

<span class="menu-icon">

<i class="bi bi-ticket-fill"></i>

</span>

Queue Management

</a>



<a href="<?=Url::to(['/medical-records/index'])?>">
<span class="menu-icon">
<i class="bi bi-file-medical-fill"></i>
</span>
Medical Records
</a>




<div class="menu-section">
LABORATORY
</div>



<a href="<?=Url::to(['/lab-request/index'])?>">
<span class="menu-icon">
<i class="bi bi-eyedropper"></i>
</span>
Lab Requests

<span class="menu-badge">
NEW
</span>

</a>



<a href="<?= Url::to(['lab-request/results']) ?>">
<span class="menu-icon">
<i class="bi bi-clipboard2-pulse-fill"></i>
</span>
 🧪 Lab Results
</a>



<div class="menu-section">
PHARMACY
</div>



<a href="<?=Url::to(['/pharmacy/index'])?>">
<span class="menu-icon">
<i class="bi bi-capsule"></i>
</span>
Pharmacy Dashboard
</a>



<a href="<?=Url::to(['/prescription/index'])?>">
<span class="menu-icon">
<i class="bi bi-prescription2"></i>
</span>
Prescriptions

<span class="menu-badge">
NEW
</span>

</a>



<div class="menu-section">
HOSPITAL OPERATIONS
</div>



<a href="<?=Url::to(['/appointment/index'])?>">
<span class="menu-icon">
<i class="bi bi-calendar-event-fill"></i>
</span>
Appointments
</a>



<a href="<?=Url::to(['/admission/index'])?>">
<span class="menu-icon">
<i class="bi bi-hospital-fill"></i>
</span>
Admissions
</a>



<a href="<?=Url::to(['/billing/index'])?>">
<span class="menu-icon">
<i class="bi bi-cash-stack"></i>
</span>
Billing
</a>




<div class="menu-section">
AI INTELLIGENCE
</div>



<a href="<?=Url::to(['/ai-risk/index'])?>">
<span class="menu-icon">
<i class="bi bi-cpu-fill"></i>
</span>
AI Risk Prediction
</a>



<a href="<?=Url::to(['/report/index'])?>">
<span class="menu-icon">
<i class="bi bi-bar-chart-fill"></i>
</span>
Analytics Reports
</a>





<div class="menu-section">
ACCOUNT
</div>



<?= Html::beginForm(
['/site/logout'],
'post'
) ?>


<button class="logout-btn">


<span class="menu-icon">

<i class="bi bi-box-arrow-right"></i>

</span>


Logout


</button>


<?= Html::endForm(); ?>


</div>


</div>






<!-- MAIN -->


<div class="main">



<div class="topbar">


<div class="system-title">


<div class="hospital-logo">

<i class="bi bi-hospital-fill"></i>

</div>



<div class="system-text">

<h2>
MYLES Health Analytics System
</h2>


<div class="system-status">

<span></span>

Smart Hospital Management Platform

</div>


</div>


</div>





<div class="search-area">

<div class="search-box">

<i class="bi bi-search"></i>


<input placeholder="Search patient, doctor, laboratory...">



</div>


</div>





<div class="top-actions">


<button class="quick-btn">

<i class="bi bi-plus-lg"></i>

</button>



<div class="date-card">

<i class="bi bi-calendar3"></i>

<?=date('d M Y')?>

</div>



<div class="notification">

<i class="bi bi-bell-fill"></i>

<span>
3
</span>

</div>




<div class="profile-card">


<div class="profile-avatar">

<i class="bi bi-person-fill"></i>

</div>


<div class="profile-info">


<strong>

<?=Html::encode(
$user->full_name ?? $user->username
)?>

</strong>


<small>

<?=Html::encode($role)?>

</small>


</div>


<i class="bi bi-chevron-down"></i>


</div>


</div>


</div>




<div class="content">

<?=$content?>

</div>



</div>



<?php else: ?>


<?=$content?>


<?php endif; ?>



<?php $this->endBody(); ?>


</body>

</html>


<?php $this->endPage(); ?>