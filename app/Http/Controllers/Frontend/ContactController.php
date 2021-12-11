<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Requests\Frontend\StoreContactRequest;
use App\Models\Contact;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Session;

class ContactController extends BaseController
{
    public function index()
    {
        return view('frontend.contact');
    }

    public function store(StoreContactRequest $request): RedirectResponse
    {
        try {
            Contact::query()->create($request->validated());

            Session::flash('status', 'success');
            Session::flash('message', 'Your message was sent successfully.');

            return redirect()->back();
        } catch (Exception $expception) {
            Session::flash('status', 'danger');
            Session::flash('message', 'Sorry something went wrong!');
            return redirect()->back();
        }
    }
}
