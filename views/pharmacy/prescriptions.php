<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\Prescription;


$this->title = "Prescription Intelligence Center";

?>


<div class="prescription-page">



<!-- ================= HERO ================= -->

<div class="hero-card">


<div class="hero-content">


<div class="icon-box">

<i class="bi bi-capsule-pill"></i>

</div>



<div>


<h1>
Prescription Intelligence Center
</h1>


<p>
Smart medication workflow, pharmacy monitoring,
dispensing control and patient safety management.
</p>



<div class="hero-tags">


<span>
<i class="bi bi-shield-check"></i>
Safe Medication
</span>



<span>
<i class="bi bi-clock-history"></i>
Real-time Tracking
</span>



<span>
<i class="bi bi-activity"></i>
Smart Pharmacy
</span>



</div>


</div>


</div>





<?= Html::a(

'<i class="bi bi-plus-circle"></i> New Prescription',

['create'],

[
'class'=>'new-btn'
]

) ?>


</div>





<!-- ================= STATISTICS ================= -->


<div class="stats-grid">



<div class="stat-card total">

<div class="stat-icon">

<i class="bi bi-file-medical"></i>

</div>


<div>

<h2>
<?= $total ?>
</h2>

<p>
Total Prescriptions
</p>

</div>

</div>





<div class="stat-card waiting">


<div class="stat-icon">

<i class="bi bi-hourglass-split"></i>

</div>



<div>

<h2>
<?= $waiting ?>
</h2>


<p>
Waiting Pharmacy
</p>


</div>


</div>






<div class="stat-card success">


<div class="stat-icon">

<i class="bi bi-check-circle"></i>

</div>


<div>

<h2>
<?= $dispensed ?>
</h2>


<p>
Dispensed
</p>


</div>


</div>






<div class="stat-card danger">


<div class="stat-icon">

<i class="bi bi-x-circle"></i>

</div>



<div>

<h2>
<?= $cancelled ?>
</h2>


<p>
Cancelled
</p>


</div>


</div>




</div>







<!-- ================= SEARCH + FILTER ================= -->



<div class="control-panel">



<div class="search-area">


<i class="bi bi-search"></i>


<input 
type="text"
id="prescriptionSearch"
placeholder="Search patient, medicine..."
>


</div>





<div class="filters">



<?= Html::a(

'All',

['prescriptions'],

[

'class'=> $status==null 
? 
'filter-btn active'
:
'filter-btn'

]

) ?>





<?= Html::a(

'Pending',

[
'prescriptions',
'status'=>Prescription::STATUS_ACTIVE
],

[

'class'=> $status==Prescription::STATUS_ACTIVE
?
'filter-btn active'
:
'filter-btn'

]

) ?>






<?= Html::a(

'Dispensed',

[
'prescriptions',
'status'=>Prescription::STATUS_DISPENSED
],

[

'class'=> $status==Prescription::STATUS_DISPENSED
?
'filter-btn active'
:
'filter-btn'

]

) ?>







<?= Html::a(

'Cancelled',

[
'prescriptions',
'status'=>Prescription::STATUS_CANCELLED
],

[

'class'=> $status==Prescription::STATUS_CANCELLED
?
'filter-btn active'
:
'filter-btn'

]

) ?>





</div>



</div>








<!-- ================= TABLE ================= -->



<div class="table-card">



<div class="table-header">


<h2>

<i class="bi bi-prescription2"></i>

Medication Orders

</h2>



<span>

<?= $total ?> Records

</span>



</div>







<?= GridView::widget([



'dataProvider'=>$dataProvider,



'layout'=>"

<div class='summary'>
{summary}
</div>

<div class='table-responsive'>
{items}
</div>

<div class='pager'>
{pager}
</div>

",




'tableOptions'=>[

'class'=>'smart-table'

],





'columns'=>[





[
'class'=>'yii\grid\SerialColumn',

'header'=>'#'

],







[
'label'=>'Patient',

'format'=>'raw',

'value'=>function($model){


$name = 
$model->patient->full_name 
?? 
'Unknown';



$letter =
strtoupper(substr($name,0,1));



return "

<div class='patient-card'>


<div class='avatar'>

$letter

</div>



<div>

<strong>
".Html::encode($name)."
</strong>


<br>


<small>
PAT-".$model->patient_id."
</small>


</div>


</div>

";


}

],







[
'label'=>'Medicine',

'format'=>'raw',

'value'=>function($model){



$name =

$model->medicine->name

??

$model->drug_name

??

'Unknown';




return "

<div class='medicine-card'>


<div class='medicine-icon'>

<i class='bi bi-capsule'></i>

</div>



<div>

<strong>
".Html::encode($name)."
</strong>


<br>


<small>
MED-".$model->medicine_id."
</small>


</div>


</div>


";

}

],







[
'label'=>'Quantity',

'format'=>'raw',

'value'=>function($model){


return "

<span class='quantity'>

<i class='bi bi-box'></i>

".$model->quantity."

 Unit

</span>

";


}

],







[
'label'=>'Status',

'format'=>'raw',

'value'=>function($model){



if(
$model->status ==
Prescription::STATUS_DISPENSED
)

{


return "

<span class='badge success'>

<i class='bi bi-check-circle'></i>

Dispensed

</span>

";


}



if(
$model->status ==
Prescription::STATUS_CANCELLED
)

{


return "

<span class='badge danger'>

<i class='bi bi-x-circle'></i>

Cancelled

</span>

";


}




return "

<span class='badge waiting'>

<i class='bi bi-clock'></i>

Waiting Pharmacy

</span>

";


}

],







[
'label'=>'Created',

'value'=>function($model){


return Yii::$app->formatter
->asDatetime($model->created_at);


}

],







[
'class'=>'yii\grid\ActionColumn',

'header'=>'Actions',

'template'=>'{view} {dispense} {cancel} {update}',


'buttons'=>[





'view'=>function($url){


return Html::a(

'<i class="bi bi-eye"></i>',

$url,

[
'class'=>'action view',
'title'=>'View'
]

);


},







'dispense'=>function($url,$model){



if(
$model->status ==
Prescription::STATUS_DISPENSED
)

{


return Html::a(

'<i class="bi bi-check"></i>',

'#',

[

'class'=>'action done',

'title'=>'Already Dispensed'

]

);


}






return Html::a(

'<i class="bi bi-capsule"></i>',


[

'/pharmacy/dispense',

'id'=>$model->id

],


[

'class'=>'action dispense',

'title'=>'Dispense Medicine',


'data'=>[

'confirm'=>
'Dispense this medicine?'

]

]

);



},







'update'=>function($url){


return Html::a(

'<i class="bi bi-pencil"></i>',

$url,

[

'class'=>'action edit'

]

);


},


'cancel'=>function($url,$model){

    if($model->status != Prescription::STATUS_ACTIVE)
    {
        return '';
    }


    return Html::a(

        '<i class="bi bi-x-circle"></i>',

        [
            '/pharmacy/cancel',
            'id'=>$model->id
        ],

        [

            'class'=>'action cancel',

            'title'=>'Cancel Prescription',

            'data'=>[
                'confirm'=>'Cancel this prescription?'
            ]

        ]

    );

},

]


]




]



]);

?>



</div>


</div>
<style>


/* ================= GLOBAL ================= */


.prescription-page{

padding:35px;

background:
linear-gradient(
135deg,
#ecfeff,
#f0fdf4
);

min-height:100vh;

font-family:
'Inter',
'Segoe UI',
sans-serif;

}





/* ================= HERO ================= */


.hero-card{


background:
linear-gradient(
135deg,
#065f46,
#14b8a6
);


padding:45px;


border-radius:35px;


display:flex;


justify-content:space-between;


align-items:center;


color:white;


box-shadow:

0 25px 60px rgba(0,0,0,.18);


margin-bottom:35px;


}



.hero-content{


display:flex;

gap:25px;

align-items:center;


}



.icon-box{


width:90px;

height:90px;


border-radius:30px;


background:white;


color:#065f46;


display:flex;


align-items:center;


justify-content:center;


font-size:45px;


box-shadow:

0 15px 30px rgba(0,0,0,.15);


}



.hero-card h1{


font-size:40px;

font-weight:900;

margin:0 0 10px;


}



.hero-card p{


font-size:16px;

opacity:.95;


}





.hero-tags{


margin-top:20px;

display:flex;

gap:10px;

flex-wrap:wrap;


}



.hero-tags span{


background:
rgba(255,255,255,.18);


padding:9px 18px;


border-radius:30px;


font-size:13px;


backdrop-filter:blur(10px);


}





.new-btn{


background:white;


color:#065f46;


padding:18px 30px;


border-radius:22px;


font-weight:900;


text-decoration:none;


transition:.3s;


}



.new-btn:hover{


transform:translateY(-5px);


box-shadow:

0 15px 30px rgba(0,0,0,.2);


}





/* ================= STATISTICS ================= */


.stats-grid{


display:grid;


grid-template-columns:
repeat(4,1fr);


gap:25px;


margin-bottom:35px;


}



.stat-card{


background:white;


padding:25px;


border-radius:28px;


display:flex;


gap:20px;


align-items:center;


box-shadow:

0 15px 40px rgba(0,0,0,.08);


transition:.3s;


border-left:6px solid transparent;


}



.stat-card:hover{


transform:translateY(-8px);


}




.stat-icon{


font-size:40px;

color:#065f46;


}



.stat-card h2{


font-size:38px;

margin:0;

font-weight:900;


}



.stat-card p{


margin:5px 0 0;

color:#64748b;


}




.stat-card.total{

border-color:#0284c7;

}



.stat-card.waiting{

border-color:#eab308;

}



.stat-card.success{

border-color:#22c55e;

}



.stat-card.danger{

border-color:#ef4444;

}





/* ================= FILTER PANEL ================= */



.control-panel{


background:white;


padding:25px;


border-radius:30px;


display:flex;


justify-content:space-between;


align-items:center;


gap:20px;


margin-bottom:35px;


box-shadow:

0 15px 35px rgba(0,0,0,.07);


}





.search-area{


flex:1;


background:#f8fafc;


padding:15px 20px;


border-radius:20px;


display:flex;


align-items:center;


gap:15px;


}



.search-area i{


color:#14b8a6;


font-size:20px;


}



.search-area input{


border:0;


outline:none;


background:none;


width:100%;


font-size:15px;


}






.filters{


display:flex;

gap:10px;

}



.filter-btn{


padding:12px 22px;


border-radius:25px;


background:#f1f5f9;


color:#334155;


font-weight:700;


text-decoration:none;


transition:.3s;


}



.filter-btn:hover,
.filter-btn.active{


background:#065f46;


color:white;


}






/* ================= TABLE ================= */



.table-card{


background:white;


padding:30px;


border-radius:35px;


box-shadow:

0 20px 50px rgba(0,0,0,.1);


}




.table-header{


display:flex;


justify-content:space-between;


align-items:center;


margin-bottom:25px;


}



.table-header h2{


font-weight:900;


color:#064e3b;


}



.table-header span{


background:#dcfce7;


color:#166534;


padding:10px 20px;


border-radius:25px;


font-weight:bold;


}







.smart-table{


width:100%;


border-collapse:separate;


border-spacing:0 15px;


}



.smart-table thead th{


background:#f8fafc;


padding:15px;


border:none;


color:#475569;


}



.smart-table tbody tr{


background:white;


box-shadow:

0 10px 25px rgba(0,0,0,.06);


transition:.3s;


}



.smart-table tbody tr:hover{


transform:translateY(-5px);


}



.smart-table td{


padding:20px;


border:none;


}








/* ================= PATIENT ================= */


.patient-card,
.medicine-card{


display:flex;

align-items:center;

gap:15px;


}




.avatar{


width:55px;


height:55px;


border-radius:50%;


background:

linear-gradient(
135deg,
#14b8a6,
#065f46
);


color:white;


display:flex;


align-items:center;


justify-content:center;


font-weight:900;


font-size:22px;


}





.medicine-icon{


width:45px;


height:45px;


border-radius:15px;


background:#ccfbf1;


display:flex;


align-items:center;


justify-content:center;


color:#065f46;


}






/* ================= BADGES ================= */


.quantity{


background:#dbeafe;


color:#1d4ed8;


padding:10px 18px;


border-radius:25px;


font-weight:800;


}



.badge{


padding:10px 18px;


border-radius:25px;


font-weight:800;


display:inline-flex;


gap:7px;


align-items:center;


}




.badge.success{


background:#dcfce7;


color:#15803d;


}




.badge.waiting{


background:#fef3c7;


color:#92400e;


}



.badge.danger{


background:#fee2e2;


color:#b91c1c;


}







/* ================= ACTION BUTTONS ================= */



.action{


width:42px;


height:42px;


border-radius:14px;


display:inline-flex;


align-items:center;


justify-content:center;


color:white;


margin:3px;


transition:.3s;


}



.action:hover{


transform:scale(1.1);


}




.view{


background:#0284c7;


}




.dispense{


background:#16a34a;


}




.done{


background:#15803d;


}



.edit{


background:#f59e0b;


}


.cancel{
background:#dc2626;
}




/* ================= RESPONSIVE ================= */



@media(max-width:1000px){


.stats-grid{


grid-template-columns:1fr 1fr;


}



.hero-card,
.control-panel{


flex-direction:column;


align-items:stretch;


}


}



@media(max-width:600px){


.stats-grid{


grid-template-columns:1fr;


}



.prescription-page{


padding:15px;


}


}






</style>





<script>


// LIVE SEARCH TABLE


document
.getElementById("prescriptionSearch")
.addEventListener("keyup",function(){


let value=this.value.toLowerCase();


document
.querySelectorAll(
".smart-table tbody tr"
)
.forEach(function(row){


row.style.display =
row.innerText
.toLowerCase()
.includes(value)

?

""

:

"none";


});


});



</script>