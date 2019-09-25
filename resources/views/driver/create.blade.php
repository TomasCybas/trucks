@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">Dashboard</div>
                    {{--TODO: add backend validation error messages--}}

                    <div class="card-body">
                     <form action="{{route('driver.store')}}" method="post">
                         @csrf
                         <div class="form-group">
                             <label for="name">Vardas</label>
                             <input type="text" name="name" id="name" class="form-control" value="{{old('name')}}" required>
                         </div>
                         @if($errors->has('name'))
                             <div class="alert alert-danger">
                                 {{$errors->first('name')}}
                             </div>
                         @endif
                         <div class="form-group">
                             <label for="surname">Pavardė</label>
                             <input type="text" name="surname" id="surname" class="form-control" value="{{old('surname')}}" required>
                         </div>
                         @if($errors->has('surname'))
                             <div class="alert alert-danger">
                                 {{$errors->first('surname')}}
                             </div>
                         @endif
                         <div class="form-group">
                             <label for="date_of_birth">Gimimo data</label>
                             <input type="date" name="date_of_birth" id="date_of_birth" class="form-control" value="{{old('date_of_birth')}}" required>
                         </div>
                         @if($errors->has('date_of_birth'))
                             <div class="alert alert-danger">
                                 {{$errors->first('date_of_birth')}}
                             </div>
                         @endif
                         <div class="form-group">
                             <label for="driver_license_no">Vairuotojo pažymėjimo Nr.</label>
                             <input type="text" name="driver_license_no" id="driver_license_no" class="form-control" value="{{old('driver_license_no')}}" required >
                         </div>
                         @if($errors->has('driver_license_no'))
                             <div class="alert alert-danger">
                                 {{$errors->first('driver_license_no')}}
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
