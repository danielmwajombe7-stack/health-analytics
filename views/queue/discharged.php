<?php

use yii\grid\GridView;

$this->title="Discharged Patients";

?>

<h2>🚑 Discharged Patients</h2>

<?= GridView::widget([

'dataProvider'=>$dataProvider,

'columns'=>[

'id',

[
'label'=>'Patient',

'value'=>function($model){

return $model->patient->first_name." ".$model->patient->last_name;

}

],

'queue_time'

]

]); ?>