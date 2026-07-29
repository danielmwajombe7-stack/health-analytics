<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;


$this->title = "Medical Records | Doctor Dashboard";


?>

<style>


.records-page{

    padding:30px;
    background:#f4f8fb;
    min-height:100vh;

}



.page-header{

    display:flex;
    justify-content:space-between;
    align-items:center;
    margin-bottom:30px;

}



.page-header h1{

    color:#004d40;
    font-size:30px;

}



.page-header p{

    color:#607d8b;

}




.stats{

    display:grid;

    grid-template-columns:repeat(auto-fit,minmax(220px,1fr));

    gap:20px;

    margin-bottom:30px;

}




.stat-card{

    background:white;

    padding:25px;

    border-radius:25px;

    box-shadow:0 10px 30px rgba(0,0,0,.08);

}



.stat-card h2{

    color:#00695c;

    font-size:35px;

}



.stat-card span{

    color:#78909c;

}





.records-card{

    background:white;

    border-radius:25px;

    padding:25px;

    box-shadow:0 10px 30px rgba(0,0,0,.08);

}





.btn-create{


background:linear-gradient(
135deg,
#00bfa5,
#00897b
);


color:white;

padding:12px 20px;

border-radius:15px;

text-decoration:none;

font-weight:bold;


}




.table-container{

margin-top:25px;

overflow:auto;

}




table{

width:100%;

border-collapse:collapse;

}



th{

background:#00695c;

color:white;

padding:15px;

text-align:left;

}



td{

padding:15px;

border-bottom:1px solid #eee;

}



.badge{

padding:7px 15px;

border-radius:20px;

font-size:13px;

font-weight:bold;

}




.completed{

background:#e8f5e9;

color:#2e7d32;

}



.pending{

background:#fff8e1;

color:#ef6c00;

}





.action-btn{

padding:9px 15px;

border-radius:12px;

text-decoration:none;

margin-right:5px;

font-size:13px;

}



.view{

background:#e3f2fd;

color:#1565c0;

}



.lab{

background:#ede7f6;

color:#6a1b9a;

}



.prescription{

background:#e8f5e9;

color:#2e7d32;

}




</style>









<div class="records-page">






<div class="page-header">


<div>


<h1>

🩺 Doctor Medical Records

</h1>


<p>

Manage patient consultations, diagnosis, laboratory and treatment history

</p>


</div>





<?= Html::a(

'➕ New Consultation',

['create'],

[

'class'=>'btn-create'

]

) ?>



</div>









<div class="stats">



<div class="stat-card">

<h2>

<?= $dataProvider->getTotalCount(); ?>

</h2>

<span>

Total Medical Records

</span>

</div>





<div class="stat-card">

<h2>

🧪

</h2>

<span>

Laboratory Requests

</span>

</div>





<div class="stat-card">

<h2>

💊

</h2>

<span>

Prescriptions

</span>

</div>





<div class="stat-card">

<h2>

🏥

</h2>

<span>

Patient History

</span>

</div>



</div>











<div class="records-card">



<h2>

📋 Consultation Records

</h2>






<div class="table-container">


<?= GridView::widget([


'dataProvider'=>$dataProvider,


'tableOptions'=>[

'class'=>'table'

],



'columns'=>[




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
'Unknown';

}

],






[

'label'=>'Diagnosis',

'value'=>function($model){

return $model->diagnosis ?: 'Not Added';

}

],







[

'label'=>'Date',

'value'=>function($model){

return date(

'Y-m-d',

strtotime($model->created_at)

);

}

],







[

'label'=>'Status',

'format'=>'raw',

'value'=>function($model){


$status=$model->status ?? 'Completed';



$class =
$status=="Completed"
?
"completed"
:
"pending";



return "<span class='badge $class'>

$status

</span>";

}


],







[

'label'=>'Actions',

'format'=>'raw',


'value'=>function($model){


return

Html::a(

'👁 View',

[

'view',

'id'=>$model->id

],

[

'class'=>'action-btn view'

]

)

.

Html::a(

'🧪 Lab',

[

'send-lab',

'id'=>$model->id

],

[

'class'=>'action-btn lab'

]

)

.

Html::a(

'💊 Prescription',

[

'prescription',

'id'=>$model->id

],

[

'class'=>'action-btn prescription'

]

);



}


]







]


]); ?>


</div>





</div>







</div>