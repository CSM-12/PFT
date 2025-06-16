<?php

namespace App\Repositories\Contracts\Auth;

interface SettingRepositoryInterface
{
    public function index();
    public function update($data);
}