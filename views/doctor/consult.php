<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;


$this->title = "Doctor Consultation";

?>


<div class="container-fluid">


<h2>
🩺 Patient Consultation
</h2>


<hr>



<div class="row">



<!-- PATIENT INFORMATION -->

<div class="col-md-4">


<div class="card shadow border-0">


<div class="card-header bg-success text-white">

<h5>
Patient Information
</h5>

</div>


<div class="card-body">


<h4>

<?=

$queue->patient->first_name
.' '.
$queue->patient->last_name

?>

</h4>


<p>

<b>Patient Number:</b>

<?= $queue->patient->patient_number ?>

</p>



<p>

<b>Gender:</b>

<?= $queue->patient->gender ?>

</p>



<p>

<b>Phone:</b>

<?= $queue->patient->phone ?>

</p>



<p>

<b>Queue Status:</b>

<span class="badge bg-warning">

<?= $queue->status ?>

</span>

</p>


</div>


</div>



</div>







<!-- CONSULTATION -->

<div class="col-md-8">


<div class="card shadow border-0">


<div class="card-header bg-primary text-white">

<h5>
Medical Consultation
</h5>

</div>



<div class="card-body">



<form method="post"
action="<?=

\yii\helpers\Url::to([
'doctor/save-consultation',
'id'=>$queue->id
])

?>">


<input type="hidden"
name="_csrf"
value="<?=Yii::$app->request->csrfToken?>">



<div class="row">


<div class="col-md-6">


<label>
Blood Pressure
</label>


<input type="text"
name="blood_pressure"
class="form-control"
placeholder="120/80">


</div>



<div class="col-md-6">


<label>
Temperature
</label>


<input type="text"
name="temperature"
class="form-control"
placeholder="36.5">


</div>



</div>



<br>


<label>
Patient Complaint
</label>


<textarea
name="complaint"
class="form-control"
rows="3"></textarea>



<br>


<label>
Diagnosis
</label>


<textarea
name="diagnosis"
class="form-control"
rows="3"></textarea>




<br>


<label>
Doctor Notes
</label>


<textarea
name="notes"
class="form-control"
rows="3"></textarea>




<br>


<button class="btn btn-success">

💾 Save Consultation

</button>


</form>



</div>

</div>


</div>


</div>









<!-- LAB REQUEST -->

<div class="card shadow border-0 mt-4">


<div class="card-header bg-warning">


<h4>
🧪 Send Laboratory Request
</h4>


</div>



<div class="card-body">



<form method="post"

action="<?=

\yii\helpers\Url::to([
'doctor/send-lab',
'id'=>$queue->id
])

?>">


<input type="hidden"
name="_csrf"
value="<?=Yii::$app->request->csrfToken?>">





<label>
Select Laboratory Test
</label>


<select name="test_name"
class="form-control">


<option value="Blood Test">
Blood Test
</option>


<option value="Urinalysis">
Urinalysis
</option>


<option value="Malaria Test">
Malaria Test
</option>


<option value="HIV Test">
HIV Test
</option>


<option value="X-Ray">
X-Ray
</option>


<option value="Other Investigation">
Other Investigation
</option>


</select>



<br>



<button class="btn btn-warning">

🧪 Send To Laboratory

</button>



</form>


</div>


</div>









<!-- PRESCRIPTION -->

<div class="card shadow border-0 mt-4">


<div class="card-header bg-info text-white">


<h4>
💊 Send Prescription Pharmacy
</h4>


</div>



<div class="card-body">



<form method="post"

action="<?=

\yii\helpers\Url::to([
'doctor/prescription',
'id'=>$queue->id
])

?>">



<input type="hidden"
name="_csrf"
value="<?=Yii::$app->request->csrfToken?>">



<div class="row">


<div class="col-md-6">


<label>
Medicine Name
</label>


<input type="text"
name="medicine_name"
class="form-control">


</div>



<div class="col-md-6">


<label>
Dosage
</label>


<input type="text"
name="dosage"
class="form-control">


</div>



</div>


<br>



<div class="row">


<div class="col-md-6">


<label>
Frequency
</label>


<input type="text"
name="frequency"
class="form-control">


</div>




<div class="col-md-6">


<label>
Duration
</label>


<input type="text"
name="duration"
class="form-control">


</div>


</div>



<br>


<label>
Instructions
</label>


<textarea
name="instructions"
class="form-control"></textarea>


<br>


<button class="btn btn-info">

💊 Send Pharmacy

</button>



</form>



</div>


</div>









<!-- HISTORY -->

<div class="card shadow border-0 mt-4">


<div class="card-header">

<h4>
📋 Medical History
</h4>

</div>



<div class="card-body">


<?php if(empty($medicalHistory)): ?>


<p>
No previous medical records.
</p>


<?php else: ?>


<table class="table table-bordered">


<tr>

<th>Date</th>

<th>Diagnosis</th>

<th>Notes</th>

</tr>



<?php foreach($medicalHistory as $record): ?>


<tr>


<td>

<?= $record->created_at ?>

</td>



<td>

<?= $record->diagnosis ?>

</td>



<td>

<?= $record->notes ?>

</td>


</tr>


<?php endforeach; ?>



</table>


<?php endif; ?>



</div>


</div>









<!-- COMPLETE VISIT -->


<div class="mt-4">


<?= Html::a(

'✅ Complete Visit',

[
'complete',
'id'=>$queue->id
],

[
'class'=>'btn btn-danger btn-lg'
]

) ?>


</div>




</div>