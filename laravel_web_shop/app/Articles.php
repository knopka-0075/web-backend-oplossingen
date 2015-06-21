<?php namespace App;

use App\Articles;
use Illuminate\Database\Eloquent\Model;

class Articles extends Model{   

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
    protected $table = 'articles';
	protected $fillable = [
		'content',
		'categorie_id'
		
	];

	/**
	 * Returns a formatted post content entry,
	 * this ensures that line breaks are returned.
	 *
	 * @return string
	 */
	public function content()
	{
		return nl2br($this->content);
	}

	/**
	 * Returns a formatted post content entry,
	 * this ensures that line breaks are returned.
	 *
	 * @return string
	 */
	public function introduction()
	{
		return nl2br($this->introduction);
	}

	/**
	 * Get the post's author.
	 *
	 * @return User
	 */
	public function author()
	{
		return $this->belongsTo('App\User', 'user_id');
	}

	// коллекция, вернёт все жанры выбранной книги
	
	public function categorie()
	{
		return $this->belongsToMany('App\Categorie');
	}
 
}


