<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\StripeClient;

class CoursePaymentController extends Controller
{
    /**
     * Redirect to Stripe Checkout
     */
    public function checkout(Course $course)
    {
        // Vérification des clés Stripe
        $secret = config('services.stripe.secret');
        $key    = config('services.stripe.key');
        if (empty($secret) || empty($key)) {
            abort(500, 'Stripe API keys sont mal configurées.');
        }
        // Initialisation du client Stripe avec clé explicite
        $stripe = new StripeClient(['api_key' => $secret]);
        $paymentIntent = $stripe->paymentIntents->create([
            'amount' => (int) ($course->price * 100),
            'currency' => 'eur',
            'metadata' => ['course_id' => $course->id, 'user_id' => auth()->id()],
        ]);
        $clientSecret = $paymentIntent->client_secret;
        $stripeKey   = $key;
        return view('courses.checkout', compact('course', 'stripeKey', 'clientSecret'));
    }

    /**
     * Handle successful payment
     */
    public function success(Course $course)
    {
        $user = auth()->user();
        if (!$user->enrolledCourses->contains($course->id)) {
            $user->enrollInCourse($course);
        }

        return redirect()->route('courses.show', $course)
                         ->with('success', 'Paiement réussi et cours débloqué !');
    }
}
