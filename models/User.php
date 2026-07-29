<?php

declare(strict_types=1);

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;



class User extends ActiveRecord implements IdentityInterface
{


    public static function tableName()
    {
        return 'users';
    }






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
                    'username'
                ],
                'required'
            ],



            [
                [
                    'email'
                ],
                'email'
            ],




            [
                [
                    'role_id',
                    'status'
                ],
                'safe'
            ],




            [
                [
                    'role_id',
                    'created_by'
                ],
                'integer'
            ],




            [
                [
                    'username',
                    'email'
                ],
                'string',
                'max'=>255
            ],



        ];

    }









    /*
    |--------------------------------------------------------------------------
    | IDENTITY METHODS
    |--------------------------------------------------------------------------
    */



    public static function findIdentity($id): ?static
    {

        return static::find()

            ->where([
                'id'=>$id
            ])

            ->andWhere([
                '!=',
                'status',
                'Deleted'
            ])

            ->one();

    }









    public static function findIdentityByAccessToken($token,$type=null): ?static
    {

        return static::findOne([

            'access_token'=>$token

        ]);

    }









    public function getId(): int|string
    {

        return $this->id;

    }









    public function getAuthKey(): ?string
    {

        return $this->auth_key ?? null;

    }









    public function validateAuthKey($authKey): bool
    {

        return $this->getAuthKey()===$authKey;

    }











    /*
    |--------------------------------------------------------------------------
    | PASSWORD
    |--------------------------------------------------------------------------
    */


    public function validatePassword($password): bool
    {


        if(empty($this->password_hash))
        {
            return false;
        }



        return Yii::$app
            ->security
            ->validatePassword(

                $password,

                $this->password_hash

            );


    }









    public function setPassword($password)
    {


        $this->password_hash =

            Yii::$app
            ->security
            ->generatePasswordHash(
                $password
            );


    }












    /*
    |--------------------------------------------------------------------------
    | ROLE RELATION
    |--------------------------------------------------------------------------
    */



    public function getRole()
    {


        return $this->hasOne(

            Role::class,

            [
                'id'=>'role_id'
            ]

        );


    }











    public function getRoleName()
    {


        return $this->role

            ?

            $this->role->role_name

            :

            'No Role';


    }









    /*
    |--------------------------------------------------------------------------
    | ROLE CHECKING
    |--------------------------------------------------------------------------
    */



    public function hasRole($role): bool
    {


        return strtolower(
            $this->getRoleName()
        )

        ===

        strtolower($role);


    }









    public function isAdmin(): bool
    {


        return in_array(

            $this->getRoleName(),

            [

                'Admin',
                'Super Admin'

            ]

        );


    }








    public function isDoctor(): bool
    {


        return $this->hasRole(
            'Doctor'
        );


    }









    public function isLaboratory(): bool
    {


        return $this->hasRole(
            'Laboratory Technician'
        );


    }









    public function isReceptionist(): bool
    {


        return $this->hasRole(
            'Receptionist'
        );


    }













    /*
    |--------------------------------------------------------------------------
    | DISPLAY
    |--------------------------------------------------------------------------
    */


    public function getDisplayName()
    {


        return $this->full_name

            ??

            $this->username;


    }









    /*
    |--------------------------------------------------------------------------
    | STATUS
    |--------------------------------------------------------------------------
    */



    public function getStatusLabel()
    {


        return match($this->status)
        {


            'Active'=>

                '🟢 Active',


            'Inactive'=>

                '⚪ Inactive',


            'Blocked'=>

                '🔴 Blocked',


            default=>

                'Unknown'


        };


    }











    /*
    |--------------------------------------------------------------------------
    | AUTO TIMESTAMP
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

                $this->status='Active';

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
    | API RESPONSE
    |--------------------------------------------------------------------------
    */



    public function fields()
    {


        return [


            'id',


            'username',


            'full_name',


            'email',


            'status',


            'role'=>function($model)
            {

                return $model->roleName;

            }


        ];


    }







}