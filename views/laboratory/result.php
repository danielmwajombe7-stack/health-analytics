<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = "Enter Laboratory Result";

?>

<div class="container">

<div class="card shadow">

<div class="card-header bg-primary text-white">

<h3>
<i class="bi bi-eyedropper"></i>
 Laboratory Result Entry
</h3>

</div>



<div class="card-body">


<h4>
Patient Laboratory Request
</h4>


<hr>


<div class="row">


<div class="col-md-6">


<p>
<b>Test Name:</b>

<?= Html::encode(
$test->test_name
) ?>

</p>



<p>
<b>Status:</b>

<span class="badge bg-warning">

<?= Html::encode(
$test->status
) ?>

</span>

</p>



</div>





<div class="col-md-6">


<p>

<b>Requested By:</b>

<?= $test->doctor->username ?? 'Doctor' ?>

</p>


<p>

<b>Visit ID:</b>

<?= $test->visit_id ?>

</p>



</div>


</div>



<hr>





<?php $form = ActiveForm::begin(); ?>



<?= $form->field(
$model,
'result'
)
->textarea([

'rows'=>6,

'placeholder'=>
'Enter laboratory findings...'

])
->label(
'Laboratory Result'
)

?>






<?= $form->field(
$model,
'remarks'
)
->textarea([

'rows'=>4,

'placeholder'=>
'Additional remarks'

])

?>







<div class="mt-3">


<?= Html::submitButton(

'Save Result',

[

'class'=>
'btn btn-success btn-lg'

]

)

?>




<?= Html::a(

'Cancel',

['index'],

[

'class'=>
'btn btn-secondary btn-lg ms-2'

]

)

?>



</div>



<?php ActiveForm::end(); ?>



</div>


</div>


</div>