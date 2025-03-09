<?php

namespace App\Http\Controllers;

use App\Http\Requests\AnnouncementCreateRequest;
use App\Mail\AnnoucementMail;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

class AnnouncementController extends Controller
{
    public function create()
    {
        return view('admin_announcement_create');
    }

    public function send(AnnouncementCreateRequest $request)
    {
        $data = $request->only(['title', 'content']);

        $users = User::getUsers()->where('role_id', User::ROLE_GENERAL);

        Mail::to($users->pluck('email'))->send(new AnnoucementMail($data));

        return redirect()->route('announcement.create', ['success' => 'true']);
    }
}
