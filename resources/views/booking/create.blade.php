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
                                <select type="text" name="client_id" id="client_id" class="form-control client-select2" required></select>
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
                                <label for="driver_id">Vairuotojas</label>
                                <select type="text" name="driver_id" id="driver_id" class="form-control driver-select2" required>
                                    <option></option>
                                    @foreach($drivers as $driver)
                                        <option value="{{$driver->id}}">{{$driver->name}} {{$driver->surname}}</option>
                                    @endforeach

                                </select>
                            </div>
                            <div class="form-group">
                                <label for="truck_id">Sunkvežimis</label>
                                <select type="text" name="truck_id" id="truck_id" class="form-control truck-select2" required>
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
                    <h5 class="modal-title">Pridėti miestą</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="create_city_form" action="{{route('city.store')}}" method="post">
                        @csrf
                        <div id="modal_city_form_errors" class="alert alert-danger d-none">

                        </div>
                        <div class="form-group">
                            <label for="name">Miestas</label>
                            <input type="text" name="name" id="name" class="form-control" value="{{old('name')}}" required>
                        </div>
                        <div class="form-group">
                            <label for="country_name">Valstybė</label>
                            <input type="text" name="country_name" id="country_name" class="form-control" value="{{old('country_name')}}" required>
                        </div>

                        <div class="modal-footer">
                            <button type="submit" class="btn btn-success">Pridėti</button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Atšaukti</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Add client modal -->
    <div class="modal fade" id="create_client_form_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Pridėti klientą</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="create_client_form" action="{{route('client.store')}}" method="post">
                        @csrf
                        <div id="modal_client_form_errors" class="alert alert-danger d-none">

                        </div>
                        <div class="form-group">
                            <label for="name">Pilnas pavadinimas</label>
                            <input type="text" name="name" id="name" class="form-control" value="{{old('name')}}" required>
                        </div>
                        <div class="form-group">
                            <label for="company_code">Įmonės kodas</label>
                            <input type="text" name="company_code" id="company_code" class="form-control" value="{{old('company_code')}}" required>
                        </div>
                        <div class="form-group">
                            <label for="vat_code">PVM mokėtojo kodas</label>
                            <input type="text" name="vat_code" id="vat_code" class="form-control" value="{{old('vat_code')}}" required>
                        </div>
                        <div class="form-group">
                            <label for="address">Adresas</label>
                            <input type="text" name="address" id="address" class="form-control" value="{{old('address')}}" required >
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-success">Pridėti</button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Atšaukti</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Add truck modal -->
    <div class="modal fade" id="create_truck_form_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Pridėti sunkvežimį</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="create_truck_form" action="{{route('truck.store')}}" method="post">
                        @csrf
                        <div id="modal_truck_form_errors" class="alert alert-danger d-none">

                        </div>
                        <div class="form-group">
                            <label for="brand">Gamintojas</label>
                            <input type="text" name="brand" id="brand" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="model">Modelis</label>
                            <input type="text" name="model" id="model" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="reg_number">Registracijos Nr.</label>
                            <input type="text" name="reg_number" id="reg_number" class="form-control" required>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-success">Pridėti</button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Atšaukti</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Add driver modal -->
    <div class="modal fade" id="create_driver_form_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Pridėti vairuotoją</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="create_driver_form" action="{{route('driver.store')}}" method="post">
                        @csrf
                        <div id="modal_driver_form_errors" class="alert alert-danger d-none">

                        </div>
                        <div class="form-group">
                            <label for="name">Vardas</label>
                            <input type="text" name="name" id="name" class="form-control" value="{{old('name')}}" required>
                        </div>
                        <div class="form-group">
                            <label for="surname">Pavardė</label>
                            <input type="text" name="surname" id="surname" class="form-control" value="{{old('surname')}}" required>
                        </div>
                        <div class="form-group">
                            <label for="date_of_birth">Gimimo data</label>
                            <input type="date" name="date_of_birth" id="date_of_birth" class="form-control" value="{{old('date_of_birth')}}" required>
                        </div>
                        <div class="form-group">
                            <label for="driver_license_no">Vairuotojo pažymėjimo Nr.</label>
                            <input type="text" name="driver_license_no" id="driver_license_no" class="form-control" value="{{old('driver_license_no')}}" required >
                        </div>
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


