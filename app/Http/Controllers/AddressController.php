<?php

namespace App\Http\Controllers;

use App\Models\Address;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    public function index()
    {
        try{
            $addresses = Address::paginate(100);
            return view('list', ['addresses' => $addresses]);
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
            if(!isset($request->cep)){
                return response()->json([
                    'status'  => 'error',
                    'message' => 'Cep não enviado',
                ]);
            }

            $cep = preg_replace('/\D+/', '', $request->cep);
            $address = Address::where('zip_code', $cep)->first();
            if($address){
                return response()->json([
                    'status'  => 'warning',
                    'message' =>  "CEP {$request->cep} já se encontra cadastrado"
                    ]);
            }
            
            Address::create([
                'zip_code'   => $cep,
                'state'      => $request->uf,
                'street'     => $request->logradouro,
                'complement' => $request->complemento,
                'district'   => $request->bairro,
                'city'       => $request->localidade,
            ]);

            return response()->json([
                'status' => 'success',
                'message' =>'Cadastro realizado com suceeso'
            ], 200);
        }catch(Exception $e){
            return response()->json([
                'status'  => 'error',
                'message' => $e->getMessage()
            ]);
        }
    }

    public function show($id)
    {
        $address = Address::find($id);
        return view('show', ['address' => $address]);
    }

    public function edit($id)
    {
        $address = Address::find($id);
        return view('edit', ['address' => $address]);
    }

    public function update(Request $request, $id)
    {
        try{
            if(!isset($request->zip_code)){
                return response()->json([
                    'status'  => 'error',
                    'message' => 'Cep não enviado',
                ]);
            }

            $zip_code = preg_replace('/\D+/', '', $request->zip_code);
            Address::whereId($id)
                ->update([
                'zip_code'   => $zip_code,
                'city'       => $request->city,
                'state'      => $request->state,
                'street'     => $request->street,
                'complement' => $request->complement,
                'district'   => $request->district,
                'number'     => $request->number,                
            ]);

            return response()->json([
                'status'  => 'success',
                'message' => 'Dados atualizados com sucesso'
            ]);

        }catch(Exception $e){
            return response()->json([
                'status'  =>'error',
                'message' => $e->getMessage()
            ]);
        }                
    }

    public function destroy($id)
    {
        try{
            $address = Address::find($id);
            if(!$address){
                return response()->json([
                    'status'  => 'warning',
                    'message' => 'Cep não encontrado'
                ]);
            }
            
            $address->delete();
            return response()->json([
                'status'  =>'success',
                'message' => 'Deletado com sucesso'
            ]);

        }catch(Exception $e){
            return response()->json([
                'status'  =>'error',
                'message' => $e->getMessage()
            ]);
        }
    }
}
