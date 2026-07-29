<?php

use yii\helpers\Html;
use yii\grid\GridView;


$this->title = "Prescription Management";


$totalPrescription = $dataProvider->getTotalCount();


$activePrescription = \app\models\Prescription::find()
->where(['status'=>'Active'])
->count();


$completedPrescription = \app\models\Prescription::find()
->where(['status'=>'Completed'])
->count();


$pendingPrescription = \app\models\Prescription::find()
->where(['status'=>'Pending'])
->count();


?>



<style>


/* =====================================================
   MHAS SMART HOSPITAL
   PRESCRIPTION MANAGEMENT UI
===================================================== */


body{

    background:
    radial-gradient(
        circle at top,
        #134e4a,
        #020617 55%
    )!important;


    font-family:
    'Inter',
    'Segoe UI',
    sans-serif;

}



/* ===============================
MAIN CONTAINER
================================ */


.prescription-page{


    padding:25px;


    color:white;


}



/* ===============================
HEADER
================================ */


.prescription-header{


    background:

    linear-gradient(
        135deg,
        rgba(15,118,110,.95),
        rgba(6,78,59,.95)
    );


    border-radius:28px;


    padding:35px;


    box-shadow:

    0 25px 60px rgba(0,0,0,.45);


    border:

    1px solid rgba(255,255,255,.15);


}



.page-title{


    font-size:34px;

    font-weight:950;

    color:white;

    margin:0;


}



.page-description{


    color:#ccfbf1;

    font-size:15px;

    margin-top:8px;

}



/* ===============================
CREATE BUTTON
================================ */


.btn-create{


    background:white;


    color:#065f46!important;


    padding:

    14px 28px;


    border-radius:18px;


    font-weight:900;


    text-decoration:none;


    box-shadow:


    0 8px 0 #064e3b,


    0 20px 35px rgba(0,0,0,.35);


    transition:.3s;


}



.btn-create:hover{


    transform:

    translateY(-5px);


}





/* ===============================
STAT CARDS
================================ */



.stat-card{


    background:

    linear-gradient(
        145deg,
        #111827,
        #1e293b
    );


    border-radius:24px;


    padding:25px;


    display:flex;


    align-items:center;


    gap:20px;


    border:

    1px solid rgba(255,255,255,.08);


    box-shadow:

    0 20px 45px rgba(0,0,0,.45);


    transition:.35s;


}



.stat-card:hover{


    transform:

    translateY(-8px);


}




.stat-icon{


    width:70px;

    height:70px;


    border-radius:20px;


    display:flex;


    justify-content:center;


    align-items:center;


    font-size:32px;


    color:white;


}




.icon-total{


background:

linear-gradient(
135deg,
#0284c7,
#0369a1
);


}



.icon-active{


background:

linear-gradient(
135deg,
#14b8a6,
#0f766e
);


}



.icon-completed{


background:

linear-gradient(
135deg,
#22c55e,
#15803d
);


}



.icon-pending{


background:

linear-gradient(
135deg,
#f59e0b,
#d97706
);


}



.stat-number{


font-size:38px;


font-weight:950;


color:white;


}



.stat-label{


color:#cbd5e1;


font-size:13px;


font-weight:900;


text-transform:uppercase;


}





/* ===============================
TOOLBAR
================================ */


.prescription-toolbar{


background:

linear-gradient(
145deg,
#111827,
#0f172a
);


padding:25px;


border-radius:25px;


border:

1px solid rgba(255,255,255,.08);


box-shadow:

0 20px 45px rgba(0,0,0,.45);


}



.search-box{


height:52px;


background:#020617!important;


border:

1px solid #334155!important;


color:white!important;


border-radius:50px!important;


padding-left:25px;


}



.search-box::placeholder{


color:#94a3b8;


}





.filter-btn{


padding:

10px 22px;


border-radius:50px;


border:none;


background:#1e293b;


color:#cbd5e1;


font-weight:800;


margin:3px;


transition:.3s;


}



.filter-btn:hover,
.filter-btn.active{


background:

linear-gradient(
135deg,
#14b8a6,
#0f766e
);


color:white;


}





.refresh-btn{


width:45px;


height:45px;


border-radius:50%;


background:#1e293b;


color:white;


border:none;


}



.refresh-btn:hover{


background:#0f766e;


}




</style>





<div class="prescription-page">



<!-- HEADER -->


<div class="prescription-header mb-4">


<div class="row align-items-center">


<div class="col-md-8">


<h1 class="page-title">


💊 Prescription Management


</h1>


<p class="page-description">

Manage patient medications, doctors prescriptions and pharmacy workflow.

</p>


</div>



<div class="col-md-4 text-end">



<?= Html::a(

'➕ Create Prescription',

['create'],

[

'class'=>'btn-create'

]

) ?>


</div>



</div>


</div>






<!-- STATISTICS -->


<div class="row g-4 mb-4">



<div class="col-xl-3 col-md-6">


<div class="stat-card">


<div class="stat-icon icon-total">

📋

</div>


<div>


<div class="stat-number">

<?= $totalPrescription ?>

</div>


<div class="stat-label">

Total Prescriptions

</div>


</div>


</div>


</div>






<div class="col-xl-3 col-md-6">


<div class="stat-card">


<div class="stat-icon icon-active">

✔

</div>


<div>


<div class="stat-number">

<?= $activePrescription ?>

</div>


<div class="stat-label">

Active

</div>


</div>


</div>


</div>






<div class="col-xl-3 col-md-6">


<div class="stat-card">


<div class="stat-icon icon-completed">

💉

</div>


<div>


<div class="stat-number">

<?= $completedPrescription ?>

</div>


<div class="stat-label">

Completed

</div>


</div>


</div>


</div>






<div class="col-xl-3 col-md-6">


<div class="stat-card">


<div class="stat-icon icon-pending">

⏳

</div>


<div>


<div class="stat-number">

<?= $pendingPrescription ?>

</div>


<div class="stat-label">

Pending

</div>


</div>


</div>


</div>



</div>






<!-- TOOLBAR -->

<div class="prescription-toolbar mb-4">


<div class="row align-items-center">


<div class="col-lg-5">


<input

id="prescriptionSearch"

class="form-control search-box"

placeholder="🔍 Search patient, doctor, medicine..."

>


</div>



<div class="col-lg-5 text-center">


<button class="filter-btn active" data-status="all">
All
</button>


<button class="filter-btn" data-status="Active">
Active
</button>


<button class="filter-btn" data-status="Completed">
Completed
</button>


<button class="filter-btn" data-status="Pending">
Pending
</button>


<button class="filter-btn" data-status="Cancelled">
Cancelled
</button>


</div>



<div class="col-lg-2 text-end">


<button class="refresh-btn">

⟳

</button>


<button class="refresh-btn" onclick="window.print()">

🖨

</button>


</div>


</div>


</div>
<!-- =====================================================
     PRESCRIPTION TABLE
===================================================== -->


<div class="prescription-table-card">


<div class="table-header">


<h3>

💊 Prescription Records

</h3>


<p>

Patient medication history and pharmacy management workflow.

</p>


</div>





<?= GridView::widget([


'dataProvider'=>$dataProvider,


'summary'=>'

<div class="table-summary">

Showing <b>{begin}-{end}</b> of 
<b>{totalCount}</b> prescriptions

</div>

',



'tableOptions'=>[

'class'=>'table prescription-table'

],



'columns'=>[



[

'class'=>'yii\grid\SerialColumn',

'header'=>'#'

],






/* ======================================
PATIENT
====================================== */


[


'label'=>'Patient',


'format'=>'raw',



'value'=>function($model){



$name="Unknown Patient";


if(
$model->visit &&
$model->visit->patient
){


$name=$model->visit->patient->fullName;


}



$initials="PT";


$words=explode(" ",$name);



if(count($words)>=2){


$initials=strtoupper(

substr($words[0],0,1).

substr($words[1],0,1)

);


}




return '


<div class="patient-card">


<div class="patient-avatar">

'.Html::encode($initials).'

</div>



<div>


<div class="patient-name">

'.Html::encode($name).'

</div>



<div class="patient-id">

🆔 Patient ID:

PT-'.

str_pad(
$model->visit_id,
5,
"0",
STR_PAD_LEFT
).'


</div>



</div>


</div>



';


}



],







/* ======================================
DOCTOR
====================================== */


[


'label'=>'Doctor',


'format'=>'raw',



'value'=>function($model){



if($model->doctor){



return '


<div class="doctor-card">


<div class="doctor-avatar">

👨‍⚕️

</div>



<div>


<div class="doctor-name">

'

.Html::encode(
$model->doctor->username
).

'

</div>


<div class="doctor-role">

Doctor

</div>


</div>


</div>


';



}




return '

<span class="not-assigned">

⚠ Not Assigned

</span>


';



}


],







/* ======================================
MEDICINE
====================================== */


[


'label'=>'Medicine',


'format'=>'raw',



'value'=>function($model){



return '


<div class="medicine-card">


<div class="medicine-icon">

💊

</div>



<div>


<div class="medicine-name">

'

.Html::encode(
$model->drug_name
).

'

</div>



<div class="medicine-label">

Medication

</div>


</div>



</div>


';



}



],







/* ======================================
DOSAGE
====================================== */


[


'label'=>'Dosage',


'format'=>'raw',



'value'=>function($model){


return '

<span class="dosage-pill">

'

.Html::encode(
$model->dosage
).

'

</span>

';



}



],







/* ======================================
FREQUENCY
====================================== */


[


'label'=>'Frequency',


'format'=>'raw',



'value'=>function($model){


return '


<span class="frequency-pill">

⏱

'

.Html::encode(
$model->frequency
).

'

</span>


';



}



],







/* ======================================
DURATION
====================================== */


[


'label'=>'Duration',


'format'=>'raw',



'value'=>function($model){



return '

<span class="duration-pill">

'

.Html::encode(
$model->duration
).

' Days

</span>

';


}



],







/* ======================================
STATUS
====================================== */


[


'label'=>'Status',


'format'=>'raw',



'value'=>function($model){



$status=$model->status ?: "Pending";



$class=strtolower(
str_replace(
" ",
"-",
$status
)
);



return '


<span class="status-pill status-'.$class.'">


<span class="status-dot"></span>


'

.Html::encode($status).

'


</span>


';



}



],







/* ======================================
ACTION
====================================== */


[


'class'=>'yii\grid\ActionColumn',


'header'=>'Actions',


'template'=>'{view} {update} {delete}',



'buttons'=>[



'view'=>function($url){


return Html::a(

'👁',

$url,

[

'class'=>'action-view',

'title'=>'View Prescription'

]

);


},




'update'=>function($url){


return Html::a(

'✏',

$url,

[

'class'=>'action-edit',

'title'=>'Edit Prescription'

]

);


},




'delete'=>function($url){


return Html::a(

'🗑',

$url,

[

'class'=>'action-delete',

'data-method'=>'post',

'data-confirm'=>'Delete this prescription?'

]

);


}


]


]





]



]); ?>



</div>


</div>
<style>


/* =====================================================
   PRESCRIPTION TABLE DESIGN
===================================================== */


.prescription-table-card{


    background:

    linear-gradient(
        145deg,
        #111827,
        #0f172a
    );


    border-radius:28px;


    padding:30px;


    box-shadow:

    0 25px 60px rgba(0,0,0,.45);


    border:

    1px solid rgba(255,255,255,.08);

}



.table-header h3{


    color:white;

    font-size:26px;

    font-weight:950;

}



.table-header p{


    color:#94a3b8;

}





.table-summary{


    background:#1e293b;

    color:#cbd5e1;

    padding:12px 18px;

    border-radius:15px;

    margin-bottom:15px;

}




/* TABLE */


.prescription-table{


    width:100%;

    border-collapse:separate;

    border-spacing:0 15px;


}




.prescription-table thead th{


    background:#064e3b!important;


    color:white!important;


    padding:16px!important;


    border:none!important;


    font-size:12px;


    text-transform:uppercase;


    font-weight:900;


}




.prescription-table tbody tr{


    background:#1e293b;


    box-shadow:

    0 10px 25px rgba(0,0,0,.35);


    transition:.3s;


}



.prescription-table tbody tr:hover{


    transform:translateY(-5px);


    background:#334155;


}




.prescription-table td{


    padding:18px!important;


    color:#e2e8f0;


    border:none!important;


    vertical-align:middle;


}




/* ===============================
PATIENT
================================ */


.patient-card{


display:flex;

align-items:center;

gap:15px;


}



.patient-avatar{


width:55px;

height:55px;

border-radius:50%;


display:flex;

justify-content:center;

align-items:center;


background:

linear-gradient(
135deg,
#14b8a6,
#0f766e
);


color:white;

font-weight:950;

font-size:18px;


}



.patient-name{


color:white;

font-weight:900;

}



.patient-id{


font-size:12px;

color:#94a3b8;


}




/* ===============================
DOCTOR
================================ */


.doctor-card{


display:flex;

align-items:center;

gap:12px;


}



.doctor-avatar{


width:50px;

height:50px;

border-radius:50%;


display:flex;

align-items:center;

justify-content:center;


background:

linear-gradient(
135deg,
#2563eb,
#1d4ed8
);


font-size:25px;


}



.doctor-name{


color:white;

font-weight:900;


}



.doctor-role{


color:#94a3b8;

font-size:12px;


}




/* ===============================
MEDICINE
================================ */


.medicine-card{


display:flex;

align-items:center;

gap:12px;


}



.medicine-icon{


font-size:30px;


}



.medicine-name{


color:#5eead4;

font-weight:950;


}



.medicine-label{


font-size:12px;

color:#94a3b8;


}






/* ===============================
PILLS
================================ */



.dosage-pill,
.frequency-pill,
.duration-pill{


padding:8px 15px;


border-radius:50px;


font-weight:900;


display:inline-flex;


align-items:center;


}



.dosage-pill{


background:#4c1d95;

color:#ddd6fe;


}



.frequency-pill{


background:#075985;

color:#bae6fd;


}



.duration-pill{


background:#78350f;

color:#fde68a;


}





/* ===============================
STATUS
================================ */


.status-pill{


padding:10px 18px;


border-radius:50px;


font-size:12px;


font-weight:900;


display:inline-flex;


align-items:center;


gap:8px;


}



.status-dot{


width:8px;

height:8px;

border-radius:50%;


}



.status-active{


background:#064e3b;

color:#6ee7b7;


}


.status-active .status-dot{


background:#22c55e;


}



.status-completed{


background:#14532d;

color:#bbf7d0;


}



.status-completed .status-dot{


background:#22c55e;


}




.status-pending{


background:#78350f;

color:#fde68a;


}


.status-pending .status-dot{


background:#f59e0b;


}




.status-cancelled{


background:#7f1d1d;

color:#fecaca;


}


.status-cancelled .status-dot{


background:#ef4444;


}






/* ===============================
ACTION BUTTONS
================================ */


.action-view,
.action-edit,
.action-delete{


width:42px;

height:42px;


display:inline-flex;


align-items:center;

justify-content:center;


border-radius:14px;


margin:3px;


color:white;


text-decoration:none;


font-size:18px;


transition:.3s;


}




.action-view{


background:#0284c7;


}




.action-edit{


background:#f59e0b;


}



.action-delete{


background:#dc2626;


}




.action-view:hover,
.action-edit:hover,
.action-delete:hover{


transform:

translateY(-5px)

scale(1.1);


color:white;


}







@media(max-width:768px){


.prescription-table-card{


overflow-x:auto;


}



.prescription-table{


font-size:12px;


}



}




</style>
