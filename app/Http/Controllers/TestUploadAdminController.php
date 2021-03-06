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
       // if (Gate::denies('see-admin-menu')) {
       //     abort(403);
       // }

        //$testadmin->train_upload_id = $request['train_upload_id'];

        //$this->authorize('update', $testadmin);

       // $testadmin->update();



        //return redirect('/testsadmin');

    }

    public function analysis(TestUploadAdmin $testadmin)
    {
        if (Gate::denies('see-admin-menu')) {
            abort(403);
        }


        //echo "id=".$testadmin->id;
        $tasca=\App\Task::find($testadmin->task_id);
        //echo "tasca=".$tasca->name_task;

        $portions=explode(" ", $tasca->name_task);
        $folder="";
        foreach ($portions as $portion)
            $folder.=$portion;
        $folder=strtolower($folder);

        $output=array();
        $cad="";
        $inf="";
        exec("python /var/www/html/masterv1/storage/python/SVM_part1.py ".$folder,$output);
        //foreach ($output as $line) print "$line<br/>";

        exec("python /var/www/html/masterv1/storage/python/SVM_part2.py ".$folder);

        $im = imagecreatefrompng("img.png");
        header('Content-Type: image/png');
        //imagepng($im);
        //imagedestroy($im);
        foreach ($output as $line)
            $cad.="$line<br/>";

        $inf='<html><head><title> Document Classification - Analysis</title><meta http-equiv="Content-Type" content="text/html; charset=utf-8"/></head><body>';
        $inf.='<h6>'.$cad.'</h6><img src="/var/www/html/masterv1/public/img.png" width="600"></body>';

        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML("$inf");
        //return $pdf->download($name_user.'.pdf');
        return $pdf->stream();

    }

    /**
     * Destroy the given train.
     *
     * @param  Request  $request
     * @param  TrainUpload  $train
     * @return Response
     */
    public function destroy(Request $request, TestUploadAdmin $test)
    {
        /*if (Gate::denies('see-admin-menu')) {
            abort(403);
        }*/
        //$this->authorize('destroy', $test);

        $test->delete();

        $tasca=\App\Task::find($test->task_id);
        $portions=explode(" ", $tasca->name_task);
        $folder="";
        foreach ($portions as $portion)
            $folder.=$portion;
        $folder=strtolower($folder);

        $user=\App\User::find($test->user_id);
        $portions_user=explode(" ", $user->name);
        $name="";
        foreach ($portions_user as $portion_user)
            $name.=$portion_user;
        $name=strtolower($name);

        $path=storage_path().'/uploads/'.$folder.'/test/'.$name.'/'.$test->name_test;
        exec("rm {$path}");

        return redirect('/testsadmin');
    }

    public function download($fileId){
        $entry = TestUploadAdmin::where('id', '=', $fileId)->firstOrFail();

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
