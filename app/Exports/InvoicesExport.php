<?php

namespace App\Exports;

use App\Invoice;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;

class InvoicesExport implements FromCollection
{
    /**
    * @return Collection
    */
    public function collection()
    {
        return Invoice::all();
    }
}
