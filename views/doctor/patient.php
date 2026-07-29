<?php


use yii\helpers\Html;


$this->title="Patient Consultation";


?>


<div class="container">


<h2>
🩺 Patient Consultation
</h2>


<hr>


<h3>

<?= $patient->first_name ?>

<?= $patient->last_name ?>

</h3>


<table class="table table-bordered">


<tr>

<th>Patient Number</th>

<td>
<?= $patient->patient_number ?>
</td>

</tr>


<tr>

<th>Gender</th>

<td>
<?= $patient->gender ?>
</td>

</tr>


<tr>

<th>Phone</th>

<td>
<?= $patient->phone ?>
</td>

</tr>


<tr>

<th>Blood Group</th>

<td>
<?= $patient->blood_group ?>
</td>

</tr>


</table>



<?= Html::a(

'Start Consultation',

['start','id'=>$queue->id],

[

'class'=>'btn btn-primary'

]

)

?>

<?= Html::a(

'Add Diagnosis',

[
'diagnosis',
'id'=>$queue->id
],

[
'class'=>'btn btn-warning'
]

)

?>



</div>