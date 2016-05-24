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
        $inf='<html><head><title> Document Classification - Tesxt Statistics</title><meta http-equiv="Content-Type" content="text/html; charset=utf-8"/></head><body>';
        $inf.='<style>.page-break {page-break-after: always;}</style>';
        $inf.='<h5>User: '.$user->name.'</h5>';

        $data = array();
        foreach ($testsforuser as $testforuser){

            $value = array();

            $tasca=\App\Task::find($testforuser->task_id);
            $portions=explode(" ", $tasca->name_task);
            $folder="";
            foreach ($portions as $portion)
                $folder.=$portion;
            $name_task=strtolower($folder);
            $inf.='<h5>Task: '.$tasca->name_task.'</h5>';
            $files=scandir("/var/www/html/masterv1/storage/uploads/".$name_task."/test/".$name_user."/");
            foreach ($files as $file){
                $name_file=$file;
            }

            $output=array();
            $cad="";
            exec("python /var/www/html/masterv1/storage/python/TS_part1.py $name_task $name_user $name_file",$output);
            foreach ($output as $line) {
                $cad .= "$line<br/>";
            }
            $inf.='<h6>'.$cad.'</h6>';

            //$inf.='<div class="page-break"></div>';

            $output3=array();
            exec("python /var/www/html/masterv1/storage/python/TS_part3.py $name_task $name_user $name_file",$output3);
            foreach ($output3 as $line) {
                $value[]=$line+0;

            }
            $data[]=$value;
            //unset($value);
        }

        exec("python /var/www/html/masterv1/storage/python/TS_part2.py ".escapeshellarg(json_encode($data)),$output2);
        foreach ($output2 as $line) print "$line<br/>";

        $im = imagecreatefrompng("img_text.png");
        header('Content-Type: image/png');
        $inf.='<h6><img src="/var/www/html/masterv1/public/img_text.png" width="600"></h6>';

        $inf.='</h6></body>';
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML("$inf");


        //imagedestroy($im);
        //return $pdf->download($name_user.'.pdf');
        return $pdf->stream();

    }



}
