<?php

namespace App\Http\Controllers\Shared;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\Response;

class QrContoller extends Controller
{
    
    public function generateQrCode(Request $request)
    {
        //$url = "https://chat.openai.com/c/fb947e59-df67-4c70-82f5-096ae6f0f3e4";// $request->url;
        
        $url  = route('admin.guest.visits.check' , $request->id);
        // Generate the QR code for the given URL
        $qrCode = QrCode::size(300)->format('png')->generate($url);
        
        // Convert the QR code string to binary data
        $imageData = base64_decode($qrCode);

        // Set response headers for file download
        $headers = [
            'Content-Type' => 'image/png',
            'Content-Disposition' => 'attachment; filename="qrcode.png"',
        ];
        
        // dd($imageData);

        // Return response with QR code image for download
        return Response::make($qrCode, 200, $headers);

        //return view('qr_code', compact('qrCode'));
    }

}
