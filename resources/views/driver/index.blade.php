@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Dashboard</div>
                    {{--TODO: add backend validation error messages--}}

                    <div class="card-body">
                        <a href="{{route('driver.create')}}" class="btn btn-success btn-lg mb-4">Pridėti naują</a>
                        <br>
                     <table class="table">
                         <thead>
                         <tr>
                             <th>Vardas</th>
                             <th>Pavardė</th>
                             <th>Gimimo data</th>
                             <th>Vairuotojo paž. Nr.</th>
                             <th></th>
                         </tr>
                         </thead>
                         <tbody>
                         @foreach($drivers as $driver)
                             <tr>
                                 <td>{{$driver->name}}</td>
                                 <td>{{$driver->surname}}</td>
                                 <td>{{$driver->date_of_birth}}</td>
                                 <td>{{$driver->driver_license_no}}</td>
                                 <td>
                                     <a href="{{route('driver.edit', $driver->id)}}" class="btn btn-sm btn-success">Koreguoti</a>
                                     <a href="{{route('driver.delete', $driver->id)}}" onclick="return confirm('Ar tikrai norite ištrinti?')" class="btn btn-sm btn-danger">Ištrinti</a>
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
