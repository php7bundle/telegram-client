<?php

namespace PhpBundle\TelegramClient\Repositories\Eloquent;

use PhpBundle\TelegramClient\Entities\UserTelegramEntity;
use PhpLab\Eloquent\Db\Base\BaseEloquentCrudRepository;

class UserTelegramRepository extends BaseEloquentCrudRepository
{

    public function tableName() : string
    {
        return 'user_telegram';
    }

    public function getEntityClass() : string
    {
        return UserTelegramEntity::class;
    }

}
