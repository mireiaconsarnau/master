<?php

namespace App\Http\Controllers;



use App\Task;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\TaskRepository;
use Illuminate\Support\Facades\Gate;
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

        return redirect('/tasks');
    }
}
