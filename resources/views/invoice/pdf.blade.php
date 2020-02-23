<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <title>Sąskaitos numeris</title>
    <style type="text/css">
        body {
            font-family: DejaVu Sans, sans-serif;
        }

        .clearfix::after {
            content: '';
            clear: both;
            display: table;
        }

        .company-logo {
            float: right;
            font-size: 25px;
            font-weight: bold;
            text-transform: uppercase;
        }

        .company-details {
            float: left;
            font-size: 8px;
            color: #8C8D96;
        }

        .main-header {
            margin-bottom: 15px
        }

        .main-header span {
            display: block;
        }

        .invoice-head {
            text-align: center;
            margin-bottom: 25px;
        }

        .title {
            font-size: 20px;
        }

        .date {
            font-size: 14px;
        }

        .seller {
            float: left;
            width: 45%;
        }

        .buyer {
            float: right;
            width: 45%;
        }

        .requisites {
            font-size: 10px;
        }

        .requisites-section {
            margin-bottom: 40px;
        }

        table {
            font-size: 12px;
            width: 100%;
        }
    </style>
</head>

<body>
<header>
  {{--  <div class="main-header clearfix">
        <div class="company-details">
            UAB Transbrieva<br>
            Įm. kodas: 304181177<br>
            PVM mok. kodas: LT100009993918<br>
            Dariaus ir Girėno g. 49-4, LT-75128 Šilalė<br>
            +37062927218 <br>
            transbrieva@gmail.com
        </div>
        <div class="company-logo">LOGO??</div>
    </div>--}}
    <div class="invoice-head">
        <div class="title">PVM SĄSKAITA FAKTŪRA</div>
        <div class="serial">Serija TRANS Nr.: 00000001</div>
        <div class="date">2020-02-01</div>
    </div>
</header>
<section class="requisites-section">
    <div class=" requisites clearfix">
        <div class="seller">
            <span><strong>PARDAVĖJAS</strong></span> <br> <br>
            UAB Transbrieva<br>
            Įm. kodas: 304181177<br>
            PVM mok. kodas: LT100009993918<br>
            Dariaus ir Girėno g. 49-4, LT-75128 Šilalė<br>
            A/S: LT137300010145924488

        </div>
        <div class="buyer">
            <span><strong>PIRKĖJAS</strong></span> <br> <br>
            {{$invoice->client->name}}<br>
            Įm. kodas: {{$invoice->client->company_code}}<br>
            PVM mok. kodas: {{$invoice->client->vat_code}}<br>
            {{$invoice->client->address}}<br>
        </div>
    </div>
</section>

<section>
    <table>
        <tr>
            <td style="border-top: 2px solid black;">
                <table>
                    <thead>
                    <tr>
                        <th>Prekės, turto ar paslaugos pavadinimas</th>
                        <th>Mato vnt.</th>
                        <th>Kiekis</th>
                        <th style="text-align: right">Kaina</th>
                        <th style="text-align: right">Suma</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($invoice->items as $item)
                    <tr>
                        <td>{{$item->name}}</td>
                        <td></td>
                        <td>{{$item->quantity}}</td>
                        <td style="text-align: right">{{$item->price/100}} EUR</td>
                        <td style="text-align: right">{{$item->total/100}} EUR</td>
                    </tr>
                    @endforeach
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td style="border-top: 2px solid black; text-align: right"><strong>Iš viso:</strong></td>
                        <td style="border-top: 2px solid black; text-align: right"><strong>{{$invoice->total/100}} EUR</strong></td>
                    </tr>
                    <tr>
                        <td style="height: 15px;"></td>
                    </tr>
                    </tbody>
                </table>
            </td>
        </tr>
        <tr>
            <td style="border-top: 2px solid black;">
                <table>
                    <thead>
                   <tr>
                       <th style="width: 60%">Suma žodžiais:</th>
                       <th style="text-align: right">{{$invoice->vat == 1 ? 'Apmokestinama PVM' : '45 straipsnis 1-3 dalys'}}</th>
                       <th style="text-align: right">PVM suma</th>
                   </tr>
                    <tr>
                        <td><strong>{{$total_string}}</strong></td>
                        <td style="text-align: right">{{$invoice->vat == 1 ? '21%' : ''}}</td>
                        <td style="text-align: right;">{{$vat_total/100}} EUR</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td style="text-align: right">Bendra suma:</td>
                        <td style="text-align: right">{{$grand_total/100}} EUR</td>
                    </tr>
                    <tr>
                        <td>Apmokėti iki 2020-20-20</td>
                    </tr>
                    <tr>
                        <td style="height: 25px"></td>
                    </tr>
                    </thead>
                </table>
            </td>
        </tr>
        <tr>
            <td>
                <table>
                    <tr>
                        <td style="width: 100%; border-bottom: 1px solid black">Sąskaitą išrašė: Direktorius Valentinas Briedis</td>
                    </tr>
                    <tr><td style="width: 100%; font-size: 8px; text-align: center">Vardas, Pavardė, parašas</td></tr>
                    <tr>
                        <td style="height: 40px;"></td>
                    </tr>
                    <tr>
                        <td style="width: 100%; border-bottom: 1px solid black">Sąskaitą priėmė</td>
                    </tr>
                    <tr><td style="width: 100%; font-size: 8px; text-align: center">Vardas, Pavardė, parašas</td></tr>
                </table>
            </td>
        </tr>
    </table>
</section>


</body>

</html>

{{--todo: suma žodžiais išskirti eurus ir centus--}}
