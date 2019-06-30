<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Clients extends Model
{
    // use Searchable;

	//Primary Key`
    public $primaryKey='clientId';    
}
