<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Spatie\Browsershot\Browsershot;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\AlertResponse;
use App\Models\UserBank;
use App\Models\UserAngpao;
use App\Models\UserBonus;
use App\Models\UserFirstDeposit;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class ApiController extends Controller
{
    public function eventRcv(Request $request)
    {
        Log::info('Motion detected: ' . $request->getContent());
        $response_data = json_decode($request->getContent(), true);
        // Process the event data as needed
        AlertResponse::create([
            'sendTime' => Carbon::parse($response_data['params']['sendTime'] ?? null),
            'eventId' => $response_data['params']['events'][0]['eventId'] ?? null,
            'eventType' => $response_data['params']['events'][0]['eventType'] ?? null,
            'status' => $response_data['params']['events'][0]['status'] ?? null,
            'human_id' => $response_data['params']['events'][0]['data']['alarmResult']['faces']['identify']['candidate']['human_id'] ?? null,
            'name' => $response_data['params']['events'][0]['data']['alarmResult']['faces']['identify']['candidate']['reserve_field']['name'] ?? null,
            'wearMaskStatus' => $response_data['params']['events'][0]['data']['alarmResult']['faces']['mask']['wearMaskStatus'] ?? null,
            'response_data' => $response_data,
        ]);
        return response()->json(['message' => 'Event received successfully']);
    }
}
