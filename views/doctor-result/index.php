<?php

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = "Doctor Results";

?>


<div class="doctor-result-container">


<h2 class="page-title">
🩺 Doctor Results Management
</h2>



<div class="cards">


<div class="card">
<h4>Total Results</h4>

<h2>
<?= count($results ?? []) ?>
</h2>

</div>



<div class="card success">

<h4>Completed</h4>

<h2>

<?= $completed ?? 0 ?>

</h2>

</div>



<div class="card warning">

<h4>Pending</h4>

<h2>

<?= $pending ?? 0 ?>

</h2>

</div>



<div class="card info">

<h4>Today Results</h4>

<h2>

<?= $today ?? 0 ?>

</h2>

</div>


</div>





<div class="table-box">


<div class="header">


<h3>
📋 Patient Medical Results
</h3>


<a href="<?=Url::to(['create'])?>"
class="btn-create">

➕ Add Result

</a>


</div>





<table>


<thead>

<tr>

<th>ID</th>

<th>Patient</th>

<th>Doctor</th>

<th>Diagnosis</th>

<th>Treatment</th>

<th>Status</th>

<th>Date</th>

<th>Action</th>

</tr>


</thead>



<tbody>



<?php foreach($results as $result): ?>


<tr>


<td>

<?= $result->id ?>

</td>



<td>


<?php if($result->patient): ?>


<?= Html::encode(
$result->patient->first_name
.' '.
$result->patient->last_name
) ?>


<?php else: ?>

Unknown Patient

<?php endif; ?>


</td>




<td>


<?php if($result->doctor): ?>


<?= Html::encode(
$result->doctor->full_name
) ?>


<?php else: ?>

-


<?php endif; ?>


</td>




<td>

<?= Html::encode(
$result->diagnosis ?? '-'
) ?>

</td>



<td>

<?= Html::encode(
$result->treatment ?? '-'
) ?>

</td>




<td>


<?php if(($result->status ?? '')=="Completed"): ?>


<span class="badge completed">

Completed

</span>


<?php else: ?>


<span class="badge pending">

Pending

</span>


<?php endif; ?>


</td>



<td>

<?= $result->created_at ?? '-' ?>

</td>




<td>


<a class="btn view"
href="<?=Url::to([
'view',
'id'=>$result->id
])?>">

View

</a>



<a class="btn edit"
href="<?=Url::to([
'update',
'id'=>$result->id
])?>">

Edit

</a>


</td>


</tr>



<?php endforeach; ?>





<?php if(empty($results)): ?>


<tr>

<td colspan="8" class="empty">

No doctor results found

</td>

</tr>


<?php endif; ?>



</tbody>


</table>



</div>



</div>






<style>


.doctor-result-container{

padding:20px;

}



.page-title{

color:#00695c;

margin-bottom:25px;

}




.cards{

display:grid;

grid-template-columns:repeat(4,1fr);

gap:20px;

margin-bottom:30px;

}



.card{

background:white;

padding:25px;

border-radius:18px;

box-shadow:0 5px 20px rgba(0,0,0,.08);

border-left:5px solid #00897b;

}



.card h4{

color:#666;

}



.card h2{

color:#00695c;

}



.success{

border-color:#2e7d32;

}



.warning{

border-color:#f9a825;

}



.info{

border-color:#0277bd;

}





.table-box{

background:white;

padding:25px;

border-radius:20px;

box-shadow:0 5px 20px rgba(0,0,0,.08);

}




.header{

display:flex;

justify-content:space-between;

align-items:center;

margin-bottom:20px;

}



.btn-create{

background:#00897b;

color:white;

padding:12px 20px;

border-radius:25px;

text-decoration:none;

}




table{

width:100%;

border-collapse:collapse;

}



th{

background:#e0f2f1;

padding:15px;

text-align:left;

}



td{

padding:14px;

border-bottom:1px solid #eee;

}



tr:hover{

background:#f8ffff;

}



.badge{

padding:6px 14px;

border-radius:20px;

font-size:12px;

font-weight:bold;

}



.completed{

background:#c8e6c9;

color:#256029;

}



.pending{

background:#fff3cd;

color:#856404;

}



.btn{

padding:7px 12px;

border-radius:8px;

text-decoration:none;

font-size:13px;

margin-right:5px;

}



.view{

background:#0277bd;

color:white;

}



.edit{

background:#f9a825;

color:white;

}



.empty{

text-align:center;

padding:30px;

color:#777;

}



@media(max-width:1000px){

.cards{

grid-template-columns:repeat(2,1fr);

}

}


</style>