<?php namespace App;
use Illuminate\Database\Eloquent\Model;

class Size extends Model {
	/**
	 * The database table used by the model.
	 * 
	 * @var string
	 */
	protected $table = 'sizes';
	/**
	 * The fields that that are mass assignable.
	 * 
	 * @var [type]
	 */
	protected $fillable = [
		'size'
	];
	/**
	 * Get the products available in a given size
	 * 
	 * @return [type] [description]
	 */
	public function products()
	{
		return $this->belongsToMany('App\Articles');
	}
}