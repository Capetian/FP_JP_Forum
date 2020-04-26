<?php

use DenchikBY\MongoDB\Model;
use Phalcon\Di;

class Users extends Model
{
    public static $relations = [
        'threads'     => [Threads::class, 'many', '_id',  'user_id'],
    ];


}