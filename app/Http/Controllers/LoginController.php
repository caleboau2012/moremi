<?php

namespace App\Http\Controllers;

use App\Photo;
use App\Profile;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Services\UserService;
use Faker\Factory as Faker;

class LoginController extends Controller
{


    public function login(Requests\LoginRequest $request)
    {
        $userService = new UserService();
        $user = $userService->findOrCreate($request);
        if (!empty($user)) {
            $token = customencrypt($user->id);
            return response()->json(['status' => true,
                'message' => 'Authentication successful',
                'user' => $user, 'authToken' => $token]);
        }
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
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


}
