<?php

namespace App\Http\Controllers;



use App\Task;
use App\TestUploadAdmin;
use App\User;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Gate;
use DB;

use Illuminate\Support\Facades\Session;
use PhpParser\Node\Expr\Cast\String_;



class UserController extends Controller
{
    /**
     * The task repository instance.
     *
     * @var TaskRepository
     */
    protected $users;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(UserRepository $users)
    {
        $this->middleware('auth');

        $this->users = $users;
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

        return view('users.index', [
            'users' => $this->users->forUser($request->user()),
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
     * Create a new task.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        if (Gate::denies('see-admin-menu')) {
            abort(403);
        }


        $this->validate($request, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
        ]);

        $request->user()->create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => bcrypt($request['password']),
            'type' => $request['type'],
        ]);



        return redirect('/users');
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



    public function update(Request $request, $user)
    {
        if (Gate::denies('see-admin-menu')) {
            abort(403);
        }

        if (strcmp($user->email,$request['email'])==0){
            if (strcmp($user->password,$request['password'])==0) {
                $this->validate($request, [
                    'name' => 'required|max:255',
                ]);

            }else{
                $this->validate($request, [
                    'name' => 'required|max:255',
                    'password' => 'required|confirmed|min:6',
                ]);

            }
        }else{
            if (strcmp($user->password,$request['password'])==0) {
                $this->validate($request, [
                    'name' => 'required|max:255',
                    'email' => 'required|email|max:255|unique:users',
                ]);

            }else {
                $this->validate($request, [
                    'name' => 'required|max:255',
                    'email' => 'required|email|max:255|unique:users',
                    'password' => 'required|confirmed|min:6',
                ]);

            }
        }

        if (strcmp($user->name,$request['name'])!=0){
            $portions=explode(" ", $user->name);
            $folder="";
            foreach ($portions as $portion)
                $folder.=$portion;
            $folder=strtolower($folder);

            $portions_new=explode(" ", $request['name']);
            $folder_new="";
            foreach ($portions_new as $portion_new)
                $folder_new.=$portion_new;
            $folder_new=strtolower($folder_new);

            if (file_exists(storage_path().'/uploads/train/'.$folder)){
                rename(storage_path().'/uploads/train/'.$folder,storage_path().'/uploads/train/'.$folder_new);
            }
            $trainsforuser=\App\TrainUpload::trainsforassociateduser($user->id)->get();
            if (count($trainsforuser) > 0) {

                foreach ($trainsforuser as $trainforuser){
                    $path_train=storage_path().'/uploads/train/'.$folder_new."/".$trainforuser->name_train;
                    $sql="UPDATE train_uploads SET train_uploads.file_train='".$path_train."' WHERE id=".$trainforuser->id;
                    DB::update($sql);
                }
            }
            $tasques=\App\Task::tasques();
            foreach ($tasques as $tasque){
                $portions_t=explode(" ", $tasque->name_task);
                $folder_t="";
                foreach ($portions_t as $portion_t)
                    $folder_t.=$portion_t;
                $folder_t=strtolower($folder_t);
                if (file_exists(storage_path().'/uploads/'.$folder_t.'/test/'.$folder)) {
                    rename(storage_path() . '/uploads/' . $folder_t . '/test/' . $folder, storage_path() . '/uploads/' . $folder_t . '/test/' . $folder_new);
                }

                $testsforuser=\App\TestUploadAdmin::testsfortaskandforuser($tasque->id,$user->id)->get();
                if (count($testsforuser) > 0) {

                    foreach ($testsforuser as $testforuser){
                        $path_test=storage_path() . '/uploads/' . $folder_t . '/test/' . $folder_new."/".$testforuser->name_test;
                        $sql_test="UPDATE test_uploads SET test_uploads.file_test='".$path_test."' WHERE task_id=".$tasque->id." AND user_id=".$user->id;
                        DB::update($sql_test);
                    }
                }
            }
        }

        if (strcmp($user->email,$request['email'])==0){
            if (strcmp($user->password,$request['password'])==0) {

                $user->name = $request['name'];
                $user->type = $request['type'];
            }else{

                $user->name = $request['name'];
                $user->type = $request['type'];
                $user->password = bcrypt($request['password']);
            }
        }else{
            if (strcmp($user->password,$request['password'])==0) {

                $user->name = $request['name'];
                $user->email = $request['email'];
                $user->type = $request['type'];
            }else {

                $user->name = $request['name'];
                $user->email = $request['email'];
                $user->type = $request['type'];
                $user->password = bcrypt($request['password']);
            }
        }



        //$this->authorize('update', $user);



        $user->update();


        return redirect('/users');

    }

    /**
     * Destroy the given task.
     *
     * @param  Request  $request
     * @param  Task  $task
     * @return Response
     */
    public function destroy(Request $request, User $user)
    {
        /*if (Gate::denies('see-admin-menu')) {
            abort(403);
        }
        $this->authorize('destroy', $user);*/
        //$task->tests()->delete();

        $user->delete();

        $portions=explode(" ", $user->name);
        $folder="";
        foreach ($portions as $portion)
            $folder.=$portion;
        $folder=strtolower($folder);

        $path=storage_path().'/uploads/train/'.$folder;
        exec("rm -r {$path}");

        $tasques=\App\Task::tasques();
        foreach ($tasques as $tasque){
            $portions_t=explode(" ", $tasque->name_task);
            $folder_t="";
            foreach ($portions_t as $portion_t)
                $folder_t.=$portion_t;
            $folder_t=strtolower($folder_t);
            $path_t=storage_path().'/uploads/'.$folder_t.'/test/'.$folder;
            exec("rm -r {$path_t}");

        }


        $user->tests()->delete();
        $user->trains2()->delete();

       return redirect('/users');
    }




}
