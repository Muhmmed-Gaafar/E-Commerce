<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Http\Resources\UserResource;
use App\Services\UserService;
use App\Trait\Response;
use Illuminate\Http\Request;

class UserController extends Controller
{
    use Response;

    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function index()
    {
        $users = $this->userService->getAllUsers();
        return $this->success(UserResource::collection($users), 'Users retrieved successfully');
    }

    public function store(UserRequest $request)
    {
        $user = $this->userService->createUser($request);
        return $this->success(new UserResource($user), 'User created successfully', 201);
    }

    public function show($id)
    {
        $user = $this->userService->getUserById($id);
        return $this->success(new UserResource($user), 'User retrieved successfully');
    }

    public function update(UserRequest $request, $id)
    {
        $user = $this->userService->getUserById($id);
        if (!$user) {
            return $this->failed(null, 'User not found', 404);
        }
        $updatedUser = $this->userService->updateUser($request->validated(), $id);
        return $this->success(new UserResource($updatedUser), 'User updated successfully');
    }

    public function destroy($id)
    {
        $user = $this->userService->getUserById($id);
        if (!$user) {
            return $this->failed(null, 'User not found', 404);
        }
        $this->userService->deleteUser($id);
        return $this->msg('User deleted successfully', 204);
    }
}
