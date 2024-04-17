<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\RoleRequest;
use App\Repositories\Interfaces\RoleInterface;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    protected $roleRepository;
    public function __construct(RoleInterface $roleRepository)
    {
        $this->roleRepository = $roleRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $roles = $this->roleRepository->index($request);
        return view('backend.pages.roles.index', compact('roles'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $permission = $this->roleRepository->create();
        return view('backend.pages.roles.create',compact('permission'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RoleRequest $request)
    {
        $this->roleRepository->store($request);
        return redirect()->route('roles.index')
            ->with('success','Role has been created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $compact = $this->roleRepository->show($id);
        return view('backend.pages.roles.show',$compact);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $compact = $this->roleRepository->edit($id);
        return view('backend.pages.roles.edit',$compact);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(RoleRequest $request, string $id)
    {
        $this->roleRepository->update($request, $id);
        return redirect()->route('roles.index')
            ->with('success','Role has been updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->roleRepository->destroy($id);
        return redirect()->route('roles.index')
            ->with('success','Role has been deleted successfully');
    }
}
