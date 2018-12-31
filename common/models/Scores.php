<?php

namespace common\models;


use yii\helpers\ArrayHelper;
use Yii;


class Scores extends base\Scores
{

    /**
     * Lấy ra một mảng chứa thông tin về top điểm cao toàn bộ game trong tuần này
     *
     * @return array ActiveRecord Objects
     */
    public static function getLeaderBoardsByWeek(){
        $list = self::find()
            ->join('left outer join',
                'scores s2',
                'scores.user_id = s2.user_id and scores.game_id = s2.game_id and scores.score<s2.score')
            ->andWhere([
                ['not', ['s2.user_id' => null] ],
                'WEEK (scores.created_at) = WEEK( current_date )',
                'YEAR( scores.created_at ) = YEAR( current_date )'
            ])
            ->orderBy([
                'scores.id' => SORT_ASC
            ])
            ->all();

        return $list;
    }

    /**
     * Lấy ra một mảng chứa thông tin về top điểm cao toàn bộ game trong tháng này
     *
     * @return array ActiveRecord Objects
     */
    public static function getLeaderBoardsByMonth(){
        $list = self::find()
            ->join('left outer join',
                'scores s2',
                'scores.user_id = s2.user_id and scores.game_id = s2.game_id and scores.score<s2.score')
            ->andWhere([
                ['not', ['s2.user_id' => null] ],
                'MONTH (scores.created_at) = MONTH( current_date )',
                'YEAR( scores.created_at ) = YEAR( current_date )'
            ])
            ->orderBy([
                'scores.id' => SORT_ASC
            ])
            ->all();

        return $list;
    }

    /**
     * Lấy ra một mảng chứa thông tin về top điểm cao toàn bộ game trong năm nay
     *
     * @return array ActiveRecord Objects
     */
    public static function getLeaderBoardsByYear(){
        $list = self::find()
            ->join('left outer join',
                'scores s2',
                'scores.user_id = s2.user_id and scores.game_id = s2.game_id and scores.score<s2.score')
            ->andWhere([
                ['not', ['s2.user_id' => null] ],
                'YEAR( scores.created_at ) = YEAR( current_date )'
            ])
            ->orderBy([
                'scores.id' => SORT_ASC
            ])
            ->all();

        return $list;
    }

    /**
     * Lấy ra một mảng chứa thông tin về top 10 điểm cao của game dựa trên game_id trong tuần này
     *
     * @param int $game_id
     *
     * @return array ActiveRecord Objects
     */
    public static function getTopGameScoresByWeek($game_id){
        $list = self::find()
            ->innerJoin('user','scores.user_id = user.id')
            ->andWhere([
                'scores.game_id' => $game_id,
                'WEEK (scores.created_at) = WEEK( current_date )',
                'YEAR( scores.created_at ) = YEAR( current_date )'
            ])
            ->orderBy([
                'scores.score' => SORT_DESC,
                'scores.created_at' => SORT_ASC
            ])
            ->limit(10)
            ->all();

        return $list;
    }

    /**
     * Lấy ra một mảng chứa thông tin về top 10 điểm cao của game dựa trên game_id trong tháng này
     *
     * @param int $game_id
     *
     * @return array ActiveRecord Objects
     */
    public static function getTopGameScoresByMonth($game_id){
        $list = self::find()
            ->innerJoin('user','scores.user_id = user.id')
            ->andWhere([
                'scores.game_id' => $game_id,
                'MONTH (scores.created_at) = MONTH( current_date )',
                'YEAR( scores.created_at ) = YEAR( current_date )'
            ])
            ->orderBy([
                'scores.score' => SORT_DESC,
                'scores.created_at' => SORT_ASC
            ])
            ->limit(10)
            ->all();

        return $list;
    }

    /**
     * Lấy ra một mảng chứa thông tin về top 10 điểm cao của game dựa trên game_id trong năm nay
     *
     * @param int $game_id
     *
     * @return array ActiveRecord Objects
     */
    public static function getTopGameScoresByYear($game_id){
        $list = self::find()
            ->innerJoin('user','scores.user_id = user.id')
            ->andWhere([
                'scores.game_id' => $game_id,
                'YEAR( scores.created_at ) = YEAR( current_date )'
            ])
            ->orderBy([
                'scores.score' => SORT_DESC,
                'scores.created_at' => SORT_ASC
            ])
            ->limit(10)
            ->all();

        return $list;
    }

    /**
     * Lấy ra một mảng chứa thông tin về top điểm cao của mình và bạn bè trong một game nhất định
     *
     * @param int $game_id
     *
     * @return array ActiveRecord Objects
     */
    public static function getFriendsTopScore($game_id){
        $friends = Relationship::getFriendsList();
        $friends_list = ArrayHelper::merge(
            ArrayHelper::getColumn($friends, 'friend_id'),
            Yii::$app->user->identity->getId()
        );

        $list = self::find()
            ->join('left outer join',
                'scores s2',
                'scores.user_id = s2.user_id and scores.game_id = s2.game_id and scores.score<s2.score')
            ->andWhere([
                'scores.game_id' => $game_id,
                'scores.user_id' => $friends_list,
                ['not', ['s2.user_id' => null] ],
            ])
            ->orderBy([
                'score' => SORT_DESC,
            ])
            ->all();

        return $list;
    }


}