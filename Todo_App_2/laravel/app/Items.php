<?php namespace App;

use App\Items;
use Illuminate\Database\Eloquent\Model;

class Items extends Model{   

	public $timestamps = false;

	protected $table = 'items';
 
}