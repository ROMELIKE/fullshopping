<?php

namespace App\Http\Controllers\Admin;

use App\Business\ContactObject;
use App\Models\Contact;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ContactController extends Controller
{
    public function getList()
    {
        $model = new Contact();
        $listContact = $model->listContact('DESC')->result;

        return view('admin.contact.list', compact(['listContact']));
    }

    public function deleteContact($id)
    {
        $model = new Contact();
        //Check $id exist
        $thisContact = $model->getContactById($id);
        if ($thisContact->messageCode) {
            $deleteContact = $model->deleteContact($id);
            if ($deleteContact->messageCode) {
                return redirect()->route('contact.list')->with([
                    'level' => 'success',
                    'message' => $deleteContact->message
                ]);
            } else {
                return redirect()->back()->with([
                    'level' => 'danger',
                    'message' => $deleteContact->message
                ]);
            }
        } else {
            return redirect()->back()->with([
                'level' => 'danger',
                'message' => $thisContact->message
            ]);
        }
    }

    public function updateContact($id)
    {
        $model = new Contact();
        //Check $id exist
        $thisContact = $model->getContactById($id);
        if ($thisContact->messageCode) {
            $contact = new ContactObject();
            $contact->status = !$thisContact->result->status;
            $contact->id = $id;
            $contact->update_at = date('y-m-d H:i:s');
            $updateContact = $model->updateContact($contact);

            return redirect()->route('contact.list');

        } else {

            return redirect()->back()->with([
                'level' => 'danger',
                'message' => $thisContact->message
            ]);
        }
    }

    public function getWriteContact()
    {
        return view('admin.contact.add');
    }
}
