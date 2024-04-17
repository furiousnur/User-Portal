<?php

namespace App\Repositories\Interfaces;

interface ProfileInterface
{
    public function profilePage();
    public function passwordUpdate($request);
}
