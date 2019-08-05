<?php

namespace App\Http\Controllers\ApiControllers;

use App\Mail\ResetPassword;
use App\Models\Commission;
use App\Models\Image;
use App\Models\Resturant;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class resturantAuthController extends Controller
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

    // api register resturant
    public function register(Request $request)
    {


        $validator = validator()->make($request->all(),
            [
                'district_id' => 'required',
                'category_id' => 'required',
                'name' => 'required',
                'phone' => 'required|unique:resturants|regex:/(01)[0-9]{9}/',
                'email' => 'required|unique:resturants|email',
                'password' => 'required|confirmed',
                'min_charge' => 'required|numeric',
                'deliver_cost' => 'required|numeric',
                'whats_app' => 'required',
                'photo'=>'required|image|mimes:jpg,png'
            ]);



        if ($validator->fails()) {
            return $this->responsejson(false, $validator->errors()->first(), $validator->errors());
        }

        $request->merge(['password' => bcrypt($request->password)]);

        $resturant = Resturant::create($request->all());

        $resturant->api_token = str_random(60);
        $resturant->pin_code = str_random(6);
        $resturant->activation_report = 'active';
        $resturant->state = 'active';
        $resturant->payment_activate = 'active';
        $resturant->save();
        $id = $resturant->id;
        $resturant->categories()->attach($request->category_id);

        Commission::create(['remain_amount' => 0 , 'resturant_id'=> $id]);

        $photo = $request->file('photo');
        $name = str_random(20) . '.' . $photo->getClientOriginalExtension();
        $photo->move(public_path('/resturantPhotos/'),$name);

        $resturant->image()->create(['name'=>'/resturantPhotos/'.$name]);


        return $this->responsejson(true, 'تم الاضافة بنجاح', [
            'api_token' => $resturant->api_token
            ,
            'client data ' => $resturant
        ]);
    }

    ////////////////////////////////////////////////////

    // api login resturant
    public function login(Request $request)
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

        $resturant = Resturant::where('phone', $request->phone)->first();

        if ($resturant) {
            if (Hash::check($request->password, $resturant->password)) {
                return $this->responsejson(true, 'تم تسجيل الدخول بنجاح', [
                    'api_token' => $resturant->api_token,
                    'client data' => $resturant
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

        $resturant = auth()->user();

        $validator = validator()->make($request->all(),
            [
                'district_id' => 'required',
                'category_id' => 'required',
                'name' => 'required',
                'phone' => 'required|unique:resturants,phone,'.$request->user()->id,
                'email' => 'required|unique:resturants,phone,'.$request->user()->id,
                'password' => 'required|confirmed',
                'min_charge' => 'required|numeric',
                'deliver_cost' => 'required|numeric',
                'whats_app' => 'required',
                'photo' => 'required|image|mimes:jpg,png',
                'state'=>'required|in:activate,deactivate'
            ]
        );


        if ($validator->fails()) {
            return $this->responsejson(false, $validator->errors()->first(), $validator->errors());
        }

        $password = Hash::make($request->password);

        $resturant->update($request->all());

        $resturant->password = $password;
        $resturant->save();

        $resturant->categories()->sync($request->category_id);

        // photo morphing update
        $name = public_path($resturant->image->name);
        File::delete($name);

        $photo = $request->file('photo');
        $name = str_random(20) . '.' . $photo->getClientOriginalExtension();
        $photo->move(public_path('/resturantPhotos/'),$name);

        $resturant->image()->update(['name'=>'/resturantPhotos/'.$name]);


        return $this->responsejson(true, 'تم الاضافة بنجاح', [
            'api_token' => $resturant->api_token
            ,
            'client data ' => $resturant
        ]);
    }

    ////////////////////////////////////////////////////


    // reset password with sending Email
    public function send_pinCode(Request $request)
    {
        if ($request->has('phone')) {
            $user = Resturant::where('phone', $request->phone)->first();


            if ($user) {
                // update the pin code
                $pin_code = str_random(6);
                $update = Resturant::where('id', $user->id)->update(['pin_code'=>$pin_code]);

                if ($update) {
                    // send email function

                    Mail::to($user->email)
                        ->bcc('sewidanmostafa@gmail.com')
                        ->send(new ResetPassword($pin_code));

                    return $this->responsejson(true, 'تم الارسال' , ['client_id' => $user->id]);
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
        if ($request->has('resturant_id')) {
            $validator = validator()->make($request->all(),
                [
                    'pin_code' => 'required',
                    'password' => 'required|confirmed',
                ]
            );
            if (!$validator->fails()) {
                $resturant = Resturant::where('id', $request->resturant_id)->first();


                if ($resturant->pin_code == $request->pin_code) {

                    // update the pin code
                    $pin_code = str_random(6);

                    $resturant->update(
                        [
                            'password' => Hash::make($request->password),
                            'pin_code' => $pin_code
                        ]
                    );
                    return $this->responsejson(true, 'تمت العمليه بنجاح', $resturant);

                } else {
                    return $this->responsejson(false, 'رمز تاكيد كلمة المرور غير صحيح');
                }
            } else {
                return $this->responsejson(false, $validator->errors()->first(), $validator->errors());
            }
        } else {
            return $this->responsejson(false, 'الرجاء ادخال (resturant_id)');
        }


    }
}
