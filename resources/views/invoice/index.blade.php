@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Sąskaitos</div>
                    <div class="card-body">
                        <a href="{{route('invoice.create')}}" class="btn btn-success btn-lg mb-4">Pridėti naują</a>
                        <div class="row">
                            <form id="invoice-export-form" method="post">
                                @csrf
                                <div class="col-sm-12">
                                    <div class="form-group form-row">
                                        <label class="col-form-label col-sm-12 col-md-6">
                                            Nuo
                                            <input type="date" name="from_date" class="form-control" required>
                                        </label>
                                        <label class="col-form-label col-sm-12 col-md-6">
                                            Iki
                                            <input type="date" name="to_date" class="form-control" required>
                                        </label>
                                        <div class="col-sm-12">
                                            <button type="submit" formaction="{{route('invoices.export_view')}}" class="btn btn-primary btn-lg mb-4">Eksportuoti</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <table class="table table-responsive-lg">
                            <thead>
                            <tr>
                                <th>Sąsk. Nr.</th>
                                <th>Data</th>
                                <th>Pirkėjas</th>
                                <th>Suma</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($invoices as $invoice)
                                <tr>
                                    <td>{{$invoice->invoice_no}}</td>
                                    <td>{{$invoice->date}}</td>
                                    <td>{{$invoice->client->name}}</td>
                                    <td>{{$invoice->total/100}}</td>
                                    <td>
                                        <a href="{{route('invoice.pdf', $invoice)}}" class="btn btn-sm btn-success">PDF</a>
                                        <a href="{{route('invoice.edit', $invoice)}}" class="btn btn-sm btn-success">Koreguoti</a>
                                        <a href="{{route('invoice.delete', $invoice)}}" onclick="return confirm('Ar tikrai norite ištrinti?')" class="btn btn-sm btn-danger">Ištrinti</a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
               {{--     @foreach( $invoices as $invoice)
                            <div class="row">
                                <div class="col-sm-12 col-md-6">
                                    {{$invoice->client->name}}
                                </div>
                                <div class="col-sm-12 col-md-6">
                                    <a href="{{route('invoice.pdf', $invoice)}}" class="btn btn-success">PDF</a>
                                </div>
                            </div>
                        @endforeach--}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@include('layouts.select2_booking_scripts')
