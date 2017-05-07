<?php

namespace App\Http\Controllers\User;

use App\Http\Requests\user\ContactRequest;
use App\Models\Contact;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Input;

class ContactController extends Controller
{
    public function getContact()
    {
        return view('user.page.contact');
    }

    public function postContact(ContactRequest $request)
    {
        $contact = new Contact();
        $data = [];
        if ($request->name) {
            $contact->name = $request->name;
            $data['name'] = $request->name;
        }
        if ($request->email) {
            $contact->email = $request->email;
            $data['email'] = $request->email;
        }
        if ($request->subject) {
            $contact->subject = $request->subject;
            $data['subject'] = $request->subject;
        }
        if ($request->message) {
            $contact->content = $request->message;
            $data['content'] = $request->message;
        }
        $contact->created_at = date('y-m-d H:i:s');
        $contact->status = 0;
        //Send feedback of customer type email section:
        try {
            $mail = Mail::send('email.feedback', $data, function ($msg) {
                $msg->from('thetung.pdca@gmail.com', 'Yournews system');
                $msg->to('romelikeyou@gmail.com', 'admin')
                    ->subject(Input::get('subject'));
            });
        } catch (\Exception $exception) {
            echo "<script>alert('Sorry, but you could not send this Email,now!'); window.location='"
                .url('/')."';</script>";
        }
        //Save email in database:
        $model = new Contact();
        $addContact = $model->addContact($contact);
        if ($addContact->messageCode) {
            echo "<script>alert('Thank for your feedback, we will reply soon!'); window.location='"
                .url('/')."';</script>";
        } else {
            echo "<script>alert('Thank for your feedback, your email was deliveried'); window.location='"
                .url('/')."';</script>";
        }
    }
}
