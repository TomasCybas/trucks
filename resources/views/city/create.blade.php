@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">Dashboard</div>
                    {{--TODO: add backend validation error messages--}}
                    <div class="card-body">
                        <form action="{{route('city.store')}}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="name">Miestas</label>
                                <input type="text" name="name" id="name" class="form-control" value="{{old('name')}}" required>
                            </div>
                            @if($errors->has('name'))
                                <div class="alert alert-danger">
                                    {{$errors->first('name')}}
                                </div>
                            @endif
                            <div class="form-group">
                                <label for="country_name">Valstybė</label>
                                <input type="text" name="country_name" id="country_name" class="form-control" value="{{old('country_name')}}" required>
                            </div>
                            @if($errors->has('surname'))
                                <div class="alert alert-danger">
                                    {{$errors->first('surname')}}
                                </div>
                            @endif
                            <button type="submit" class="btn btn-success">Pridėti</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
