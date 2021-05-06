<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Author;
use App\Models\Book;
use App\Models\Genre;
use App\Models\Publisher;
use Illuminate\Http\Request;

class BooksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $books = Book::all();
        return view('admin.books.index', compact('books'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $authors = Author::selectRaw("id, CONCAT(COALESCE(first_name,''), ' ', COALESCE(middle_name,''), ' ', COALESCE(last_name,'')) AS name")
            ->orderBy('last_name', 'asc')
            ->pluck('name', 'id');
        $new_authors = [];
        $i = 0;
        foreach ($authors as $key => $author) {
            $new_authors[$i]['name'] = $author;
            $new_authors[$i]['value'] = $key;
            $i++;
        }

        $publishers = Publisher::pluck('title', 'id');      // sukuriamas knygų leidėjų masyvas iš publishers lentelės
        $publishers->prepend('---Please select---', 0);     // pirmo masyvo elemento reikšmė bus '---Please select---'
        $publishers->all();

        $genres = Genre::pluck('title', 'id');              // sukuriamas knygų žanrų masyvas iš genres lentelės
        $genres->prepend('---Please select---', 0);         // pirmo masyvo elemento reikšmė bus '---Please select---'
        $genres->all();

        $years = array_combine(range(date("Y"), 1900), range(date("Y"), 1900)); // sukuriamas asociatyvus metų masyvas nuo 1900 iki einamųjų metų
        $years = array('0' => '---Please select---') + $years;                                        // pirmo masyvo elemento reikšmė bus '---Please select---'

        // vaizdui perduodami visi keturi masyvai: autorių, leidėjų, žanrų ir metų
        // šie masyvai reikalingi tam, kad vaizde jų reikšmes galima būtų atvaizduoti Select arba Multiselect lauke
        return view('admin.books.form', compact('new_authors', 'publishers', 'genres', 'years'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'authors' => 'required',
            'isbn' => 'required|between:10,13',
            'year' => 'required',
            'pages' => 'required|integer',
            'quantity' => 'required|integer',
            'cover' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'publisher_id' => 'required',
            'genre_id' => 'required',
        ]);

        $data = $request->all();
        if ($request->hasFile('cover')) {
            //$fileName = time().'_'.$request->cover->getClientOriginalName(); // failo pavadinimas pvz. 1620283915_virselis.jpg
            $fileName = time().'.'.$request->cover->extension(); // failo pavadinimas pvz. 1620283915.jpg
            $request->cover->move(public_path('uploads/covers'), $fileName); // failas bus išsaugotas kataloge ..\library\public\uploads
            $data['cover'] = $fileName;
        }

        $book = Book::create($data);
        $authors_ids = rtrim($request->input('authors'), ";");
        $authors = explode(';', $authors_ids);
        $book->authors()->sync($authors);  // išsaugom atitinkamus ryšius lentelėje books_authors

        return redirect('admin/books')->with('success', 'Book added successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $book = Book::findOrFail($id);
        return view('admin.books.show', compact('book'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $book = Book::findOrFail($id);

        $authors = Author::selectRaw("id, CONCAT(COALESCE(first_name,''), ' ', COALESCE(middle_name,''), ' ', COALESCE(last_name,'')) AS name")
            ->orderBy('last_name', 'asc')
            ->pluck('name', 'id');
        $new_authors = [];
        $i = 0;
        foreach ($authors as $key => $author) {
            $new_authors[$i]['name'] = $author;
            $new_authors[$i]['value'] = $key;
            $i++;
        }

        $selected_authors[] = array();
        foreach ($book->authors as $author) {
            $selected_authors[] = $author->id;
        }

        $publishers = Publisher::pluck('title', 'id');
        $publishers->prepend('---Please select---', 0);
        $publishers->all();

        $genres = Genre::pluck('title', 'id');
        $genres->prepend('---Please select---', 0);
        $genres->all();

        $years = array_combine(range(date("Y"), 1900), range(date("Y"), 1900));
        $years = array('0' => '---Please select---') + $years;

        return view('admin.books.form', compact('book', 'new_authors', 'selected_authors', 'publishers', 'genres', 'years'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'authors' => 'required',
            'isbn' => 'required|between:10,13',
            'year' => 'required',
            'pages' => 'required|integer',
            'quantity' => 'required|integer',
            'cover' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'publisher_id' => 'required',
            'genre_id' => 'required',
        ]);

        $data = $request->all();
        $book = Book::findOrFail($id);

        if ($request->hasFile('cover')) {
            @unlink(public_path('uploads/covers/').$book->cover);
            //$fileName = time().'_'.$request->cover->getClientOriginalName(); // failo pavadinimas pvz. 1620283915_virselis.jpg
            $fileName = time().'.'.$request->cover->extension(); // failo pavadinimas pvz. 1620283915.jpg
            $request->cover->move(public_path('uploads/covers'), $fileName); // failas bus išsaugotas kataloge ..\library\public\uploads
            $data['cover'] = $fileName;
        }

        $book->update($data);
        //$authors = $request->input('authors');
        $authors_ids = rtrim($request->input('authors'), ";");
        $authors = explode(';', $authors_ids);
        $book->authors()->sync($authors);
        return redirect('admin/books')->with('success', 'Book updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $book = Book::findOrFail($id); // surandam knygą pagal jos id
        $book->authors()->detach(); // ištrinam atitinkamus ryšius lentelėje books_authors
        $book->delete(); // ištrinam pačią knygą
        return redirect('admin/books')->with('success', 'Book deleted successfully.');
    }
}
