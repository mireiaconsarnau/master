<?php

namespace App\Http\Controllers;

use App\TestUpload;
use App\Task;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\TestRepository;
use Illuminate\Support\Facades\Gate;
use PhpParser\Node\Expr\Cast\String_;
use Input;

use Stevebauman\Location\Facades\Location;

use Validator;

class TestUploadController extends Controller
{
    /**
     * The test repository instance.
     *
     * @var TestRepository
     */
    protected $tests;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(TestRepository $tests)
    {
        $this->middleware('auth');

        $this->tests = $tests;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (Gate::denies('see-user-menu')) {
            abort(403);
        }

        return view('tests.index', [
            'tests' => $this->tests->forUser($request->user()),
            'available_tasks' => Task::available($request->user())->orderBy('created_at')->get(),
            //'available_tasks' => Task::available(),

        ]);


    }




    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Create a new train.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        if (Gate::denies('see-user-menu')) {
            abort(403);
        }

        $this->validate($request, [
            'file_test' => 'required',
            'task_id' => 'required',
        ]);

        $file = Input::file('file_test');
        $destinationPath = storage_path() . '/uploads/testfiles';

        if(!$file->move($destinationPath, $file->getClientOriginalName())) {
            return $this->errors(['message' => 'Error saving the file.', 'code' => 400]);
        }

        $location = Location::get($_SERVER["REMOTE_ADDR"]);
        $request->user()->tests()->create([
            'file_test' => storage_path().'/uploads/testfiles'.$file->getClientOriginalName(),
            'name_test' => $file->getClientOriginalName(),
            'task_id' => $request->task_id,
            'ip' => $location->ip,
            'countryCode' => $location->countryCode,
            'countryName' => $location->countryName,
            'cityName' => $location->cityName,
        ]);

        return redirect('/tests');




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



    public function update(Request $request, $test)
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
    public function destroy(Request $request, TestUpload $test)
    {
        if (Gate::denies('see-user-menu')) {
            abort(403);
        }
        $this->authorize('destroy', $test);

        $test->delete();

        return redirect('/tests');
    }

    public function download($fileId){
        $entry = TestUpload::where('id', '=', $fileId)->firstOrFail();
        $pathToFile=storage_path()."/uploads/testfiles/".$entry->name_test;
        return response()->download($pathToFile);
    }
}
