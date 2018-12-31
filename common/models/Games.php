<?php

namespace common\models;

class Games extends base\Games
{
    /**
     * Lấy ra điểm cao nhất của game
     *
     * @param int $game_id
     *
     * @return  ActiveRecord|boolean   hoặc trả về AR Object, hoặc trả về false
     */
    public static function getHighestScore($game_id){
        $record = Scores::find()
            ->andWhere([
                'game_id' => $game_id
            ])
            ->orderBy([
                'scores.score' => SORT_DESC
            ])
            ->one();

        return $record?$record:false;
    }

}