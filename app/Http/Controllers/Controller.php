<?php

namespace App\Http\Controllers;

use App\Mail\Mail;
use App\Mail\NewMail;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use PHPUnit\Exception;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function index()
    {
        $data = [
            'subject' => ' Test mail from wigle',
            'body' => 'hey how you doing'
        ];
        \Mail::to("mrtom996@gmail.com")->send(new NewMail($data));
        dd('Mail sent');
    }
}
