<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ToDoUser extends Model
{
    protected $table = 'todousers';
    public $primaryKey = 'u_id';
    
}
