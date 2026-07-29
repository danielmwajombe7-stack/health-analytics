<?php

use yii\helpers\Html;
use yii\grid\GridView;

$this->title = "Doctor Clinical Dashboard";

?>

<style>

body{
    background:#f4f8fb;
}

.doctor-header{

    background:linear-gradient(135deg,#0f766e,#0ea5e9);
    color:white;
    padding:30px;
    border-radius:20px;
    margin-bottom:25px;
    box-shadow:0 10px 30px rgba(0,0,0,.1);

}


.stat-card{

    border:none;
    border-radius:18px;
    padding:25px;
    color:white;
    height:130px;
    box-shadow:0 8px 20px rgba(0,0,0,.08);
    transition:.3s;

}


.stat-card:hover{

    transform:translateY(-5px);

}



.stat-icon{

    font-size:35px;

}


.card-modern{

    border:none;
    border-radius:20px;
    box-shadow:0 8px 25px rgba(0,0,0,.06);
    background:white;
    padding:25px;

}


.queue-title{

    font-size:20px;
    font-weight:700;

}



.badge-waiting{

    background:#f59e0b;
    color:white;
    padding:6px 12px;
    border-radius:20px;

}


.badge-consulting{

    background:#2563eb;
    color:white;
    padding:6px 12px;
    border-radius:20px;

}


.badge-completed{

    background:#16a34a;
    color:white;
    padding:6px 12px;
    border-radius:20px;

}


.badge-high{

    background:#dc2626;
    color:white;
    padding:6px 12px;
    border-radius:20px;

}


.badge-normal{

    background:#10b981;
    color:white;
    padding:6px 12px;
    border-radius:20px;

}


</style>




<div class="container-fluid">


<!-- HEADER -->

<div class="doctor-header">


<h2>
🩺 Doctor Clinical Command Center
</h2>


<p class="mb-0">

Manage patient consultation, diagnosis and treatment workflow

</p>


</div>





<!-- STATISTICS -->


<div class="row g-4 mb-4">


<div class="col-md-3">

<div class="stat-card bg-primary">


<div class="stat-icon">
👥
</div>

<h3>
<?= $waitingPatients->totalCount ?? 0 ?>
</h3>

<p>
Waiting Patients
</p>


</div>

</div>





<div class="col-md-3">

<div class="stat-card bg-success">


<div class="stat-icon">
🩺
</div>


<h3>
Today
</h3>

<p>
Consultations
</p>


</div>

</div>






<div class="col-md-3">

<div class="stat-card bg-warning">


<div class="stat-icon">
🧪
</div>


<h3>
Lab
</h3>


<p>
Pending Requests
</p>


</div>

</div>







<div class="col-md-3">

<div class="stat-card bg-danger">


<div class="stat-icon">
🚨
</div>


<h3>
Emergency
</h3>


<p>
Critical Patients
</p>


</div>

</div>



</div>






<!-- QUEUE -->


<div class="card-modern">


<div class="d-flex justify-content-between align-items-center mb-3">


<h4 class="queue-title">

🎫 Patients Waiting For Doctor

</h4>


<button class="btn btn-primary">

+ Register Patient

</button>


</div>






<?= GridView::widget([


'dataProvider'=>$waitingPatients,


'tableOptions'=>[

'class'=>'table table-hover align-middle'

],



'columns'=>[



[

'class'=>'yii\grid\SerialColumn'

],





[

'attribute'=>'queue_number',

'label'=>'Queue No'

],





[

'label'=>'Patient Name',

'value'=>function($model){


if($model->patient){

return $model->patient->first_name .
" ".
$model->patient->last_name;

}


return "(Not Assigned)";


}

],





[

'label'=>'Gender',

'value'=>function($model){


return $model->patient->gender ?? '-';


}

],





[

'label'=>'Age',

'value'=>function($model){


return $model->patient->age ?? '-';


}

],





'department',





[

'label'=>'Priority',

'value'=>function($model){


if($model->priority=="High"){

return '<span class="badge-high">
High
</span>';

}


return '<span class="badge-normal">
Normal
</span>';


},


'format'=>'raw'


],





[

'label'=>'Status',

'value'=>function($model){


$status=$model->status;


$class='badge-waiting';



if($status=="Consulting"){

$class='badge-consulting';

}


elseif($status=="Completed"){

$class='badge-completed';

}



return "<span class='$class'>$status</span>";


},


'format'=>'raw'


],





[

'label'=>'Action',


'format'=>'raw',


'value'=>function($model){


return Html::a(

'📝 Open Patient',

['patient','id'=>$model->id],

[

'class'=>'btn btn-success btn-sm rounded-pill'

]


);


}


]





]


]);


?>



</div>





</div>