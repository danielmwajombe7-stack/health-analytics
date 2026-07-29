<?php

use yii\helpers\Html;
use yii\grid\GridView;


$this->title = "Laboratory Results";

?>


<style>

body{

background:
linear-gradient(
135deg,
#ecfeff,
#f8fafc
)!important;

font-family:'Inter','Segoe UI',sans-serif;

}


.lab-page{

padding:25px;

}



/* HEADER */

.lab-header{

background:
linear-gradient(
135deg,
#0f766e,
#115e59
);

padding:35px;

border-radius:28px;

color:white;

box-shadow:
0 20px 45px rgba(0,0,0,.18);

display:flex;

justify-content:space-between;

align-items:center;

}



.lab-header h1{

font-size:34px;

font-weight:900;

margin:0;

}



.lab-header p{

color:#ccfbf1;

margin-top:10px;

}



.new-btn{

background:white;

color:#0f766e!important;

padding:14px 25px;

border-radius:18px;

font-weight:900;

text-decoration:none;

}



/* CARD */


.result-card{

margin-top:30px;

background:white;

padding:25px;

border-radius:25px;

box-shadow:
0 15px 40px rgba(0,0,0,.08);

}




.result-table{

border-collapse:separate;

border-spacing:0 12px;

}



.result-table thead th{

background:#ecfdf5;

color:#065f46;

padding:16px;

border:none;

font-size:13px;

text-transform:uppercase;

}



.result-table tbody tr{

background:white;

box-shadow:
0 5px 20px rgba(0,0,0,.08);

}



.result-table td{

padding:18px;

border:none;

vertical-align:middle;

}




/* PATIENT */


.patient-box{

display:flex;

align-items:center;

gap:12px;

}



.patient-avatar{

width:45px;

height:45px;

border-radius:50%;


background:
linear-gradient(
135deg,
#14b8a6,
#0f766e
);


color:white;

display:flex;

align-items:center;

justify-content:center;

font-weight:900;

}



/* STATUS */


.status{

padding:8px 18px;

border-radius:30px;

font-weight:800;

font-size:12px;

}



.status-completed{

background:#dcfce7;

color:#166534;

}


.status-pending{

background:#fef3c7;

color:#92400e;

}



.status-processing{

background:#dbeafe;

color:#1e40af;

}



.status-abnormal{

background:#fee2e2;

color:#991b1b;

}




.test-box{

font-weight:800;

color:#0f766e;

}




.finding{

font-size:13px;

color:#64748b;

max-width:250px;

}




/* PAGINATION */


.pagination{

display:flex;

gap:15px;

margin-top:25px;

}


.pagination li{

list-style:none;

}



.pagination li a{

background:#0f766e;

color:white;

padding:10px 22px;

border-radius:15px;

font-weight:800;

text-decoration:none;

}



.pagination li.disabled a{

background:#cbd5e1;

color:#64748b;

}


</style>





<div class="lab-page">



<div class="lab-header">


<div>


<h1>

🧪 Laboratory Results Management

</h1>


<p>

Manage laboratory test results, reports and clinical workflow.

</p>


</div>




<?= Html::a(

'➕ New Result',

['create'],

[
'class'=>'new-btn'
]

) ?>



</div>







<div class="result-card">



<h3 class="fw-bold">

🧾 Laboratory Result Records

</h3>



<p class="text-muted">

Patient laboratory investigation history.

</p>






<?= GridView::widget([



'dataProvider'=>$dataProvider,



'summary'=>'

<div class="alert alert-light">

Showing <b>{begin}-{end}</b> of 

<b>{totalCount}</b> results.

</div>

',




'tableOptions'=>[

'class'=>'table result-table'

],





'pager'=>[

'prevPageLabel'=>'← Previous',

'nextPageLabel'=>'Next →',

'firstPageLabel'=>false,

'lastPageLabel'=>false,

'maxButtonCount'=>0,

],






'columns'=>[





[

'class'=>'yii\grid\SerialColumn',

'header'=>'#'

],








/*
PATIENT
*/


[


'label'=>'Patient',

'format'=>'raw',



'value'=>function($model){



$patient="Unknown Patient";

$id="N/A";




if(

$model->test &&

$model->test->patient

)

{


$p=$model->test->patient;



$patient = trim(

($p->first_name ?? '')

." ".

($p->last_name ?? '')

);




if(empty($patient))

{

$patient="Unknown Patient";

}



$id=$p->id;



}





$initial=strtoupper(

substr($patient,0,2)

);



return "

<div class='patient-box'>


<div class='patient-avatar'>

{$initial}

</div>


<div>


<b>

".Html::encode($patient)."

</b>


<br>


<small>

PT-".str_pad($id,5,'0',STR_PAD_LEFT)."

</small>


</div>


</div>

";


}

],










/*
TEST
*/


[


'label'=>'Laboratory Test',

'format'=>'raw',



'value'=>function($model){


return "

<div class='test-box'>

🧪 ".

Html::encode(

$model->testName

)

."

</div>

";


}

],







/*
RESULT
*/


[


'label'=>'Result',

'format'=>'raw',



'value'=>function($model){


return "

<strong>

".

Html::encode(

$model->result ?? 'Pending'

)

."

</strong>

";


}

],







/*
FINDINGS
*/


[


'label'=>'Findings',

'format'=>'raw',



'value'=>function($model){


return "

<div class='finding'>

".

Html::encode(

$model->findings ?? 'No findings recorded'

)

."

</div>

";


}

],







/*
STATUS
*/


[


'label'=>'Status',

'format'=>'raw',



'value'=>function($model){



$status=$model->status ?? 'Pending';



$class=strtolower(

str_replace(

' ',

'-',

$status

)

);



return "

<span class='status status-{$class}'>

● ".

Html::encode($status).

"

</span>

";


}

],







/*
DATE
*/


[


'label'=>'Date',



'value'=>function($model){



if($model->created_at)

{

return date(

'd M Y',

strtotime($model->created_at)

);

}



return "N/A";


}

],







[

'class'=>'yii\grid\ActionColumn',

'template'=>'{view} {update}',

],





]

]); ?>




</div>


</div>