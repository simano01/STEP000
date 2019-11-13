<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\MailRequest;
use App\Contact;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class ContactController extends Controller
{
  // 画面表示
  public function view() {
    return view('contact');
  }

  // メール送信機能
  public function mail(MailRequest $request) {
    $contact = new Contact;
    $contact->name = $request->name;
    $contact->text = $request->text;
    $contact->email = $request->email;

    Mail::send('mail.contact', ['contact' => $contact],
    function($contact) {
      $contact->to('simasimano01@gmail.com')
              ->subject('【STEP】お問い合わせ');
    });

    return redirect('/contact')->with('flash_message', __('送信しました！'));

  }
}
