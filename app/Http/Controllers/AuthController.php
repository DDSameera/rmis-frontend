<?php

namespace App\Http\Controllers;


use App\Http\Requests\RegisterRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class AuthController extends Controller
{

    private static String $apiDomain;

    public function __construct()
    {
        self::$apiDomain = config('app.api_domain');

    }


    public function index()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $email = $request->input('inputEmail');
        $password = $request->input('inputPassword');


        //Send Request
        $response = Http::post(self::$apiDomain . '/api/v1/user/login', [
            'email' => $email,
            'password' => $password,
            'deviceName' => 'desktop'
        ]);


        //Response Status
        $status = $response->status();

        //Response Result
        $result = $response->json();

        if ($status == 200) {

            $bearerToken = $result['data']['token'];
            $userRole = $result['data']['user']['role'];

            //Save Session
            $request->session()->put('bearer_token', $bearerToken);
            $request->session()->put('user_role', $userRole);

            return redirect('/dashboard')->with('success', 'Welcome to the RMIS System');
        } else {

            if (isset($result['errors'])) {
                $errors = (array)$result['errors'];
            } else {
                $errors = [
                    'Maintenance is in progress. Please try again later'
                ];
            }


            return redirect('/')->with('error', $errors);
        }

    }

    public function register()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {


        //Send Request
        $response = Http::post(self::$apiDomain . '/api/v1/user/register', $request->all());

        $result = $response->json();

        $status = $response->status();


        if ($status !== 201) {
            return redirect('/register')->with('error', $result['errors'])->withInput($request->all());
        }

        return redirect('/register')->with('success', $result['message'])->withInput($request->all());
    }


    public function logout()
    {

        //Bearer Token
        $bearerToken = request()->session()->get('bearer_token');

        //Send Request
        $response = Http::withToken($bearerToken)
            ->get(self::$apiDomain . '/api/v1/user/logout');


        //JSON Results
        $result = $response->json();
        $status = $response->status();

        //Remove Session
        request()->session()->forget('bearer_token');


        //Status
        if ($status == 200) {
            return redirect('/login')->with('success', $result['message']);
        } else {
            return redirect('/login')->with('error', $result['errors']);
        }


    }
}
