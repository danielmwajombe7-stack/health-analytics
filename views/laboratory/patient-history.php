<?php

use yii\helpers\Html;

/* @var $patient app\models\Patient */
/* @var $requests app\models\LabRequest[] */


$this->title = "Patient Laboratory History";


?>


<div class="container-fluid">


<div class="card shadow">


<div class="card-header bg-success text-white">

<h3>

🧪 Patient Laboratory History

</h3>

</div>




<div class="card-body">



<div class="row mb-4">


<div class="col-md-4">

<div class="card bg-light p-3">

<h5>
Patient Information
</h5>


<hr>


<p>
<b>Name:</b>

<?= Html::encode(
    $patient->fullName
) ?>

</p>



<p>
<b>Gender:</b>

<?= Html::encode(
    $patient->gender
) ?>

</p>



<p>
<b>Phone:</b>

<?= Html::encode(
    $patient->phone
) ?>

</p>


<p>
<b>Status:</b>

<?= Html::encode(
    $patient->status
) ?>

</p>


</div>


</div>




<div class="col-md-8">


<div class="card bg-white p-3">


<h5>
Laboratory Requests
</h5>


<hr>



<table class="table table-bordered table-striped">


<thead class="table-dark">


<tr>

<th>ID</th>

<th>Test</th>

<th>Status</th>

<th>Result</th>

<th>Date</th>


</tr>


</thead>




<tbody>


<?php if(!empty($requests)): ?>


<?php foreach($requests as $request): ?>


<tr>


<td>

<?= Html::encode(
$request->id
) ?>

</td>



<td>

<?= Html::encode(
$request->test_name
) ?>

</td>




<td>


<?php if($request->status=="Pending"): ?>


<span class="badge bg-warning">

Pending

</span>


<?php elseif($request->status=="Processing"): ?>


<span class="badge bg-primary">

Processing

</span>


<?php else: ?>


<span class="badge bg-success">

Completed

</span>


<?php endif; ?>


</td>





<td>

<?= Html::encode(

$request->result ?? "No Result"

) ?>


</td>




<td>

<?= Html::encode(

$request->created_at

) ?>

</td>



</tr>



<?php endforeach; ?>


<?php else: ?>


<tr>

<td colspan="5" class="text-center">

No Laboratory History Found

</td>

</tr>


<?php endif; ?>



</tbody>


</table>



</div>


</div>



</div>





<?= Html::a(

"← Back",

[
    'requests'
],

[
'class'=>'btn btn-secondary'
]

) ?>



</div>


</div>


</div>