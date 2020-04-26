<?php

use DenchikBY\MongoDB\Model;

class Users extends Model
{
    public static $relations = [
        'threads'     => [Threads::class, 'many', '_id',  'user_id'],
    ];

}