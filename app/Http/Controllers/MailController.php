<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\StatusUpdateMail;

use App\Models\User;
use App\Models\Paperwork;

class MailController extends Controller
{
    public function sendEmail($id)
    {
        $paperwork = Paperwork::find($id);
        $user = User::find($paperwork->clubId);

        Mail::to('receiver@example.com')->send(new StatusUpdateMail($user->name));

        return 'Email was sent';
    }
}
