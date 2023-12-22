<?php

namespace App\Imports;

use App\Models\GuestsModel;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithCustomCsvSettings;
use Maatwebsite\Excel\Concerns\WithStartRow;

class GuestsImport implements ToModel, WithStartRow, WithCustomCsvSettings
{

    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        // Check if any value in the row is null
        if (count(array_filter($row)) > 0) {
            return new GuestsModel([
                'name'  => $row[0] ?? null,
                'phone' => $row[1] ?? null,
                'email' => $row[2] ?? null,
            ]);
        }

        // If all values in the row are null, do not create a model instance
        return null;
    }


    public function startRow(): int
    {
        return 2; // Start from the second row
    }

    public function getCsvSettings(): array
    {
        return [
            'delimiter' => ',',
            'encoding' => 'UTF-8',
        ];
    }
}
