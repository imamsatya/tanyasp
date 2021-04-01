<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Question;
use App\Kabupaten;
// use Auth;
class ForumController extends Controller
{
    //
    public function index2()
    {
        $questions = new Question;
         $questions = $questions->where('status', '1')->get();
         
        return view('home2', compact('questions'));
    }

    public function store(Request $request)
    {
        // dd($request);
        $kabupaten = new Kabupaten;
        $kabupaten = $kabupaten->where('nama_kabupaten_kota', $request->kabupaten_kota)->first();

        
        $question = new Question;
        // $question->judul = $request->judul;
        $question->siapa = $request->siapa;
        $question->kabupaten_kota_id = $kabupaten->id;
        $question->pertanyaan = $request->pertanyaan;
        $question->status = 0;
        $question->save();

    }
}
