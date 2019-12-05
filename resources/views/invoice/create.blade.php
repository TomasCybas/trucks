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
                        <form id="invoice-form" method="post" action="{{route('invoice.store', $booking)}}">
                            @csrf
                            <div class="col-3 ml-auto">
                                <div class="form-group form-row">
                                    <label class="col-form-label col-12">
                                        Išrašymo data
                                        <input type="date" name="date" class="form-control">
                                    </label>
                                </div>

                            </div>
                            <div class="col-2 ml-auto">
                                <div class="form-group form-row">
                                    <label for="invoice_no" class="col-form-label col-3">SKS</label>
                                    <div class="col-9">
                                        <input id="invoice_no" name="invoice_no" type="text" class="form-control" value="{{$invoice_no}}">
                                    </div>
                                </div>
                            </div>
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
                                                <input type="text" name="lines[0][item_quantity]" class="form-control item-quantity" value="1">
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-2">
                                        <div class="form-group form-row">
                                            <label class="col-form-label col-12">
                                                Kaina
                                                <input type="text" name="lines[0][item_price]" class="form-control item-price" value="{{$booking->price/100}}" >
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-2">
                                        <div class="form-group form-row">
                                            <label class="col-form-label col-9">
                                                Viso
                                                <input type="text" name="lines[0][item_total]" class="form-control item-total" value="" >
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
                            <input type="hidden" name="grand_total">
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
