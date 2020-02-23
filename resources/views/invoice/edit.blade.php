@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">Sąskaita</div>
                    <div class="card-body">
                        <form id="invoice-form" method="post" action="{{route("invoice.update", $invoice)}}">
                            @csrf
                            <div class="col-4 nopadleft">
                                <div class="form-group">
                                    <label for="client_id">Klientas</label>
                                    <select type="text" name="client_id" id="client_id"
                                            class="form-control client-select2" required>
                                        <option selected
                                                value="{{$invoice->client_id}}">{{$invoice->client->name}}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-12 clearfix nopadleft">
                                <div class="col-9 float-left nopadleft">
                                    <div class="form-group form-row">
                                        <label class="col-form-label col-3">
                                            Apmokėti iki:
                                            <input type="date" name="payment_date" class="form-control"
                                                   value="{{$invoice->payment_date}}" required>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-3 float-right">
                                    <div class="col-12">
                                        <div class="form-group form-row">
                                            <label class="col-form-label col-12">
                                                Išrašymo data
                                                <input type="date" name="date" class="form-control"
                                                       value="{{$invoice->date}}" required>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group form-row">
                                            <label for="invoice_no" class="col-form-label col-7"><strong>Sąskaita
                                                    TRANS</strong> </label>
                                            <div class="col-5">
                                                <input id="invoice_no" name="invoice_no" type="text"
                                                       class="form-control" value="{{$invoice->invoice_no}}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                                <script>
                                    var lineSelect = [];
                                </script>
                            <div class="invoice-lines-container">
                                @foreach($invoice->items as $key => $item)
                                    <div class="form-row invoice-line">
                                        <div class="col-4">
                                            <div class="form-group form-row">
                                                <label class="col-form-label col-12">
                                                    Paslauga/pavadinimas
                                                    <input type="text" name="lines[{{$key}}][item_name]"
                                                           class="form-control item-name"
                                                           value="{{$item->name}}" required>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <div class="form-group form-row">
                                                <label class="col-form-label col-12">
                                                    Konteinerio nr.
                                                    <select type="text" name="lines[{{$key}}][booking_id]"
                                                            class="form-control booking-select2">
                                                        {{--<option selected
                                                                value="{{$item->booking_id}}">{{$item->booking->container_no . 'selected'}}</option>--}}
                                                    </select>
                                                    <script>
                                                        lineSelect['{{$key}}'] = $('select[name="lines[{{$key}}][booking_id]"]');
                                                        $.ajax({
                                                            type: 'GET',
                                                            url: '{{route('select.booking.single', $item->booking_id)}}'
                                                        }).then(function (data) {
                                                            var newData = data.results;
                                                            var option = new Option(newData.text, newData.id, true, true);
                                                            lineSelect['{{$key}}'].append(option);
                                                            lineSelect['{{$key}}'].select2('data')[0].price = '{{$item->price}}';
                                                            lineSelect['{{$key}}'].trigger('change');
                                                            lineSelect['{{$key}}'].trigger({
                                                                type: 'select2:select',
                                                                params: {
                                                                    newData
                                                                }
                                                            });
                                                        })
                                                    </script>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-1">
                                            <div class="form-group form-row">
                                                <label class="col-form-label col-12">
                                                    Kiekis
                                                    <input type="text" name="lines[{{$key}}][item_quantity]"
                                                           class="form-control item-quantity"
                                                           value="{{$item->quantity}}" required>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-2">
                                            <div class="form-group form-row">
                                                <label class="col-form-label col-12">
                                                    Kaina
                                                    <input type="text" name="lines[{{$key}}][item_price]"
                                                           class="form-control item-price"
                                                           value="{{$item->price/100}}"
                                                           required>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-2">
                                            <div class="form-group form-row">
                                                <label class="col-form-label col-9">
                                                    Viso
                                                    <input type="text" name="lines[{{$key}}][item_total]"
                                                           class="form-control item-total" value="" readonly>
                                                </label>
                                                @if($key > 0)
                                                    <div class="col-form-label col-2">
                                                        <br>
                                                        <a href="#" class="btn btn-danger remove-line">X</a>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <a href="#" @click="addItem" id="add_invoice_line" class="btn btn-success">+</a>
                            <input type="hidden" name="grand_total">
                            <div class="grand-total text-right">Iš viso: <span></span></div>
                            <div class="form-group mt-4 text-right">
                                <div class="form-check form-group">
                                    <input type="checkbox" id="vat" name="vat" value="1"
                                           {{$invoice->vat == 1 ? 'checked' : ''}} class="form-check-input">
                                    <label for="vat" class="form-check-label">PVM</label>
                                </div>
                                <button type="submit" class="btn btn-success">Išsaugoti</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Add client modal -->
    <div class="modal fade" id="create_client_form_modal" tabindex="-1" role="dialog"
         aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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
                            <input type="text" name="name" id="name" class="form-control" value="{{old('name')}}"
                                   required>
                        </div>
                        <div class="form-group">
                            <label for="company_code">Įmonės kodas</label>
                            <input type="text" name="company_code" id="company_code" class="form-control"
                                   value="{{old('company_code')}}" required>
                        </div>
                        <div class="form-group">
                            <label for="vat_code">PVM mokėtojo kodas</label>
                            <input type="text" name="vat_code" id="vat_code" class="form-control"
                                   value="{{old('vat_code')}}" required>
                        </div>
                        <div class="form-group">
                            <label for="address">Adresas</label>
                            <input type="text" name="address" id="address" class="form-control"
                                   value="{{old('address')}}" required>
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
