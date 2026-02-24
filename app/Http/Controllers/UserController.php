<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Spatie\Browsershot\Browsershot;
use Illuminate\Http\Request;
use App\Models\User;
use Bouncer;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use DB;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $user = User::where('role_id','!=',1)->get();

        return view('user.index')->with('user',$user);
    }

    public function sync()
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://115.133.81.137/artemis/api/resource/v1/person/personList',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_SSL_VERIFYHOST => false,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS =>'{
                "pageNo": 1,
                "pageSize": 100
            }',
            CURLOPT_HTTPHEADER => array(
                'Accept: application/json',
                'Content-Type: application/json;charset=UTF-8',
                'X-Ca-Key: 36500929',
                'X-Ca-Signature: 8Fa+Rl1FbeKkrfjtoCtNltDulPlWjLUGqQDUl1kFhHA='
            ),
        ));


        $response = curl_exec($curl);

        curl_close($curl);
        if ($response === false) {
            dd('Curl Error: ' . curl_error($curl));
        }
        $data = json_decode($response);
        // dd($data);
        if($data->code == 0){
            if(count($data->data->list) > 0){
                foreach($data->data->list as $person){
                    User::updateOrCreate(
                        [
                            'personId'=> $person->personId,
                            'personCode'=> $person->personCode,
                            'username'=>$person->personCode,
                        ],
                        [
                            'name'=>$person->personFamilyName.' '.$person->personGivenName,
                            'email'=>$person->email,
                            'password'=>Hash::make('123456789'),
                            'role_id'=> 2,
                            'orgIndexCode'=> $person->orgIndexCode,
                            'personFamilyName'=> $person->personFamilyName,
                            'personGivenName'=> $person->personGivenName,
                            'gender'=> $person->gender,
                            'phoneNo'=> $person->phoneNo,
                            'personPhoto'=> $person->personPhoto->picUri ?? null,
                            'remark'=> $person->remark,
                            'beginTime'=> Carbon::parse($person->beginTime),
                            'endTime'=> Carbon::parse($person->endTime),
                        ]
                    );
                }
            }
        }
        return redirect()->route('user.index')->withSuccess('Data synced');
    }

    public function store(Request $request)
    {
        $user = User::create($request->all());

        return redirect()->route('user.index')->withSuccess('Data saved');
    }

    public function edit(User $user)
    {
        return view('user.create')->with('user',$user);
    }

    public function update(Request $request, User $user)
    {
        $user->update($request->all());
        return redirect()->route('user.index')->withSuccess('Data updated');
    }

    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('user.index')->withSuccess('Data deleted');
    }

}
