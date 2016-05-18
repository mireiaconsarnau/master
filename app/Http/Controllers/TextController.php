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
    public function textforone(User $user)
    {
        if (Gate::denies('see-admin-menu')) {
            abort(403);
        }

        $portions = explode(" ", $user->name);
        $name = "";
        foreach ($portions as $portion) {
            $name .= $portion;

        }
        $name_user=strtolower($name);

        $testsforuser=\App\TestUploadAdmin::testsforuser($user->id)->get();
        foreach ($testsforuser as $testforuser){
            $tasca=\App\Task::find($testforuser->task_id);
            $portions=explode(" ", $tasca->name_task);
            $folder="";
            foreach ($portions as $portion)
                $folder.=$portion;
            $name_task=strtolower($folder);

            $files=scandir("/var/www/html/masterv1/storage/uploads/".$name_task."/test/".$name_user."/");
            foreach ($files as $file){
                $name_file=$file;
            }
            $hola=array($name_task,$name_user,$name_file);
            $output=array();
            exec("python /var/www/html/masterv1/storage/python/RL_part1.py $name_task $name_user $name_file",$output);
            //exec("python /var/www/html/masterv1/storage/python/RL_part2.py $name_task $name_user $name_file");
            //$im = imagecreatefrompng("img_text.png");
            //header('Content-Type: image/png');
            //imagepng($im);
            //imagedestroy($im);

            $inf='<style>.page-break {page-break-after: always;}</style><h1>Page 1</h1><div class="page-break"></div><h1>Page 2</h1>';

        }
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML("$inf");
        //return $pdf->download($name_user.'.pdf');
        return $pdf->stream();
        /* $data=["sdfsdf", "asd"];
         $pdf = \PDF::loadView('pdf.invoice', $data);
         return $pdf->download('invoice.pdf');*/
        /*return view('textstatistics.index', [
            'inf' => $output,

        ]);*/
    }

}
