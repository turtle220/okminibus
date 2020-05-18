<?php

namespace App\Exports;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\FromCollection;

class InvoiceExcel implements FromView
{

	public $data;
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        //
          return view('excel.excelprint', [
            'values' => $this->data
        ]);
    }

    public function getData($data)
    {
    	$this->data = $data;
    }
}
