<?php

namespace App\Imports;

use App\Cliente;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithCustomCsvSettings;

class AppImportData implements ToModel
{
    /**
     * @param array $row
     *
     * @return ClienteI|null
     */
    public function model(array $row)
    {
        return new ClienteI([
           'nombreSr'     => $row[0],
           'NombreSra'    => $row[1],
           
        ]);
    }

    public function getCsvSettings(): array
    {
        return [
            'input_encoding' => 'ISO-8859-1'
            
        ];
    }
}
