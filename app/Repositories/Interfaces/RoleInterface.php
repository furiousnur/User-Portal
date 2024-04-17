<?php

namespace App\Repositories\Interfaces;

use Illuminate\Http\Request;
interface RoleInterface
{
    public function index(Request $request);
    public function create();
    public function store(Request $request);
    public function show(string $id);
    public function edit(string $id);
    public function update(Request $request, string $id);
    public function destroy(string $id);
}
