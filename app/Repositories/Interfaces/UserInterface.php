<?php

namespace App\Repositories\Interfaces;

use Illuminate\Http\Request;

interface UserInterface
{
    public function index(Request $request);
    public function create(array $data);
    public function edit(string $id);
    public function find($id);
    public function syncRoles($user, array $roles);
}
