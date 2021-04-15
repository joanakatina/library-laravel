<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Publisher;
use App\Models\Genre;
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
        $publishers = Publisher::pluck('title', 'id');      // sukuriamas knygų leidėjų masyvas iš publishers lentelės
        $publishers->prepend('---Please select---', 0);     // pirmo masyvo elemento reikšmė bus '---Please select---'
        $publishers->all();

        $genres = Genre::pluck('title', 'id');              // sukuriamas knygų žanrų masyvas iš genres lentelės
        $genres->prepend('---Please select---', 0);         // pirmo masyvo elemento reikšmė bus '---Please select---'
        $genres->all();

        $years = array_combine(range(date("Y"), 1900), range(date("Y"), 1900)); // sukuriamas asociatyvus metų masyvas nuo 1900 iki einamųjų metų
        $years = array('0' => '---Please select---') + $years;                                        // pirmo masyvo elemento reikšmė bus '---Please select---'

        // vaizdui perduodami visi trys masyvai: leidėjų, žanrų ir metų
        // šie masyvai reikalingi tam, kad vaizde jų reikšmes galima būtų atvaizduoti <select> lauke
        return view('admin.books.form', compact('publishers', 'genres', 'years'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Book::create($request->all());
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
        $publishers = Publisher::pluck('title', 'id');
        $publishers->prepend('---Please select---', 0);
        $publishers->all();

        $genres = Genre::pluck('title', 'id');
        $genres->prepend('---Please select---', 0);
        $genres->all();

        $years = array_combine(range(date("Y"), 1900), range(date("Y"), 1900));
        $years = array('0' => '---Please select---') + $years;

        $book = Book::findOrFail($id);
        return view('admin.books.form', compact('book', 'publishers', 'genres', 'years'));
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
        $book = Book::findOrFail($id);
        $book->update($request->all());
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
        $book = Book::findOrFail($id);
        $book->delete();
        return redirect('admin/books')->with('success', 'Book deleted successfully.');
    }
}
