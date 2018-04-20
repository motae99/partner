<?php

use yii\db\Migration;
use \api\models\User;

class m150513_053633_add_dummy_user extends Migration
{
    public function up()
    {
		$user = new User();
		$user->id = 1;
		$user->email = 'taha@gmail.com';
		$user->password = '1111111';
		$user->generateAuthKey();
		$user->save();

		$user = new User();
		$user->id = 2;
		$user->email = 'user2@gmail.com';
		$user->password = '22222222';
		$user->generateAuthKey();
		$user->save();

		$user = new User();
		$user->id = 3;
		$user->email = 'user3@gmail.com';
		$user->password = '333333333';
		$user->generateAuthKey();
		$user->save();

		$user = new User();
		$user->id = 4;
		$user->email = 'user4@gmail.com';
		$user->password = '444444444';
		$user->generateAuthKey();
		$user->save();

		$user = new User();
		$user->id = 5;
		$user->email = 'user5@gmail.com';
		$user->password = '555555555';
		$user->generateAuthKey();
		$user->save();

		$user = new User();
		$user->id = 6;
		$user->email = 'user6@gmail.com';
		$user->password = '666666666';
		$user->generateAuthKey();
		$user->save();


    }

    public function down()
    {
		$user = User::find()->all();
		if (!empty($user)) {
			$user->delete();
		}
    }
}
