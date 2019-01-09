<?php

namespace console\controllers;

use common\models\Relationship;
use common\models\User;
use yii\console\Controller;
use yii\console\ExitCode;

class SeedController extends Controller
{
    public function actionDummyUsers(){
        $faker = \Faker\Factory::create();

        $count = 0;

        for ( $i = 0; $i < 5; $i++ )
        {
            $user = new User();

            $user->username = $faker->userName;
            $user->nickname = $user->username;
            $user->setPassword($faker->password);
            $user->generateAuthKey();
            $user->email = $faker->email;

            if (  $user->save() ){
                echo ++$count. " success\n";
            }
        }

        echo "Import success $count users, unsuccess ". (5 - $count) . " users.";
    }

    public function actionDummyRelationship(){
        $list_relationship = [
            [
                'user_id' => 1,
                'other_id' => 2,
                'status' => Relationship::STATUS_ACCEPTED
            ],
            [
                'user_id' => 2,
                'other_id' => 1,
                'status' => Relationship::STATUS_ACCEPTED
            ],
            [
                'user_id' => 1,
                'other_id' => 3,
                'status' => Relationship::STATUS_ACCEPTED
            ],
            [
                'user_id' => 3,
                'other_id' => 1,
                'status' => Relationship::STATUS_ACCEPTED
            ],
            [
                'user_id' => 1,
                'other_id' => 4,
                'status' => Relationship::STATUS_WAITED
            ],
            [
                'user_id' => 4,
                'other_id' => 1,
                'status' => Relationship::STATUS_PENDING
            ],
            [
                'user_id' => 1,
                'other_id' => 5,
                'status' => Relationship::STATUS_BLOCKED
            ],
            [
                'user_id' => 5,
                'other_id' => 1,
                'status' =>Relationship::STATUS_BE_BLOCKED
            ],
            [
                'user_id' => 1,
                'other_id' => 6,
                'status' => Relationship::STATUS_DECLINED
            ],
            [
                'user_id' => 6,
                'other_id' => 1,
                'status' =>Relationship::STATUS_DECLINED
            ],
        ];

        $i = 0; $count = 0;

        foreach ($list_relationship as $rel){
            echo ++$i . "\n";

            $relationship = new Relationship();
            $relationship->user_id = $rel['user_id'];
            $relationship->other_id = $rel['other_id'];
            $relationship->status = $rel['status'];

            if ($relationship->save())
                $count++;
        }

        echo "Import success $count relationships, fail ". ($i - $count) . " rels";
    }
}