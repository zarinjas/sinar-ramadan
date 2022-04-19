<?php

namespace App\Http\Controllers\Billplz;

use GuzzleHttp\Client;
use App\Models\Billplz\Bill;
use Illuminate\Http\Request;
use App\Models\Billplz\Collection;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Config;

class BillplzController extends Controller
{
    // public function statusPayment() {
    //     // $ch = curl_init('https://www.billplz-sandbox.com/api/v4/open_collections/utsx2wdq1');
    //     // $api_key = '4e2cc3c3-aaa0-44c7-9561-39208c8aa78d';

    //     // // curl_setopt($ch, CURLOPT_HEADER, 1);
    //     // curl_setopt($ch, CURLOPT_USERPWD, $api_key . ":");
    //     // // curl_setopt($ch, CURLOPT_TIMEOUT, 30);
    //     // // curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);

    //     // $response = curl_exec($ch);
    //     // curl_close($ch);

    //     // dd($response);

    //     $value = '1234';
    //     $cent = substr($value, -2);
    //     $removeCent = substr($value, 0, -2);
        
    //     $money_format = $removeCent . '.' . $cent;
    //     // dd($money_format);
    //     $time = '2022-03-26T03:26:50.539+08:00';
    //     // $mysql_time_format = str_replace('T', ' ', substr($time, 0, strpos($time, ".")));
    //     $mysql_time_format = substr($time, 0, strpos($time, "T"));

    //     dd($mysql_time_format);
    // }

    public function callback(Request $request) {

        $id = $request->billplz['id'];
        if($request->billplz['paid'] == 'true') {
            $url = Config::get('billplz.billplz_url') . Config::get('billplz.billplz_suffix') . $id ;
            $api_key = Config::get('billplz.billplz_apikey');

            $bplz_request = Http::withBasicAuth($api_key, '')->get($url);
            $response = $bplz_request->object();
            $statusCode = $bplz_request->getStatusCode();
    
            if((!empty($response)) && $statusCode == 200) {
                $paid_amount = $response->paid_amount;
                $cent = substr($paid_amount, -2);
                $removeCent = substr($paid_amount, 0, -2);
                $paid_amount_formatted = $removeCent . '.' . $cent;

                $bplz_dateTime = $response->paid_at;
                $mysql_date_format = substr($bplz_dateTime, 0, strpos($bplz_dateTime, "T"));

                Bill::upsert([
                    'bill_id'       => $response->id, 
                    'donator_name'  => $response->name, 
                    'paid_amount'   => $paid_amount_formatted, 
                    'paid_at'       => $mysql_date_format,
                ],
                ['bill_id'],['donator_name', 'paid_amount', 'paid_at']);
            }

            return redirect()->route('utama')->with('success_donate', 'success donate');
        }
        return redirect()->route('utama')->with('failed_donate', 'failed donate');
    }
}
