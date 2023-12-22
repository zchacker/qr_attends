<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\GuestsModel;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class GuestsController extends Controller
{
    
    public function show_user_details(Request $request)
    {
        $user = GuestsModel::where('id',$request->id)->first();

        if($user != NULL)
        {
            
            $url  = route('admin.guest.visits.check' , $request->id);
            return view('public.show_qr' , compact('url'));

        }else
        {

            return abort(Response::HTTP_NOT_FOUND);

        }
    }

}
