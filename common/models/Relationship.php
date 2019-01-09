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


//    public function getFriend(Relationship $rel){
//        if (Yii::$app->user->identity->getId() === $rel->user_id){
//            return $rel->user_id;
//        } else {
//            return $rel->other_id;
//        }
//    }

    /**
     * Lấy ra một mảng chứa thông tin về những user là bạn của user đang đăng nhập, được sắp xếp theo thứ tự alphabet
     *
     * @return array ActiveRecord Objects
     */
    public static function getFriendsList(){
        if (Yii::$app->user->identity)
            $user_id = Yii::$app->user->identity->getId();
        else
            return false;

        $list = self::find()
            ->andWhere([
                'relationship.status' => self::STATUS_ACCEPTED,
                'relationship.user_id' => $user_id
            ])
            ->innerJoin('user','relationship.user_id = user.id')
            ->orderBy('user.username')
            ->all();

        return $list;
    }

    /**
     * Lấy ra một mảng chứa thông tin về những user gửi yêu cầu kết bạn tói
     * user đang đăng nhập, được sắp xếp theo ngày tạo request giảm dần (updated_at giảm dần)
     *
     * @return array ActiveRecord Objects
     */
    public static function getFriendsRequest(){
        $user_id = Yii::$app->user->identity->getId();

        $list = self::find()
            ->andWhere([
                'status' => self::STATUS_PENDING,
                'user_id' => $user_id
            ])
            ->orderBy("updated_at desc")
            ->all();

        return $list;
    }

    /**
     * Lấy ra một mảng chứa thông tin về những user đã bị chặn bởi
     * user đang đăng nhập, được sắp xếp theo ngày bị chặn tăng dần (updated_at tăng dần)
     *
     * @return array ActiveRecord Objects
     */
    public static function getBlackList(){
        $user_id = Yii::$app->user->identity->getId();

        $list = self::find()
            ->andWhere([
                'status' => self::STATUS_BLOCKED,
                'user_id' => $user_id
            ])
            ->orderBy("created_at")
            ->all();

        return $list;
    }

    /**
     * Lấy ra trạng thái quan hệ giữa người dùng có user_id là $other_id
     * với cả người dùng đang đăng nhập hiện tại
     *
     * @param int $other_id
     *
     * @return boolean|int - hoặc là false, hoặc là trạng thái quan hệ
     */
    public static function getRelationship($other_id){
        $user_id = Yii::$app->user->identity->getId();

        $rel = self::findOne([
            'user_id' => $user_id,
            'other_id' => $other_id
        ]);

        if ($rel === null)
            return false;
        return $rel->status;
    }

    /**
     * Kết bạn với người dùng khác
     *
     * @param int $other_id - user_id của người dùng khác
     *
     * @return boolean
     */
    public static function addFriendRequest($other_id){
        $user_id = Yii::$app->user->identity->getId();
        if ($other_id == $user_id)
            return false;

        $rel_1 = self::findOne([
            'user_id' => $user_id,
            'other_id' => $other_id,
        ]);

        $rel_2 = self::findOne([
            'user_id' => $other_id,
            'other_id' => $user_id,
        ]);

        if (isset($rel_1) && isset($rel_2)){
            if ($rel_1->status != self::STATUS_DECLINED || $rel_2->status != self::STATUS_DECLINED ) {
                return false;
            }
        } else {
            $rel_1 = new Relationship();
            $rel_1->user_id = $user_id;
            $rel_1->other_id = $other_id;

            $rel_2 = new Relationship();
            $rel_2->user_id = $other_id;
            $rel_2->other_id = $user_id;
        }

        $rel_1->status = self::STATUS_PENDING;
        $rel_2->status = self::STATUS_PENDING;

        return $rel_1->save() && $rel_2->save();

    }

    /**
     *  Chấp nhận kết bạn với người dùng khác
     *
     * @param int $other_id - user_id của người dùng khác
     *
     * @return boolean
     */
    public static function acceptFriendRequest($other_id) {
        $user_id = Yii::$app->user->identity->getId();
        if ($other_id == $user_id)
            return false;

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

    /**
     * Từ chối yêu cầu kết bạn với người dùng khác
     *
     * @param int $other_id - user_id của người dùng khác
     *
     * @return boolean
     */
    public static function declineFriendRequest($other_id){
        $user_id = Yii::$app->user->identity->getId();
        if ($other_id == $user_id)
            return false;

        $rel_1 = Relationship::findOne([
            'user_id' => $user_id,
            'other_id' => $other_id,
            'status' => self::STATUS_PENDING
        ]);

        $rel_2 = Relationship::findOne([
            'user_id' => $other_id,
            'other_id' => $user_id,
            'status' => self::STATUS_PENDING
        ]);

        if ( !isset($rel_1) || !isset($rel_2))
            return false;

        $rel_1->status = self::STATUS_ACCEPTED;
        $rel_2->status = self::STATUS_ACCEPTED;

        return $rel_1->save() && $rel_2->save();
    }

    /**
     * Hủy kết bạn với người dùng khác
     *
     * @param int $other_id - user_id của người dùng khác
     *
     * @return boolean
     */
    public static function unfriend($other_id){
        $user_id = Yii::$app->user->identity->getId();
        if ($other_id == $user_id)
            return false;

        $rel_1 = Relationship::findOne([
            'user_id' => $user_id,
            'other_id' => $other_id,
            'status' => self::STATUS_ACCEPTED
        ]);

        $rel_2 = Relationship::findOne([
            'user_id' => $other_id,
            'other_id' => $user_id,
            'status' => self::STATUS_ACCEPTED
        ]);

        if ( !isset($rel_1) || !isset($rel_2))
            return false;

        $rel_1->status = self::STATUS_DECLINED;
        $rel_2->status = self::STATUS_DECLINED;

        return $rel_1->save() && $rel_2->save();

    }

    /**
     * Chặn người dùng khác
     *
     * @param int $other_id - user_id của người dùng khác
     *
     * @return boolean
     */
    public static function block($other_id){
        $user_id = Yii::$app->user->identity->getId();
        if ($other_id == $user_id)
            return false;

        $rel_1 = Relationship::findOne([
            'user_id' => $user_id,
            'other_id' => $other_id,
        ]);

        $rel_2 = Relationship::findOne([
            'user_id' => $other_id,
            'other_id' => $user_id,
        ]);

        if ( !isset($rel_1) || !isset($rel_2))
            return false;

        if ($rel_1->status == self::STATUS_BLOCKED || $rel_2->status == self::STATUS_BLOCKED)
            return false;

        $rel_1->status = self::STATUS_BLOCKED;
        $rel_2->status = self::STATUS_BE_BLOCKED;

        return $rel_1->save() && $rel_2->save();

    }

    /**
     * Hủy chặn người dùng khác
     *
     * @param int $other_id - user_id của người dùng khác
     *
     * @return boolean
     */
    public static function unblock($other_id) {
        $user_id = Yii::$app->user->identity->getId();
        if ($other_id == $user_id)
            return false;

        $rel_1 = Relationship::findOne([
            'user_id' => $user_id,
            'other_id' => $other_id,
            'status' => self::STATUS_BLOCKED
        ]);

        $rel_2 = Relationship::findOne([
            'user_id' => $other_id,
            'other_id' => $user_id,
            'status' => self::STATUS_BE_BLOCKED
        ]);

        if ( !isset($rel_1) || !isset($rel_2))
            return false;

        $rel_1->status = self::STATUS_DECLINED;
        $rel_2->status = self::STATUS_DECLINED;

        return $rel_1->save() && $rel_2->save();

    }


}