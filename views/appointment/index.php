<?php

use yii\helpers\Html;

$this->title = "Appointments Management";

/* Get models from ActiveDataProvider */
$appointments = $dataProvider->getModels();

?>

<style>

body{
    background:linear-gradient(135deg,#ecfeff,#f8fafc)!important;
    font-family:'Inter','Segoe UI',sans-serif;
}

.app-page{
    padding:25px;
}

.app-header{
    background:linear-gradient(135deg,#0f766e,#115e59);
    padding:35px;
    border-radius:28px;
    color:#fff;
    box-shadow:0 20px 45px rgba(0,0,0,.18);
    display:flex;
    justify-content:space-between;
    align-items:center;
}

.app-header h1{
    margin:0;
    font-size:34px;
    font-weight:900;
}

.app-header p{
    color:#ccfbf1;
    margin-top:8px;
}

.new-btn{
    background:#fff;
    color:#0f766e!important;
    padding:14px 25px;
    border-radius:18px;
    font-weight:700;
    text-decoration:none;
}

.new-btn:hover{
    text-decoration:none;
    background:#f0fdfa;
}

.card-box{
    margin-top:30px;
    background:#fff;
    padding:25px;
    border-radius:25px;
    box-shadow:0 15px 40px rgba(0,0,0,.08);
}

.app-table{
    width:100%;
    border-collapse:separate;
    border-spacing:0 12px;
}

.app-table th{
    background:#ecfdf5;
    padding:15px;
    color:#065f46;
}

.app-table td{
    background:#fff;
    padding:18px;
    box-shadow:0 5px 20px rgba(0,0,0,.05);
}

.status{
    padding:7px 15px;
    border-radius:30px;
    font-size:12px;
    font-weight:700;
}

.pending{
    background:#fef3c7;
    color:#92400e;
}

.confirmed{
    background:#dbeafe;
    color:#1d4ed8;
}

.completed{
    background:#dcfce7;
    color:#166534;
}

.cancelled{
    background:#fee2e2;
    color:#991b1b;
}

.action-btn{
    margin-right:5px;
}

.empty-row{
    text-align:center;
    color:#888;
    font-weight:600;
    padding:30px;
}

</style>

<div class="app-page">

    <div class="app-header">

        <div>

            <h1>📅 Appointment Management</h1>

            <p>Manage patient appointments and hospital schedules.</p>

        </div>

        <?= Html::a(
            '➕ New Appointment',
            ['create'],
            ['class'=>'new-btn']
        ) ?>

    </div>

    <div class="card-box">

        <h3>📋 Appointment Records</h3>

        <p class="text-muted">
            Patient appointment history.
        </p>

        <table class="app-table">

            <thead>

            <tr>

                <th>#</th>

                <th>Patient</th>

                <th>Date</th>

                <th>Doctor</th>

                <th>Status</th>

                <th width="180">Action</th>

            </tr>

            </thead>

            <tbody>

            <?php if(!empty($appointments)): ?>

                <?php foreach($appointments as $i=>$appointment): ?>

                    <tr>

                        <td>
                            <?= $i+1 ?>
                        </td>

                        <td>

                            <?php

                            if($appointment->patient){

                                echo Html::encode(
                                    $appointment->patient->fullName
                                );

                            }else{

                                echo '<span class="text-danger">Unknown Patient</span>';

                            }

                            ?>

                        </td>

                        <td>

                            <?= Html::encode($appointment->appointment_date ?: 'N/A') ?>

                        </td>

                        <td>

                            <?php

                            if($appointment->doctor){

                                echo Html::encode($appointment->doctor->username);

                            }else{

                                echo "Not Assigned";

                            }

                            ?>

                        </td>

                        <td>

                            <?php

                            $status=strtolower($appointment->status ?? 'pending');

                            ?>

                            <span class="status <?= $status ?>">

                                <?= Html::encode($appointment->status ?? 'Pending') ?>

                            </span>

                        </td>

                        <td>

                            <?= Html::a(
                                '👁 View',
                                ['view','id'=>$appointment->id],
                                [
                                    'class'=>'btn btn-success btn-sm action-btn'
                                ]
                            ) ?>

                            <?= Html::a(
                                '✏ Update',
                                ['update','id'=>$appointment->id],
                                [
                                    'class'=>'btn btn-primary btn-sm action-btn'
                                ]
                            ) ?>

                            <?= Html::a(
                                '🗑 Delete',
                                ['delete','id'=>$appointment->id],
                                [
                                    'class'=>'btn btn-danger btn-sm',
                                    'data'=>[
                                        'confirm'=>'Delete this appointment?',
                                        'method'=>'post'
                                    ]
                                ]
                            ) ?>

                        </td>

                    </tr>

                <?php endforeach; ?>

            <?php else: ?>

                <tr>

                    <td colspan="6" class="empty-row">

                        No appointments found.

                    </td>

                </tr>

            <?php endif; ?>

            </tbody>

        </table>

    </div>

</div>