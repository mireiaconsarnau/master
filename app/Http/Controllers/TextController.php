<?php

namespace App\Http\Controllers;



use App\Task;
use App\User;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\TaskRepository;
use Illuminate\Support\Facades\Gate;

use Illuminate\Support\Facades\Session;
use PhpParser\Node\Expr\Cast\String_;



class TextController extends Controller
{

    //protected $texts;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');

        //$this->texts = $texts;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (Gate::denies('see-admin-menu')) {
            abort(403);
        }

        return view('texts.index');


    }




}
