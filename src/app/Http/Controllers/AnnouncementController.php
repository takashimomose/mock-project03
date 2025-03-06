<?php

namespace App\Http\Controllers;

use App\Mail\AnnoucementMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class AnnouncementController extends Controller
{
    public function create()
    {
        return view('admin_announcement_create');
    }

    public function send(Request $request)
    {
        $data = $request->only(['title', 'content']);

        $users = User::getUsers()->where('role_id', 3);

        Mail::to($users->pluck('email'))->send(new AnnoucementMail($data));

        return redirect()->route('annoucement.create', ['success' => 'true']);
    }
}
