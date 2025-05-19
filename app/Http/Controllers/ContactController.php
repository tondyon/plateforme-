<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class ContactController extends Controller
{
    /**
     * Affiche le formulaire de contact
     */
    public function create(): View
    {
        return view('contact');
    }

    /**
     * Traite la soumission du formulaire de contact
     */
    public function submit(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
            'message' => 'required|string|min:10',
        ]);

        // Envoyer l'email
        Mail::raw(
            "Sujet: {$validated['subject']}\nTéléphone: {$validated['phone']}\nMessage de : {$validated['name']} ({$validated['email']})\n\n{$validated['message']}",
            function($message) use ($validated) {
                $message->to(config('mail.from.address'))
                        ->subject("Nouveau message de contact - {$validated['name']}")
                        ->from($validated['email'], $validated['name']);
            }
        );

        return back()->with('success', 'Votre message a été envoyé avec succès ! Nous vous répondrons dans les plus brefs délais.');
    }
}
