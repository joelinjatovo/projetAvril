<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Session;

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
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    
    /**
     * Where to redirect users after login.
     *
     * return @var string
     */
    protected function redirectTo()
    {
        Auth::check();
        Session::put('locale',Auth::user()->language);
        Session::save();
        
        /*
        try{
            // get current logged in customer
            $customer = Auth::user();

            // using your customer id we will create
            // brain tree customer id with same id
            $response = \Braintree_Customer::create([
               'id' => $customer->id
            ]);

            // save your braintree customer id
            if( $response->success) {
                $customer->braintree_customer_id = $response->customer->id;
                $customer->save();
            }
        }catch(\Exception $e){
            
        }
        */
        
        if(Auth::user()->use_default_password==1){
            return '/profile/password';
        }
        return '/'.Auth::user()->role;
    }
    
    /**
     * Show the application's login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showLoginForm()
    {
        $latitude = option(\App\Models\Config::$APP_LATITUDE, -25.647467468105795);
        $longitude = option(\App\Models\Config::$APP_LONGITUDE, 146.89921517372136);
        
        $locale = \App::getLocale();
        $title = \App\Models\Config::login()->get_meta_array('title', $locale, __('app.connexion'));
        $content = \App\Models\Config::login()->get_meta_array('content', $locale);
        $address = \App\Models\Config::login()->get_meta_array('address', $locale);
        $contact = \App\Models\Config::login()->get_meta_array('contact', $locale);
        
        return view('auth.login')
            ->with('latitude', $latitude)
            ->with('longitude', $longitude)
            ->with('title', $title)
            ->with('content', $content)
            ->with('address', $address)
            ->with('contact', $contact);
    }
    
    

    /**
     * Handle a login request to the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        $this->validateLogin($request);

        // If the class is using the ThrottlesLogins trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.
        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }

        /*
        * Method 1: Default Login
        if ($this->attemptLogin($request)) {
            return $this->sendLoginResponse($request);
        }
        */
        
        /*
        * Method 2: Login Active user only
        */
        if ($this->guard()->validate($this->credentials($request))) {
            $user = $this->guard()->getLastAttempted();
            
            // Make sure the user is active
            if ($user->active() && $this->attemptLogin($request)) {
                // Send the normal successful login response
                return $this->sendLoginResponse($request);
            } else {
                
                // Increment the failed login attempts and redirect back to the
                // login form with an error message.
                $this->incrementLoginAttempts($request);
                
                if($user->status == 'disabled'){
                    return redirect()
                        ->route('login')
                        ->withInput($request->only($this->username(), 'remember'))
                        ->with('error', 'Your account is deactivated. An email is sent to your email.');
                }
                
                return redirect()
                    ->route('login')
                    ->withInput($request->only($this->username(), 'remember'))
                    ->with('error', 'You must be confirm your account.');
            }
        }

        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        $this->incrementLoginAttempts($request);

        return $this->sendFailedLoginResponse($request);
    }
}
