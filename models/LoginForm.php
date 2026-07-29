<?php

declare(strict_types=1);

namespace app\models;

use Yii;
use yii\base\Model;


/**
 * Login Form
 */
class LoginForm extends Model
{


    public string $username = '';

    public string $password = '';

    public bool $rememberMe = true;


    private ?User $_user = null;





    public function rules(): array
    {

        return [

            [
                [
                    'username',
                    'password'
                ],
                'required'
            ],



            [
                'rememberMe',
                'boolean'
            ],



            [
                'password',
                'validatePassword'
            ]

        ];

    }









    public function validatePassword(
        $attribute,
        $params
    )
    {


        if(!$this->hasErrors())
        {


            $user = $this->getUser();



            if(
                !$user ||
                !$user->validatePassword($this->password)
            )
            {

                $this->addError(
                    $attribute,
                    'Incorrect username/email or password.'
                );

            }


        }


    }










    public function login(): bool
    {


        if($this->validate())
        {


            return Yii::$app->user->login(

                $this->getUser(),

                $this->rememberMe
                    ? 3600 * 24 * 30
                    : 0

            );


        }



        return false;


    }









    /**
     * Find by username OR email
     */
    public function getUser(): ?User
    {


        if($this->_user === null)
        {


            $this->_user = User::find()

                ->where([

                    'username'=>$this->username

                ])

                ->orWhere([

                    'email'=>$this->username

                ])

                ->one();


        }



        return $this->_user;


    }



}