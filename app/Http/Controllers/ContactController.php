<?php

namespace App\Http\Controllers;

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
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        return view('contacts.create');
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
        $sendgrid_name = getenv('SENDGRID_NAME');
        $sendgrid_email = getenv('SENDGRID_EMAIL');

        $email = new Mail();
        $email->setFrom($sendgrid_email, $sendgrid_name);
        $email->setSubject($validated['subject']);
        $email->addTo($sendgrid_email);

        $msg = "От: " . $validated['name'] . "\n" . 'Имейл: ' . $validated['email'] . "\n" . "Тема: " . $validated['subject'] . "\n";
        $msg .= "Съобщение: " . $validated['message'];

        $email->addContent("text/plain", $msg);

        $sendgrid = new SendGrid(getenv('SENDGRID_API_KEY'));
        $response = $sendgrid->send($email);

//        print $response->statusCode() . "\n";
//        Code - Meaning
//        --------------
//        401 - Error
//        202 - Success
//        print_r($response->headers());
//        print $response->body() . "\n";

        $status_code = $response->statusCode();

        return view('contacts.result', compact('status_code'));
    }
}
