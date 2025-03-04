<?php

namespace App\Http\Controllers;

use App\Models\User;

class OwnerController extends Controller
{
    private const ITEMS_PER_PAGE = 20;

    public function index()
    {
        $owners = User::getUsers()
            ->where('role_id', User::ROLE_OWNER)
            ->paginate(self::ITEMS_PER_PAGE);

        return view('admin_owner_list', compact('owners'));
    }
}
