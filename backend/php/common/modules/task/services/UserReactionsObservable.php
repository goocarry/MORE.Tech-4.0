<?php

namespace common\modules\task\services;

use common\modules\blog\models\BlogUserReaction;
use common\modules\task\models\Task;

class UserReactionsObservable
{
    protected $observers = [];

    protected function notify(BlogUserReaction $blogUserReaction)
    {
        foreach ($this->observers as $observer) {
            $observer->onUserReact($blogUserReaction);
        }
    }

    public function attach(Task $observer)
    {
        $this->observers[] = $observer;
    }

    public function userReacted(BlogUserReaction $blogUserReaction)
    {
        $this->notify($blogUserReaction);
    }
}
