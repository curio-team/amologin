<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Routing\Controllers\Middleware;

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
    protected $redirectTo = '/me';

    /**
     * Get the middleware that should be assigned to the controller.
     */
    public static function middleware(): array
    {
        return [
            new Middleware('guest', except: ['logout']),
        ];
    }

    public function username()
    {
        return 'id';
    }

    public function credentials(\Illuminate\Http\Request $request)
    {
        $id = $request->get('id');
        $field = filter_var($id, FILTER_VALIDATE_EMAIL) ? 'email' : 'id';

        $credentials = array(
            $field => $request->get('id'),
            'password' => $request->get('password')
        );

        return $credentials;
    }
}
