<?php namespace App;

use App\Categories;
use Illuminate\Database\Eloquent\Model;

class Categories extends Model{   

	// таблица
    protected $table = 'categories';

    // заполняемые поля в админке (например)
    protected $fillable = [
        'title'
    ];
    // коллекция, вернёт все книги выбранного жанра
    public function articles()
    {
        return $this->belongsToMany('App\Articles');
    }
 
}