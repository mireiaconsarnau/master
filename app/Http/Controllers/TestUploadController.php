<?php

namespace App\Http\Controllers;

use App\TestUpload;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\TestRepository;
use Illuminate\Support\Facades\Gate;
use PhpParser\Node\Expr\Cast\String_;
use Input;
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
        ]);

        $file = Input::file('file_test');
        $destinationPath = storage_path() . '/uploads/testfiles';

        if(!$file->move($destinationPath, $file->getClientOriginalName())) {
            return $this->errors(['message' => 'Error saving the file.', 'code' => 400]);
        }

        $request->user()->tests()->create([
            'file_test' => storage_path().'/uploads/testfiles'.$file->getClientOriginalName(),
            'name_test' => $file->getClientOriginalName(),
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
        if (Gate::denies('see-user-menu')) {
            abort(403);
        }


        $this->validate($request, [
            'file_test' => 'required',
        ]);


        $file = Input::file('file_test');

        $destinationPath = storage_path() . '/uploads/testfiles';

        if(!$file->move($destinationPath, $file->getClientOriginalName())) {
            return $this->errors(['message' => 'Error saving the file.', 'code' => 400]);
        }

        $test->file_test=storage_path().'/uploads/testfiles'.$file->getClientOriginalName();
        $test->name_test = $file->getClientOriginalName();


        $this->authorize('update', $test);

        $train->update();



        return redirect('/tests');

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
