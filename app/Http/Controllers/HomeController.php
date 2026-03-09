<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Browsershot\Browsershot;
use App\Models\User;
use App\Models\Package;
use App\Models\PackageInvoice;
use App\Models\BankAccount;
use App\Models\DailyReport;
use App\Models\AlertResponse;
use Bouncer;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index(Request $request)
    {
        $member_present_today = AlertResponse::whereDate('sendTime', Carbon::today())->where('human_id','>',0)->groupBy('human_id')->select('human_id')->get();

        $member_first_detected_today = AlertResponse::whereDate('sendTime', Carbon::today())->where('human_id','>',0)->groupBy('name')->selectRaw('name,MIN(sendTime) as first_detected')->get();

        $member_after_9am = $member_first_detected_today->filter(function($item) {
            return Carbon::parse($item->first_detected)->hour >= 9;
        })->count();
        // dd($member_after_9am);

        $registered = User::where('role_id',2)->get();

        return view('home', compact('member_present_today', 'member_first_detected_today', 'member_after_9am', 'registered'));
    }
    
    public function change_password(Request $request){
        $user = Auth::user();

        $validator = Validator::make($request->all(), [
            'new_password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);


        if ($validator->fails()) {
            $message = "";
            foreach($validator->messages()->messages() as $m){
                foreach($m as $mm){
                    $message .=$mm.'\n';
                }
            }
            return redirect()->back()->withInfo($message);
        }

        $user->update([
            'password' => Hash::make($request->new_password),
        ]);

        return redirect()->route('home')->withSuccess('Password changed successfully.');
    }
}
