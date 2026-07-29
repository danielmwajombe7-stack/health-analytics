<?php

use yii\helpers\Html;
use app\models\Prescription;

$this->title = "Prescription Details";

?>


<div class="prescription-view">


<div class="view-header">


<div>

<h1>
<i class="bi bi-file-medical"></i>
Prescription Details
</h1>


<p>
Medication information and dispensing workflow
</p>


</div>


<?= Html::a(

'<i class="bi bi-arrow-left"></i> Back',

['prescriptions'],

[
'class'=>'btn-back'
]

) ?>


</div>






<div class="content-grid">



<!-- PATIENT -->

<div class="detail-card">


<div class="card-title">

<i class="bi bi-person-circle"></i>
Patient Information

</div>



<div class="patient-section">


<div class="avatar">


<?= strtoupper(
substr(
$model->patient->full_name ?? 'U',
0,
1
)
) ?>


</div>




<div>


<h2>

<?= Html::encode(
$model->patient->full_name ?? 'Unknown'
) ?>

</h2>



<p>

Patient ID:

<strong>
PAT-<?= $model->patient_id ?>
</strong>

</p>



</div>



</div>


</div>









<!-- PRESCRIPTION INFO -->

<div class="detail-card">


<div class="card-title">

<i class="bi bi-clipboard2-pulse"></i>
Prescription Information

</div>




<div class="info">


<div>

<label>
Prescription ID
</label>

<h4>
#<?= $model->id ?>
</h4>


</div>



<div>

<label>
Visit ID
</label>

<h4>
<?= $model->visit_id ?? 'N/A' ?>
</h4>


</div>




<div>

<label>
Doctor ID
</label>

<h4>
<?= $model->doctor_id ?? 'N/A' ?>
</h4>


</div>




<div>

<label>
Created
</label>

<h4>

<?= Yii::$app->formatter->asDatetime(
$model->created_at
) ?>

</h4>


</div>


</div>


</div>









<!-- MEDICINE -->

<div class="detail-card medicine-card">


<div class="card-title">

<i class="bi bi-capsule"></i>
Medication Details

</div>




<div class="medicine-name">


<?= Html::encode(

$model->medicine->name ??

$model->drug_name ??

'Unknown Medicine'

) ?>


</div>




<div class="medicine-grid">



<div>

<span>
Quantity
</span>

<h3>
<?= $model->quantity ?>
</h3>


</div>




<div>

<span>
Dosage
</span>

<h3>

<?= Html::encode(
$model->dosage ?? 'N/A'
) ?>

</h3>


</div>




<div>

<span>
Frequency
</span>

<h3>

<?= Html::encode(
$model->frequency ?? 'N/A'
) ?>

</h3>


</div>





<div>

<span>
Duration
</span>

<h3>

<?= Html::encode(
$model->duration ?? 'N/A'
) ?>

</h3>


</div>



</div>







<?php if(!empty($model->instructions)): ?>


<div class="instruction">


<i class="bi bi-info-circle"></i>


<?= Html::encode(
$model->instructions
) ?>


</div>


<?php endif; ?>



</div>









<!-- STATUS -->


<div class="detail-card">


<div class="card-title">

<i class="bi bi-activity"></i>
Pharmacy Status

</div>



<div class="status-area">


<?php if(
$model->status == 'Waiting Pharmacy' ||
$model->status == 'Active' ||
$model->status == 'Pending'
): ?>


<span class="active">

⏳ Waiting Pharmacy

</span>





<?php elseif(
$model->status == 'Dispensed'
): ?>


<span class="dispensed">

✅ Dispensed

</span>





<?php elseif(
$model->status == 'Cancelled'
): ?>


<span class="cancelled">

❌ Cancelled

</span>





<?php else: ?>


<span class="active">

⏳ <?= Html::encode($model->status) ?>

</span>


<?php endif; ?>


</div>






<?php if(!empty($model->dispensed_at)): ?>


<div class="dispense-time">


Dispensed At:

<strong>

<?= Yii::$app->formatter->asDatetime(
$model->dispensed_at
) ?>

</strong>


</div>


<?php endif; ?>


</div>





</div>


</div>








<style>


.prescription-view{

padding:35px;

background:
linear-gradient(
135deg,
#ecfeff,
#f0fdf4
);

min-height:100vh;

}



.view-header{

background:
linear-gradient(
135deg,
#065f46,
#14b8a6
);

padding:35px;

border-radius:30px;

color:white;

display:flex;

justify-content:space-between;

align-items:center;

margin-bottom:30px;

}



.view-header h1{

font-size:36px;

font-weight:900;

}



.view-header p{

margin:0;

opacity:.9;

}



.btn-back{

background:white;

color:#065f46;

padding:14px 25px;

border-radius:15px;

font-weight:800;

text-decoration:none;

}



.content-grid{

display:grid;

grid-template-columns:

repeat(2,1fr);

gap:25px;

}



.detail-card{

background:white;

padding:30px;

border-radius:30px;

box-shadow:

0 20px 50px rgba(0,0,0,.08);

}



.card-title{

font-size:20px;

font-weight:900;

color:#065f46;

margin-bottom:25px;

}



.patient-section{

display:flex;

align-items:center;

gap:20px;

}



.avatar{

width:80px;

height:80px;

border-radius:50%;

background:

linear-gradient(
135deg,
#14b8a6,
#065f46
);

color:white;

display:flex;

justify-content:center;

align-items:center;

font-size:35px;

font-weight:900;

}



.patient-section h2{

margin:0;

font-weight:900;

}



.info{

display:grid;

grid-template-columns:

repeat(2,1fr);

gap:20px;

}



.info div{

background:#f0fdfa;

padding:18px;

border-radius:20px;

}



.info label{

color:#64748b;

font-size:14px;

}



.medicine-card{

grid-column:span 2;

}



.medicine-name{

font-size:32px;

font-weight:900;

color:#0f766e;

margin-bottom:25px;

}



.medicine-grid{

display:grid;

grid-template-columns:

repeat(4,1fr);

gap:20px;

}



.medicine-grid div{

background:#ecfeff;

padding:20px;

border-radius:20px;

}



.medicine-grid span{

color:#64748b;

}



.medicine-grid h3{

margin-top:10px;

}



.instruction{

margin-top:25px;

padding:20px;

background:#f0fdfa;

border-radius:20px;

color:#065f46;

font-weight:600;

}



.status-area span{

padding:12px 25px;

border-radius:30px;

font-weight:900;

font-size:18px;

display:inline-block;

}



.active{

background:#fef3c7;

color:#92400e;

}



.dispensed{

background:#dcfce7;

color:#166534;

}



.cancelled{

background:#fee2e2;

color:#991b1b;

}



.dispense-time{

margin-top:25px;

background:#f8fafc;

padding:20px;

border-radius:20px;

}



@media(max-width:900px){


.content-grid{

grid-template-columns:1fr;

}



.medicine-card{

grid-column:auto;

}



.medicine-grid{

grid-template-columns:1fr;

}


}


</style>