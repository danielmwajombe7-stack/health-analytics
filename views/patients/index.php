<?php

use yii\helpers\Html;
use yii\widgets\LinkPager;

$this->title = "Patient Management";

?>


<style>

/* =====================================================
   MHAS SMART HOSPITAL
   PATIENT MANAGEMENT V2
===================================================== */


.patient-page{

    padding:30px;
    background:#f5f9fc;
    min-height:100vh;

}



.patient-header{

    background:white;

    padding:30px;

    border-radius:25px;

    display:flex;

    justify-content:space-between;

    align-items:center;

    margin-bottom:25px;

    box-shadow:
    0 10px 30px rgba(0,0,0,.08);

}



.patient-header h1{

    color:#00695c;

    font-size:32px;

    font-weight:900;

    margin:0;

}



.patient-header p{

    color:#64748b;

    margin-top:10px;

}



/* REGISTER BUTTON */

.register-btn{

    background:#00897b;

    color:white!important;

    padding:14px 25px;

    border-radius:15px;

    font-weight:900;

    text-decoration:none;

}





/* SEARCH */

.search-box{

    background:white;

    padding:25px;

    border-radius:25px;

    margin-bottom:25px;

    box-shadow:
    0 8px 20px rgba(0,0,0,.06);

}



.search-box input{

    width:85%;

    padding:15px;

    border-radius:15px;

    border:1px solid #ddd;

    font-size:15px;

}



.search-btn{

    background:#00695c;

    color:white;

    border:none;

    padding:15px 25px;

    border-radius:15px;

    font-weight:800;

}



/* TABLE CARD */

.table-card{

    background:white;

    padding:25px;

    border-radius:25px;

    box-shadow:
    0 10px 30px rgba(0,0,0,.08);

}



.table{

    width:100%;

}



.table thead{

    background:#f0fdfa;

}



.table thead th{

    padding:18px;

    color:#00695c;

    font-weight:900;

    border:none;

}



.table tbody td{

    padding:18px;

    vertical-align:middle;

    color:#334155;

    font-weight:600;

}



.table tbody tr{

    transition:.3s;

}



.table tbody tr:hover{

    background:#f8fafc;

    transform:scale(1.01);

}




.patient-id{

    background:#e0f2fe;

    color:#0369a1;

    padding:8px 14px;

    border-radius:20px;

    font-weight:900;

}



.patient-name{

    color:#004d40;

    font-weight:900;

    font-size:16px;

}



.status{

    background:#dcfce7;

    color:#166534;

    padding:8px 15px;

    border-radius:20px;

    font-weight:900;

    font-size:13px;

}





/* ACTION BUTTONS */


.action-btn{

    padding:9px 15px;

    border-radius:12px;

    text-decoration:none;

    font-weight:800;

    font-size:13px;

}



.view-btn{

    background:#e0f2fe;

    color:#0369a1!important;

}



.edit-btn{

    background:#fff7ed;

    color:#c2410c!important;

}





/* PAGINATION */


.pagination{

    justify-content:center;

    margin-top:30px;

}



.pagination li a,

.pagination li span{

    border-radius:50%!important;

    margin:5px;

    width:40px;

    height:40px;

    display:flex;

    align-items:center;

    justify-content:center;

    font-weight:800;

}



.pagination .active span{

    background:#00695c;

    color:white;

}




@media(max-width:900px){


.patient-header{

flex-direction:column;

gap:20px;

align-items:flex-start;

}



.search-box input{

width:100%;

margin-bottom:10px;

}


.table{

font-size:13px;

}


}


</style>





<div class="patient-page">



<!-- HEADER -->

<div class="patient-header">


<div>


<h1>
👥 Patient Management
</h1>


<p>
Manage registered patients and patient information
</p>


</div>




<?= Html::a(

'➕ Register Patient',

['create'],

[
'class'=>'register-btn'
]

) ?>



</div>







<!-- SEARCH -->

<div class="search-box">


<form method="get">


<input

type="text"

name="search"

placeholder="🔍 Search patient name, phone or patient ID"

value="<?= Html::encode(Yii::$app->request->get('search')) ?>"



>


<button class="search-btn">

Search

</button>


</form>


</div>








<!-- PATIENT TABLE -->


<div class="table-card">


<table class="table">


<thead>


<tr>


<th>
Patient ID
</th>


<th>
Patient Name
</th>


<th>
Gender
</th>


<th>
Phone
</th>


<th>
Status
</th>


<th>
Action
</th>


</tr>


</thead>




<tbody>



<?php foreach($dataProvider->models as $patient): ?>



<tr>



<td>


<span class="patient-id">

<?= Html::encode(
$patient->patient_number
) ?>

</span>


</td>




<td>


<div class="patient-name">

<?= Html::encode(
$patient->fullName
) ?>

</div>


</td>





<td>

<?= Html::encode(
$patient->gender
) ?>

</td>




<td>

<?= Html::encode(
$patient->phone
) ?>

</td>




<td>


<span class="status">

🟢 Active

</span>


</td>




<td>



<?= Html::a(

'👁 View',

[
'view',
'id'=>$patient->id
],

[
'class'=>'action-btn view-btn'
]

) ?>




<?= Html::a(

'✏ Edit',

[
'update',
'id'=>$patient->id
],

[
'class'=>'action-btn edit-btn'
]

) ?>



</td>




</tr>




<?php endforeach; ?>




</tbody>


</table>



</div>







<!-- PAGINATION -->


<?= LinkPager::widget([

'pagination'=>$dataProvider->pagination,

'options'=>[
'class'=>'pagination'
]

]); ?>





</div>