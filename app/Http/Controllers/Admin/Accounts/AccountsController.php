<?php

namespace App\Http\Controllers\Admin\Accounts;

use Illuminate\Routing\Controller;
use App\Models\profile;
use App\Models\User;
use App\Models\UserRole;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class AccountsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = profile::all();
        return view('admin.users.index', compact('users'));
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'firstName' => 'bail|required|string|min:3',
            'lastName' => 'bail|required|string|min:3',
            'email' => 'bail|required|email',
            'phone' => 'bail|required|string|min:8',
            'gender' => 'bail|required|string',
            'country' => 'bail|required|string',
            'password' => 'bail|required|string|min:4',
            'con-password' => 'bail|required|string|min:4|same:password',
        ]);
        if($validator->fails()){
            Session::flash('error',$validator->errors()->first());
            return redirect()->back()->withInput();
        }
        try{
            $user = new User();
            $user->agencies_id = null;
            $user->email = $request->email;
            $user->phone = $request->phone;
            $user->password = Hash::make($request->password);
            $user->api_token = Str::random(60);
            $user->activated = 1;
            $user->blocked = 0;
            $user->save();
            $useRole = new UserRole();
            $useRole->users_id = $user->id;
            $useRole->roles_id = 2;
            $useRole->save();
            $profile = new profile();
            $profile->first_name = $request->firstName;
            $profile->last_name = $request->lastName;
            $profile->users_id = $user->id;
            $profile->email = $request->email;
            $profile->phone = $request->phone;
            $profile->gender = $request->gender;
            $profile->birthday = $request->birthday;
            $profile->save();

        }catch(QueryException $e){
            Session::flash('error', $e->getMessage());
            return redirect()->back()->withInput();
        }

        Session::flash('success', "Compte créer avec succés");
        return redirect()->route('login');
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
        $validator = Validator::make($request->all(),[
            'firstName' => 'bail|required|string|min:3',
            'lastName' => 'bail|required|string|min:3',
            'email' => 'bail|required|email',
            'phone' => 'bail|required|string|min:8',
            'address' => 'bail|required|string',
            'city' => 'bail|required|string',
            'region' => 'bail|required|string',
            'zipcode' => 'bail|required|string|min:4',
        ]);
        if($validator->fails()){
            Session::flash('error',$validator->errors()->first());
            return redirect()->back()->withInput();
        }
        try{
            Contacts::where('id',$id)->update([
               'first_name' =>  $request->firstName,
                'last_name' => $request->lastName,
                'email' => $request->email,
                'phone' => $request->phone,
                'gender' => $request->gender,
                'birthday' => $request->birthday,
                'address_line' => $request->birthday,
                'city' => $request->city,
                'region' => $request->region,
                'zip_code' => $request->zipcode
            ]);
        }catch(QueryException $e){
            Session::flash('error', $e->getMessage());
            return redirect()->back()->withInput();
        }

        Session::flash('success', "Utilisateur mis a jour avec succés");
        return redirect()->route('users-accounts.list');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try
        {
            Contacts::where('id',$id)->delete();
        }catch(QueryException $e){
            Session::flash('error', $e->getMessage());
            return redirect()->back()->withInput();
        }
        Session::flash('success', "Utilisateur supprimer avec succés");
        return redirect()->route('users-accounts.list');
    }
}
