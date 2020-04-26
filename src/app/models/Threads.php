<?php
use DenchikBY\MongoDB\Model;

class Threads extends Model
{
    protected static $casts = [
        'pinned' => 'boolean',
        'locked' => 'boolean',
        'deleted' => 'boolean',
        'root' => 'id',
        'user_id' => 'id',
        'subforum_id' => 'id',
    ];

    public static $relations = [
        'subforum'     => [Subforums::class, 'one',  'subforum_id', '_id'],
        'user'     => [Users::class, 'one',  'user_id', '_id'],
        'replies'     => [Threads::class, 'many',  '_id', 'root'],
        'thread'     => [Threads::class, 'one', 'root',  '_id'],
    ];
    
    public function beforeCreate()
    {
        $this->created_at = $this->updated_at  = time();
        
    }
    public function afterCreate()
    {
        $id = $this->root;
        if (isset($id)) {
            Threads::findById($id)->update(["updated_at"=>$this->created_at]);
        }
    }
}