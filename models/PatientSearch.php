<?php

namespace app\models;

use yii\data\ActiveDataProvider;
use yii\base\Model;


/**
 * PatientSearch represents the model behind the search form of Patient.
 */
class PatientSearch extends Patient
{

    /**
     * Validation rules
     */
    public function rules()
    {
        return [

            [
                [
                    'id',
                    'created_by'
                ],
                'integer'
            ],


            [
                [
                    'patient_number',
                    'first_name',
                    'middle_name',
                    'last_name',
                    'gender',
                    'date_of_birth',
                    'phone',
                    'email',
                    'address',
                    'blood_group',
                    'marital_status',
                    'occupation',
                    'nationality',
                    'next_of_kin',
                    'next_of_kin_phone',
                    'insurance_type',
                    'insurance_number',
                    'created_at',
                    'updated_at'
                ],
                'safe'
            ],

        ];
    }



    /**
     * Disable scenarios
     */
    public function scenarios()
    {
        return Model::scenarios();
    }




    /**
     * Search patients
     */
    public function search($params, $formName = null)
    {


        $query = Patient::find();



        $dataProvider = new ActiveDataProvider([

            'query'=>$query,

            'pagination'=>[
                'pageSize'=>10
            ],

            'sort'=>[
                'defaultOrder'=>[
                    'id'=>SORT_DESC
                ]
            ]

        ]);




        $this->load($params,$formName);



        if(!$this->validate()){

            return $dataProvider;

        }




        $query->andFilterWhere([

            'id'=>$this->id,

            'created_by'=>$this->created_by,

            'date_of_birth'=>$this->date_of_birth,

            'created_at'=>$this->created_at,

            'updated_at'=>$this->updated_at,

        ]);




        $query
        ->andFilterWhere([
            'like',
            'patient_number',
            $this->patient_number
        ])


        ->andFilterWhere([
            'like',
            'first_name',
            $this->first_name
        ])


        ->andFilterWhere([
            'like',
            'middle_name',
            $this->middle_name
        ])


        ->andFilterWhere([
            'like',
            'last_name',
            $this->last_name
        ])


        ->andFilterWhere([
            'like',
            'phone',
            $this->phone
        ])


        ->andFilterWhere([
            'like',
            'gender',
            $this->gender
        ])


        ->andFilterWhere([
            'like',
            'blood_group',
            $this->blood_group
        ])


        ->andFilterWhere([
            'like',
            'insurance_number',
            $this->insurance_number
        ]);



        return $dataProvider;

    }

}