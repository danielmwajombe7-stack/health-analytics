<?php

use yii\helpers\Html;
use yii\grid\GridView;


$this->title = "Patient Queue";

?>


<div class="container">


<h2>
🏥 Patient Queue
</h2>



<?= GridView::widget([

'dataProvider'=>$dataProvider,


'columns'=>[


[
'label'=>'Queue No',
'value'=>function($model){

return $model->queue_number;

}
],


[
'label'=>'Patient Name',
'value'=>function($model){

return 
$model->patient->first_name.' '.
$model->patient->last_name;

}
],



'status',



'created_at',



[

'class'=>'yii\grid\ActionColumn',

'template'=>'{recover} {discharge}',


'buttons'=>[


'recover'=>function($url,$model){

return Html::a(

'✅ Recover',

[
'recover',
'id'=>$model->id
],

[
'class'=>'btn btn-success btn-sm',
'data-method'=>'post'

]

);

},



'discharge'=>function($url,$model){

return Html::a(

'🚪 Discharge',

[
'discharge',
'id'=>$model->id
],

[
'class'=>'btn btn-danger btn-sm',
'data-method'=>'post'

]

);

}



]


]


]


]);

?>


</div>