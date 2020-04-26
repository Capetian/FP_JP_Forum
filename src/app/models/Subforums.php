<?php

use DenchikBY\MongoDB\Model;

class Subforums extends Model
{
    public static $relations = [
        'threads'     => [Threads::class, 'many', '_id', 'subforum_id'],
    ];

}