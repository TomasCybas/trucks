<table class="table">
    <thead>
    <tr>
        <th>Sąsk. Nr.</th>
        <th>Data</th>
        <th>Pirkėjas</th>
        <th>Suma</th>
    </tr>
    </thead>
    <tbody>
    @foreach($invoices as $invoice)
        <tr>
            <td>{{$invoice->invoice_no}}</td>
            <td>{{$invoice->date}}</td>
            <td>{{$invoice->client->name}}</td>
            <td>{{$invoice->total/100}}</td>
        </tr>
    @endforeach
    </tbody>
</table>

