<?php

namespace App\Datatable;


use App\Models\UserContact;
use Illuminate\Support\Facades\Cookie;
use App\Models\Contact;

class UserDatatable
{
    public function get($input = [])
    {
        $query = UserContact::query()->select('user_contacts.*');
        $query->where('app_id', Cookie::get('appId'));

        return $query;
    }

    public function show($id = [])
    {
        $contact = Contact::query()->where('user_id',$id)->select('contacts.*');
        $contact->where('app_id', Cookie::get('appId'));
        return $contact;
    }
}
