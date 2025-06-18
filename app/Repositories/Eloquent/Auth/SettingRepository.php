<?php

namespace App\Repositories\Eloquent\Auth;

use App\Repositories\Contracts\Auth\SettingRepositoryInterface;
use Illuminate\Support\Facades\Auth;

class SettingRepository implements SettingRepositoryInterface
{
    public function index()
    {
        $user = Auth::user();

        $first_name = $user->first_name;
        $last_name = $user->last_name;
        $phone = $user->phone;
        $country = $user->country;
        $language = $user->language;
        $timeZone = $user->time_zone;
        $currency = $user->currency;

        return (object)[
            'first_name' => $first_name,
            'last_name' => $last_name,
            'phone' => $phone,
            'country' => $country,
            'language' => $language,
            'time_zone' => $timeZone,
            'currency' => $currency
        ];
    }

    public function update($data)
    {
        $user = Auth::user();
        return $user->update($data);
    }
}
