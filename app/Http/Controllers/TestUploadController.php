<?php

namespace App\Http\Controllers;

use App\TestUpload;
use App\Task;
use App\TrainUpload;
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

        $tasca=\App\Task::find($request->task_id);
        $portions=explode(" ", $tasca->name_task);
        $folder="";
        foreach ($portions as $portion)
            $folder.=$portion;
        $folder=strtolower($folder);

        $user=\App\User::find($request->user()->id);
        $portions_user=explode(" ", $user->name);
        $name="";
        foreach ($portions_user as $portion_user)
            $name.=$portion_user;
        $name=strtolower($name);

        $file = Input::file('file_test');
        $destinationPath = storage_path() . '/uploads/'.$folder.'/test/'.$name;


        $portions_file=explode(" ", $file->getClientOriginalName());
        $file_upload="";
        foreach ($portions_file as $portion_file)
            $file_upload.=$portion_file;
        $file_upload=strtolower($file_upload);


        if(!$file->move($destinationPath, $file_upload)) {
            return $this->errors(['message' => 'Error saving the file.', 'code' => 400]);
        }

        $location = Location::get($_SERVER["REMOTE_ADDR"]);



       /*$associated_trains= TrainUpload::trainid($request->user()->id)->orderBy('id')->get();
        $train_as=0;
        foreach ($associated_trains as $associated_train) {
            $train_as = $associated_train->id;
        }*/



       $request->user()->tests()->create([
           'file_test' => storage_path().'/uploads/'.$folder.'/test/'.$name.'/'.$file_upload,
           'name_test' => $file_upload,
            'task_id' => $request->task_id,
            'ip' => $location->ip,
            'countryCode' => $location->countryCode,
            'countryName' => $location->countryName,
            'cityName' => $location->cityName,
            //'train_upload_id' => $train_as,
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

        $tasca=\App\Task::find($test->task_id);
        $portions=explode(" ", $tasca->name_task);
        $folder="";
        foreach ($portions as $portion)
            $folder.=$portion;
        $folder=strtolower($folder);

        $user=\App\User::find($request->user()->id);
        $portions_user=explode(" ", $user->name);
        $name="";
        foreach ($portions_user as $portion_user)
            $name.=$portion_user;
        $name=strtolower($name);

        $path=storage_path().'/uploads/'.$folder.'/test/'.$name.'/'.$test->name_test;
        exec("rm {$path}");

        return redirect('/tests');
    }

    public function download($fileId){

        $entry = TestUpload::where('id', '=', $fileId)->firstOrFail();

        $tasca=\App\Task::find($entry->task_id);
        $portions=explode(" ", $tasca->name_task);
        $folder="";
        foreach ($portions as $portion)
            $folder.=$portion;
        $folder=strtolower($folder);

        $user=\App\User::find($entry->user_id);
        $portions_user=explode(" ", $user->name);
        $name="";
        foreach ($portions_user as $portion_user)
            $name.=$portion_user;
        $name=strtolower($name);

        $pathToFile=storage_path()."/uploads/".$folder."/test/".$name."/".$entry->name_test;
        return response()->download($pathToFile);
    }
}
