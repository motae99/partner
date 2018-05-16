<?php
namespace api\common\controllers;
use \Yii as Yii;
use api\models\User;
use api\common\models\Register;
use api\common\models\Patient;

// use api\common\models\Profile;
use yii\db\Expression;
use \Unifonic\API\Client;



class RegisterController extends \api\components\ActiveController
{
    public $modelClass = '\api\common\models\Register';

    public function accessRules()
    {
        return [
            [
                'allow' => true,
                'actions' => [
                    'code',
                    'verify',
                    'create',
                ],
                'roles' => ['?'],
            ],
           
        ];
    }

    public function actions(){
        $actions = parent::actions();
        unset($actions['index']);
        unset($actions['view']);
        unset($actions['create']);
        unset($actions['update']);
        unset($actions['delete']);
        return $actions;
    }

    public function actionCode(){
        $body = json_decode(Yii::$app->getRequest()->getRawBody(), true);
        if ($body['phone_no']) {
            $user = User::find()->where(['email' => $body['phone_no']])->one();
            if ($user) {
                return array('success' => 0, 'massege' => 'User is already registered');
            }else{
                $client = new Client();
                $no = $body['phone_no'];
                $response = $client->Verify->GetCode($no , 'لتأكيد الأشتراك الرجاء ادخال الرقم التالي', 'OTP');
                return array('success' => 1 ,'response' => $response);
            }
        
        }else{
            return array('success' => 0, 'massege' => 'phone_no is required');
  
        }

    }

    public function actionVerify(){
        $body = json_decode(Yii::$app->getRequest()->getRawBody(), true);
        if ($body['phone_no'] && $body['code']) {
            $client = new Client();
            $no = $body['phone_no'];
            $code = $body['code'];
            // if ($response) {
            $response = $client->Verify->VerifyNumber($no, $code);
            return array('response' => $response);
        }
        // }else{
        //     return array('success' => 0, 'massege' => 'username & password are required');
  
        // }

    }

    public function actionCreate(){
        $body = json_decode(Yii::$app->getRequest()->getRawBody(), true);
        if (isset($body['phone_no']) && isset($body['password']) && isset($body['gender']) && isset($body['dob']) && isset($body['name'])) {
            $user = User::find()->where(['email' => $body['phone_no']])->one();
            if ($user) {
                return array('success' => 0, 'massege' => 'User is already registered');
                die();
            }
            $user = new User();
            $user->email = $body['phone_no'];
            $user->password = $body['password'];
            $user->generateAuthKey();
            $flag = $user->save();

            $patient = new Patient();
            $patient->name = $body['name'];
            $patient->contact_no = $body['phone_no'];
            $patient->gender = $body['gender'];
            $patient->dob = $body['dob'];
            if (isset($body['martial_status'])) {
                $patient->martial_status = $body['martial_status'];
            }
            if (isset($body['insurance_id']) && isset($body['insurance_no']) && isset($body['valid_till'])) {
                $patient->insurance_id = $body['insurance_id'];
                $patient->insurance_no = $body['insurance_no'];
                $patient->valid_till = $body['valid_till'];
                $patient->has_insurance = 1;
            }else{
                $patient->has_insurance = 0;
            }
            
            $patient->created_by = $user->id;
            $flag2 = $patient->save();
            
            if ($flag2 && $flag) {
                return array('success' => 1, 'data' => $patient);
            }else{
                return array('success' => 0, 'massege' => 'something went wrong please call me');
            }
        }else{
            return array('success' => 0, 'massege' => 'phone_no, password, gender, dob & name are required | martial_status & (insurance_id, insurance_no & valid_till) are optional');
  
        }

    }

}