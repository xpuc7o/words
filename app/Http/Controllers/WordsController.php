<?php


namespace App\Http\Controllers;

use App\Domain\GeneratesWords;


class WordsController extends Controller
{

    public function index()
    {
        return view('welcome');
    }

    public function store()
    {
        $words = (new GeneratesWords)->handle();

        return redirect('/')->with('words', $words);
    }
}
