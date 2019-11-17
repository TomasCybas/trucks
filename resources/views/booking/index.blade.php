@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Dashboard</div>

                    <div class="card-body">
                        <a href="{{route('booking.create')}}" class="btn btn-lg btn-success mb-3">Kurti naują</a>
                        <a href="#" class="btn btn-lg btn-dark mb-3 float-right">Filtruoti</a>
                        <form>
                            {{--TODO: create a form for filtering results--}}
                        </form>
                        <table class="table">
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
                                    <td>{{$booking->vat}}</td>
                                    <td>{{$booking->price/100}}</td>

                                    <td>
                                        <a href="{{route('booking.edit', $booking->id)}}" class="btn btn-sm btn-success">Koreguoti</a>
                                        <a href="{{route('booking.delete', $booking->id)}}" onclick="return confirm('Ar tikrai norite ištrinti?')" class="btn btn-sm btn-danger">Ištrinti</a>
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
