<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    use HasFactory;

    protected $table = 'authors';
    protected $fillable = ['first_name', 'middle_name', 'last_name', 'gender'];

    public function books()
    {
        return $this->belongsToMany(Book::class, 'books_authors', 'author_id', 'book_id');
    }
}
