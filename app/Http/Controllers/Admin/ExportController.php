<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GuestsModel;
use Illuminate\Http\Request;

class ExportController extends Controller
{
    public function exportToCSV(Request $request)
    {
        $data = GuestsModel::select('id', 'name', 'phone', 'email')->get(); // Fetch the data to export

        $csvFileName = 'exported_data.csv';
        $headers = [
            'Content-Type' => 'text/csv; charset=utf-8',
            'Content-Disposition' => "attachment; filename=$csvFileName",
            'Pragma' => 'no-cache',
            'Cache-Control' => 'must-revalidate, post-check=0, pre-check=0',
            'Expires' => '0',
            'BOM' => "\xEF\xBB\xBF", // UTF-8 BOM for Excel compatibility
        ];

        $callback = function () use ($data) {
            $file = fopen('php://output', 'w');

            // Add UTF-8 BOM to support non-English characters in Excel
            fputs($file, "\xEF\xBB\xBF");

            // Custom header names
            $customHeader = ['name', 'phone', 'email', 'QR_url'];

            // Write custom header to CSV
            fputcsv($file, $customHeader);
            
            // Add headers
            //fputcsv($file, array_keys($data->first()->toArray()));

            // Add data
            foreach ($data as $item) {
                // Convert each item's values to UTF-8 before adding to the CSV
                $url  = route('admin.guest.visits.check' , $item->id);
                $row = [
                    $item->name,
                    $item->phone,
                    $item->email,
                    $url, // Replace with the actual value you want for the custom column
                ];

                // foreach ($item->toArray() as $value) {
                //     $row[] = mb_convert_encoding($value, 'UTF-8', 'UTF-8');
                // }
                fputcsv($file, $row);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    public function exportAttendsToCSV(Request $request)
    {

        $data = GuestsModel::select('id', 'name', 'phone', 'email')
        ->where('attend' , 1)
        ->get(); // Fetch the data to export

        $csvFileName = 'exported_data.csv';
        $headers = [
            'Content-Type' => 'text/csv; charset=utf-8',
            'Content-Disposition' => "attachment; filename=$csvFileName",
            'Pragma' => 'no-cache',
            'Cache-Control' => 'must-revalidate, post-check=0, pre-check=0',
            'Expires' => '0',
            'BOM' => "\xEF\xBB\xBF", // UTF-8 BOM for Excel compatibility
        ];

        $callback = function () use ($data) {
            $file = fopen('php://output', 'w');

            // Add UTF-8 BOM to support non-English characters in Excel
            fputs($file, "\xEF\xBB\xBF");

            // Custom header names
            $customHeader = ['name', 'phone', 'email', 'QR_url'];

            // Write custom header to CSV
            fputcsv($file, $customHeader);
            
            // Add headers
            //fputcsv($file, array_keys($data->first()->toArray()));

            // Add data
            foreach ($data as $item) {
                // Convert each item's values to UTF-8 before adding to the CSV
                $url  = route('admin.guest.visits.check' , $item->id);
                $row = [
                    $item->name,
                    $item->phone,
                    $item->email,
                    $url, // Replace with the actual value you want for the custom column
                ];

                // foreach ($item->toArray() as $value) {
                //     $row[] = mb_convert_encoding($value, 'UTF-8', 'UTF-8');
                // }
                fputcsv($file, $row);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);

    }


}
