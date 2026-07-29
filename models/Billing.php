<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

class Billing extends ActiveRecord
{

    /*
    |--------------------------------------------------------------------------
    | TABLE
    |--------------------------------------------------------------------------
    */

    public static function tableName()
    {
        return 'billing';
    }

    /*
    |--------------------------------------------------------------------------
    | BILLING STATUS
    |--------------------------------------------------------------------------
    */

    const STATUS_UNPAID    = 'Unpaid';
    const STATUS_PARTIAL   = 'Partial';
    const STATUS_PAID      = 'Paid';
    const STATUS_CANCELLED = 'Cancelled';

    /*
    |--------------------------------------------------------------------------
    | PAYMENT STATUS
    |--------------------------------------------------------------------------
    */

    const PAYMENT_PENDING = 'Pending';
    const PAYMENT_PARTIAL = 'Partial';
    const PAYMENT_PAID    = 'Paid';
    const PAYMENT_FAILED  = 'Failed';

    /*
    |--------------------------------------------------------------------------
    | PAYMENT METHODS
    |--------------------------------------------------------------------------
    */

    const METHOD_CASH         = 'Cash';
    const METHOD_CARD         = 'Card';
    const METHOD_BANK         = 'Bank';
    const METHOD_MOBILE_MONEY = 'Mobile Money';
    const METHOD_INSURANCE    = 'Insurance';

    /*
    |--------------------------------------------------------------------------
    | VALIDATION RULES
    |--------------------------------------------------------------------------
    */

    public function rules()
    {
        return [

            [
                [
                    'visit_id',
                    'service_name',
                    'amount'
                ],
                'required'
            ],

            [
                [
                    'patient_id',
                    'visit_id',
                    'created_by'
                ],
                'integer'
            ],

            [
                [
                    'amount',
                    'discount',
                    'tax',
                    'total_amount'
                ],
                'number'
            ],

            [
                [
                    'description'
                ],
                'string'
            ],

            [
                [
                    'service_name'
                ],
                'string',
                'max' => 255
            ],

            [
                [
                    'status',
                    'payment_status',
                    'payment_method'
                ],
                'string',
                'max' => 50
            ],

        [
    [
        'created_at',
        'updated_at'
    ],
    'safe'
]

];
}

    /*
    |--------------------------------------------------------------------------
    | ATTRIBUTE LABELS
    |--------------------------------------------------------------------------
    */

    public function attributeLabels()
    {
        return [

            'patient_id'     => 'Patient',
            'visit_id'       => 'Visit',
            'service_name'   => 'Service',
            'description'    => 'Description',
            'amount'         => 'Amount',
            'discount'       => 'Discount',
            'tax'            => 'Tax',
            'total_amount'   => 'Total Amount',
            'payment_status' => 'Payment Status',
            'payment_method' => 'Payment Method',
            'status'         => 'Billing Status',
            'created_by'     => 'Cashier',
            'created_at'     => 'Created',
            'updated_at'     => 'Updated',

        ];
    }

    /*
    |--------------------------------------------------------------------------
    | BEFORE SAVE
    |--------------------------------------------------------------------------
    */

    public function beforeSave($insert)
    {
        if (!parent::beforeSave($insert)) {
            return false;
        }

        $amount   = (float) ($this->amount ?? 0);
        $discount = (float) ($this->discount ?? 0);
        $tax      = (float) ($this->tax ?? 0);

        $this->total_amount = ($amount - $discount) + $tax;

        if ($insert) {

            if (empty($this->payment_status)) {
                $this->payment_status = self::PAYMENT_PENDING;
            }

            if (empty($this->status)) {
                $this->status = self::STATUS_UNPAID;
            }

            if (empty($this->payment_method)) {
                $this->payment_method = self::METHOD_CASH;
            }

            if (
                $this->hasAttribute('created_by') &&
                empty($this->created_by) &&
                !Yii::$app->user->isGuest
            ) {
                $this->created_by = Yii::$app->user->id;
            }

            if (
                $this->hasAttribute('created_at') &&
                empty($this->created_at)
            ) {
                $this->created_at = date('Y-m-d H:i:s');
            }
        }

        if ($this->hasAttribute('updated_at')) {
            $this->updated_at = date('Y-m-d H:i:s');
        }

        return true;
    }
    /*
    |--------------------------------------------------------------------------
    | PATIENT RELATION
    |--------------------------------------------------------------------------
    */

    public function getPatient()
    {
        return $this->hasOne(
            Patient::class,
            [
                'id' => 'patient_id'
            ]
        );
    }

    /*
    |--------------------------------------------------------------------------
    | VISIT RELATION
    |--------------------------------------------------------------------------
    */

    public function getVisit()
    {
        return $this->hasOne(
            PatientVisits::class,
            [
                'id' => 'visit_id'
            ]
        );
    }

    /*
    |--------------------------------------------------------------------------
    | CASHIER RELATION
    |--------------------------------------------------------------------------
    */

    public function getCreatedBy()
    {
        return $this->hasOne(
            User::class,
            [
                'id' => 'created_by'
            ]
        );
    }

    /*
    |--------------------------------------------------------------------------
    | PAYMENTS
    |--------------------------------------------------------------------------
    */

    public function getPayments()
    {
        return $this->hasMany(
            Payment::class,
            [
                'billing_id' => 'id'
            ]
        );
    }

    /*
    |--------------------------------------------------------------------------
    | PATIENT NAME
    |--------------------------------------------------------------------------
    */

    public function getPatientName()
    {
        if (!$this->patient) {
            return 'Unknown Patient';
        }

        if (
            !empty($this->patient->first_name) ||
            !empty($this->patient->last_name)
        ) {
            return trim(
                ($this->patient->first_name ?? '') .
                ' ' .
                ($this->patient->last_name ?? '')
            );
        }

        if (isset($this->patient->full_name)) {
            return $this->patient->full_name;
        }

        return 'Unknown Patient';
    }

    /*
    |--------------------------------------------------------------------------
    | CASHIER NAME
    |--------------------------------------------------------------------------
    */

    public function getCashierName()
    {
        if (!$this->createdBy) {
            return 'Unknown Cashier';
        }

        return
            $this->createdBy->username
            ??
            $this->createdBy->email
            ??
            'Cashier';
    }

    /*
    |--------------------------------------------------------------------------
    | FORMATTED AMOUNT
    |--------------------------------------------------------------------------
    */

    public function getFormattedAmount()
    {
        return number_format(
            (float)$this->amount,
            2
        );
    }

    /*
    |--------------------------------------------------------------------------
    | FORMATTED TOTAL
    |--------------------------------------------------------------------------
    */

    public function getFormattedTotal()
    {
        return number_format(
            (float)$this->total_amount,
            2
        );
    }

    /*
    |--------------------------------------------------------------------------
    | STATUS BADGE
    |--------------------------------------------------------------------------
    */

    public function getStatusBadge()
    {
        $badges = [

            self::STATUS_UNPAID =>
                '<span class="badge bg-danger">Unpaid</span>',

            self::STATUS_PARTIAL =>
                '<span class="badge bg-warning">Partial</span>',

            self::STATUS_PAID =>
                '<span class="badge bg-success">Paid</span>',

            self::STATUS_CANCELLED =>
                '<span class="badge bg-secondary">Cancelled</span>',

        ];

        return
            $badges[$this->status]
            ??
            '<span class="badge bg-dark">Unknown</span>';
    }

    /*
    |--------------------------------------------------------------------------
    | PAYMENT BADGE
    |--------------------------------------------------------------------------
    */

    public function getPaymentBadge()
    {
        $badges = [

            self::PAYMENT_PENDING =>
                '<span class="badge bg-warning">Pending</span>',

            self::PAYMENT_PARTIAL =>
                '<span class="badge bg-info">Partial</span>',

            self::PAYMENT_PAID =>
                '<span class="badge bg-success">Paid</span>',

            self::PAYMENT_FAILED =>
                '<span class="badge bg-danger">Failed</span>',

        ];

        return
            $badges[$this->payment_status]
            ??
            '<span class="badge bg-dark">Unknown</span>';
    }

    /*
    |--------------------------------------------------------------------------
    | PAYMENT HELPERS
    |--------------------------------------------------------------------------
    */

    public function isPaid()
    {
        return $this->payment_status === self::PAYMENT_PAID;
    }

    public function isPending()
    {
        return $this->payment_status === self::PAYMENT_PENDING;
    }

    public function markAsPaid()
    {
        $this->payment_status = self::PAYMENT_PAID;
        $this->status = self::STATUS_PAID;

        return $this->save(false);
    }

   public function markAsCancelled()
{
    $this->status = self::STATUS_CANCELLED;
    $this->payment_status = self::PAYMENT_FAILED;

    return $this->save(false);
}

}