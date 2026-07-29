<?php

use yii\helpers\Html;
use yii\grid\GridView;

$this->title = "Laboratory Request Management";


$totalRequests = $dataProvider->getTotalCount();


$pending = \app\models\LabRequest::find()
->where(['status'=>'Pending'])
->count();


$completed = \app\models\LabRequest::find()
->where(['status'=>'Completed'])
->count();


$urgent = \app\models\LabRequest::find()
->where(['priority'=>'Urgent'])
->count();

?>


<style>


/* ======================================
   MHAS LABORATORY MANAGEMENT UI
====================================== */


body{

background:
radial-gradient(
circle at top,
#134e4a,
#020617 65%
)!important;

font-family:'Inter','Segoe UI',sans-serif;

}



/* MAIN */

.lab-page{

padding:25px;
color:white;

}



/* HEADER */

.lab-header{


background:

linear-gradient(
135deg,
#0f766e,
#064e3b
);


padding:35px;

border-radius:28px;


box-shadow:

0 25px 60px rgba(0,0,0,.5);


border:

1px solid rgba(255,255,255,.15);

}



.lab-header h1{

font-size:34px;

font-weight:950;

margin:0;

}



.lab-header p{

color:#ccfbf1;

font-weight:600;

margin-top:10px;

}



/* BUTTON */


.new-btn{

background:white;

color:#065f46!important;

padding:14px 25px;

border-radius:18px;

font-weight:900;

text-decoration:none;

box-shadow:

0 7px 0 #064e3b;

transition:.3s;

}



.new-btn:hover{

transform:translateY(-5px);

}





/* =================================
STAT CARDS HORIZONTAL
================================ */


.stats-container{


display:grid;

grid-template-columns:

repeat(4,1fr);


gap:20px;

margin-top:25px;

}



.stat-card{


background:

linear-gradient(
145deg,
#111827,
#1e293b
);


padding:25px;

border-radius:24px;


display:flex;

align-items:center;


gap:18px;


border:

1px solid rgba(255,255,255,.1);


box-shadow:

0 20px 45px rgba(0,0,0,.45);


transition:.3s;


}



.stat-card:hover{

transform:translateY(-8px);

}




.stat-icon{


width:65px;

height:65px;

border-radius:18px;

display:flex;

align-items:center;

justify-content:center;

font-size:30px;

background:

linear-gradient(
135deg,
#14b8a6,
#0f766e
);

}




.stat-number{

font-size:34px;

font-weight:950;

}



.stat-label{

font-size:13px;

font-weight:800;

color:#cbd5e1;

text-transform:uppercase;

}



/* TABLE */


.lab-table-card{


margin-top:30px;


background:

linear-gradient(
145deg,
#111827,
#0f172a
);


padding:25px;


border-radius:25px;


box-shadow:

0 20px 45px rgba(0,0,0,.45);


border:

1px solid rgba(255,255,255,.1);


}




.table-title{


font-size:22px;

font-weight:900;

margin-bottom:20px;


}



.lab-table{


color:white!important;

border-collapse:separate;

border-spacing:0 12px;

}



.lab-table thead th{


background:#065f46;

color:white;

padding:15px;

border:none;

font-size:12px;

text-transform:uppercase;

}



.lab-table tbody tr{


background:#1e293b;

transition:.3s;


}



.lab-table tbody tr:hover{


background:#334155;

transform:scale(1.01);


}



.lab-table td{


padding:16px;

border:none;

color:#e5e7eb;

font-weight:600;

}





/* STATUS */


.status-badge{


padding:8px 15px;

border-radius:50px;

font-size:12px;

font-weight:900;

}



.status-pending{


background:#78350f;

color:#fde68a;

}



.status-completed{


background:#14532d;

color:#bbf7d0;

}



.status-urgent{


background:#7f1d1d;

color:#fecaca;

}





/* ACTION */


.action-btn{


width:40px;

height:40px;

display:inline-flex;

align-items:center;

justify-content:center;

border-radius:12px;

color:white;

margin:3px;

}



.action-btn:hover{

color:white;

transform:translateY(-4px);

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



@media(max-width:1000px){

.stats-container{

grid-template-columns:1fr 1fr;

}

}



@media(max-width:600px){

.stats-container{

grid-template-columns:1fr;

}

}



</style>





<div class="lab-page">



<!-- HEADER -->

<div class="lab-header mb-4">


<div class="row align-items-center">


<div class="col-md-8">


<h1>

🧪 Laboratory Request Management

</h1>


<p>

Manage patient laboratory investigations, test requests and clinical workflow.

</p>


</div>



<div class="col-md-4 text-end">


<?= Html::a(

'➕ New Lab Request',

['create'],

[
'class'=>'new-btn'
]

) ?>


</div>



</div>

</div>







<!-- STATISTICS -->


<div class="stats-container">



<div class="stat-card">

<div class="stat-icon">

🧪

</div>


<div>

<div class="stat-number">

<?= $totalRequests ?>

</div>


<div class="stat-label">

Total Requests

</div>


</div>


</div>





<div class="stat-card">

<div class="stat-icon">

⏳

</div>


<div>

<div class="stat-number">

<?= $pending ?>

</div>


<div class="stat-label">

Pending

</div>


</div>


</div>






<div class="stat-card">

<div class="stat-icon">

✔

</div>


<div>

<div class="stat-number">

<?= $completed ?>

</div>


<div class="stat-label">

Completed

</div>


</div>


</div>






<div class="stat-card">

<div class="stat-icon">

🚨

</div>


<div>

<div class="stat-number">

<?= $urgent ?>

</div>


<div class="stat-label">

Urgent

</div>


</div>


</div>



</div>







<!-- TABLE -->


<div class="lab-table-card">


<h3 class="table-title">

🧪 Laboratory Requests Records

</h3>


<p class="text-secondary">

Patient laboratory investigations and clinical workflow tracking.

</p>






<?= GridView::widget([


'dataProvider'=>$dataProvider,


'tableOptions'=>[

'class'=>'table lab-table align-middle'

],



'columns'=>[



[

'class'=>'yii\grid\SerialColumn',

'header'=>'#'

],




[

'attribute'=>'patient_id',

'label'=>'Patient ID'

],




[

'attribute'=>'test_name',

'label'=>'Laboratory Test'

],





[

'attribute'=>'status',

'label'=>'Status',

'format'=>'raw',


'value'=>function($model){


$status=strtolower($model->status);


$class='status-'.$status;


return "

<span class='status-badge $class'>

✔ ".Html::encode($model->status)."

</span>

";


}

],






[

'attribute'=>'created_at',

'label'=>'Requested Date'

],






[

'class'=>'yii\grid\ActionColumn',


'template'=>'{view} {update} {delete}',


'buttons'=>[


'view'=>function($url){

return Html::a(
'👁',
$url,
[
'class'=>'action-btn view-btn'
]
);

},


'update'=>function($url){

return Html::a(
'✏',
$url,
[
'class'=>'action-btn edit-btn'
]
);

},


'delete'=>function($url){

return Html::a(
'🗑',
$url,
[
'class'=>'action-btn delete-btn',
'data-method'=>'post',
'data-confirm'=>'Delete this request?'
]
);

}


]


]


]


]); ?>



</div>


</div>