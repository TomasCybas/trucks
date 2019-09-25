<?php

namespace App\Http\Controllers;

use App\Client;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ClientController extends Controller
{
    public function index(){
        $clients = Client::all();
        return view('client.index', ['clients' => $clients] );
    }

    public function create(){
       return view('client.create');
    }

    public function store(Request $request){

        $this->validate($request, [
            'name' => 'required',
            'company_code' => 'unique:clients,company_code',
            'vat_code' => 'unique:clients,vat_code',
        ],
            [
                'company_code.unique' => 'Įmonė su tokiu įmonės kodu jau egzistuoja.',
                'vat_code.unique' => 'Įmonė su tokiu PVM kodu jau egzistuoja.',

            ]);

        $client = new Client();
        $client->name= $request->name;
        $client->company_code= $request->company_code;
        $client->vat_code= $request->vat_code;
        $client->address= $request->address;
        $client->save();
        return redirect()->route('clients')->with('success', "Pridėta įmonė $client->name");
    }

    public function edit($id){
        $client = Client::find($id);
        return view('client.edit', ['client' => $client]);
    }

    public function update($id, Request $request){

        $this->validate($request, [
            'name' => 'required',
            'company_code' => 'unique:clients,company_code',
            'vat_code' => 'unique:clients,vat_code',
        ],
            [
                'company_code.unique' => 'Įmonė su tokiu įmonės kodu jau egzistuoja.',
                'vat_code.unique' => 'Įmonė su tokiu PVM kodu jau egzistuoja.',

            ]);
        $client = Client::find($id);
        $client->name= $request->name;
        $client->company_code= $request->company_code;
        $client->vat_code= $request->vat_code;
        $client->address= $request->address;
        $client->save();

        return redirect()->route('clients')->with('success', "$client->name informacija atnaujinta");

    }

    public function delete($id){
        Client::destroy($id);

        return redirect()->route('clients');
    }
    //TODO: add show, methods,
}
