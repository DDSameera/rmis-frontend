<?php

namespace App\Http\Controllers;

use App\Exceptions\TokenExpireException;
use App\Http\Requests\GenerateChartRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class DashboardController extends Controller
{
    private static $apiDomain;

    public function __construct()
    {
        self::$apiDomain = config('app.api_domain');
    }


    public function index()
    {


        return view('dashboard.index');
    }

    /**
     * @throws TokenExpireException
     */
    public function generateChart(GenerateChartRequest $generateChartRequest)
    {



        $excelFile = $generateChartRequest->file('excel_file');
        $bearerToken = $generateChartRequest->session()->get('bearer_token');


        //Send Request
        $response = Http::withToken($bearerToken)
            ->attach('excel_file', file_get_contents($excelFile), 'export.csv')
            ->post(self::$apiDomain . '/api/v1/generate/chart', $generateChartRequest->all());

        $status = $response->status();

        $result = $response->json();


        if ($status == 404) {
            throw new TokenExpireException();
        }

        if ($status == 422) {
            return redirect('/dashboard')->with('error', $result['errors'][0]);
        }


        $chartData = $response->json()['data'];

        $chartData = json_encode($chartData);
        return view('dashboard.index', compact('chartData'));


    }
}
