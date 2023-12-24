<?php

namespace App\Http\Controllers\Shared;

use App\Http\Controllers\Controller;
use App\Models\GuestsModel;
use App\Models\QrCodesModel;
use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;

class QrContoller extends Controller
{
    
    public function generateQrCode(Request $request)
    {
        //$url = "https://chat.openai.com/c/fb947e59-df67-4c70-82f5-096ae6f0f3e4";// $request->url;
        
        $guest  = GuestsModel::find($request->id);         
        $url    = route('admin.guest.visits.check' , $request->id);
        // Generate the QR code for the given URL
        $qrCode = QrCode::size(300)->format('png')->generate($url);
        
        // Convert the QR code string to binary data
        $imageData = base64_decode($qrCode);
        $guest_name = $guest->name ?? "qrCode";

        // Set response headers for file download
        $headers = [
            'Content-Type' => 'image/png',
            'Content-Disposition' => 'attachment; filename="'.$guest_name.'.png"',
        ];
        
        // dd($imageData);

        // Return response with QR code image for download
        return Response::make($qrCode, 200, $headers);

        //return view('qr_code', compact('qrCode'));
    }

    public function generateQrPublic(Request $request)
    {
     
        $qr     = QrCodesModel::where('id' , $request->id)->first(); 
        $url    = $qr->data;

        if($qr->type == 'pdf')
        {
            $storage_driver = 'public';
            $url = Storage::disk($storage_driver)->url($qr->data);
        }

        // Generate the QR code for the given URL
        $qrCode = QrCode::size(300)->errorCorrection('M')->format('png')->generate($url);
        
        // Convert the QR code string to binary data        
        $guest_name = "qrCode";

        // Set response headers for file download
        $headers = [
            'Content-Type' => 'image/png',
            'Content-Disposition' => 'attachment; filename="'.$guest_name.'.png"',
        ];
              
        // Return response with QR code image for download
        return Response::make($qrCode, 200, $headers);

    }

}
