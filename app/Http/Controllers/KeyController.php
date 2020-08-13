<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Mail\Contact;
use App\Validators\ReCaptcha;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;

class KeyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Factory|View
     */
    public function publickey()
    {
        return redirect('https://pastebin.com/raw/EDzeqRrb');
    }
    public function  fingerprint(){
        return redirect('https://pastebin.com/raw/EDzeqRrb');
    }
}
