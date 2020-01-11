<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class UserController extends Controller
{
    public function index()
    {
        try{
            return view('create');
        }catch(Exception $e){
            return response()->json([
                'status' =>'error',
                'message' => $e->getMessage()
            ]);
        }
    }

    public function create(Request $request)
    {
        try{
            return view('create');
        }catch(Exception $e){
            return response()->json([
                'status' =>'error',
                'message' => $e->getMessage()
            ]);
        }

    }

    public function store(Request $request)
    {
        try{
            $this->validate($request, [
                $request->name => 'required', 'string',
                $request->email => 'required', 'string', 'unique:users'
            ], [
                'required' => 'Campo nome é obrigatório'
            ]);

            $user = User::create([
                'name'       => $request->name,
                'email'      => $request->email,
                'date_birth' => $request->date_birth,
                'genre'      => $request->genre,
                'cpf'        => $request->cpf,
                'password'   => Hash::make($request->password),
            ]);

            Address::create([
                'user_id'    => $user->id,
                'zip_code'   => $request->zip_code,
                'state'      => $request->state,
                'street'     => $request->street,
                'complement' => $request->complement,
                'district'   => $request->district,
                'number'     => $request->number,
            ]);

            return Redirect::back();
        }catch(Exception $e){
            return response()->json([
                'status' =>'error',
                'message' => $e->getMessage()
            ]);
        }
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $user = User::find($id);
        return view('edit',['user' =>$user]);
    }

    public function update(Request $request, $id)
    {
        try{
            User::whereId($id)
                ->update([
                'name'       => $request->name,
                'email'      => $request->email,
                'date_birth' => $request->date_birth,
                'genre'      => $request->genre,
                'cpf'        => $request->cpf,
                'password'   => Hash::make($request->password),
            ]);
    
            Address::whereUser_id($id)
                ->update([
                'zip_code'   => $request->zip_code,
                'state'      => $request->state,
                'street'     => $request->street,
                'complement' => $request->complement,
                'district'   => $request->district,
                'number'     => $request->number,                
            ]);

        }catch(Exception $e){
            return response()->json([
                'status' =>'error',
                'message' => $e->getMessage()
            ]);
        }                
    }

    public function destroy($id)
    {
        try{
            $address = Address::find($id);
            if($address){
                $address->delete();
            }
            $User = User::find($id);
            if(!$User){
                return Redirect::back()->withError('Usuario não enontrado');
            }
            $User->delete();
            return Redirect::back()->withSuccess('Usuario cadastrado com sucesso');

        }catch(Exception $e){
            return response()->json([
                'status' =>'error',
                'message' => $e->getMessage()
            ]);
        }
    }
}
