<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ContactController extends Controller
{
    public function index()
    {
        $contacts = DB::table('contacts')->select('contacts.*')->get();
        return view('admin.contact.index', [
            'contacts' => $contacts,
        ]);
    }
}
