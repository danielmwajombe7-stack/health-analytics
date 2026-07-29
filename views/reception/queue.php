<?php

use yii\helpers\Html;

$this->title = "Patient Queue";

?>


<div class="container-fluid">



<div class="d-flex justify-content-between align-items-center mb-4">


<div>

<h2>
📋 Doctor Waiting Queue
</h2>


<p class="text-muted">
Patients waiting for consultation
</p>


</div>




<?= Html::a(
    '← Reception Dashboard',
    [
        'index'
    ],
    [
        'class'=>'btn btn-secondary'
    ]
) ?>



</div>








<div class="card shadow border-0">



<div class="card-header bg-warning">


<h4>
Waiting Patients
</h4>


</div>







<div class="card-body">





<table class="table table-bordered table-hover">



<thead>


<tr>

<th>
#
</th>


<th>
Queue Number
</th>


<th>
Patient Name
</th>


<th>
Patient Number
</th>


<th>
Gender
</th>


<th>
Priority
</th>


<th>
Status
</th>


<th>
Time
</th>


</tr>


</thead>






<tbody>


<?php if(!empty($queue)): ?>



<?php foreach($queue as $index=>$item): ?>


<tr>


<td>
<?= $index+1 ?>
</td>



<td>

<span class="badge bg-primary">

<?= $item->queue_number ?>

</span>

</td>







<td>

<?= 
$item->patient->first_name
.' '.
$item->patient->last_name
?>

</td>






<td>

<?= $item->patient->patient_number ?>

</td>







<td>

<?= $item->patient->gender ?>

</td>







<td>


<?php if($item->priority=="Critical"): ?>


<span class="badge bg-danger">

Critical

</span>


<?php elseif($item->priority=="High"): ?>


<span class="badge bg-warning">

High

</span>


<?php else: ?>


<span class="badge bg-success">

Normal

</span>


<?php endif; ?>


</td>








<td>


<span class="badge bg-secondary">

<?= $item->status ?>

</span>


</td>







<td>

<?= date(
    'H:i',
    strtotime($item->created_at)
) ?>


</td>




</tr>



<?php endforeach; ?>



<?php else: ?>


<tr>

<td colspan="8" class="text-center">

No patients waiting

</td>


</tr>


<?php endif; ?>



</tbody>


</table>






</div>


</div>




</div>