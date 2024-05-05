<?php
namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Storage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Mail\OtpMail;

class UserService
{
    public function store(array $data, $pdf = null){
        DB::transaction(function () use($data, $pdf) {
            if($pdf){
                $diskConfig = config('filesystems.disks.user');
                $diskRootPath = isset($diskConfig['root']) ? $diskConfig['root'] : null;
                $file_name_to_store = md5(random_bytes(10)) . date('YmdHis') . '_' . $pdf->getClientOriginalName();
                if (!file_exists($diskRootPath)) {
                    mkdir($diskRootPath, 0777, true);
                }
                Storage::disk('user')->putFileAs('', $pdf, $file_name_to_store);

                $data['nid'] = $file_name_to_store;
            }else {
                $data['nid'] = null;
            }
            $data['password'] = Hash::make($data['password']);
            $user = User::create($data);
        }, 5);
    }
    public function sendOtp($user){
        // $user = User::where('email', $request->email)->first();

        $length = 6;
        $otp = Str::random($length);
        // $otp = OtpHelper::generateOtp();
        $user->otp = $otp;
        $user->save();

        // Send OTP via email
        // $send_mail = Mail::to($user->email)->send(new OtpMail($otp));
        Mail::to($user->email)->send(new OtpMail($otp));

        // return redirect()->route('verify.otp.form');
        // if($send_mail){
            return true;
        // }
        // return false;
        // return back()->withErrors(['email' => 'User not found']);
    }
}
