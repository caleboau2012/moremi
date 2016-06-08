<?php

namespace App\Http\Controllers;

use App\Photo;
use Illuminate\Http\Request;
use App\Services\UploadPicture;

use App\Http\Requests;


class PhotoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $_upload;

    public function __construct() {

    }

    public function index()
    {
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Requests\UploadPhotoRequest $request)
    {
        $profile_id  = $request->input('profile_id');
        $upload =new UploadPicture();
        $upload->process($request);
        $photo = new Photo();
        $photo->full_path =$upload->full_path;
        $photo->thumb_path =$upload->thumb_path;
        $photo->profile_id =$profile_id;
        $photo->save();
        return response()->json(['status'=>true,
            'message'=>"Your photo was uploaded successfully",
            'photo'=>['thumb_path'=>$photo->thumb_path,
                'full_path'=>$photo->full_path]]);


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
}
