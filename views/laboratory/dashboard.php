<?php

use yii\helpers\Html;

$this->title = "Laboratory Dashboard";

?>


<style>

.lab-container{

    background:#f4f8fb;
    min-height:100vh;
    padding:25px;

}


.lab-header{

    background:white;
    padding:25px;
    border-radius:20px;
    margin-bottom:25px;
    box-shadow:0 10px 25px rgba(0,0,0,.08);

}


.lab-header h1{

    color:#00695c;
    margin:0;

}


.lab-header p{

    color:#607d8b;

}



/* CARDS */

.lab-cards{

    display:grid;
    grid-template-columns:repeat(4,1fr);
    gap:20px;
    margin-bottom:30px;

}



.lab-card{

    background:white;
    padding:25px;
    border-radius:20px;
    box-shadow:0 10px 25px rgba(0,0,0,.08);

}



.lab-icon{

    font-size:35px;

}



.lab-title{

    color:#607d8b;
    margin-top:10px;

}



.lab-number{

    font-size:38px;
    font-weight:800;
    color:#00695c;

}





/* TABLE */


.lab-table-box{

    background:white;
    padding:25px;
    border-radius:20px;
    box-shadow:0 10px 25px rgba(0,0,0,.08);

}



.lab-table{

    width:100%;
    border-collapse:collapse;

}



.lab-table th{

    background:#00695c;
    color:white;
    padding:15px;

}



.lab-table td{

    padding:15px;
    border-bottom:1px solid #eee;

}



.lab-table tr:hover{

    background:#f1f8f7;

}



/* BADGES */


.badge{

    padding:7px 15px;
    border-radius:20px;
    font-size:13px;
    font-weight:bold;

}



.pending{

    background:#fff3cd;
    color:#856404;

}



.processing{

    background:#cfe2ff;
    color:#084298;

}



.completed{

    background:#d1e7dd;
    color:#0f5132;

}



/* BUTTONS */


.action-btn{

    padding:8px 15px;
    border-radius:10px;
    text-decoration:none;
    font-size:13px;
    display:inline-block;

}


.start{

    background:#0288d1;
    color:white;

}



.result{

    background:#00897b;
    color:white;

}



.view{

    background:#546e7a;
    color:white;

}



.empty{

    text-align:center;
    padding:30px;
    color:#777;

}



@media(max-width:1000px){

.lab-cards{

grid-template-columns:1fr 1fr;

}

}



@media(max-width:600px){

.lab-cards{

grid-template-columns:1fr;

}

}



</style>





<div class="lab-container">



<div class="lab-header">

<h1>
🧪 Laboratory Dashboard
</h1>


<p>
Manage laboratory tests, results and doctor requests
</p>


</div>






<div class="lab-cards">



<div class="lab-card">

<div class="lab-icon">
⏳
</div>

<div class="lab-title">
Pending Tests
</div>

<div class="lab-number">
<?= $pending ?? 0 ?>
</div>


</div>





<div class="lab-card">

<div class="lab-icon">
⚙️
</div>

<div class="lab-title">
Processing
</div>

<div class="lab-number">
<?= $processing ?? 0 ?>
</div>


</div>





<div class="lab-card">

<div class="lab-icon">
✅
</div>

<div class="lab-title">
Completed
</div>

<div class="lab-number">
<?= $completed ?? 0 ?>
</div>


</div>





<div class="lab-card">

<div class="lab-icon">
🧪
</div>

<div class="lab-title">
Total Tests
</div>

<div class="lab-number">
<?= $total ?? 0 ?>
</div>


</div>



</div>









<div class="lab-table-box">


<h2>
🧪 Recent Laboratory Requests
</h2>





<table class="lab-table">


<thead>

<tr>

<th>Patient</th>

<th>Test</th>

<th>Doctor</th>

<th>Priority</th>

<th>Status</th>

<th>Actions</th>

</tr>


</thead>





<tbody>



<?php 

$requests = $recentRequests ?? [];

?>



<?php if(empty($requests)): ?>


<tr>

<td colspan="6" class="empty">

No laboratory requests found

</td>

</tr>



<?php endif; ?>






<?php foreach($requests as $request): ?>


<tr>



<td>

<?= Html::encode(

$request->patient->fullName ?? 'Unknown'

) ?>

</td>





<td>

<?= Html::encode(

$request->test_name

) ?>

</td>





<td>

<?= Html::encode(

$request->doctor->username ?? 'Not Assigned'

) ?>

</td>





<td>

<?= Html::encode(

$request->priority ?? 'Normal'

) ?>

</td>







<td>



<?php if($request->status=="Pending"): ?>


<span class="badge pending">

⏳ Pending

</span>




<?php elseif($request->status=="Processing"): ?>


<span class="badge processing">

⚙ Processing

</span>




<?php else: ?>


<span class="badge completed">

✅ Completed

</span>


<?php endif; ?>



</td>









<td>



<?php if($request->status=="Pending"): ?>


<?= Html::a(

"▶ Start",

[

'process',

'id'=>$request->id

],

[

'class'=>'action-btn start',

'data'=>[

'method'=>'post',

'confirm'=>'Start laboratory test?'

]

]

)

?>






<?php elseif($request->status=="Processing"): ?>


<?= Html::a(

"📝 Add Result",

[

'create-result',

'id'=>$request->id

],

[

'class'=>'action-btn result'

]

)

?>







<?php else: ?>


<?= Html::a(

"👁 View",

[

'view',

'id'=>$request->id

],

[

'class'=>'action-btn view'

]

)

?>




<?php endif; ?>



</td>





</tr>



<?php endforeach; ?>



</tbody>


</table>




</div>




</div>