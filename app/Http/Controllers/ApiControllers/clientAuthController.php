<?php

namespace App\Http\Controllers\ApiControllers;

use App\Mail\ResetPassword;
use App\Models\Client;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class clientAuthController extends Controller

{

    public function responsejson($status, $massage, $data = null)
    {

        $response =
            [
                'status' => $status,
                'massage' => $massage,
                'data' => $data
            ];
        return response()->json($response);

    }

    //////////////////////////////////////////////////

    // api register client
    public function client_register(Request $request)
    {


        $validator = validator()->make($request->all(),
            [
                'district_id' => 'required',
                'name' => 'required',
                'phone' => 'required|unique:clients|regex:/(01)[0-9]{9}/',
                'email' => 'required|unique:clients|email',
                'password' => 'required|confirmed',
                'photo'=>'required|image|mimes:jpg,png'
            ]
        );

        if ($validator->fails()) {
            return $this->responsejson(false, $validator->errors()->first(), $validator->errors());
        }

        $request->merge(['password' => bcrypt($request->password)]);
        $client = Client::create($request->all());
        $client->api_token = str_random(60);
        $client->pin_code = str_random(6);
        $client->activation_report = 'active';
        $client->save();

        $photo = $request->file('photo');
        $name = str_random(20) . '.' . $photo->getClientOriginalExtension();
        $photo->move(public_path('/clientPhotos/'),$name);

        $client->image()->create(['name'=>'/clientPhotos/'.$name]);



        return $this->responsejson(true, 'تم الاضافة بنجاح', [
            'api_token' => $client->api_token
            ,
            'client data ' => $client
        ]);
    }

    ////////////////////////////////////////////////////

    // api login client
    public function client_login(Request $request)
    {


        $validator = validator()->make($request->all(),
            [
                'phone' => 'required|regex:/(01)[0-9]{9}/',
                'password' => 'required',

            ]
        );
        if ($validator->fails()) {
            return $this->responsejson(false, $validator->errors()->first(), $validator->errors());
        }

        $client = Client::where('phone', $request->phone)->first();

        if ($client) {
            if (Hash::check($request->password, $client->password)) {
                return $this->responsejson(true, 'تم تسجيل الدخول بنجاح', [
                    'api_token' => $client->api_token,
                    'client data' => $client
                ]);
            } else {
                return $this->responsejson(false, 'كلمة المرور غير صحيحه');
            }
        } else {
            return $this->responsejson(false, 'رقم الهاتف غير صحيح');
        }
    }

    ////////////////////////////////////////////////////

    // api update client profile
    public function update_profile(Request $request)
    {

        $client = auth()->user();


        $validator = validator()->make($request->all(),
            [
                'district_id' => 'required',
                'name' => 'required',
                'phone' => 'required|unique:clients,phone,' . $client->id . '',
                'email' => 'required|unique:clients,email,' . $client->id . '',
                'password' => 'required|confirmed',
                'photo' => 'required|image|mimes:jpg,png'

            ]
        );


        if ($validator->fails()) {
            return $this->responsejson(false, $validator->errors()->first(), $validator->errors());
        }

        $password = Hash::make($request->password);

        $client->update($request->all());
        $client->password = $password;
        $client->save();
       // return $client->image->name;
        $name = public_path($client->image->name);

        if(file_exists($request->photo))
        {
            File::delete($name);

            $photo = $request->file('photo');
            $name = str_random(20) . '.' . $photo->getClientOriginalExtension();
            $photo->move(public_path('/clientPhotos/'),$name);

            $client->image->update(['name'=>'/clientPhotos/'.$name]);

        }

        return $this->responsejson(true, 'تم الاضافة بنجاح', [
            'api_token' => $client->api_token
            ,
            'client data ' => $client
        ]);
    }

    ////////////////////////////////////////////////////


    // reset password with sending Email
    public function send_pinCode(Request $request)
    {
        if ($request->has('phone')) {
            $user = Client::where('phone', $request->phone)->first();


            if ($user) {
                // update the pin code
                $pin_code = str_random(6);
                $update = Client::where('id' , $user->id)->update(['pin_code'=>$pin_code]);

                if ($update) {
                    // send email function

                    Mail::to($user->email)
                        ->bcc('sewidanmostafa@gmail.com')
                        ->send(new ResetPassword($pin_code));

                    return $this->responsejson(true, 'تم الارسال' ,['client_id' => $user->id]);
                } else {
                    return $this->responsejson(false, 'حدث خطاء الرجاء اعادة المحاولة');
                }


            } else {
                return $this->responsejson(false, 'لا يوجد مستخدم يحمل هذا الرقم');
            }
        } else {
            return $this->responsejson(false, 'الرجاء ادخال رقم الهاتف لارسال كود التحقق');
        }


    }

    ////////////////////////////////////////////////////

    public function reset_password(Request $request)
    {
        if ($request->has('client_id')) {
            $validator = validator()->make($request->all(),
                [
                    'pin_code' => 'required',
                    'password' => 'required|confirmed',
                ]
            );
            if (!$validator->fails()) {
                $client = Client::where('id', $request->client_id)->first();


                if ($client->pin_code == $request->pin_code) {
                Client::where('id', $request->client_id)->
                    update([
                        'password' => Hash::make($request->password)
                    ]);
                    return $this->responsejson(true, 'تمت العمليه بنجاح', $client);

                } else {
                    return $this->responsejson(false, 'رمز تاكيد كلمة المرور غير صحيح');
                }
            } else {
                return $this->responsejson(false, $validator->errors()->first(), $validator->errors());
            }
        } else {
            return $this->responsejson(false, 'الرجاء ادخال (client_id)');
        }


    }


}
