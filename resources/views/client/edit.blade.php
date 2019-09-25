@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">Dashboard</div>
                    {{--TODO: add backend validation error messages--}}

                    <div class="card-body">
                        <form action="{{route('client.update', $client->id)}}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="name">Pilnas pavadinimas</label>
                                <input type="text" name="name" id="name" class="form-control"
                                       value="{{(old('name'))!='' ? old('name') : $client->name }}" required>
                            </div>
                            @if($errors->has('name'))
                                <div class="alert alert-danger">
                                    {{$errors->first('name')}}
                                </div>
                            @endif
                            <div class="form-group">
                                <label for="company_code">Įmonės kodas</label>
                                <input type="text" name="company_code" id="company_code" class="form-control"
                                       value="{{(old('company_code'))!= '' ? old('company_code') : $client->company_code }}" required>
                            </div>
                            @if($errors->has('company_code'))
                                <div class="alert alert-danger">
                                    {{$errors->first('company_code')}}
                                </div>
                            @endif
                            <div class="form-group">
                                <label for="vat_code">PVM mokėtojo kodas</label>
                                <input type="text" name="vat_code" id="vat_code" class="form-control"
                                       value="{{(old('vat_code'))!='' ? old('vat_code') : $client->vat_code }}" required>
                            </div>
                            @if($errors->has('vat_code'))
                                <div class="alert alert-danger">
                                    {{$errors->first('vat_code')}}
                                </div>
                            @endif
                            <div class="form-group">
                                <label for="address">Adresas</label>
                                <input type="text" name="address" id="address" class="form-control"
                                       value="{{(old('address'))!='' ? old('address') : $client->name }}" required >
                            </div>
                            @if($errors->has('address'))
                                <div class="alert alert-danger">
                                    {{$errors->first('address')}}
                                </div>
                            @endif
                            <button type="submit" class="btn btn-success">Išsaugoti</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
