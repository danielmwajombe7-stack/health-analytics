<?php

use yii\helpers\Html;


$this->title="Update Patient";

?>


<h1>
✏ Update Patient
</h1>



<?= $this->render(

    '_form',

    [

        'model'=>$model

    ]

) ?>