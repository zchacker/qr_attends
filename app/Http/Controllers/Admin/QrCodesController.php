<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\QrCodesModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class QrCodesController extends Controller
{
    public function list(Request $request)
    {        
        $query      = QrCodesModel::orderByDesc('created_at');       
        $sum        = $query->count('id');
        $codes      = $query->paginate(100);
        return view('admin.qr.list', compact('codes', 'sum'));
    }

    public function select_type(Request $request)
    {
        return view('admin.qr.select_type');
    }    

    public function create(Request $request)
    {
        $type = $request->type ?? "default";        
        return view('admin.qr.create', compact('type'));
    }

    public function create_action(Request $request)
    {
        $messages = [            
            'file.mimes' => 'مطلوب رفع ملف PDF ',
            'file.max' => 'حجم الملف المسموح به 25 ميجا',
        ];
        
        // Validate the uploaded file
        $request->validate([
            'file' => 'mimes:pdf|max:25000'
        ], $messages);

        if ($request->hasFile('file')) {
            
            $url = $request->file('file')->storePublicly(
                "files/pdf",
                $this->basicStorage
            );

            $data = QrCodesModel::create([
                'user_id'   => $request->user()->id,
                'type'      => $request->type,
                'is_static' => 0,
                'name'      => $request->name,
                'data'      => $url,
            ]);

            if($data)
            {
                return redirect(route('admin.qr.show', $data->id))->with(['success' => __('added_successfuly')]);                
            }else{
                return back()->withErrors(['error' => __('not_save_error')]);                
            }

        }else{

            $data = QrCodesModel::create([
                'user_id'   => $request->user()->id,
                'type'      => $request->type,
                'is_static' => 0,
                'name'      => $request->name,
                'data'      => $request->url,
            ]);

            if($data)
            {
                return redirect(route('admin.qr.show', $data->id))->with(['success' => __('added_successfuly')]);                
            }else{
                return back()->withErrors(['error' => __('not_save_error')]);                
            }

        }


    }

    public function show(Request $request)
    {        
        $qr     = QrCodesModel::where('id' , $request->id)->first(); 
        $url    = $qr->data;

        if($qr->type == 'pdf')
        {
            $storage_driver = 'public';
            $url = Storage::disk($storage_driver)->url($qr->data);
        }
        return view('admin.qr.show', compact('qr' , 'url')); 
    }

    public function edit(Request $request)
    {

    }

    public function edit_action(Request $request)
    {

    }

    public function delete(QrCodesModel $qr_code)
    {
        $qr_code->delete();
        return back()->with(['success' => __('updated_successfuly')]);
    }

}
