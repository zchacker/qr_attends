<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\UsersModel;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    

    public function login_action(Request $request)
    {
        $rules = array(
            'email'    => 'required',
            'password' => 'required',
        );

        $messages = [
            'email.required'    => __('email_required'),
            'password.required' => __('password_required'),
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        

        if ($validator->fails() == false) {
            
            try {

                // looking for email if exists
                $user = UsersModel::withTrashed()
                ->where('email', '=', $request->email)
                ->first();
               
                if ($user->deleted_at !== null) {
                    // Account soft deleted
                    
                    // Redirect with a message indicating that the account is deleted                    
                    return back()
                    ->withErrors(['login_error' => __('account_deleted')])
                    ->withInput($request->all());                            
                }

                if ($user) {

                    if (Auth::guard($user->user_type)->attempt(['email' => $request->email, 'password' => $request->password], true)) {                                                                        
                        
                        switch ($user->user_type) {
                            
                            case "admin":                                
                                return redirect()->intended(route('admin.guest.list'));                                
                                break;
                            case "supervisor":
                                return redirect()->intended(route('supervisor.guest.list'));                                ;
                                break;                          
                            default:
                                return redirect()->intended(route('home'));

                        }
                                                
                        return redirect()->route('home');

                    } else {
                       
                        return back()
                            ->withErrors(['login_error' => __('worng_password')])
                            ->withInput($request->all());
                            
                    }
                } else {

                    return back()
                        ->withErrors(['login_error' => __('worng_password')])
                        ->withInput($request->all());
                }

            } catch (Exception $ex) {                
                return back()
                    ->withErrors(['login_error' => __('unknown_error')])
                    ->withInput($request->all());
            }
        } else {

            $error     = $validator->errors();
            $allErrors = "";

            foreach ($error->all() as $err) {
                $allErrors .= $err . " <br/>";
            }

            return back()
                ->withErrors(['login_error' => $allErrors])
                ->withInput($request->all());
        }
    }


    public function logout(Request $request)
    {
        
    }

}
