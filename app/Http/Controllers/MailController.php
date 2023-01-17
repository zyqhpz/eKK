<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\StatusUpdateMail;
use App\Mail\StatusApprovedMail;

use App\Models\User;
use App\Models\Paperwork;

class MailController extends Controller
{
    public function sendEmail($id, $status)
    {
        $paperwork = Paperwork::find($id);
        $user = User::find($paperwork->clubId);

        $link = 'https://ekk.fly.dev/kertas-kerja-kelab/'.$id ;

        if ($status == "Lulus") {
            Mail::to('receiver@example.com')->send(new StatusApprovedMail($user->name, $link));
        } else {
            Mail::to('receiver@example.com')->send(new StatusUpdateMail($user->name, $link));
        }

        return 'Email was sent';
    }
}
