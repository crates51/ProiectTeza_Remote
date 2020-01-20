<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;
use App\Clients;

class Bookings extends Model
{

 
    // use Searchable;
    //Table Name
    protected $table ='bookings';
    //Primary Key`
    public $primaryKey='bookingId';
    //Thimestamps
    public $timestamps=true;

    // $client = new Clients;


    public function user(){
    	return $this->belongsTo('App\User');
    }

    public function toSearchableArray()
{
    // $array = $this->toArray();

    // $array = $this->transform($array);

    // $array['author_name'] = $this->client->clientId;

    $this->categories;

    $array = $this->toArray();

    $array = $this->transform($array);

    return $array;
}
}
