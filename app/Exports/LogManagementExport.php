<?php

namespace App\Exports;

use App\Models\LogManagement;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class LogManagementExport implements FromCollection, WithHeadings
{
    protected $request;

    function __construct($request) {
        $this->request = $request;
    }
    
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $data = LogManagement::export_excel($this->request);

        return $data;
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function headings(): array
    {
        return ["ID", "IP", "URL", "Log", "Data ID", "File Name", "File Path", "Latitude", "Longitude", "User Input", "Created At"];
    }
}
