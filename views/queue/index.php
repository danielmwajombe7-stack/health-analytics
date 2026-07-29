<?php

use yii\grid\GridView;


$this->title="Patient Queue";


?>


<h2>
🏥 Patients Queue
</h2>



<?= GridView::widget([


'dataProvider'=>$dataProvider,


'columns'=>[


[
'class'=>'yii\grid\SerialColumn'
],



[
'label'=>'Patient',

'value'=>function($model){

return $model->patient
?
$model->patient->first_name." ".$model->patient->last_name
:
"Unknown";

}

],



[
'label'=>'Patient ID',

'value'=>'patient_id'

],



[
'attribute'=>'queue_number'
],



[
'attribute'=>'department'
],



[
'attribute'=>'priority'
],




[

'label'=>'Status',

'format'=>'raw',

'value'=>function($model){



if($model->status=="waiting")
{

return '<span class="badge bg-warning">
⏳ Waiting Doctor
</span>';

}



if($model->status=="consulting")
{

return '<span class="badge bg-success">
🩺 With Doctor
</span>';

}



if($model->status=="completed")
{

return '<span class="badge bg-primary">
✔ Completed
</span>';

}



}


],




[
'attribute'=>'arrival_time'
]



]


]);

?>