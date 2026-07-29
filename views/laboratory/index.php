<?php

use yii\helpers\Html;

$this->title = "Laboratory Dashboard";

?>

<div class="container-fluid">


<!-- HEADER -->

<div class="card shadow-sm mb-4">

<div class="card-body">

<h2>
🧪 Laboratory Dashboard
</h2>

<p class="text-muted">
Hospital Laboratory Information System
</p>


<span class="badge bg-success">
🟢 Laboratory Online
</span>


</div>

</div>




<!-- STATISTICS CARDS -->

<div class="row">



<div class="col-md-3">

<div class="card shadow text-center p-3">

<h5>
🧪 Total Tests
</h5>

<h1>
<?= $totalTests ?>
</h1>

<p>
All Laboratory Requests
</p>


</div>

</div>




<div class="col-md-3">

<div class="card shadow text-center p-3">

<h5>
⏳ Pending Tests
</h5>


<h1>
<?= $pendingLab ?>
</h1>


<p>
Waiting Laboratory Action
</p>


</div>

</div>





<div class="col-md-3">

<div class="card shadow text-center p-3">

<h5>
✅ Completed
</h5>


<h1>
<?= $completedLab ?>
</h1>


<p>
Finished Tests
</p>


</div>

</div>





<div class="col-md-3">

<div class="card shadow text-center p-3">


<h5>
⚠ Critical Results
</h5>


<h1>
<?= $criticalResults ?>
</h1>


<p>
Need Doctor Review
</p>


</div>


</div>



</div>







<!-- TODAY + QUEUE -->


<div class="row mt-4">


<div class="col-md-6">


<div class="card shadow p-4">


<h4>
📅 Today's Laboratory Activity
</h4>


<h2>

<?= $todayTests ?>

</h2>


<p>
Tests received today
</p>


</div>


</div>





<div class="col-md-6">


<div class="card shadow p-4">


<h4>
👥 Laboratory Queue
</h4>


<h2>

<?= $waitingPatients ?>

</h2>


<p>
Patients waiting for laboratory
</p>


</div>


</div>


</div>








<!-- REQUEST TABLE -->


<div class="card shadow mt-4">


<div class="card-header">


<h4>
🧾 Laboratory Requests
</h4>


</div>



<div class="card-body">


<table class="table table-bordered table-striped">


<thead>

<tr>

<th>
Patient
</th>


<th>
Test
</th>


<th>
Status
</th>


<th>
Date
</th>


<th>
Action
</th>


</tr>


</thead>



<tbody>


<?php foreach($requests as $request): ?>


<tr>


<td>

<?= $request->patient->first_name ?? 'Unknown' ?>

</td>



<td>

<?= $request->test_name ?>

</td>



<td>


<?php if($request->status=="Completed"): ?>

<span class="badge bg-success">

Completed

</span>


<?php else: ?>


<span class="badge bg-warning">

Pending

</span>


<?php endif; ?>


</td>



<td>

<?= $request->created_at ?? '-' ?>

</td>



<td>


<a href="<?= Yii::$app->urlManager->createUrl([
'laboratory/update',
'id'=>$request->id
]) ?>"
class="btn btn-primary btn-sm">

Update Result

</a>


</td>


</tr>


<?php endforeach; ?>



</tbody>


</table>


</div>


</div>








<!-- ANALYTICS -->


<div class="row mt-4">


<div class="col-md-6">


<div class="card shadow p-4">


<h4>
📊 Test Status Analytics
</h4>


<canvas id="labChart"></canvas>


</div>


</div>



<div class="col-md-6">


<div class="card shadow p-4">


<h4>
🧠 Laboratory Intelligence
</h4>


<p>

System monitors laboratory performance,
pending tests and abnormal results.

</p>


</div>


</div>



</div>



</div>






<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


<script>


new Chart(
document.getElementById('labChart'),
{


type:'doughnut',


data:{


labels:[
"Pending",
"Completed"
],


datasets:[{


data:[

<?= $pendingLab ?>,

<?= $completedLab ?>

]


}]


}


});


</script>