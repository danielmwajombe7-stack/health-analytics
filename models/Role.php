<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;



class Role extends ActiveRecord
{


    public static function tableName()
    {

        return 'roles';

    }








    /*
    |--------------------------------------------------------------------------
    | ROLE CONSTANTS
    |--------------------------------------------------------------------------
    */


    const SUPER_ADMIN =
        'Super Admin';


    const ADMIN =
        'Admin';


    const DOCTOR =
        'Doctor';


    const NURSE =
        'Nurse';


    const RECEPTIONIST =
        'Receptionist';


    const LAB_TECHNICIAN =
        'Laboratory Technician';


    const PHARMACIST =
        'Pharmacist';


    const CASHIER =
        'Cashier';


    const RADIOLOGIST =
        'Radiologist';


    const STORE_KEEPER =
        'Store Keeper';









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
                    'role_name'
                ],
                'required'
            ],




            [
                [
                    'role_name'
                ],
                'string',
                'max'=>100
            ],




            [
                [
                    'description'
                ],
                'string'
            ],




            [
                [
                    'status'
                ],
                'safe'
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
    | USERS RELATION
    |--------------------------------------------------------------------------
    */


    public function getUsers()
    {


        return $this->hasMany(

            User::class,

            [
                'role_id'=>'id'
            ]

        );


    }











    /*
    |--------------------------------------------------------------------------
    | BEFORE SAVE
    |--------------------------------------------------------------------------
    */


    public function beforeSave($insert)
    {


        if(!parent::beforeSave($insert))
        {

            return false;

        }







        if($insert)
        {


            if($this->hasAttribute('status')
                &&
                empty($this->status))
            {

                $this->status =
                    'Active';

            }






            if($this->hasAttribute('created_at'))
            {

                $this->created_at =
                    date(
                        'Y-m-d H:i:s'
                    );

            }


        }








        if($this->hasAttribute('updated_at'))
        {

            $this->updated_at =
                date(
                    'Y-m-d H:i:s'
                );

        }






        return true;


    }













    /*
    |--------------------------------------------------------------------------
    | ROLE CHECK METHODS
    |--------------------------------------------------------------------------
    */



    public function isAdmin()
    {


        return in_array(

            $this->role_name,

            [

                self::SUPER_ADMIN,

                self::ADMIN

            ]

        );


    }








    public function isMedicalStaff()
    {


        return in_array(

            $this->role_name,

            [

                self::DOCTOR,

                self::NURSE,

                self::LAB_TECHNICIAN,

                self::PHARMACIST,

                self::RADIOLOGIST

            ]

        );


    }









    public function canAccess($module)
    {


        $permissions = [



            self::SUPER_ADMIN => [

                'all'

            ],




            self::ADMIN => [

                'users',
                'patients',
                'reports',
                'settings'

            ],




            self::DOCTOR => [

                'patients',
                'diagnosis',
                'prescription',
                'laboratory'

            ],




            self::NURSE => [

                'patients',
                'vitals',
                'queue'

            ],




            self::LAB_TECHNICIAN => [

                'laboratory'

            ],




            self::PHARMACIST => [

                'pharmacy'

            ],




            self::CASHIER => [

                'billing'

            ],




            self::RECEPTIONIST => [

                'registration',
                'appointments',
                'queue'

            ]



        ];





        return in_array(

            $module,

            $permissions[$this->role_name]
            ??

            []

        )

        ||

        in_array(

            'all',

            $permissions[$this->role_name]
            ??

            []

        );


    }













    /*
    |--------------------------------------------------------------------------
    | DISPLAY
    |--------------------------------------------------------------------------
    */


    public function getBadge()
    {


        return match($this->role_name)
        {


            self::SUPER_ADMIN =>

                '👑 Super Admin',



            self::ADMIN =>

                '🛡 Admin',



            self::DOCTOR =>

                '👨‍⚕️ Doctor',



            self::NURSE =>

                '👩‍⚕️ Nurse',



            self::LAB_TECHNICIAN =>

                '🧪 Laboratory',



            self::PHARMACIST =>

                '💊 Pharmacy',



            self::CASHIER =>

                '💰 Cashier',



            self::RECEPTIONIST =>

                '📝 Reception',



            default =>

                $this->role_name



        };


    }












    /*
    |--------------------------------------------------------------------------
    | API FIELDS
    |--------------------------------------------------------------------------
    */


    public function fields()
    {


        return [


            'id',


            'role_name',


            'description',


            'status',


            'usersCount'=>function($model)
            {

                return count($model->users);

            }


        ];


    }








}