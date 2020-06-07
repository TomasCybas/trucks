@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Dashboard</div>

                    <div class="card-body">
                        <a href="{{route('booking.create')}}" class="btn btn-lg btn-success mb-3">Kurti naują</a>
                        <a href="#" id="filter_menu_trigger" class="btn btn-lg btn-dark mb-3 float-right">Filtrai</a>
                        <div class="row">
                            <div class="col-12 filter-container mb-3">
                                <form action="{{route('filter.bookings')}}" method="post">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="client_id">Klientas</label>
                                                <select type="text" name="client_id" id="client_id"
                                                        class="form-control client-select2 noModal"></select>
                                            </div>
                                            <div class="form-group">
                                                <label for="loading_city_id">Pakrovimo miestas</label>
                                                <select type="text" name="loading_city_id" id="loading_city_id"
                                                        class="form-control city-select2 noModal">
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="unloading_city_id">Iškrovimo miestas</label>
                                                <select type="text" name="unloading_city_id" id="unloading_city_id"
                                                        class="form-control city-select2 noModal">
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="container_type">Konteinerio tipas</label>
                                                <select type="text" name="container_type" id="container_type"
                                                        class="form-control">
                                                    <option value="">Pasirinkite konteinerio tipą</option>
                                                    <option value="1">40'DV</option>
                                                    <option value="2">40'HQ</option>
                                                    <option value="3">20'DV</option>
                                                    <option value="4">40'REF</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="type">Tipas</label>
                                                <select type="text" name="type" id="type" class="form-control">
                                                    <option value="">Pasirinkite pervežimo tipą</option>
                                                    <option value="1">Tiesioginis</option>
                                                    <option value="2">Atgalinis</option>
                                                </select>
                                            </div>

                                            <div class="form-group">
                                                <label for="loading_date">Pakrovimo data</label>
                                                <input type="date" name="loading_date" id="loading_date"
                                                       class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label for="driver_id">Vairuotojas</label>
                                                <select type="text" name="driver_id" id="driver_id"
                                                        class="form-control driver-select2 noModal">
                                                    <option></option>
                                                    @foreach($drivers as $driver)
                                                        <option
                                                            value="{{$driver->id}}">{{$driver->name}} {{$driver->surname}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="driver_id">Sunkvežimis</label>
                                                <select type="text" name="truck_id" id="truck_id"
                                                        class="form-control truck-select2 noModal">
                                                    <option></option>
                                                    @foreach($trucks as $truck)
                                                        <option
                                                            value="{{$truck->id}}">{{$truck->brand}} {{$truck->model}}, valst. nr.: {{$truck->reg_number}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-dark">Filtruoti</button>
                                </form>
                            </div>
                        </div>
                        <table class="table table-responsive-xl">
                            <thead>
                            <tr>
                                <th>Užsakovas</th>
                                <th>Pakrovimo vieta</th>
                                <th>Iškrovimo vieta</th>
                                <th>Pakrovimo data</th>
                                <th>Konteinerio tipas</th>
                                <th>Konteinerio numeris</th>
                                <th>Krovinio tipas</th>
                                <th>Vairuotojas</th>
                                <th>Sunkvežimis</th>
                                <th>PVM</th>
                                <th>Kaina</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($bookings as $booking)
                                <tr>
                                    <td>{{$booking->client->name}}</td>
                                    <td>{{$booking->loadingCity->name}}</td>
                                    <td>{{$booking->unloadingCity->name}}</td>
                                    <td>{{$booking->loading_date}}</td>
                                    <td>{{$booking->container_type}}</td>
                                    <td>{{$booking->container_no}}</td>
                                    <td>{{$booking->type}}</td>
                                    <td>{{$booking->driver->name.' '.$booking->driver->surname}}</td>
                                    <td>{{$booking->truck->brand.' '.$booking->truck->model.' '.$booking->truck->reg_number}}</td>
                                    <td>{{$booking->vat == "1" ? "Taip" : "Ne"}}</td>
                                    <td>{{$booking->price/100}}</td>
                                    <td>
                                        <a href="{{route('invoice.create', $booking)}}" class="btn btn-sm btn-success mb-1">Sąskaita</a>
                                        <a href="{{route('booking.edit', $booking->id)}}"
                                           class="btn btn-sm btn-success mb-1">Koreguoti</a>
                                        <a href="{{route('booking.delete', $booking->id)}}"
                                           onclick="return confirm('Ar tikrai norite ištrinti?')"
                                           class="btn btn-sm btn-danger">Ištrinti</a>
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

@include('layouts.select2_booking_scripts')
