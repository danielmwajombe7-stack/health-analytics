<?php

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Patient Consultation - ' . Html::encode($queue->patient->first_name . ' ' . $queue->patient->last_name);
?>

<div class="patient-consultation-workspace container-fluid px-4 py-3">

    <!-- 1. TOP BREADCRUMB & NAVIGATION BAR -->
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div class="d-flex align-items-center gap-2">
            <?= Html::a(
                '<i class="bi bi-arrow-left"></i> Back to Command Center',
                ['index'],
                ['class' => 'btn btn-outline-secondary btn-sm rounded-pill px-3 fw-semibold']
            ) ?>
            <span class="text-muted">/</span>
            <span class="fw-bold text-dark fs-7">Consultation Workspace</span>
        </div>
        <div>
            <span class="badge bg-primary-soft text-primary rounded-pill px-3 py-2 fw-semibold">
                <i class="bi bi-hash"></i> Queue #<?= sprintf('%03d', $queue->id) ?>
            </span>
        </div>
    </div>

    <!-- 2. MAIN HEADER CARD -->
    <div class="card border-0 shadow-sm rounded-4 mb-4 bg-white overflow-hidden">
        <div class="card-body p-4">
            <div class="d-flex justify-content-between align-items-start flex-wrap gap-3">
                <div class="d-flex align-items-center gap-3">
                    <div class="patient-avatar bg-primary text-white fw-bold fs-3 rounded-circle d-flex align-items-center justify-content-center shadow-sm" style="width: 64px; height: 64px;">
                        <?= strtoupper(substr($queue->patient->first_name ?? 'P', 0, 1)) ?>
                    </div>
                    <div>
                        <div class="d-flex align-items-center gap-2">
                            <h2 class="fw-bold text-dark mb-0">
                                <?= Html::encode($queue->patient->first_name . ' ' . $queue->patient->last_name) ?>
                            </h2>
                            <span class="badge bg-success-soft text-success rounded-pill px-3 py-1 fs-8 fw-semibold">
                                <i class="bi bi-record-fill text-success me-1 pulse"></i> <?= Html::encode($queue->status) ?>
                            </span>
                        </div>
                        <p class="text-muted mb-0 fs-7">
                            <span class="me-3"><i class="bi bi-card-heading text-primary me-1"></i> <strong>ID:</strong> <?= Html::encode($queue->patient->patient_number ?? 'N/A') ?></span>
                            <span class="me-3"><i class="bi bi-person text-secondary me-1"></i> <strong>Gender:</strong> <?= ucfirst(Html::encode($queue->patient->gender ?? 'Not set')) ?></span>
                            <span><i class="bi bi-calendar3 text-info me-1"></i> <strong>Age:</strong> <?= Html::encode($queue->patient->age ?? 'Not set') ?> Yrs</span>
                        </p>
                    </div>
                </div>

                <div class="d-flex gap-2">
                    <?= Html::a(
                        '<i class="bi bi-folder2-open me-1"></i> Full Health Record',
                        ['medical-record', 'id' => $queue->patient_id],
                        ['class' => 'btn btn-light btn-sm rounded-pill px-3 border shadow-2xs fw-semibold text-secondary']
                    ) ?>
                    <?= Html::a(
                        '<i class="bi bi-check-lg me-1"></i> Complete Visit',
                        ['complete', 'id' => $queue->id],
                        ['class' => 'btn btn-success btn-sm rounded-pill px-3 shadow-sm fw-semibold']
                    ) ?>
                </div>
            </div>
        </div>
    </div>

    <!-- 3. VITALS & AI ROW -->
    <div class="row g-4 mb-4">

        <!-- VITALS DISPLAY (HORIZONTAL METRICS) -->
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm rounded-4 p-4 h-100 bg-white">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="fw-bold text-dark mb-0 d-flex align-items-center gap-2">
                        <i class="bi bi-heart-pulse-fill text-danger fs-5"></i> Current Patient Vitals
                    </h5>
                    <span class="text-muted fs-8">Recorded by Triage Nurse</span>
                </div>

                <div class="row g-3 my-auto">
                    <!-- Blood Pressure -->
                    <div class="col-sm-3 col-6">
                        <div class="p-3 rounded-4 bg-danger-soft text-center h-100 border border-danger-subtle">
                            <div class="text-danger-emphasis fs-8 fw-semibold mb-1"><i class="bi bi-activity"></i> Blood Pressure</div>
                            <h3 class="fw-extrabold text-danger mb-0">120/80</h3>
                            <small class="text-muted fs-8">mmHg</small>
                        </div>
                    </div>

                    <!-- Heart Rate -->
                    <div class="col-sm-3 col-6">
                        <div class="p-3 rounded-4 bg-primary-soft text-center h-100 border border-primary-subtle">
                            <div class="text-primary-emphasis fs-8 fw-semibold mb-1"><i class="bi bi-heart-fill"></i> Heart Rate</div>
                            <h3 class="fw-extrabold text-primary mb-0">78</h3>
                            <small class="text-muted fs-8">bpm</small>
                        </div>
                    </div>

                    <!-- Temperature -->
                    <div class="col-sm-3 col-6">
                        <div class="p-3 rounded-4 bg-warning-soft text-center h-100 border border-warning-subtle">
                            <div class="text-warning-emphasis fs-8 fw-semibold mb-1"><i class="bi bi-thermometer-half"></i> Temperature</div>
                            <h3 class="fw-extrabold text-warning mb-0">36.8</h3>
                            <small class="text-muted fs-8">°C</small>
                        </div>
                    </div>

                    <!-- Oxygen Saturation -->
                    <div class="col-sm-3 col-6">
                        <div class="p-3 rounded-4 bg-success-soft text-center h-100 border border-success-subtle">
                            <div class="text-success-emphasis fs-8 fw-semibold mb-1"><i class="bi bi-wind"></i> Oxygen (SpO2)</div>
                            <h3 class="fw-extrabold text-success mb-0">98%</h3>
                            <small class="text-muted fs-8">Normal</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- AI CLINICAL ASSISTANT PANEL -->
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm rounded-4 p-4 h-100 bg-white ai-card position-relative overflow-hidden">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <div class="d-flex align-items-center gap-2">
                        <div class="ai-icon bg-success text-white rounded-circle p-2 d-flex align-items-center justify-content-center" style="width:36px; height:36px;">
                            <i class="bi bi-robot fs-5"></i>
                        </div>
                        <h5 class="fw-bold mb-0 text-dark">AI Risk Triage</h5>
                    </div>
                    <span class="badge bg-success-soft text-success rounded-pill px-3 py-1 fs-8">92% Match</span>
                </div>

                <div class="alert alert-soft-info border-0 rounded-3 p-3 my-2">
                    <div class="fs-8 text-uppercase fw-bold text-info-emphasis mb-1">Possible Risk Analysis</div>
                    <div class="fw-bold text-dark fs-6">Respiratory Infection</div>
                    <div class="progress mt-2" style="height: 5px;">
                        <div class="progress-bar bg-info" role="progressbar" style="width: 92%;" aria-valuenow="92" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>

                <div class="mb-3">
                    <div class="fs-8 text-uppercase fw-bold text-muted mb-2">Suggested Next Steps</div>
                    <ul class="list-unstyled mb-0">
                        <li class="d-flex align-items-center gap-2 text-dark fs-7 mb-1">
                            <i class="bi bi-check-circle-fill text-success fs-7"></i> Blood Test (CBC Panel)
                        </li>
                        <li class="d-flex align-items-center gap-2 text-dark fs-7 mb-1">
                            <i class="bi bi-check-circle-fill text-success fs-7"></i> Digital Chest X-Ray
                        </li>
                        <li class="d-flex align-items-center gap-2 text-dark fs-7">
                            <i class="bi bi-check-circle-fill text-success fs-7"></i> Temperature Monitoring
                        </li>
                    </ul>
                </div>

                <button class="btn btn-success rounded-3 w-100 py-2 fw-semibold shadow-sm fs-7 mt-auto d-flex align-items-center justify-content-center gap-2">
                    <i class="bi bi-file-earmark-pdf"></i> Generate AI Diagnostic Report
                </button>
            </div>
        </div>

    </div>

    <!-- 4. QUICK CLINICAL ACTIONS GRID -->
    <div class="card border-0 shadow-sm rounded-4 p-4 mb-4 bg-white">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <div>
                <h5 class="fw-bold text-dark mb-0">⚡ Quick Clinical Actions</h5>
                <small class="text-muted">Direct workflow routing for patient care</small>
            </div>
        </div>

        <div class="row g-3">

            <!-- Start Diagnosis -->
            <div class="col-md-3 col-sm-6">
                <?= Html::a(
                    '<div class="d-flex align-items-center gap-3">
                        <div class="action-icon rounded-circle bg-primary text-white p-3"><i class="bi bi-stethoscope fs-4"></i></div>
                        <div class="text-start">
                            <div class="fw-bold text-dark">Start Diagnosis</div>
                            <small class="text-muted fs-8">Clinical notes & symptoms</small>
                        </div>
                    </div>',
                    ['consult', 'id' => $queue->id],
                    ['class' => 'card action-card border-0 shadow-2xs p-3 rounded-4 text-decoration-none bg-light h-100 d-flex justify-content-center']
                ) ?>
            </div>

            <!-- Laboratory Request -->
            <div class="col-md-3 col-sm-6">
                <?= Html::a(
                    '<div class="d-flex align-items-center gap-3">
                        <div class="action-icon rounded-circle bg-warning text-white p-3"><i class="bi bi-eyedropper fs-4"></i></div>
                        <div class="text-start">
                            <div class="fw-bold text-dark">Lab Requests</div>
                            <small class="text-muted fs-8">Order blood, radiology tests</small>
                        </div>
                    </div>',
                    ['lab-request', 'id' => $queue->id],
                    ['class' => 'card action-card border-0 shadow-2xs p-3 rounded-4 text-decoration-none bg-light h-100 d-flex justify-content-center']
                ) ?>
            </div>

            <!-- Prescription -->
            <div class="col-md-3 col-sm-6">
                <?= Html::a(
                    '<div class="d-flex align-items-center gap-3">
                        <div class="action-icon rounded-circle bg-success text-white p-3"><i class="bi bi-capsule fs-4"></i></div>
                        <div class="text-start">
                            <div class="fw-bold text-dark">Prescription</div>
                            <small class="text-muted fs-8">Issue pharmacy orders</small>
                        </div>
                    </div>',
                    ['prescription', 'id' => $queue->id],
                    ['class' => 'card action-card border-0 shadow-2xs p-3 rounded-4 text-decoration-none bg-light h-100 d-flex justify-content-center']
                ) ?>
            </div>

            <!-- Medical History -->
            <div class="col-md-3 col-sm-6">
                <?= Html::a(
                    '<div class="d-flex align-items-center gap-3">
                        <div class="action-icon rounded-circle bg-dark text-white p-3"><i class="bi bi-file-earmark-medical fs-4"></i></div>
                        <div class="text-start">
                            <div class="fw-bold text-dark">Medical Records</div>
                            <small class="text-muted fs-8">Past visit archives</small>
                        </div>
                    </div>',
                    ['medical-record', 'id' => $queue->patient_id],
                    ['class' => 'card action-card border-0 shadow-2xs p-3 rounded-4 text-decoration-none bg-light h-100 d-flex justify-content-center']
                ) ?>
            </div>

        </div>
    </div>

    <!-- 5. MEDICAL HISTORY TIMELINE -->
    <div class="card border-0 shadow-sm rounded-4 p-4 bg-white">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <div>
                <h5 class="fw-bold text-dark mb-0">📋 Patient Timeline & Previous Encounters</h5>
                <small class="text-muted">Historical diagnostic logs and interventions</small>
            </div>
            <span class="badge bg-light text-secondary border rounded-pill px-3 py-1 fs-8">Sorted by Date</span>
        </div>

        <div class="timeline-modern position-relative ps-4 ms-2">

            <!-- Item 1 -->
            <div class="timeline-item mb-4 position-relative">
                <div class="timeline-badge bg-primary text-white rounded-circle position-absolute d-flex align-items-center justify-content-center" style="width:28px; height:28px; left:-40px; top:0;">
                    <i class="bi bi-calendar-check fs-8"></i>
                </div>
                <div class="p-3 rounded-3 bg-light border-0">
                    <div class="d-flex justify-content-between align-items-center mb-1">
                        <strong class="text-dark fs-7">General OPD Patient Visit</strong>
                        <span class="badge bg-white text-muted border fs-8">2026</span>
                    </div>
                    <p class="mb-0 text-muted fs-7">Clinical assessment completed. Patient reported mild fever and prescribed standard antipyretics.</p>
                </div>
            </div>

            <!-- Item 2 -->
            <div class="timeline-item position-relative">
                <div class="timeline-badge bg-secondary text-white rounded-circle position-absolute d-flex align-items-center justify-content-center" style="width:28px; height:28px; left:-40px; top:0;">
                    <i class="bi bi-journal-medical fs-8"></i>
                </div>
                <div class="p-3 rounded-3 bg-light border-0">
                    <div class="d-flex justify-content-between align-items-center mb-1">
                        <strong class="text-dark fs-7">Previous Consultation & Treatment</strong>
                        <span class="badge bg-white text-muted border fs-8">2025</span>
                    </div>
                    <p class="mb-0 text-muted fs-7">Full routine checkup done. All vitals were within normal physiological limits.</p>
                </div>
            </div>

        </div>
    </div>

</div>

<!-- CSS STYLES FOR CONSULTATION VIEW -->
<style>
:root {
    --primary-soft: rgba(13, 110, 253, 0.1);
    --warning-soft: rgba(255, 193, 7, 0.15);
    --info-soft: rgba(13, 202, 240, 0.15);
    --danger-soft: rgba(220, 53, 69, 0.1);
    --success-soft: rgba(25, 135, 84, 0.1);
}

.patient-consultation-workspace {
    font-family: 'Inter', system-ui, -apple-system, sans-serif;
    background-color: #f8f9fa;
}

.bg-primary-soft { background-color: var(--primary-soft); }
.bg-warning-soft { background-color: var(--warning-soft); }
.bg-info-soft { background-color: var(--info-soft); }
.bg-danger-soft { background-color: var(--danger-soft); }
.bg-success-soft { background-color: var(--success-soft); }

.alert-soft-info {
    background-color: rgba(13, 202, 240, 0.08);
}

.action-card {
    transition: transform 0.2s ease, box-shadow 0.2s ease, background-color 0.2s ease;
}

.action-card:hover {
    transform: translateY(-4px);
    background-color: #ffffff !important;
    box-shadow: 0 10px 20px rgba(0,0,0,0.06) !important;
}

.ai-card {
    border: 1px solid rgba(25, 135, 84, 0.2) !important;
}

/* TIMELINE CUSTOM LINE */
.timeline-modern::before {
    content: '';
    position: absolute;
    top: 5px;
    bottom: 10px;
    left: -27px;
    width: 2px;
    background: #e2e8f0;
}

.pulse {
    animation: pulse-animation 1.5s infinite;
}

@keyframes pulse-animation {
    0% { opacity: 1; }
    50% { opacity: 0.4; }
    100% { opacity: 1; }
}

.fs-7 { font-size: 0.85rem; }
.fs-8 { font-size: 0.75rem; }
</style>