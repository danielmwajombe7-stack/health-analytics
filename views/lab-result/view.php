<?php

use yii\helpers\Html;
use yii\helpers\Url;


$this->title = "Laboratory Result Details";

?>


<style>


.result-page{

    padding:25px;

    min-height:100vh;

    background:#f5f8fa;

}



.result-card{

    background:white;

    border-radius:25px;

    padding:30px;

    box-shadow:
    0 10px 30px rgba(0,0,0,.08);

}



.result-header{

    background:
    linear-gradient(
        135deg,
        #00695c,
        #14b8a6
    );

    color:white;

    padding:25px;

    border-radius:20px;

    margin-bottom:25px;

}



.result-header h2{

    font-weight:900;

}



.info-box{

    background:#f8fafc;

    padding:20px;

    border-radius:15px;

    margin-bottom:20px;

}



.label{

    color:#64748b;

    font-weight:800;

}



.value{

    color:#0f172a;

    font-size:17px;

    font-weight:700;

}



.result-content{

    background:#ecfeff;

    padding:20px;

    border-radius:15px;

    border-left:6px solid #00695c;

}



.findings-box{

    background:#f0fdf4;

    padding:20px;

    border-radius:15px;

    border-left:6px solid #16a34a;

}



.btn-custom{

    border-radius:15px;

    padding:12px 20px;

    font-weight:800;

}



</style>





<div class="result-page">


<div class="result-card">





<div class="result-header">


<h2>

🧪 Laboratory Result Details

</h2>


<p>

Medical Laboratory Investigation Report

</p>


</div>









<div class="row">


<div class="col-md-6">


<div class="info-box">


<div class="label">

Test Name

</div>


<div class="value">

<?= Html::encode(

$model->testName ?? 'Unknown Test'

) ?>

</div>


</div>


</div>






<div class="col-md-6">


<div class="info-box">


<div class="label">

Status

</div>



<div class="value">


<?php


$status = $model->status ?? 'Pending';



$class = match($status){


    'Completed'=>'bg-success',

    'Processing'=>'bg-primary',

    default=>'bg-warning text-dark'


};


?>


<span class="badge <?= $class ?>">


<?= Html::encode($status) ?>


</span>


</div>


</div>


</div>



</div>









<h4>

🔬 Result

</h4>


<div class="result-content">


<?= nl2br(

Html::encode(

$model->result ?? 'No result available'

)

) ?>


</div>









<br>


<h4>

📋 Findings

</h4>


<div class="findings-box">


<?= nl2br(

Html::encode(

$model->findings ?? 'No findings recorded'

)

) ?>


</div>









<br>





<div class="row">


<div class="col-md-6">


<div class="info-box">


<div class="label">

Normal Range

</div>


<div class="value">


<?= Html::encode(

$model->normal_range ?? '-'

) ?>


</div>


</div>


</div>







<div class="col-md-6">


<div class="info-box">


<div class="label">

Created Date

</div>


<div class="value">


<?= Html::encode(

$model->created_at ?? '-'

) ?>


</div>


</div>


</div>



</div>









<h4>

📎 Attachment

</h4>




<?php if(!empty($model->attachment)): ?>


<?= Html::a(

'📂 Open Attachment',

Url::to(

'/uploads/lab/'.$model->attachment

),

[

'class'=>'btn btn-primary btn-custom',

'target'=>'_blank'

]

) ?>



<?php else: ?>


<div class="alert alert-secondary">

No attachment uploaded.

</div>


<?php endif; ?>









<hr>





<div>


<?= Html::a(

'⬅ Back',

['index'],

[

'class'=>'btn btn-secondary btn-custom'

]

) ?>






<?= Html::a(

'✏ Update Result',

[

'update',

'id'=>$model->id

],

[

'class'=>'btn btn-warning btn-custom'

]

) ?>






<?= Html::a(

'🗑 Delete',

[

'delete',

'id'=>$model->id

],

[

'class'=>'btn btn-danger btn-custom',

'data'=>[

'confirm'=>'Delete this laboratory result?',

'method'=>'post'

]

]

) ?>



</div>





</div>

</div>