<?php

namespace App\Http\Controllers\admin\contact;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;

class adminContactController extends Controller
{
    public function index(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $contact_info = Contact::query()
            ->paginate();

        return view('admin.contact.index', compact('contact_info'));
    }

    public function show(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {

        $contact_show_info = Contact::query()
            ->first();

        return view('admin.contact.show', compact('contact_show_info'));
    }

    public function delete($id): \Illuminate\Http\RedirectResponse
    {
        $contact_info = Contact::query()->findOrFail($id);
        $contact_info->delete();

        alert()->success('', 'سوالات تماس با ما با موفقیت حذف شد.');
        return redirect()->route('admin.contact_panel');
    }

}

