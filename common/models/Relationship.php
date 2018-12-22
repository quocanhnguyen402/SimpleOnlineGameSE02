<?php

namespace common\models;


use yii\helpers\ArrayHelper;
use Yii;


class Relationship extends base\Relationship
{
    const STATUS_PENDING = 0;
    const STATUS_ACCEPTED = 1;
    const STATUS_DECLINED = 2;
    const STATUS_BLOCKED = 3;
    const STATUS_BE_BLOCKED = 4;

    public function getFriend(Relationship $rel){
        if (Yii::$app->user->identity->getId() === $rel->user_id){
            return $rel->user_id;
        } else {
            return $rel->other_id;
        }
    }

    public function getFriendsList(){
        $user_id = Yii::$app->user->identity->getId();

        $list = self::findAll([
            'status' => self::STATUS_ACCEPTED,
            'user_id' => $user_id
        ])->orderBy('username');

        return $list;
    }

    public function getFriendsRequest(){
        $user_id = Yii::$app->user->identity->getId();

        $list = self::findAll([
            'status' => self::STATUS_PENDING,
            'user_id' => $user_id
        ])->orderBy("created_at desc");

        return $list;
    }

    public function getBlackList(){
        $user_id = Yii::$app->user->identity->getId();

        $list = self::findAll([
            'status' => self::STATUS_BLOCKED,
            'user_id' => $user_id
        ])->orderBy("created_at");

        return $list;
    }

    public function getRelationship($other_id){
        $user_id = Yii::$app->user->identity->getId();

        $rel = self::findOne([
            'user_id' => $user_id,
            'other_id' => $other_id
        ]);

        if ($rel === null)
            return false;
        return $rel->status;
    }

    public function addFriendRequest(User $other){
        $user_id = Yii::$app->user->identity->getId();
        $other_id = $other->id;

        $rel_1 = new Relationship();
        $rel_1->user_id = $user_id;
        $rel_1->other_id = $other_id;
        $rel_1->status = self::STATUS_PENDING;

        $rel_2 = new Relationship();
        $rel_2->user_id = $other_id;
        $rel_2->other_id = $user_id;
        $rel_2->status = self::STATUS_PENDING;

        return $rel_1->save() && $rel_2->save();

    }

    public function acceptFriendRequest(User $other) {
        $user_id = Yii::$app->user->identity->getId();
        $other_id = $other->id;

        $rel_1 = Relationship::findOne([
            'user_id' => $user_id,
            'other_id' => $other_id,
            'status' => self::STATUS_PENDING
        ]);
        $rel_1->status = self::STATUS_ACCEPTED;

        $rel_2 = Relationship::findOne([
            'user_id' => $other_id,
            'other_id' => $user_id,
            'status' => self::STATUS_PENDING
        ]);
        $rel_2->status = self::STATUS_ACCEPTED;

        return $rel_1->save() && $rel_2->save();
    }
}