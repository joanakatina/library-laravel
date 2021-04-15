<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Author;

class AuthorsController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        //SELECT * from authors order by last_name
        $authors = Author::all()->sortBy("last_name");   // naudojam modelį Author; ši eilutė įvykdo SQL užklausą "SELECT * FROM `authors`"; taip pat išrūšiuojam autorius pagal pavardę
        return view('user.authors.index', compact('authors'));
    }
}
