<?php

namespace App\Http\Controllers;

use App\Photo;
use App\Profile;
use app\Services\Photo\DeletePhoto;
use App\Services\Photo\UploadPicture;
use App\Services\UserService;
use App\User;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;


class PhotoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $_upload;
    private $_userId;
    private $auth=false;
    public function __construct(Request $request) {
        $access_token = $request->header('authToken');
        $userId =null;
        if(!is_null($access_token)) {
            $userId =customdecrypt($access_token);
            $userInstance = UserService::instance();
            if($userInstance->isValid($userId)){
                $this->auth =true;
            }
        }
        $this->_userId =$userId;
    }


    public function index(Request $request)
    {
       return response()->json($request->header('authToken'));
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
        if(!$this->auth) {
            return response()->json(['status'=>false,'message'=>'You must be logged in to upload photo']);
        }
        $profile_id  =$this->_userId;
        $upload =new UploadPicture();
        $upload->process($request);
        $photo = new Photo();
        $photo->full_path =$upload->full_path;
        $photo->thumb_path =$upload->thumb_path;
        $photo->profile_id =$profile_id;
        $photo->save();

        //go ahead and set as feature photo
        $profile =Profile::find($this->_userId);
       // echo $photo->id;
        $profile->photo_id=$photo->id;
        $profile->save();

        return response()->json(['status'=>true,
            'message'=>"Your photo was uploaded successfully",
            'photo'=>[
                'id'=>$photo->id,
                'thumb_path'=>$photo->thumb_path,
                'full_path'=>$photo->full_path]]);


    }

    public  function storeImgFromString(Requests\PhotoFromStringRequest $request){
        if(!$this->auth) {
            return response()->json(['status'=>false,'message'=>'You must be logged in to upload photo']);
        }
        $profile_id  =$this->_userId;
        $upload =new UploadPicture();
        $data =$upload->ImageFromUrlOrString($request->photo);
        if(is_array($data) && !empty($data)){
            foreach($data as $d){
                $photo = new Photo();
                $photo->full_path =$d['full_path'];
                $photo->thumb_path =$d['thumb_path'];
                $photo->profile_id =$profile_id;
                $photo->save();
            }
        }

        $profile =Profile::find($this->_userId);
        if($request->has('profile_pic')){
            $upl =new UploadPicture();
            $d =[$request->profile_pic];
            $data =$upl->ImageFromUrlOrString($d);
            if(!is_null($data) && !empty($data)) {
                $profile_ph = new Photo();
                $profile_ph->full_path = $data[0]['full_path'];
                $profile_ph->thumb_path = $data[0]['thumb_path'];
                $profile_ph->profile_id = $profile_id;
                $profile_ph->save();
                $profile->photo_id = $profile_ph->id;
            }
        }
        //go ahead and set as feature photo
        if($request->status!=null) {
            $profile->about = $request->status;
        }
        $profile->save();
        return response()->json(['status'=>true,
            'message'=>"Your photo was uploaded successfully",
            'photo'=>[
                'id'=>isset($photo->id)?$photo->id:null,
                'thumb_path'=>isset($photo)?asset($photo->thumb_path):null,
                'full_path'=>isset($photo)?asset($photo->full_path):null]]);

    }


    public function storefb(Requests\FacebookUploadRequest $request){
        if(!$this->auth) {
            return response()->json(['status'=>false,'message'=>'You must be logged in to upload photo']);
        }
        $profile_id  =$this->_userId;

        foreach($request->urls as $url){
            $photo = new Photo();
            $photo->full_path =$url;
            $photo->thumb_path =$url;
            $photo->profile_id =$profile_id;
            $photo->save();
        }
     $p =Photo::where('full_path',$request->profile_pic)->where('profile_id',$profile_id)->first();
        $profile =Profile::find($profile_id);
        $profile->about=$request->status;
        $profile->photo_id =$p->id;
        $profile->save();
        return response()->json(['status'=>true,'message'=>'Pictures were saved successfully']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $photo =Photo::findOrFail($id);
        return response()->json(['status'=>true,
            'photo'=>['thumb_path'=>$photo->thumb_path,
                'full_path'=>$photo->full_path],
            'first_name'=>$photo->profile->first_name,
            'last_name'=>$photo->profile->last_name
        ]);
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


    public  function getSpaceUsed($user_id,array $photos){
        $profile =Profile::find($user_id);
        $spaceRemain =abs(6-$profile->photos()->count());
        if(count($photos)<$spaceRemain) {
            foreach($photos as $photo){
                //$this->upload($uphoto);
            }
            }
        if(count($photos)>$spaceRemain  ) //& request does not have profile pic
        {
            $photoToupload = [];
            $i = 1;
            foreach ($photos as $p) {
                while ($i <= $spaceRemain) {
                    $photoToupload[] = $p;
                }
            }
            //delete non_profile pic photo
            $a = 1;
            foreach ($profile->photos as $p) {
                while ($a >= count($spaceRemain) && $p->id!=$profile->photo_id ){
                        ///delete pic
                }
                ///upload all

        }

        }
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if($this->_userId!='') {
            $delete = new DeletePhoto($this->_userId, $id);
            $delete->delete();
        }

    }

    public  function updateStatus(Request $request){
            $validator = Validator::make($request->all(), [
                'status' => 'required|max:255',
            ]);

            if ($validator->fails()) {
            return response()->json(['status'=>false,'msg'=>'Invalid status update']);
            }
        $profile =Profile::find($this->_userId);
        $profile->about =$request->status;
        $profile->update();
        return response()->json(['status'=>true,'msg'=>'Status updated successfully']);

        }

}
