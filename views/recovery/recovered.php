<?php

use yii\grid\GridView;

$this->title="Recovered Patients";

?>

<h2>✅ Recovered Patients</h2>

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