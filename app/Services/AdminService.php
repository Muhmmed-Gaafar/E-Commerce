<?php

namespace App\Services;

use App\Models\Admin;

use Illuminate\Support\Facades\Storage;

class AdminService
{
    public function getAllAdmins()
    {
        return Admin::all();
    }

    public function getAdminById($id)
    {
        return Admin::where('id', $id)->first();
    }

    public function createAdmin($request)
    {
         $data=  $request->validated();
         $data['image'] = upload_image('public/AdminsImages' ,$data['image']);
        return Admin::create($data);
    }


    public function updateAdmin($id,  $data)
    {
        $admin = Admin::where('id', $id)->first();
        if (isset($data['image'])) {
            if ($admin->image) {
                Storage::delete(str_replace('/storage', 'public', $admin->image));
            }
            $data['image'] = upload_image($data['image'], 'AdminsImages');
        }
        $admin->update($data);
        return $admin;
    }

    public function deleteAdmin($id)
    {
        $admin = Admin::where('id', $id)->first();
        if(isset($admin->image)){
            Storage::delete($admin->image);
        }
        $admin->delete();
    }
}

