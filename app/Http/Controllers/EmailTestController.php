<?php

namespace App\Http\Controllers;

use App\Mail\DeveloperApplicationMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class EmailTestController extends Controller
{
    public function sendTest(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'company' => 'required|string',
            'vacancy' => 'nullable|string'
        ]);

        Mail::to($request->email)->send(
            new DeveloperApplicationMail(
                $request->company,
                $request->vacancy ?? 'вакансию'
            )
        );

        return response()->json(['message' => 'Email sent successfully']);
    }

    public function showForm()
    {
        return view('test-email');
    }
}