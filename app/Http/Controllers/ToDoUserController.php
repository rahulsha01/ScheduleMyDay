<?php

namespace App\Http\Controllers;
use App\ToDoUser;
use Validator;
use Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;

class ToDoUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $ToDoUser = new ToDoUser();
        $ToDoUser->u_username = $request->input('u_username');
        $ToDoUser->u_password = Crypt::encryptString($request->input('u_password'));
        $ToDoUser->u_role = $request->input('u_role');
        $ToDoUser->u_email = $request->input('u_email');
        if($request->hasFile('u_image')) {
            $filenamewithextension = $request->file('u_image')->getClientOriginalName();

            $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);
 
            //get file extension
            $extension = $request->file('u_image')->getClientOriginalExtension();
     
            //filename to store
            $filenametostore = $filename.'_'.time().'.'.$extension;
    
            $request->file('u_image')->storeAs('public/profile_images', $filenametostore);

            if(!file_exists(public_path('storage/profile_images/crop'))) {
                mkdir(public_path('storage/profile_images/crop'), 0755);
            }
            $profileImage = 'storage/profile_images/'.$filenametostore;
            $img = Image::make(public_path('storage/profile_images/'.$filenametostore));
            $croppath = public_path('storage/profile_images/crop/'.$filenametostore);

            $img->resize(80, 80);
            $img->save($croppath);
     
            // you can save crop image path below in database
            $cropPath = asset('storage/profile_images/crop/'.$filenametostore);
            $pureImage = asset('storage/profile_images/'.$filenametostore);
            $ToDoUser->u_image = $pureImage;
            $ToDoUser->u_thumbnail = $cropPath;
        }
        $ToDoUser->u_status = $request->input('u_status');
        $ToDoUser->save();
        return response()->json($ToDoUser);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
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

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function login(Request $request) {

    }
}
