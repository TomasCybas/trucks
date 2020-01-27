@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Dashboard</div>
                    {{--TODO: add backend validation error messages--}}
                    <div class="card-body">
                        <a href="{{route('client.create')}}" class="btn btn-success btn-lg mb-4">Pridėti naują</a>
                        <br>
                        <table class="table">
                            <thead>
                            <tr>
                                <th>Pavadinimas</th>
                                <th>Įmonės kodas</th>
                                <th>PVM kodas</th>
                                <th>Adresas</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($clients as $client)
                                <tr>
                                    <td>{{$client->name}}</td>
                                    <td>{{$client->company_code}}</td>
                                    <td>{{$client->vat_code}}</td>
                                    <td>{{$client->address}}</td>
                                    <td>
                                        <a href="{{route('client.edit', $client->id)}}" class="btn btn-sm btn-success">Koreguoti</a>
                                        <a href="{{route('client.delete', $client->id)}}" onclick="return confirm('Ar tikrai norite ištrinti?')" class="btn btn-sm btn-danger">Ištrinti</a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

