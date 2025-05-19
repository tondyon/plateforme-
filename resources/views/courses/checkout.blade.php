@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-2xl font-semibold mb-4">Payer le cours "{{ $course->title }}" ({{ number_format($course->price, 2) }}€)</h1>
    <div id="card-element" class="mb-4"></div>
    <button id="submit" class="px-4 py-2 bg-blue-600 text-white rounded">Payer</button>
    <div id="error-message" class="text-red-600 mt-4"></div>
</div>

<script src="https://js.stripe.com/v3/"></script>
<script>
    const stripe = Stripe("{{ $stripeKey }}");
    const elements = stripe.elements();
    const card = elements.create('card');
    card.mount('#card-element');

    document.getElementById('submit').addEventListener('click', async () => {
        const {error, paymentIntent} = await stripe.confirmCardPayment(
            '{{ $clientSecret }}',
            {
                payment_method: {
                    card: card,
                    billing_details: { name: '{{ auth()->user()->name }}' }
                }
            }
        );
        if (error) {
            document.getElementById('error-message').textContent = error.message;
        } else if (paymentIntent && paymentIntent.status === 'succeeded') {
            window.location.href = "{{ route('courses.checkout.success', $course->id) }}";
        }
    });
</script>

<style>
#card-element > .StripeElement {
  padding: 10px;
  border: 1px solid #ccc;
  border-radius: 4px;
}
</style>
@endsection
