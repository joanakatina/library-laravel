<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $table = 'books';
    protected $fillable = ['title', 'description', 'isbn', 'year', 'pages', 'quantity', 'price', 'cover', 'publisher_id', 'genre_id'];

    public function publisher()
    {
        return $this->belongsTo(Publisher::class)->withDefault();
    }

    public function genre()
    {
        return $this->belongsTo(Genre::class)->withDefault();
    }

    public function authors()
    {
        return $this->belongsToMany(Author::class, 'books_authors', 'book_id', 'author_id');
    }

    public function orders()
    {
        return $this->belongsToMany(Order::class, 'orders', 'book_id', 'user_id');
    }
}
