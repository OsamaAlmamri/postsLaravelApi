<?php

namespace App\Actions\Auth;

use App\Mail\OtpEmail;
use App\Models\Otp;
use Illuminate\Support\Facades\Mail;
use Throwable;

class EmailVerifyAction
{
    /**
     * @throws Throwable
     */
    public function handle($user)
    {
        $data = Otp::updateOrCreate(
            ['user_id' => $user->id],
            ['otp' => random_int(1000, 9999), 'email' => $user->email]
        );

        Mail::to($user->email)
            ->send(new OtpEmail($data));

        return [
            'id' => $data->id,
            'user_id' => $data->user_id,
            'name' => $user->name,
            'mobile' => $user->mobile,
            'email' => $user->email,
            'updated_at' => $data->updated_at
        ];
    }
}
