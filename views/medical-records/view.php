<?php

use yii\helpers\Html;
use yii\helpers\Url;


$this->title="Medical Consultation Report";


$patient=$model->patient;

$doctor=$model->doctor;


?>


<style>


.report-page{

padding:30px;

background:#f4f8fb;

min-height:100vh;

}





.header{

display:flex;

justify-content:space-between;

align-items:center;

margin-bottom:30px;

}



.header h1{

color:#004d40;

}





.card{

background:white;

padding:25px;

border-radius:25px;

box-shadow:
0 10px 30px rgba(0,0,0,.08);

margin-bottom:25px;

}





.card-title{

font-size:20px;

font-weight:bold;

color:#00695c;

margin-bottom:20px;

}




.grid{

display:grid;

grid-template-columns:repeat(auto-fit,minmax(250px,1fr));

gap:20px;

}



.info{

background:#f8ffff;

padding:18px;

border-radius:15px;

}



.info b{

color:#004d40;

}





.vital-box{

display:grid;

grid-template-columns:repeat(auto-fit,minmax(180px,1fr));

gap:15px;

}



.vital{

background:#e0f2f1;

padding:20px;

border-radius:18px;

}



.vital h3{

color:#00695c;

}





.actions{

display:flex;

gap:15px;

flex-wrap:wrap;

}




.btn{

padding:12px 20px;

border-radius:15px;

text-decoration:none;

font-weight:bold;

}





.lab{

background:#ede7f6;

color:#6a1b9a;

}



.prescription{

background:#e8f5e9;

color:#2e7d32;

}



.update{

background:#e3f2fd;

color:#1565c0;

}



.delete{

background:#ffebee;

color:#c62828;

}



.back{

background:#eceff1;

color:#37474f;

}




.print{

background:#00695c;

color:white;

}





</style>









<div class="report-page">







<div class="header">


<div>


<h1>

🩺 Medical Consultation Report

</h1>


<p>

Complete patient clinical assessment

</p>


</div>



<?=Html::a(

"🖨 Print Report",

"#",

[

'class'=>'btn print'

]

)?>



</div>













<div class="card">


<div class="card-title">

👤 Patient Information

</div>




<div class="grid">



<div class="info">

<b>Name</b>

<br>

<?=Html::encode(
$patient->fullName ?? 'Unknown'
)?>

</div>




<div class="info">

<b>Patient Number</b>

<br>

<?=Html::encode(
$patient->patient_number
)?>

</div>




<div class="info">

<b>Gender</b>

<br>

<?=Html::encode(
$patient->gender
)?>

</div>




<div class="info">

<b>Blood Group</b>

<br>

<?=Html::encode(
$patient->blood_group ?? 'Not Recorded'
)?>

</div>



</div>


</div>












<div class="card">


<div class="card-title">

👨‍⚕️ Doctor Information

</div>




<div class="grid">



<div class="info">

<b>Doctor</b>

<br>

<?=Html::encode(
$doctor->username ?? 'Unknown'
)?>

</div>




<div class="info">

<b>Consultation Date</b>

<br>

<?=Html::encode(
$model->created_at
)?>

</div>




<div class="info">

<b>Queue ID</b>

<br>

<?=Html::encode(
$model->queue_id
)?>

</div>



</div>


</div>









<div class="card">


<div class="card-title">

❤️ Clinical Examination

</div>





<div class="vital-box">



<div class="vital">

<h3>

🩸 Blood Pressure

</h3>


<?=Html::encode(
$model->blood_pressure ?? 'Not Recorded'
)?>

</div>





<div class="vital">

<h3>

🌡 Temperature

</h3>


<?=Html::encode(
$model->temperature ?? 'Not Recorded'
)?>

</div>





<div class="vital">

<h3>

😷 Complaint

</h3>


<?=Html::encode(
$model->complaint ?? 'Not Recorded'
)?>

</div>



</div>





<br>


<div class="info">


<b>

Diagnosis

</b>


<br>


<?=Html::encode(
$model->diagnosis ?? 'Not Recorded'
)?>



</div>





<br>



<div class="info">


<b>

Doctor Notes

</b>


<br>


<?=Html::encode(
$model->notes ?? 'No notes'
)?>



</div>





</div>














<div class="card">


<div class="card-title">

⚕️ Doctor Actions

</div>





<div class="actions">



<?=Html::a(

"🧪 Send To Laboratory",

[

'send-lab',

'id'=>$model->id

],

[

'class'=>'btn lab'

]

)?>







<?=Html::a(

"💊 Create Prescription",

[

'prescription',

'id'=>$model->id

],

[

'class'=>'btn prescription'

]

)?>








<?=Html::a(

"✏️ Update",

[

'update',

'id'=>$model->id

],

[

'class'=>'btn update'

]

)?>









<?=Html::a(

"🗑 Delete",

[

'delete',

'id'=>$model->id

],

[

'class'=>'btn delete',

'data-method'=>'post',

'data-confirm'=>'Delete this medical record?'

]

)?>








<?=Html::a(

"⬅ Back",

[

'index'

],

[

'class'=>'btn back'

]

)?>






</div>


</div>







</div>