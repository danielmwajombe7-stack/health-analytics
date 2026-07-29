# 🏥Myles Health Analytics System (MHAS)

<p align="center">
    <img src="https://www.yiiframework.com/image/design/logo/yii2.svg" width="180" alt="Yii2 Framework">
</p>

<h1 align="center">
Health Analytics System
</h1>

<p align="center">
A Modern Hospital Management & Clinical Analytics Platform Built with Yii2 Framework
</p>


<p align="center">

![PHP](https://img.shields.io/badge/PHP-8.2-blue?style=for-the-badge&logo=php)

![Yii2](https://img.shields.io/badge/Yii2-Framework-green?style=for-the-badge)

![MySQL](https://img.shields.io/badge/MySQL-Database-orange?style=for-the-badge&logo=mysql)

![Bootstrap](https://img.shields.io/badge/Bootstrap-5-purple?style=for-the-badge&logo=bootstrap)

![GitHub](https://img.shields.io/badge/GitHub-Version_Control-black?style=for-the-badge&logo=github)

</p>


---

# 📌 About The Project

**Health Analytics System (HAS)** is a modern Hospital Management Information System designed to digitize healthcare operations, improve patient care workflows, and provide real-time clinical analytics.

The platform integrates all major hospital departments into one connected workflow:

```
Patient Registration
        |
        ↓
Nursing Assessment
        |
        ↓
Doctor Consultation
        |
        ↓
Laboratory Investigation
        |
        ↓
Pharmacy Management
        |
        ↓
Billing
        |
        ↓
Admission / Discharge
```

The system is built using **Yii2 MVC Architecture**, PHP 8.2+, MySQL/MariaDB, Bootstrap 5 and modern web technologies.


---

# 🚀 Main Features


# 👥 User Management

Supported system roles:

- Super Administrator
- Hospital Administrator
- Receptionist
- Nurse
- Doctor
- Laboratory Technician
- Pharmacist
- Cashier
- Radiologist
- Store Keeper


Features:

- User authentication
- Role-based access control
- Permission management
- Activity tracking
- Audit logs


---

# 🏥 Patient Management

Features:

- Patient registration
- Patient profiles
- Medical history
- Visit records
- Emergency information
- Patient tracking
- Patient queue management


---

# 👩‍⚕️ Nursing Module

Includes:

- Patient queue management
- Vital signs recording
- Temperature
- Blood pressure
- Pulse rate
- Oxygen saturation
- Nurse clinical notes
- Patient monitoring


---

# 👨‍⚕️ Doctor Module

Features:

- Doctor worklist
- Consultation queue
- Clinical assessment
- Diagnosis management
- Clinical notes
- Prescription creation
- Laboratory requests
- Treatment planning


---

# 🧪 Laboratory Management

Includes:

- Laboratory test requests
- Sample tracking
- Laboratory workflow
- Results management
- Test history
- Doctor result review


---

# 💊 Pharmacy Management

Features:

- Prescription processing
- Medicine inventory
- Dispensing management
- Stock monitoring
- Medicine tracking


---

# 💰 Billing System

Includes:

- Invoice generation
- Payment processing
- Billing history
- Revenue reports
- Financial tracking


---

# 🛏 Admission & Discharge Management

Features:

- Patient admission
- Ward management
- Recovery tracking
- Discharge summaries
- Patient outcome records


---

# 📊 Analytics Dashboard

Health Analytics System provides healthcare intelligence dashboards:

Features:

- Total patient statistics
- Daily patient flow
- Department performance
- Clinical activity monitoring
- Disease analytics
- Revenue insights
- Patient risk indicators
- Hospital workflow analytics


---

# 🏗 System Architecture

Health Analytics System follows MVC Architecture:


```
                User Interface

                      |

                      ↓

               Controllers

                      |

                      ↓

                  Models

                      |

                      ↓

                Database
```


Hospital workflow architecture:


```
Reception
    |
    ↓
Nurse
    |
    ↓
Doctor
    |
    ↓
Laboratory
    |
    ↓
Pharmacy
    |
    ↓
Billing
    |
    ↓
Discharge
```


---

# 🛠 Technology Stack


## Backend

- PHP 8.2+
- Yii2 Framework
- MVC Architecture


## Database

- MySQL
- MariaDB


## Frontend

- HTML5
- CSS3
- Bootstrap 5
- JavaScript
- Chart.js


## Development Tools

- XAMPP
- Composer
- Git
- GitHub
- Visual Studio Code


---

# 📋 Database Modules


Main database tables include:


```
users
roles
departments

patients
patient_visits
patient_queue

appointments

medical_records
vital_signs

diagnoses

prescriptions

lab_requests
lab_results
lab_tests

medicines

billing

admissions
recoveries
discharges

audit_logs
```


---

# 📂 Project Structure


```
health-analytics/

├── assets/
├── commands/
├── config/
├── controllers/
├── migrations/
├── models/
├── runtime/
├── tests/
├── vendor/
├── views/
├── web/
│
├── composer.json
├── yii
└── README.md
```


---

# ⚙ Installation


## Requirements

Before installation make sure you have:


- PHP >= 8.2
- Composer
- MySQL/MariaDB
- XAMPP


---

## Clone Repository


```bash
git clone https://github.com/danielmwajombe7-stack/health-analytics.git
```


Move into project:


```bash
cd health-analytics
```


---

## Install Dependencies


```bash
composer install
```


---

# 🗄 Database Configuration


Edit:


```
config/db.php
```


Example:


```php
return [
    'class' => 'yii\db\Connection',
    'dsn' => 'mysql:host=localhost;dbname=health_analytics',
    'username' => 'root',
    'password' => '',
    'charset' => 'utf8',
];
```


Import database:


```
health_analytics.sql
```


---

# ▶ Running The System


Start XAMPP:

```
Apache
MySQL
```


Open browser:


```
http://localhost/health-analytics/web/
```


---

# 🔐 Security Features


Implemented security:

- User authentication
- Password hashing
- Role Based Access Control
- Permission management
- Audit logging
- Secure database access


---

# 🚀 Future Improvements


Planned upgrades:


- AI Disease Prediction
- Machine Learning Patient Risk Analysis
- Mobile Application
- SMS Notification System
- Telemedicine Support
- IoT Vital Monitoring
- AI Clinical Decision Support
- Hospital Digital Twin


---

# 👨‍💻 Developer


**Daniel Melick Mwajombe**

Health Analytics System Project


---

# 📄 License


This project is developed for healthcare management, hospital automation and analytics purposes.