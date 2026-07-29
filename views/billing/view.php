<?php

use yii\helpers\Html;

$this->title = "Billing Details";

?>


<style>

.billing-wrapper{

    padding:30px;

    background:#f1f7f6;

    min-height:100vh;

    font-family:'Inter','Segoe UI',Arial,sans-serif;

}



/* HEADER */

.billing-header{

    display:flex;

    justify-content:space-between;

    align-items:center;

    margin-bottom:35px;

    flex-wrap:wrap;

    gap:15px;

}


.billing-header h1{

    font-size:32px;

    font-weight:800;

    color:#064e3b;

    margin:0;

}



.billing-header p{

    color:#64748b;

    margin-top:8px;

}



/* BACK BUTTON */


.btn-back{


    background:#0f766e;

    color:white;

    padding:12px 25px;

    border-radius:14px;

    font-weight:700;

    text-decoration:none;

    transition:.3s;

}


.btn-back:hover{

    background:#115e59;

    color:white;

    transform:translateY(-2px);

}





/* MAIN CARD */


.billing-card{


    background:white;

    border-radius:25px;

    padding:35px;


    box-shadow:

    0 15px 40px rgba(15,118,110,.12);


    animation:fade .5s ease;


}



@keyframes fade{

from{

opacity:0;

transform:translateY(20px);

}

to{

opacity:1;

transform:none;

}

}






/* PATIENT HEADER */


.patient-banner{


background:

linear-gradient(
135deg,
#0f766e,
#14b8a6
);


padding:30px;


border-radius:22px;


color:white;


margin-bottom:35px;


}


.patient-banner h2{

font-size:28px;

font-weight:800;

margin:0 0 10px;


}


.patient-banner span{

opacity:.9;

}




/* GRID */


.info-grid{


display:grid;


grid-template-columns:

repeat(auto-fit,minmax(240px,1fr));


gap:25px;


}





.info-box{


background:#f8fafc;


padding:25px;


border-radius:18px;


border-left:5px solid #14b8a6;


transition:.3s;


}



.info-box:hover{


transform:translateY(-5px);


box-shadow:

0 10px 25px rgba(0,0,0,.08);


}




.info-box label{


font-size:12px;


font-weight:700;


color:#64748b;


text-transform:uppercase;


letter-spacing:1px;


}



.info-box h3{


margin-top:12px;


font-size:24px;


font-weight:800;


color:#0f172a;


}




/* STATUS */


.status{


padding:10px 22px;


border-radius:50px;


font-size:14px;


font-weight:800;


display:inline-block;


}



.status-paid{


background:#dcfce7;

color:#166534;


}


.status-pending{


background:#fef3c7;

color:#92400e;


}



.status-danger{


background:#fee2e2;

color:#991b1b;


}



/* MOBILE */


@media(max-width:768px){


.billing-wrapper{

padding:15px;

}


.billing-card{

padding:20px;

}


.billing-header h1{

font-size:25px;

}


}



</style>





<div class="billing-wrapper">



<div class="billing-header">


<div>


<h1>

<i class="bi bi-receipt"></i>

Billing Details

</h1>


<p>

Hospital Financial Transaction Overview

</p>


</div>



<?= Html::a(

'<i class="bi bi-arrow-left"></i> Back',

['index'],

[

'class'=>'btn-back'

]

) ?>


</div>









<div class="billing-card">





<div class="patient-banner">


<h2>

<i class="bi bi-person-circle"></i>

Patient Billing Record

</h2>


<span>

Transaction ID:

#

<?= Html::encode($model->id) ?>

</span>


</div>







<div class="info-grid">





<div class="info-box">

<label>

Patient ID

</label>


<h3>

<?= Html::encode($model->patient_id ?? 'N/A') ?>

</h3>


</div>









<div class="info-box">

<label>

Invoice Amount

</label>


<h3>

TZS

<?=

isset($model->amount)

?

number_format($model->amount)

:

'0'

?>


</h3>


</div>









<div class="info-box">

<label>

Payment Status

</label>


<h3>


<?php


$status = strtolower($model->status ?? 'pending');


$class='status-pending';



if($status=='paid'){

$class='status-paid';

}


elseif($status=='cancelled'){

$class='status-danger';

}



?>


<span class="status <?= $class ?>">


<?= strtoupper($status) ?>


</span>


</h3>


</div>









<div class="info-box">

<label>

Created Date

</label>


<h3>


<?=

isset($model->created_at)

?

date(

'd M Y',

strtotime($model->created_at)

)

:

'N/A'

?>


</h3>


</div>





</div>







<br>





<div class="info-box">


<label>

Billing Description

</label>


<h3>

Hospital Service Payment

</h3>


</div>





</div>


</div>