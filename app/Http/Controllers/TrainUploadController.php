<?php

namespace App\Http\Controllers;



use App\Repositories\TrainRepository;
use App\TrainUpload;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\TrainRepositoryRepository;
USE Symfony\Component\HttpFoundation\File\UploadedFile;

class TrainUploadController extends Controller
{
    /**
     * The train repository instance.
     *
     * @var TrainRepository
     */
    protected $trains;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(TrainRepository $trains)
    {
        $this->middleware('auth');

        $this->trains = $trains;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return view('trains.index', [
            'trains' => $this->trains->forUser($request->user()),
        ]);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Create a new task.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'file_train' => 'required',

        ]);

        $file = $request->file('file_train');
        if ($request->hasFile('file_train')) {
            //
        }
        if ($request->file('file_train')->isValid()) {
            //
        }
        $request->file('photo')->move($destinationPath, $fileName);

        return redirect('/trains');
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Destroy the given train.
     *
     * @param  Request  $request
     * @param  TrainUpload  $train
     * @return Response
     */
    public function destroy(Request $request, TrainUpload $train)
    {
        $this->authorize('destroy', $train);

        $train->delete();

        return redirect('/trains');
    }
}
