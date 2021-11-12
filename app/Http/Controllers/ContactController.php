<?php

namespace App\Http\Controllers;

use App\Services\ContactService;
use Exception;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

use SendGrid;
use SendGrid\Mail\Mail;

class ContactController extends Controller
{
    private $contactService;

    public function __construct(ContactService $contactService)
    {
        $this->contactService = $contactService;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('contacts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Application|Factory|View
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|max:255',
            'message' => 'required|max:1000',
        ]);

//        todo: translate errors in bulgarian
//        todo: change receiver email
        $from_name = getenv('SENDGRID_NAME');
        $from_email = getenv('SENDGRID_EMAIL');

        $modified_message = $this->contactService->buildMessageContactUs(
            $validated['name'],
            $validated['email'],
            $validated['subject'],
            $validated['message']
        );

        $status_code = $this->contactService->sendEmail(
            $from_email,
            $from_name,
            $from_email,
            $from_name,
            $validated['subject'],
            $modified_message
        );

        return view('contacts.result', compact('status_code'));
    }
}
