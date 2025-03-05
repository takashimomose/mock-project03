<?php

namespace App\Http\Controllers;

use App\Models\User;

class OwnerController extends Controller
{
    public function index()
    {
        $owners = User::getUsers()
            ->where('role_id', User::ROLE_OWNER)
            ->paginate(config('const.items_per_page'));

        return view('admin_owner_list', compact('owners'));
    }
}
