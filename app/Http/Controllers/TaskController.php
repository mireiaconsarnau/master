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



class TaskController extends Controller
{
    /**
     * The task repository instance.
     *
     * @var TaskRepository
     */
    protected $tasks;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(TaskRepository $tasks)
    {
        $this->middleware('auth');

        $this->tasks = $tasks;
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

        return view('tasks.index', [
            'tasks' => $this->tasks->forUser($request->user()),
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
            'name_task' => 'required|max:255',
            'available_task' => 'required|max:3',
        ]);

        $request->user()->tasks()->create([
            'name_task' => $request->name_task,
            'available' => $request->available_task,
        ]);

        $portions=explode(" ", $request->name_task);
        $folder="";
        foreach ($portions as $portion)
            $folder.=$portion;

        mkdir(storage_path().'/uploads/'.$folder, 0777);
        chmod(storage_path().'/uploads/'.$folder, 0777);
        mkdir(storage_path().'/uploads/'.$folder.'/test', 0777);
        chmod(storage_path().'/uploads/'.$folder.'/test', 0777);

        $usersNoAdmin=User::usersNoAdmin()->orderBy('name')->get();
        foreach ($usersNoAdmin as $userNoAdmin) {
            $portions = explode(" ", $userNoAdmin->name);
            $name = "";
            foreach ($portions as $portion) {
                $name .= $portion;

            }
            mkdir(storage_path() . '/uploads/' . $folder . '/test/' . $name, 0777);
            chmod(storage_path() . '/uploads/' . $folder . '/test/' . $name, 0777);
        }

        return redirect('/tasks');
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



    public function update(Request $request, $task)
    {
        if (Gate::denies('see-admin-menu')) {
            abort(403);
        }
        $this->validate($request, [
            'name_task' => 'required|max:255',
            'available_task' => 'required|max:3',
        ]);

        $portions=explode(" ", $task->name_task);
        $folder="";
        foreach ($portions as $portion)
            $folder.=$portion;

        $portions_new=explode(" ", $request['name_task']);
        $folder_new="";
        foreach ($portions_new as $portion_new)
            $folder_new.=$portion_new;

        rename(storage_path().'/uploads/'.$folder,storage_path().'/uploads/'.$folder_new);

        $task->name_task = $request['name_task'];
        $task->available = $request['available_task'];

        $this->authorize('update', $task);



        $task->update();


        return redirect('/tasks');

    }

    /**
     * Destroy the given task.
     *
     * @param  Request  $request
     * @param  Task  $task
     * @return Response
     */
    public function destroy(Request $request, Task $task)
    {
        if (Gate::denies('see-admin-menu')) {
            abort(403);
        }
        $this->authorize('destroy', $task);
        $task->tests()->delete();

        $task->delete();

        $portions=explode(" ", $task->name_task);
        $folder="";
        foreach ($portions as $portion)
            $folder.=$portion;

        $path=storage_path().'/uploads/'.$folder;
        exec("rm -r {$path}");

       return redirect('/tasks');
    }




}
