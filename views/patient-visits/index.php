<?php

use yii\helpers\Html;
use yii\grid\GridView;


$this->title = "Patient Visits Management";


/*
=====================================================
MHAS LIVE STATISTICS
=====================================================
*/


$totalVisits = $dataProvider->getTotalCount();


$waitingVisits = \app\models\PatientVisit::find()
    ->where(['status'=>'Waiting'])
    ->count();


$completedVisits = \app\models\PatientVisit::find()
    ->where(['status'=>'Completed'])
    ->count();


$criticalCases = \app\models\PatientVisit::find()
    ->where(['status'=>'Critical'])
    ->count();


?>


<style>

/*
=====================================================
MHAS PATIENT VISITS DESIGN
=====================================================
*/


.patient-page{

    background:#f4f8f7;

    min-height:100vh;

    padding:20px;

    font-family:'Segoe UI',sans-serif;

}



/*
==============================
HEADER
==============================
*/


.mhas-header{


background:
linear-gradient(
135deg,
#00695c,
#14b8a6
);


padding:35px;

border-radius:25px;

color:white;

box-shadow:
0 15px 35px rgba(0,0,0,.12);

}



.mhas-header h1{

font-weight:900;

font-size:32px;

}



.mhas-header p{

opacity:.9;

}



/*
==============================
CREATE BUTTON
==============================
*/


.create-btn{


background:white;

color:#00695c;

padding:14px 25px;

border-radius:15px;

font-weight:800;

text-decoration:none;

}



.create-btn:hover{

background:#ecfdf5;

}



/*
==============================
STATUS
==============================
*/


.system-status{


background:
rgba(255,255,255,.2);

padding:10px 18px;

border-radius:50px;

display:inline-flex;

gap:10px;

align-items:center;

font-weight:700;


}



.status-dot{


width:10px;

height:10px;

background:#22c55e;

border-radius:50%;


}



/*
==============================
STATISTICS
==============================
*/


.visit-stats{


display:grid;

grid-template-columns:
repeat(4,1fr);

gap:20px;

margin:30px 0;


}



.stat-card{


background:white;

padding:25px;

border-radius:22px;

display:flex;

align-items:center;

gap:20px;

box-shadow:

0 10px 30px rgba(0,0,0,.07);


}



.stat-icon{


width:65px;

height:65px;

border-radius:20px;

display:flex;

align-items:center;

justify-content:center;

font-size:28px;


}



.total{

background:#dbeafe;

color:#2563eb;

}


.waiting{

background:#fef3c7;

color:#d97706;

}


.completed{

background:#dcfce7;

color:#16a34a;

}


.critical{

background:#fee2e2;

color:#dc2626;

}



.stat-number{


font-size:32px;

font-weight:900;

color:#0f172a;


}



.stat-title{


font-size:13px;

font-weight:700;

color:#64748b;

}



/*
==============================
TOOLBAR
==============================
*/


.visit-toolbar{


background:white;

padding:25px;

border-radius:22px;

box-shadow:

0 10px 25px rgba(0,0,0,.06);


}



.search-input{


height:50px;

border-radius:30px;

padding-left:25px;


}



.filter-btn{


border:none;

padding:10px 20px;

border-radius:30px;

background:#f1f5f9;

font-weight:700;

margin:5px;


}



.filter-btn.active,
.filter-btn:hover{


background:#0f766e;

color:white;


}



@media(max-width:1000px){


.visit-stats{

grid-template-columns:
repeat(2,1fr);

}


}



@media(max-width:600px){


.visit-stats{

grid-template-columns:
1fr;

}


}



</style>



<div class="container-fluid patient-page">



<!-- HEADER -->

<div class="mhas-header mb-4">


<div class="row align-items-center">


<div class="col-md-8">


<h1>

<i class="fa fa-stethoscope"></i>

Patient Visits Management

</h1>


<p>

Monitor consultations, outpatient visits,
doctor assignments and clinical workflow.

</p>


<br>


<div class="system-status">

<span class="status-dot"></span>

MHAS Clinical System Online

</div>



</div>



<div class="col-md-4 text-end">


<?= Html::a(

'<i class="fa fa-plus-circle"></i>
 Create New Visit',

['create'],

[
'class'=>'create-btn'
]

) ?>


</div>


</div>


</div>





<!-- STATISTICS -->


<div class="visit-stats">



<div class="stat-card">

<div class="stat-icon total">

<i class="fa fa-calendar"></i>

</div>


<div>

<div class="stat-number">

<?= $totalVisits ?>

</div>


<div class="stat-title">

TOTAL VISITS

</div>

</div>


</div>





<div class="stat-card">

<div class="stat-icon waiting">

<i class="fa fa-clock-o"></i>

</div>


<div>

<div class="stat-number">

<?= $waitingVisits ?>

</div>


<div class="stat-title">

WAITING QUEUE

</div>


</div>


</div>






<div class="stat-card">

<div class="stat-icon completed">

<i class="fa fa-check"></i>

</div>


<div>

<div class="stat-number">

<?= $completedVisits ?>

</div>


<div class="stat-title">

COMPLETED

</div>


</div>


</div>






<div class="stat-card">

<div class="stat-icon critical">

<i class="fa fa-heartbeat"></i>

</div>


<div>

<div class="stat-number">

<?= $criticalCases ?>

</div>


<div class="stat-title">

CRITICAL CASES

</div>


</div>


</div>



</div>




<!-- SEARCH TOOLBAR -->


<div class="visit-toolbar mb-4">


<div class="row align-items-center">


<div class="col-md-5">


<input

id="visitSearch"

class="form-control search-input"

placeholder="Search patient, doctor, status..."

>


</div>



<div class="col-md-5 text-center">


<button class="filter-btn active">

All Visits

</button>


<button class="filter-btn">

Waiting

</button>


<button class="filter-btn">

Completed

</button>


<button class="filter-btn">

Critical

</button>


</div>



<div class="col-md-2 text-end">


<button class="btn btn-success rounded-circle">

<i class="fa fa-refresh"></i>

</button>


</div>


</div>


</div>
<!-- =====================================================
     CLINICAL VISIT RECORDS
===================================================== -->


<div class="card border-0 shadow-sm rounded-4">


<div class="card-body p-4">



<div class="d-flex justify-content-between align-items-center mb-4">


<div>


<h4 class="fw-bold">

<i class="fa fa-list text-success"></i>

Clinical Visit Records

</h4>


<p class="text-muted">

Complete patient consultation history and clinical workflow.

</p>


</div>



<div>


<span class="badge bg-success p-2">


<i class="fa fa-database"></i>

Live Database


</span>


</div>



</div>



</div>

</div>

<?= GridView::widget([

'dataProvider'=>$dataProvider,



'layout'=>"

{summary}

{items}

{pager}

",



'summary'=>'

<div class="visit-summary">

Showing <b>{begin}-{end}</b>

of

<b>{totalCount}</b>

patient visits

</div>

',





'tableOptions'=>[

'class'=>'table visit-table align-middle'

],






/*
=====================================================
MODERN PAGINATION
=====================================================
*/


'pager'=>[


'class'=>yii\widgets\LinkPager::class,


'maxButtonCount'=>5,



'prevPageLabel'=>'

<span class="pagination-icon">

<i class="fa fa-angle-left"></i>

</span>

',



'nextPageLabel'=>'

<span class="pagination-icon">

<i class="fa fa-angle-right"></i>

</span>

',



'firstPageLabel'=>false,


'lastPageLabel'=>false,



'disabledPageCssClass'=>'disabled',


'options'=>[

'class'=>'pagination justify-content-center'

]


],






'columns'=>[




/*
=====================================================
NUMBER
=====================================================
*/


[

'class'=>'yii\grid\SerialColumn',

'header'=>'#'

],






/*
=====================================================
PATIENT
=====================================================
*/


[


'label'=>'Patient',


'format'=>'raw',



'value'=>function($model){



$name =
$model->patient

?

$model->patient->fullName

:

'Unknown Patient';



$initials =
strtoupper(
substr($name,0,2)
);




return '

<div class="patient-profile">


<div class="patient-avatar">

'.$initials.'

</div>



<div>


<div class="patient-name">

'.$name.'

</div>



<div class="patient-id">

MRN : PT-'

.str_pad(

$model->patient_id,

5,

"0",

STR_PAD_LEFT

).

'

</div>


</div>


</div>


';



}


],








/*
=====================================================
VISIT DATE
=====================================================
*/


[


'label'=>'Visit Date',


'format'=>'raw',



'value'=>function($model){



return '

<div class="visit-date">


<strong>

<i class="fa fa-calendar text-success"></i>

'

.Yii::$app->formatter->asDate(

$model->visit_date,

"php:d M Y"

).

'


</strong>



<br>



<small>

<i class="fa fa-clock-o"></i>


'

.Yii::$app->formatter->asTime(

$model->visit_date,

"php:H:i"

).

'


</small>


</div>


';



}


],








/*
=====================================================
DOCTOR
=====================================================
*/


[


'label'=>'Doctor',


'format'=>'raw',



'value'=>function($model){



if($model->doctor){



return '

<div class="doctor-profile">


<div class="doctor-avatar">


<i class="fa fa-user-md"></i>


</div>



<div>


<strong>

'

.$model->doctor->username.

'


</strong>



<br>



<small>

Assigned Doctor

</small>



</div>


</div>


';



}



return '

<span class="text-muted">

<i class="fa fa-user-times"></i>

Not Assigned

</span>


';


}


],







/*
=====================================================
STATUS
=====================================================
*/


[


'label'=>'Visit Status',


'format'=>'raw',



'value'=>function($model){



$status=strtolower(
$model->status
);



$class='default-status';

$icon='fa-circle';



if(str_contains($status,'waiting')){


$class='waiting-status';

$icon='fa-clock-o';


}


elseif(str_contains($status,'completed')){


$class='completed-status';

$icon='fa-check-circle';


}


elseif(str_contains($status,'critical')){


$class='critical-status';

$icon='fa-heartbeat';


}


elseif(str_contains($status,'progress')){


$class='progress-status';

$icon='fa-spinner';


}



return '

<span class="status-badge '.$class.'">


<i class="fa '.$icon.'"></i>


'.$model->status.'


</span>


';



}


],







/*
=====================================================
ACTIONS
=====================================================
*/


[


'class'=>'yii\grid\ActionColumn',


'header'=>'Actions',


'template'=>'{view} {update} {delete}',



'contentOptions'=>[

'style'=>'white-space:nowrap;text-align:center'

],




'buttons'=>[




'view'=>function($url){


return Html::a(

'<i class="fa fa-eye"></i>',

$url,

[

'class'=>'action-btn view-btn',

'title'=>'View'

]

);


},





'update'=>function($url){


return Html::a(

'<i class="fa fa-edit"></i>',

$url,

[

'class'=>'action-btn edit-btn',

'title'=>'Edit'

]

);


},





'delete'=>function($url){


return Html::a(

'<i class="fa fa-trash"></i>',

$url,

[

'class'=>'action-btn delete-btn',

'data-method'=>'post',

'data-confirm'=>'Delete this visit?'

]

);


}



]


]





]


]); ?>
<style>


/*
=====================================================
SUMMARY
=====================================================
*/

.visit-summary{

    background:#f0fdfa;

    padding:15px 20px;

    border-radius:15px;

    color:#475569;

    margin-bottom:20px;

    font-weight:600;

}



/*
=====================================================
TABLE DESIGN
=====================================================
*/


.visit-table{

    border-collapse:separate;

    border-spacing:0 15px;

}



.visit-table thead th{

    background:#e6fffa;

    color:#00695c;

    font-weight:800;

    padding:16px;

    border:none;

    font-size:13px;

}



.visit-table tbody tr{

    background:white;

    box-shadow:

    0 8px 25px rgba(0,0,0,.06);

    transition:.3s;

}



.visit-table tbody tr:hover{

    transform:translateY(-5px);

    box-shadow:

    0 15px 35px rgba(0,0,0,.12);

}



.visit-table td{

    padding:18px;

    border:none;

    vertical-align:middle;

}




/*
=====================================================
PATIENT AVATAR
=====================================================
*/


.patient-profile{

    display:flex;

    align-items:center;

    gap:15px;

}



.patient-avatar{

    width:55px;

    height:55px;

    border-radius:50%;

    background:

    linear-gradient(
    135deg,
    #0f766e,
    #2dd4bf
    );

    display:flex;

    justify-content:center;

    align-items:center;

    color:white;

    font-weight:900;

    font-size:18px;

}



.patient-name{

    font-weight:800;

    color:#1e293b;

}



.patient-id{

    color:#64748b;

    font-size:12px;

}





/*
=====================================================
DOCTOR
=====================================================
*/


.doctor-profile{

    display:flex;

    align-items:center;

    gap:12px;

}



.doctor-avatar{


    width:42px;

    height:42px;

    background:#2563eb;

    color:white;

    border-radius:50%;

    display:flex;

    justify-content:center;

    align-items:center;


}





/*
=====================================================
STATUS BADGES
=====================================================
*/


.status-badge{


    display:inline-flex;

    align-items:center;

    gap:8px;

    padding:9px 18px;

    border-radius:50px;

    font-weight:800;

    font-size:13px;


}



.waiting-status{


    background:#fef3c7;

    color:#b45309;


}




.completed-status{


    background:#dcfce7;

    color:#15803d;


}



.critical-status{


    background:#fee2e2;

    color:#b91c1c;


}



.progress-status{


    background:#dbeafe;

    color:#1d4ed8;


}



.default-status{


    background:#f1f5f9;

    color:#475569;


}




/*
=====================================================
ACTION BUTTONS
=====================================================
*/


.action-btn{


    width:38px;

    height:38px;

    display:inline-flex;

    align-items:center;

    justify-content:center;

    border-radius:12px;

    color:white;

    margin:3px;

    text-decoration:none;

    transition:.3s;


}



.action-btn:hover{


    transform:translateY(-4px);

    color:white;


}



.view-btn{


    background:#0284c7;


}



.edit-btn{


    background:#f59e0b;


}



.delete-btn{


    background:#dc2626;


}




/*
=====================================================
MODERN PAGINATION
=====================================================
*/


.pagination{


    display:flex;

    justify-content:center;

    gap:8px;

    margin-top:30px;


}



.pagination li{

    list-style:none;

}



.pagination li a,
.pagination li span{


    width:42px;

    height:42px;


    display:flex;

    align-items:center;

    justify-content:center;


    border-radius:14px;


    background:white;


    border:1px solid #d1fae5;


    color:#0f766e;


    font-weight:800;


    text-decoration:none;


    transition:.3s;


}



.pagination li a:hover{


    background:#0f766e;

    color:white;

    transform:translateY(-3px);


}



.pagination .active span{


    background:#0f766e;

    color:white;

    border-color:#0f766e;


}



.pagination .disabled span{


    background:#f1f5f9;

    color:#94a3b8;


}





/*
=====================================================
MOBILE RESPONSIVE
=====================================================
*/


@media(max-width:768px){



.patient-profile{


    flex-direction:column;

    align-items:flex-start;


}



.visit-table{


    font-size:13px;


}



.action-btn{


    width:32px;

    height:32px;


}



.pagination li a,
.pagination li span{


    width:35px;

    height:35px;


}



}




</style>





<script>


document.addEventListener(
"DOMContentLoaded",
function(){



/*
=====================================================
LIVE SEARCH
=====================================================
*/


let search =
document.getElementById(
"visitSearch"
);



if(search){


search.addEventListener(
"keyup",
function(){



let value =
this.value.toLowerCase();



document
.querySelectorAll(
".visit-table tbody tr"
)
.forEach(function(row){



let text =
row.innerText.toLowerCase();



row.style.display =

text.includes(value)

?

""

:

"none";



});


});


}




/*
=====================================================
FILTER STATUS
=====================================================
*/


document
.querySelectorAll(".filter-btn")
.forEach(function(button){


button.addEventListener(
"click",
function(){



document
.querySelectorAll(".filter-btn")
.forEach(function(btn){

btn.classList.remove("active");

});



this.classList.add("active");



let filter =
this.innerText
.toLowerCase()
.trim();



document
.querySelectorAll(
".visit-table tbody tr"
)
.forEach(function(row){



let rowText =
row.innerText
.toLowerCase();



if(filter === "all visits"){

    row.style.display="";

}

else if(rowText.includes(filter)){


    row.style.display="";


}

else{


    row.style.display="none";


}



});


});


});




/*
=====================================================
REFRESH BUTTON
=====================================================
*/


document
.querySelector(".btn-success")
?.addEventListener(
"click",
function(){


location.reload();


});



});

</script>