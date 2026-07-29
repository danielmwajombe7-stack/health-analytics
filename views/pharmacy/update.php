<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;


$this->title = "Update Prescription";

?>


<div class="update-page">


<div class="update-header">

<h1>
<i class="bi bi-pencil-square"></i>
Update Prescription
</h1>

<p>
Edit patient medication prescription details
</p>

</div>




<div class="update-card">


<?php $form = ActiveForm::begin(); ?>



<!-- Hidden real patient ID -->
<?= $form->field($model,'patient_id')
->hiddenInput()
->label(false)
?>



<!-- Patient Number Display -->

<div class="mb-3">

<label class="form-label fw-bold">
Patient
</label>


<input 
type="text"
class="form-control"
value="<?= 
$model->patient->patient_number ?? 
$model->patient_id
?>"
readonly>


</div>






<!-- Medicine -->

<?= $form->field($model,'medicine_id')
->dropDownList(

\yii\helpers\ArrayHelper::map(

\app\models\Medicine::find()->all(),

'id',

'name'

),

[

'class'=>'form-select'

]

)

->label('Medicine')

?>






<!-- Quantity -->

<?= $form->field($model,'quantity')
->textInput([

'type'=>'number',

'class'=>'form-control',

'min'=>1

])

->label('Quantity')

?>







<!-- Dosage -->

<?= $form->field($model,'dosage')

->textInput([

'class'=>'form-control'

])

->label('Dosage')

?>






<!-- Frequency -->

<?= $form->field($model,'frequency')

->textInput([

'class'=>'form-control'

])

->label('Frequency')

?>






<!-- Duration -->

<?= $form->field($model,'duration')

->textInput([

'class'=>'form-control'

])

->label('Duration')

?>







<!-- Status -->

<?= $form->field($model,'status')

->dropDownList([


'Pending'=>'Pending',

'Dispensed'=>'Dispensed',

'Cancelled'=>'Cancelled'


],

[

'class'=>'form-select'

]

)

?>







<div class="buttons">


<?= Html::submitButton(

'<i class="bi bi-save"></i> Update Prescription',

[

'class'=>'save-btn'

]

) ?>





<?= Html::a(

'<i class="bi bi-arrow-left"></i> Cancel',

['prescriptions'],

[

'class'=>'cancel-btn'

]

) ?>


</div>



<?php ActiveForm::end(); ?>


</div>


</div>








<style>


.update-page{

padding:35px;

background:

linear-gradient(
135deg,
#ecfeff,
#f0fdf4
);

min-height:100vh;

}





.update-header{

background:

linear-gradient(
135deg,
#065f46,
#14b8a6
);

color:white;

padding:35px;

border-radius:30px;

margin-bottom:30px;

}





.update-header h1{

font-weight:900;

font-size:36px;

}





.update-card{

background:white;

padding:40px;

border-radius:30px;

box-shadow:

0 20px 50px rgba(0,0,0,.1);

max-width:800px;

}





.form-control,
.form-select{

padding:15px;

border-radius:15px;

border:1px solid #cbd5e1;

}





.buttons{

margin-top:30px;

display:flex;

gap:15px;

}





.save-btn{

background:#0f766e;

color:white;

padding:15px 30px;

border-radius:15px;

font-weight:800;

text-decoration:none;

border:none;

}





.cancel-btn{

background:#64748b;

color:white;

padding:15px 30px;

border-radius:15px;

font-weight:800;

text-decoration:none;

}



</style>