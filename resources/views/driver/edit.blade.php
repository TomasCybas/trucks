@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">Dashboard</div>
                    {{--TODO: add backend validation error messages--}}

                    <div class="card-body">
                        <form action="{{route('driver.update', $driver->id)}}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="name">Vardas</label>
                                <input type="text" name="name" id="name" class="form-control"
                                       value="{{$driver->name}}" required>
                            </div>
                            <div class="form-group">
                                <label for="surname">Pavardė</label>
                                <input type="text" name="surname" id="surname" class="form-control"
                                       value="{{$driver->surname}}" required>
                            </div>
                            <div class="form-group">
                                <label for="date_of_birth">Gimimo data</label>
                                <input type="date" name="date_of_birth" id="date_of_birth" class="form-control"
                                       value="{{$driver->date_of_birth}}" required>
                            </div>
                            <div class="form-group">
                                <label for="driver_license_no">Vairuotojo pažymėjimo Nr.</label>
                                <input type="text" name="driver_license_no" id="driver_license_no" class="form-control"
                                       value="{{$driver->driver_license_no}}" required>
                            </div>
                            <button type="submit" class="btn btn-success">Atnaujinti</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

