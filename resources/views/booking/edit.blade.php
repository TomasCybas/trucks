@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Dashboard</div>
                    {{--TODO: add backend validation error messages--}}
                    <div class="card-body">
                        <form action="{{route('booking.update', $booking->id)}}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="client_id">Klientas</label>
                                <select type="text" name="client_id" id="client_id" class="form-control" required>
                                    <option selected value="{{$booking->client_id}}">{{$booking->client->name}}</option>
                                </select>

                            </div>
                            <div class="form-group">
                                <label for="loading_city_id">Pakrovimo miestas</label>
                                <select type="text" name="loading_city_id" id="loading_city_id" class="form-control city-select2" required>
                                    <option selected value="{{$booking->loading_city_id}}">{{$booking->loadingCity->name}}</option>

                                </select>
                            </div>
                            <div class="form-group">
                                <label for="unloading_city_id">Iškrovimo miestas</label>
                                <select type="text" name="unloading_city_id" id="unloading_city_id" class="form-control city-select2" required>
                                    <option selected value="{{$booking->unloading_city_id}}">{{$booking->unloadingCity->name}}</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="container_no">Konteinerio numeris</label>
                                <input type="text" name="container_no" id="container_no" class="form-control" required value="{{$booking->container_no}}">
                            </div>
                            <div class="form-group">
                                <label for="container_type">Konteinerio tipas</label>
                                <select type="text" name="container_type" id="container_type" class="form-control" required>
                                    <option selected value="{{$booking->container_type}}">{{$booking->container_type}} </option>
                                    <option value="1">Type A</option>
                                    <option value="2">Type B</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="type">Tipas</label>
                                <select type="text" name="type" id="type" class="form-control" required>
                                    <option value="1" {{$booking->type == 'tiesioginis' ? 'selected':''}}>Tiesioginis</option>
                                    <option value="2" {{$booking->type == 'tiesioginis' ? 'selected':''}}>Atgalinis</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="loading_date">Pakrovimo data</label>
                                <input type="date" name="loading_date" id="loading_date" class="form-control" required value="{{$booking->loading_date}}">
                            </div>
                            <div class="form-group">
                                <label for="unloading_date">Iškrovimo data</label>
                                <input type="date" name="unloading_date" id="unloading_date" class="form-control" required value="{{$booking->unloading_date}}">
                            </div>
                            <div class="form-group">
                                <label for="driver_id">Vairuotojas</label>
                                <select type="text" name="driver_id" id="driver_id" class="form-control" required>
                                    <option selected value="{{$booking->driver_id}}">{{$booking->driver->name}} {{$booking->driver->surname}}</option>
                                    @foreach($drivers as $driver)
                                        <option value="{{$driver->id}}">{{$driver->name}} {{$driver->surname}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="truck_id">Sunkvežimis</label>
                                <select type="text" name="truck_id" id="truck_id" class="form-control" required>
                                    <option selected value="{{$booking->truck_id}}">{{$booking->truck->brand}} {{$booking->truck->model}}, valst. nr.: {{$booking->truck->reg_number}}</option>
                                    @foreach($trucks as $truck)
                                        <option value="{{$truck->id}}">{{$truck->brand}} {{$truck->model}}, valst. nr.: {{$truck->reg_number}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="vat">PVM</label>
                                <select type="text" name="vat" id="vat" class="form-control" required>
                                    <option selected value="{{$booking->vat}}">{{$booking->vat}}</option>
                                    <option value="2" >Ne</option>
                                    <option value="1" >Taip</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="price">Kaina</label>
                                <input type="text" name="price" id="price" class="form-control" required value="{{$booking->price/100}}">
                            </div>
                            <div class="form-group">
                                <label for="currency">Valiuta</label>
                                <select type="text" name="currency" id="currency" class="form-control" required>
                                    <option selected value="{{$booking->currency}}">{{$booking->currency}}</option>
                                    <option value="1">EUR</option>
                                    <option value="2">USD</option>
                                </select>
                            </div>


                            <button type="submit" class="btn btn-success">Išsaugoti</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@include('layouts.select2_booking_scripts')



