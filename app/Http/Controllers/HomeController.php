<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    use HasRoles;
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        if (Auth::user()->hasRole(['admin', 'librarian'])) {
            return redirect('/admin');
        }
        else {
            return redirect('/');
        }
    }
}
