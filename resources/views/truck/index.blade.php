@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Dashboard</div>

                    <div class="card-body">
                        <a href="{{route('truck.create')}}" class="btn btn-success btn-lg mb-4">Pridėti naują</a>
                        <br>
                        <table class="table">
                            <thead>
                            <tr>
                                <th>Gamintojas</th>
                                <th>Modelis</th>
                                <th>Registracijos Nr.</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($trucks as $truck)
                                <tr>
                                    <td>{{$truck->brand}}</td>
                                    <td>{{$truck->model}}</td>
                                    <td>{{$truck->reg_number}}</td>
                                    <td>
                                        <a href="" class="btn btn-sm btn-success">Daugiau</a>
                                        <a href="{{route('truck.delete', $truck->id)}}" onclick="return confirm('Ar tikrai norite ištrinti?')" class="btn btn-sm btn-danger">Ištrinti</a>
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
