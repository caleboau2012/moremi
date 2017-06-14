<?php

namespace App\Http\Controllers;

use App\Photo;
use App\Profile;
use App\Services\Photo\DeletePhoto;
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

    public  function storeImgFromString(Requests\PhotoFromStringRequest $request)
    {
        if (!$this->auth) {
            return response()->json(['status' => false, 'message' => 'You must be logged in to upload photo']);
        }

        if ((!$request->has('photo')) && ($request->status == "") && ($request->venue == 0)){
            return response()->json(['status' => false, 'message' => "You didn't enter anything. Why?"]);
        }

        $profile_id = $this->_userId;
        $profile = Profile::find($profile_id);

        if($request->has('photo')) {
            $upload = new UploadPicture();
            $data = $upload->ImageFromUrlOrString($request->photo);

//        $photo_ids = [];
            if (is_array($data) && !empty($data)) {
                foreach ($data as $d) {
                    $photo = new Photo();
                    $photo->full_path = $d['full_path'];
                    $photo->thumb_path = $d['thumb_path'];
                    $photo->profile_id = $profile_id;
                    $photo->save();
                }
            }

            $photos = $profile->photos->toArray();

            if ($request->has('profile_pic')) {
                $profile->photo_id = $photos[$request->profile_pic]['id'];
            }
        }

        if($request->status !=null) {
            $profile->about = $request->status;
        }
        if($request->venue != null)
            $profile->venue = $request->venue;

        $profile->save();
        return response()->json(['status'=>true,
            'message'=>"Your profile was saved successfully",
        ]);
    }


    public function storefb($profile, $request){
//        dd($request->cover);
        if (!$profile){
            return false;
        }

        $photo_id = null;

        if($request->has('cover')) {
            $upload = new UploadPicture();
            $data = $upload->ImageFromUrlOrString([$request->cover['source']]);

            if (is_array($data) && !empty($data)) {
                foreach ($data as $d) {
                    $photo = new Photo();
                    $photo->full_path = $d['full_path'];
                    $photo->thumb_path = $d['thumb_path'];
                    $photo->profile_id = $profile->id;
                    $photo->save();
                    $photo_id = $photo->id;
                }
            }

            $profile->photo_id = $photo_id;
        }

        $profile->save();
        return $profile;
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
        $status = false;

        if($this->_userId!='') {
            $delete = new DeletePhoto($this->_userId, $id);
            $status = $delete->delete();
        }

        if($status)
            return response()->json(['status' => true, 'msg' => 'Deletion Successful']);
        else
            return response()->json(['status' => false, 'msg' => 'Nothing was deleted']);
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
