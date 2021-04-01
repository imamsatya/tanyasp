<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Auth;

use App\Question;
use App\Kabupaten;
use App\User;
use DB;
use Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // dd('a');
           $user = Auth::user();
             $questions = new Question;
         $questions = $questions->where('kabupaten_kota_id', $user->kabupaten_id);
         if ($user->kabupaten_id == 14) {
              $questions = new Question;
            $questions = $questions->get();
         }

         if ($user->kabupaten_id == 2 || $user->kabupaten_id == 3) {
             $questions = new Question;
            $questions = $questions->where('kabupaten_kota_id', [2,3])->get();
         }
        
         if ( $user->kabupaten_id == 6 || $user->kabupaten_id == 7 ) {
             $questions = new Question;
            $questions = $questions->where('kabupaten_kota_id', [6,7])->get();
         }

     
            
            
        

        //  dd($questions);
        return view('home', compact('questions', 'user'));
    }

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
        $question->judul = $request->judul;
        $question->siapa = $request->siapa;
        $question->kabupaten_kota_id = $kabupaten->id;
        $question->pertanyaan = $request->pertanyaan;
        $question->status = 0;
        $question->save();

    }

     public function jawabanStore(Request $request)
    {
        // dd($request);
        $kabupaten = new Kabupaten;
        $kabupaten = $kabupaten->where('nama_kabupaten_kota', $request->kabupaten_kota)->first();
        
        
        $question = new Question;
        $question = $question->where('id', $request->id)->first();
        $question->jawaban = $request->jawaban;
        $question->status = 1;
        $question->save();

    }

     public function get_user(){
         $user = Auth::user();
        //  $role= $user->jabatan->role;
         
    //      return response()->json([
    // $user, $role]);

    return response()->json([
    $user]);
    }

     public function gantiPassword(Request $request)
    {   
        $user=Auth::user();
        $db_user= new User;
        $db_user= $db_user->where('id', $user->id)->first();
        // dd($request->input('password_lama'));
        if(Hash::check($request->input('password_lama'), $user->password)){
            $db_user->password = Hash::make($request->input('password_baru'));
            $db_user->save();
            return 'berhasil';
        }else{
            return 'gagal';
        }
        
    }

      public function logout(){
          \Auth::logout();

        return redirect()->route('login');
    }

    public function settings(){

        return view('settings');
    }

     public function about(){

        return view('about');
    }

}
