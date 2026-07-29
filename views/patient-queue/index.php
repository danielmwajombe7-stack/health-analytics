<?php

use yii\helpers\Html;
use yii\grid\GridView;


$this->title="Patient Queue Command Center";


$total=$dataProvider->totalCount;


$waiting=\app\models\PatientQueue::find()
->where(['status'=>'Waiting'])
->count();


$consulting=\app\models\PatientQueue::find()
->where(['status'=>'Consulting'])
->count();


$completed=\app\models\PatientQueue::find()
->where(['status'=>'Completed'])
->count();

?>


<style>

.queue-wrapper{

padding:35px;
background:#f4f8fb;
min-height:100vh;
font-family:'Segoe UI',sans-serif;

}



.header-box{

display:flex;
justify-content:space-between;
align-items:center;
margin-bottom:35px;

}



.header-box h1{

font-size:32px;
font-weight:900;
color:#004d40;

}



.header-box p{

color:#64748b;

}



.live-status{

background:#dcfce7;
color:#166534;
padding:12px 22px;
border-radius:30px;
font-weight:bold;

}




.add-btn{

background:linear-gradient(
135deg,
#009688,
#00695c
);

padding:14px 25px;
border-radius:15px;
color:white!important;
font-weight:bold;
text-decoration:none;

}




.stats{

display:grid;
grid-template-columns:repeat(4,1fr);
gap:25px;
margin-bottom:35px;

}



.stat-card{

background:white;
padding:25px;
border-radius:25px;
box-shadow:0 15px 35px rgba(0,0,0,.08);

}



.stat-card h2{

font-size:36px;
color:#004d40;

}



.icon{

font-size:35px;

}




.panel{

background:white;
padding:30px;
border-radius:30px;
box-shadow:0 15px 40px rgba(0,0,0,.08);

}



.panel h2{

color:#004d40;

}




.table{

margin-top:20px;

}



.table thead{

background:#00695c;
color:white;

}



.table th{

padding:16px!important;

}



.table td{

padding:15px!important;

vertical-align:middle;

}




.badge{

padding:8px 16px;
border-radius:30px;
font-weight:bold;

}



.queue{

background:#e0f2fe;
color:#0369a1;

}



.wait{

background:#fef3c7;
color:#92400e;

}



.consult{

background:#cffafe;
color:#155e75;

}



.done{

background:#dcfce7;
color:#166534;

}




.view{

background:#eceff1;
padding:10px 18px;
border-radius:12px;
text-decoration:none;
font-weight:bold;
color:#263238;

}



@media(max-width:1000px){

.stats{

grid-template-columns:1fr 1fr;

}

}



</style>



<div class="queue-wrapper">



<div class="header-box">


<div>

<h1>
🎫 Patient Queue Command Center
</h1>

<p>
Real-time OPD patient movement monitoring
</p>

</div>



<div>

<div class="live-status">

🟢 System Live

</div>


<br>


<?=Html::a(
'➕ Add Patient',
['create'],
[
'class'=>'add-btn'
]
)?>


</div>


</div>







<div class="stats">


<div class="stat-card">

<div class="icon">
👥
</div>

<h2>
<?=$total?>
</h2>

<p>
Total Patients
</p>

</div>



<div class="stat-card">

<div class="icon">
⏳
</div>

<h2>
<?=$waiting?>
</h2>

<p>
Waiting
</p>

</div>




<div class="stat-card">

<div class="icon">
🩺
</div>

<h2>
<?=$consulting?>
</h2>

<p>
Consulting
</p>

</div>




<div class="stat-card">

<div class="icon">
✅
</div>

<h2>
<?=$completed?>
</h2>

<p>
Completed
</p>

</div>


</div>








<div class="panel">


<h2>
🏥 Live Patient Flow
</h2>






<?=GridView::widget([


'dataProvider'=>$dataProvider,


'tableOptions'=>[
'class'=>'table table-hover'
],


'columns'=>[



[
'class'=>'yii\grid\SerialColumn'
],




[
'label'=>'Queue No',

'format'=>'raw',

'value'=>function($model){

return Html::tag(

'span',

$model->queue_number,

[
'class'=>'badge queue'
]

);

}

],





[
'label'=>'Patient',

'value'=>function($model){

return $model->patient

?

$model->patient->fullName

:

'Unknown';

}

],





[
'label'=>'Doctor',

'value'=>function($model){

return $model->doctor

?

$model->doctor->full_name

:

'Not Assigned';

}

],





[
'label'=>'Status',

'format'=>'raw',

'value'=>function($model){


$status=strtolower($model->status);



if($status=="waiting"){

return '<span class="badge wait">
⏳ Waiting
</span>';

}



if($status=="consulting"){

return '<span class="badge consult">
🩺 Consulting
</span>';

}



if($status=="completed"){

return '<span class="badge done">
✔ Completed
</span>';

}



return $model->status;


}

],





[
'label'=>'Actions',

'format'=>'raw',

'value'=>function($model){


return Html::a(

'👁 View',

[
'view',
'id'=>$model->id
],

[
'class'=>'view'
]

);


}

]



]



]); ?>





</div>


</div>