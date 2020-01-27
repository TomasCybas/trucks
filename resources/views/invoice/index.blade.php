@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Sąskaitos</div>

                    <div class="card-body">
                        @foreach( $invoices as $invoice)
                            <div class="row">
                                <div class="col-sm-12 col-md-6">
                                    {{$invoice->client->name}}
                                </div>
                                <div class="col-sm-12 col-md-6">
                                    <a href="{{route('invoice.pdf', $invoice)}}" class="btn btn-success">PDF</a>
                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@include('layouts.select2_booking_scripts')
