<?php

namespace App\Http\Controllers;

use App\Repositories\TestAdminRepository;
use App\TestUploadAdmin;
use App\Task;
use App\TrainUpload;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Gate;
use PhpParser\Node\Expr\Cast\String_;
use Input;

use Stevebauman\Location\Facades\Location;

use Validator;

class TestUploadAdminController extends Controller
{
    /**
     * The test repository instance.
     *
     * @var TestRepository
     */
    protected $testsadmin;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(TestAdminRepository $testsadmin)
    {
        $this->middleware('auth');

        $this->testsadmin = $testsadmin;
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

        return view('testsadmin.index', [
            'testsadmin' => $this->testsadmin->forUser(),
            'available_tasks' => Task::available($request->user())->orderBy('created_at')->get(),
            'trainupload_files' => TrainUpload::trainfiles($request->user())->orderBy('name_train')->get(),
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



    public function update(Request $request, $testadmin)
    {
        if (Gate::denies('see-admin-menu')) {
            abort(403);
        }

        $testadmin->disabled = $request['disabled'];
        $testadmin->train_upload_id = $request['train_upload_id'];

        //$this->authorize('update', $testadmin);

        $testadmin->update();



        return redirect('/testsadmin');

    }

    public function analysis(TestUploadAdmin $testadmin)
    {
        if (Gate::denies('see-admin-menu')) {
            abort(403);
        }

       echo "id=".$testadmin->id;




        //return redirect('/testsadmin');

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

    }

    public function download($fileId){
        $entry = TestUploadAdmin::where('id', '=', $fileId)->firstOrFail();
        $pathToFile=storage_path()."/uploads/testfiles/".$entry->name_test;
        return response()->download($pathToFile);
    }
}
