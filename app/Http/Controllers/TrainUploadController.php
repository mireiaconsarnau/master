<?php

namespace App\Http\Controllers;



use App\TrainUpload;
use App\Http\Requests;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\TrainRepository;
use Illuminate\Support\Facades\Gate;
use PhpParser\Node\Expr\Cast\String_;
use Input;
use Validator;


class TrainUploadController extends Controller
{
    /**
     * The train repository instance.
     *
     * @var TrainRepository
     */
    protected $trains;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(TrainRepository $trains)
    {
        $this->middleware('auth');

        $this->trains = $trains;
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

        return view('trains.index', [
            'trains' => $this->trains->forUser($request->user()),
            'available_users' => User::available($request->user())->orderBy('name')->get(),
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
        if (Gate::denies('see-admin-menu')) {
            abort(403);
        }

        $this->validate($request, [
            'file_train' => 'required',
            'associated_user_id' => 'required',
        ]);


        $user=\App\User::find($request->associated_user_id);
        $portions=explode(" ", $user->name);
        $folder="";
        foreach ($portions as $portion)
            $folder.=$portion;
        $folder=strtolower($folder);

        if (!file_exists(storage_path().'/uploads/train/'.$folder)) {
            mkdir(storage_path() . '/uploads/train/' . $folder, 0777);
            chmod(storage_path() . '/uploads/train/' . $folder, 0777);
        }

        $file = Input::file('file_train');
        $destinationPath = storage_path() . '/uploads/train/'.$folder;

        $portions_file=explode(" ", $file->getClientOriginalName());
        $file_upload="";
        foreach ($portions_file as $portion_file)
            $file_upload.=$portion_file;
        $file_upload=strtolower($file_upload);


        if(!$file->move($destinationPath, $file_upload)) {
            return $this->errors(['message' => 'Error saving the file.', 'code' => 400]);
        }

       $request->user()->trains()->create([
            'file_train' => storage_path().'/uploads/train/'.$folder."/".$file_upload,
            'name_train' => $file_upload,
            'associated_user_id' => $request->associated_user_id,
        ]);

        return redirect('/trains');




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



    public function update(Request $request, $train)
    {
        if (Gate::denies('see-admin-menu')) {
            abort(403);
        }


        /*$this->validate($request, [
            'file_train' => 'required',
        ]);*/


        $file = Input::file('file_train');

        $user=\App\User::find($train->associated_user_id);
        $portions=explode(" ", $user->name);
        $folder="";
        foreach ($portions as $portion)
            $folder.=$portion;
        $folder=strtolower($folder);

        if ($file) {
            $destinationPath = storage_path() . '/uploads/train/'.$folder.'/'.$train->name_train;
            $destinationPath2 = storage_path() . '/uploads/train/'.$folder;
            exec("rm {$destinationPath}");


            $portions_file=explode(" ", $file->getClientOriginalName());
            $file_upload="";
            foreach ($portions_file as $portion_file)
                $file_upload.=$portion_file;
            $file_upload=strtolower($file_upload);

            if (!$file->move($destinationPath2, $file_upload)) {
                return $this->errors(['message' => 'Error saving the file.', 'code' => 400]);
            }

            $train->file_train = storage_path() . '/uploads/train/'.$folder."/" . $file_upload;
            $train->name_train = $file_upload;
        }



        //$train->associated_user_id = $request->associated_user_id;


        $this->authorize('update', $train);

        $train->update();



        return redirect('/trains');

    }

    /**
     * Destroy the given train.
     *
     * @param  Request  $request
     * @param  TrainUpload  $train
     * @return Response
     */
    public function destroy(Request $request, TrainUpload $train)
    {
        if (Gate::denies('see-admin-menu')) {
            abort(403);
        }
        $this->authorize('destroy', $train);
        //$train->tests()->delete();

        $numbertrain=\App\TrainUpload::Numbertrainsforassociateduser($train->associated_user_id)->count();

        $train->delete();

        $user=\App\User::find($train->associated_user_id);
        $portions_user=explode(" ", $user->name);
        $name="";
        foreach ($portions_user as $portion_user)
            $name.=$portion_user;
        $name=strtolower($name);


        //echo  $numbertrain;
        if($numbertrain==1) {
            $path = storage_path() . '/uploads/train/' . $name;
            exec("rm -r {$path}");
        }else{

            $path = storage_path() . '/uploads/train/' . $name . '/' . $train->name_train;
            exec("rm {$path}");
        }



        return redirect('/trains');
    }

    public function download($fileId){
        $entry = TrainUpload::where('id', '=', $fileId)->firstOrFail();

        $user=\App\User::find($entry->associated_user_id);
        $portions_user=explode(" ", $user->name);
        $name="";
        foreach ($portions_user as $portion_user)
            $name.=$portion_user;
        $name=strtolower($name);


        $pathToFile=storage_path()."/uploads/train/".$name."/".$entry->name_train;
        return response()->download($pathToFile);
    }
}
