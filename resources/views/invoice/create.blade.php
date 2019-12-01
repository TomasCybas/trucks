@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">Sąskaita</div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-4">
                                <strong>Pirkėjas:</strong>
                                <br>
                                {{$booking->client->name}}
                                <br>
                                Įmonės kodas: {{$booking->client->company_code}}
                                <br>
                                PVM kodas: {{$booking->client->vat_code}}
                                <br>
                                Adresas: {{$booking->client->address}}

                            </div>

                        </div>
                        <form id="invoice-form" method="post" action="{{route('invoice.store')}}">
                            @csrf
                            <div class="invoice-lines-container">
                                <div class="form-row invoice-line">
                                    <div class="col-7">
                                        <div class="form-group form-row">
                                            <label class="col-form-label col-12">
                                                Paslauga/pavadinimas
                                                <input type="text" name="lines[0][item_name]" class="form-control item-name">
                                            </label>
                                        </div>

                                    </div>
                                    <div class="col-1">
                                        <div class="form-group form-row">
                                            <label class="col-form-label col-12">
                                                Kiekis
                                                <input type="text" name="lines[0][item_quantity]" class="form-control item-quantity">
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-2">
                                        <div class="form-group form-row">
                                            <label class="col-form-label col-12">
                                                Kaina
                                                <input type="text" name="lines[0][item_price]" class="form-control item-price" >
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-2">
                                        <div class="form-group form-row">
                                            <label class="col-form-label col-9">
                                                Viso
                                                <input type="text" name="lines[0][item_total]" class="form-control item-total" value="" disabled>
                                            </label>
                                            <div class="col-form-label col-2">
                                                <br>
                                                <a href="#" class="btn btn-danger remove-line">X</a>
                                            </div>



                                        </div>
                                    </div>
                                </div>
                            </div>
                            <a href="#" @click="addItem" id="add_invoice_line" class="btn btn-success">+</a>
                            <div class="grand-total text-right">Iš viso: <span></span></div>
                            <div class="form-group mt-4 text-right">
                                <button type="submit" class="btn btn-success">Išsaugoti</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@include('layouts.select2_booking_scripts')
