<?php

use yii\helpers\Html;

?>


<div class="card shadow">


<div class="card-header bg-success text-white">

<h3>

💊 Dispense Medicine

</h3>

</div>



<div class="card-body">


<h5>

Patient:

<?= 
$prescription->patient->first_name .
' ' .
$prescription->patient->last_name
?>

</h5>


<hr>


<p>

<b>Medicine:</b>

<?= $prescription->medicine_name ?>

</p>


<p>

<b>Dosage:</b>

<?= $prescription->dosage ?>

</p>



<p>

<b>Frequency:</b>

<?= $prescription->frequency ?>

</p>



<p>

<b>Duration:</b>

<?= $prescription->duration ?>

</p>




<p>

<b>Instructions:</b>

<?= $prescription->instructions ?>

</p>





<?= Html::beginForm() ?>



<?= Html::submitButton(

'✅ Confirm Dispense',

[

'class'=>'btn btn-success'

]

) ?>



<?= Html::endForm() ?>


</div>


</div>