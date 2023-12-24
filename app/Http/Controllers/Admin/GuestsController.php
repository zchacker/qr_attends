<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Imports\GuestsImport;
use App\Models\GuestsModel;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;

class GuestsController extends Controller
{

    public function list(Request $request)
    {
        $type       = $request->type ?? "active";
        $query      = GuestsModel::orderByDesc('created_at');
        if ($type == "trashed") {
            $query      = GuestsModel::orderByDesc('created_at')
                ->where('user_type', 'engineer')
                ->onlyTrashed();
        }
        $sum        = $query->count('id');
        $guests  = $query->paginate(100);
        return view('admin.guests.list', compact('guests', 'sum'));
    }

    public function visits(Request $request)
    {
        //$type       = $request->type ?? "active";
        $query      = GuestsModel::orderByDesc('created_at')->where('attend', 1);

        // if ($type == "trashed") {
        //     $query      = GuestsModel::orderByDesc('created_at')
        //         ->where('user_type', 'engineer')
        //         ->onlyTrashed();
        // }

        $sum        = $query->count('id');
        $guests     = $query->paginate(100);
        return view('admin.visitors.list', compact('guests', 'sum'));
    }

    public function check(Request $request)
    {
        
        $user = GuestsModel::where('id', $request->id)->first();

        if($user != NULL)
        {                    
            return view('admin.check.details' , compact('user'));
        }else
        {            
            return abort(Response::HTTP_NOT_FOUND);
        }
    }

    public function confirm(Request $request)
    {
        $user = GuestsModel::where('id',$request->id)->first();

        if($user != NULL)
        {                   
            GuestsModel::where('id',$request->id)
            ->update([
                'attend' => 1
            ]);

            return back()->with(['success' => __('aattend_successfuly')]);

        }else
        {            
            
            return abort(Response::HTTP_NOT_FOUND);

        }
    }

    public function create(Request $request)
    {
        return view('admin.guests.create');
    }

    public function upload(Request $request)
    {
        return view('admin.guests.upload');
    }

    public function upload_action(Request $request)
    {

        $messages = [
            'csv_file.required' => 'مطلوب رفع ملف',
            'csv_file.mimes' => 'مطلوب رفع ملف اكسل أو نصي',
        ];
        
        // Validate the uploaded file
        $request->validate([
            'csv_file' => 'required|mimes:csv,txt,xls,xlsx'
        ], $messages);
        

        if ($request->hasFile('csv_file')) {

            $file = $request->file('csv_file');                        
            Excel::import(new GuestsImport(), $file);

            /*if ($file->getClientOriginalExtension() === 'xlsx') {

                //$data = Excel::toArray([], $file);

                // Import data from the Excel file and save it to the database
                Excel::import(new GuestsImport(), $file);

            } elseif ($file->getClientOriginalExtension() === 'csv') {

                // Process the CSV file
                $csvData = array_map('str_getcsv', array_slice(file($file), 1));

                // Handle the CSV data and save/update user records
                // Loop through $csvData and process each row to create or update users
                // Example:
                foreach ($csvData as $row) {

                    // Process each row data and create or update users
                    // For instance, assuming columns are in order: name, email, etc.
                    try {

                        $name  = $row[0] ?? NULL;
                        $phone = $row[1] ?? NULL;
                        $email = $row[2] ?? NULL;

                        $guest          = new GuestsModel();
                        $guest->name    = $name;
                        $guest->phone   = $phone;
                        $guest->email   = $email;
                        $guest->save();

                        // Create or update user with $name and $email
                        // You can use Eloquent ORM to create/update records

                    } catch (Exception $e) {
                        dd($e);
                        //return back()->withErrors(['error' => 'No file uploaded.']);
                    }

                }
            }*/

            return back()->with(['success' => __('added_successfuly')]);
        }

        return back()->withErrors(['error' => 'No file uploaded.']);
    }

    public function create_action(Request $request)
    {
        $rules = array(
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            //'password' => 'required',
        );

        $messages = [
            'name.required' => __('name_required'),
            'email.required' => __('email_required'),
            'email.unique' => __('email_unique'),
            'phone.required' => __('phone_required'),
            'phone.unique' => __('phone_unique'),
            'password.required' => __('password_required'),
        ];


        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails() == false) {

            // create user account
            $user = GuestsModel::create($request->all());

            // send email for verification

            return back()->with(['success' => __('added_successfuly')]);
        } else {

            $error     = $validator->errors();
            $allErrors = "";

            foreach ($error->all() as $err) {
                $allErrors .= $err . " <br/>";
            }

            return back()
                ->withErrors(['error' => $allErrors])
                ->withInput($request->all());
        }
    }

    public function edit(Request $request)
    {
        $user = GuestsModel::find($request->id);

        if ($user == null) {
            return abort(Response::HTTP_NOT_FOUND);
        }

        return view('admin.engineers.edit', compact('user'));
    }

    public function edit_action(Request $request)
    {
        $user_id = $request->user_id;

        $rules = array(
            'name' => 'required',
            //'email' => ['required',Rule::unique('users')->ignore($user_id)],
            //'phone' => ['required',Rule::unique('users')->ignore($user_id)],
            // 'password' => 'required',
        );

        $messages = [
            'name.required' => __('name_required'),
            'email.required' => __('email_required'),
            'email.unique' => __('email_unique'),
            'phone.required' => __('phone_required'),
            'phone.unique' => __('phone_unique'),
            'password.required' => __('password_required'),
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails() == false) {

            $profile_data = GuestsModel::where(['id' => $user_id])->first();

            $profile_data->name  = $request->name;
            $profile_data->email = $request->email;
            $profile_data->phone = $request->phone;

            if ($profile_data->update()) {
                return back()->with(['success' => __('updated_successfuly')]);
            } else {

                return back()->withErrors(['error' => __('unknown_error')]);
            }

            // send email for verification
            return back()->with(['success' => __('added_successfuly')]);
        } else {

            $error     = $validator->errors();
            $allErrors = "";

            foreach ($error->all() as $err) {
                $allErrors .= $err . " <br/>";
            }

            return back()
                ->withErrors(['error' => $allErrors])
                ->withInput($request->all());
        }
    }

    public function delete(GuestsModel $user)
    {
        $user->delete();
        return back()->with(['success' => __('updated_successfuly')]);
    }
}
