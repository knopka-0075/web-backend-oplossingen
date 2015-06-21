<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Mail;

use Illuminate\Http\Request;
use App\Http\Requests\ContactFormRequest;

class AboutController extends Controller {

  /*Contact form aan maken*/
    public function create()
    {
        return view('about.contact');
    }

     public function store(ContactFormRequest $request)
  {
    /*Contact form Valideren*/
    \Mail::send('emails.contact',
        array(
            'name' => $request->get('name'),
            'surname' => $request->get('surname'),
            'email' => $request->get('email'),
            'user_message' => $request->get('message')
        ), function($message)
    {
      /*Van vie */
        $message->from('zaya1991@list.ru');
      /*Naar vie*/  
        $message->to('zaya1991@list.ru', 'Admin')->subject('KRIStyle');
    });

  return \Redirect::route('contact')->with('message', 'Thanks for contacting us!');

  }
}
