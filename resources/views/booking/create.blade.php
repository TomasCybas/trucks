@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Dashboard</div>
                    {{--TODO: add backend validation error messages--}}
                    <div class="card-body">
                        <form action="{{route('booking.store')}}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="client_id">Klientas</label>
                                <select type="text" name="client_id" id="client_id" class="form-control" required></select>
                            </div>
                            <div class="form-group">
                                <label for="loading_city_id">Pakrovimo miestas</label>
                                <select type="text" name="loading_city_id" id="loading_city_id" class="form-control city-select2" required>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="unloading_city_id">Iškrovimo miestas</label>
                                <select type="text" name="unloading_city_id" id="unloading_city_id" class="form-control city-select2" required>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="container_no">Konteinerio numeris</label>
                                <input type="text" name="container_no" id="container_no" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="container_type">Konteinerio tipas</label>
                                <select type="text" name="container_type" id="container_type" class="form-control" required>
                                    <option value="">Pasirinkite konteinerio tipą </option>
                                    <option value="1">Type A</option>
                                    <option value="2">Type B</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="type">Tipas</label>
                                <select type="text" name="type" id="type" class="form-control" required>
                                    <option value="">Pasirinkite pervežimo tipą</option>
                                    <option value="1">Tiesioginis</option>
                                    <option value="2">Atgalinis</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="loading_date">Pakrovimo data</label>
                                <input type="date" name="loading_date" id="loading_date" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="unloading_date">Iškrovimo data</label>
                                <input type="date" name="unloading_date" id="unloading_date" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="driver_id">Vairuotojas</label>
                                <select type="text" name="driver_id" id="driver_id" class="form-control" required>
                                    <option></option>
                                    @foreach($drivers as $driver)
                                        <option value="{{$driver->id}}">{{$driver->name}} {{$driver->surname}}</option>
                                    @endforeach

                                </select>
                            </div>
                            <div class="form-group">
                                <label for="truck_id">Sunkvežimis</label>
                                <select type="text" name="truck_id" id="truck_id" class="form-control" required>
                                    <option></option>
                                    @foreach($trucks as $truck)
                                        <option value="{{$truck->id}}">{{$truck->brand}} {{$truck->model}}, valst. nr.: {{$truck->reg_number}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="vat">PVM</label>
                                <select type="text" name="vat" id="vat" class="form-control" required>
                                    <option selected value="2">Ne</option>
                                    <option value="1" >Taip</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="price">Kaina</label>
                                <input type="text" name="price" id="price" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="currency">Valiuta</label>
                                <select type="text" name="currency" id="currency" class="form-control" required>
                                    <option value="1">EUR</option>
                                    <option value="2">USD</option>
                                </select>
                            </div>


                            <button type="submit" class="btn btn-success">Pridėti</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Add city modal -->
    <div class="modal fade" id="create_city_form_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="form-modal" action="{{route('city.store')}}" method="post">
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
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-success">Pridėti</button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Atšaukti</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection


@include('layouts.select2_booking_scripts')


