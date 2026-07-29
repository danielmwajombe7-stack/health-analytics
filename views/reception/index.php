<?php

use yii\helpers\Html;

$this->title = "Reception Dashboard";

?>


<div class="container-fluid">


<div class="d-flex justify-content-between align-items-center mb-4">


<div>

<h2>
🏥 Reception Dashboard
</h2>

<p class="text-muted">
Patient registration and queue management
</p>

</div>



<div>

<?= Html::a(
    '➕ Register Patient',
    [
        'register'
    ],
    [
        'class'=>'btn btn-success btn-lg'
    ]
) ?>


</div>



</div>







<div class="row">



<!-- TODAY PATIENTS -->

<div class="col-md-4">


<div class="card shadow border-0">


<div class="card-body">


<h6 class="text-muted">
Today's Patients
</h6>


<h1>

<?= $todayPatients ?>

</h1>


<p>
Registered today
</p>


</div>


</div>


</div>







<!-- WAITING -->

<div class="col-md-4">


<div class="card shadow border-0">


<div class="card-body">


<h6 class="text-muted">
Waiting Queue
</h6>


<h1>

<?= $waitingPatients ?>

</h1>


<p>
Patients waiting for doctor
</p>


</div>


</div>


</div>







<!-- CONSULTING -->

<div class="col-md-4">


<div class="card shadow border-0">


<div class="card-body">


<h6 class="text-muted">
Consulting
</h6>


<h1>

<?= $consultingPatients ?>

</h1>


<p>
Currently with doctor
</p>


</div>


</div>


</div>



</div>









<div class="card shadow border-0 mt-4">


<div class="card-header bg-success text-white">


<h4>
Quick Actions
</h4>


</div>




<div class="card-body">



<?= Html::a(
    '👤 Register New Patient',
    [
        'register'
    ],
    [
        'class'=>'btn btn-primary btn-lg me-2'
    ]
) ?>





<?= Html::a(
    '📋 View Doctor Queue',
    [
        'queue'
    ],
    [
        'class'=>'btn btn-warning btn-lg'
    ]
) ?>



</div>


</div>



</div>