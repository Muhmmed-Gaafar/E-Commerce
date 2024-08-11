<?php

namespace App\Http\Controllers;

use App\Http\Requests\AdminRequest;
use App\Http\Resources\AdminResource;
use App\Services\AdminService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    protected $adminService;

    public function __construct(AdminService $adminService)
    {
        $this->adminService = $adminService;
    }





    public function index()
    {
        $admins = $this->adminService->getAllAdmins();
        return AdminResource::collection($admins);
    }

    public function show($id)
    {
        $admin = $this->adminService->getAdminById($id);
        return new AdminResource($admin);
    }

    public function store(AdminRequest $request)
    {
        $admin = $this->adminService->createAdmin($request);
        return new AdminResource($admin);
    }

    public function update(AdminRequest $request, $id)
    {
        $admin = $this->adminService->updateAdmin($id, $request->validated());
        return new AdminResource($admin);
    }

    public function destroy($id)
    {
        $this->adminService->deleteAdmin($id);
        return response()->json(['message' => 'Admin deleted successfully.']);
    }

    public function register(AdminRequest $request)
    {
        $admin = $this->adminService->createAdmin($request);
        return new AdminResource($admin);
    }
}
