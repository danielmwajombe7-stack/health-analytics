<?php

use yii\helpers\Html;
use yii\helpers\Url;


$this->title = "Laboratory Tests";

?>

<style>

.page-box{

    padding:25px;

    background:#f4f8fb;

}


.header-box{

    background:linear-gradient(
        135deg,
        #009688,
        #00695c
    );

    color:white;

    padding:30px;

    border-radius:20px;

    margin-bottom:25px;

}



.header-box h1{

    font-size:40px;

}



.add-btn{

    background:white;

    color:#009688;

    padding:12px 25px;

    border-radius:30px;

    text-decoration:none;

    font-weight:bold;

}



.card-table{

    background:white;

    padding:25px;

    border-radius:20px;

    box-shadow:0 10px 25px rgba(0,0,0,.08);

}



table{

    width:100%;

    border-collapse:collapse;

}



th{

    background:#009688;

    color:white;

    padding:15px;

}



td{

    padding:15px;

    border-bottom:1px solid #eee;

}



.status{

    padding:6px 15px;

    border-radius:20px;

    color:white;

}



.Pending{

    background:#ff9800;

}



.Processing{

    background:#2196f3;

}



.Completed{

    background:#4caf50;

}


</style>





<div class="page-box">



<div class="header-box">


<h1>
🧪 Laboratory Tests
</h1>


<p>
Manage requested laboratory investigations
</p>


</div>







<div class="card-table">



<table>


<tr>


<th>ID</th>

<th>Test Name</th>

<th>Priority</th>

<th>Status</th>

<th>Requested By</th>

<th>Action</th>


</tr>





<?php foreach($tests as $test): ?>


<tr>


<td>
<?= $test->id ?>
</td>



<td>
<?= $test->test_name ?>
</td>



<td>
<?= $test->priority ?? 'Normal' ?>
</td>




<td>

<span class="status <?= $test->status ?>">

<?= $test->status ?>

</span>


</td>



<td>

<?= $test->doctor 
? $test->doctor->username 
: 'Doctor'
?>

</td>




<td>


<a href="<?=Url::to([
    '/lab-test/view',
    'id'=>$test->id
])?>"
class="btn btn-success btn-sm">


View


</a>



</td>



</tr>



<?php endforeach; ?>



</table>



</div>




</div>