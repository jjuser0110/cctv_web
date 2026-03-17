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
        $human_id = $response_data['params']['events'][0]['data']['alarmResult']['faces']['identify']['candidate']['human_id'] ?? null;
        $name = $response_data['params']['events'][0]['data']['alarmResult']['faces']['identify']['candidate']['reserve_field']['name'] ?? null;
        $wearMaskStatus = $response_data['params']['events'][0]['data']['alarmResult']['faces']['mask']['wearMaskStatus'] ?? null;
        $eventType = $response_data['params']['events'][0]['eventType'] ?? null;
        $status = $response_data['params']['events'][0]['status'] ?? null;
        AlertResponse::create([
            'sendTime' => Carbon::parse($response_data['params']['sendTime'] ?? null),
            'eventId' => $response_data['params']['events'][0]['eventId'] ?? null,
            'eventType' => $eventType,
            'status' => $status,
            'human_id' => $human_id,
            'name' => $name,
            'wearMaskStatus' => $wearMaskStatus,
            'response_data' => $response_data,
        ]);

        if($human_id>0 && $wearMaskStatus != 1){
            cache(['message' => $name.' detected without mask', 'last_update' => Carbon::now()]);
        }

        if($eventType == '3073' && $status == 1){
            cache(['message' => 'Phone call detected', 'last_update' => now()]);
        }

        return response()->json(['message' => 'Event received successfully']);
    }
}
