<?php
use DenchikBY\MongoDB\Model;

class Threads extends Model
{
    public static $relations = [
        'subforum'     => [Subforums::class, 'one',  'subforum_id', '_id'],
        'user'     => [Users::class, 'one',  'user_id', '_id'],
        'replies'     => [Threads::class, 'many',  '_id', 'root'],
        'thread'     => [Threads::class, 'one', 'root',  '_id'],
    ];

}