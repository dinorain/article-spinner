<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Kamaln7\Toastr\Facades\Toastr;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Handle a login request to the application.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     * @throws \Illuminate\Validation\ValidationException
     */
    public function loginUser(Request $request)
    {
        try {
            if ($this->login($request)) {
                if (Auth::user()) {
                    return redirect()->route('admin.index');
                }
                else
                {
                    Toastr::error('Invalid email address or password.', 'Error');
                    return redirect()->back();
                }
            }
            else
            {
                Toastr::error('Invalid email address or password.', 'Error');
                return redirect()->back();
            }
        } catch (\Exception $error) {
            Toastr::error('Invalid email address or password.', 'Error');
            return redirect()->back();
        }
    }

    /**
     * Get the login username to be used by the controller.
     *
     * @return string
     */
    public function username()
    {
        $loginType = request()->input('username');
        $this->username = filter_var($loginType, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
        request()->merge([$this->username => $loginType]);
        return property_exists($this, 'username') ? $this->username : 'email';
    }
}
