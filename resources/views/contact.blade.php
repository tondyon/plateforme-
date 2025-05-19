@extends('layouts.app')
@section('title', 'Nous contacter')
@section('header')
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Nous contacter') }}
    </h2>
@endsection
@section('content')

    <div x-data="{ submitting: false }" x-init="$el.classList.add('animate-fadeIn')" class="contact-container flex items-center justify-center">
        <div class="contact-form-wrapper p-8 w-full max-w-sm">
            <div class="w-full">
                <!-- Animated center line under header -->
                <hr class="mx-auto my-4 border-t-2 border-indigo-600 animate-lineGrow w-0" x-init="$el.classList.add('w-full')">
                @if(session('success'))
                    <div class="mb-4 px-4 py-3 rounded relative bg-green-100 border border-green-400 text-green-700">
                        {{ session('success') }}
                    </div>
                @endif

                <form action="{{ route('contact.submit') }}" method="POST" class="space-y-6 contact-form">
                    @csrf

                    <div class="relative mb-4 contact-field" x-data="{ value: '{{ old('name') }}' }">
                        <x-text-input id="name" name="name" type="text" placeholder=" " x-model="value" @input="value = $event.target.value" class="w-full px-3 py-2 rounded bg-white bg-opacity-80 focus:bg-opacity-100 transition" required autofocus />
                        <label for="name">Nom</label>
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <div class="relative mb-4 contact-field" x-data="{ value: '{{ old('email') }}' }">
                        <x-text-input id="email" name="email" type="email" placeholder=" " x-model="value" @input="value = $event.target.value" class="w-full px-3 py-2 rounded bg-white bg-opacity-80 focus:bg-opacity-100 transition" required />
                        <label for="email">Email</label>
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <div class="relative mb-4 contact-field" x-data="{ value: '{{ old('subject') }}' }">
                        <x-text-input id="subject" name="subject" type="text" placeholder=" " x-model="value" @input="value = $event.target.value" class="w-full px-3 py-2 rounded bg-white bg-opacity-80 focus:bg-opacity-100 transition" required />
                        <label for="subject">Sujet</label>
                        <x-input-error :messages="$errors->get('subject')" class="mt-2" />
                    </div>

                    <div class="relative mb-4 contact-field" x-data="{ value: '{{ old('phone') }}' }">
                        <x-text-input id="phone" name="phone" type="text" placeholder=" " x-model="value" @input="value = $event.target.value" class="w-full px-3 py-2 rounded bg-white bg-opacity-80 focus:bg-opacity-100 transition" />
                        <label for="phone">Téléphone</label>
                        <x-input-error :messages="$errors->get('phone')" class="mt-2" />
                    </div>

                    <div class="relative mb-4 contact-field" x-data="{ value: '{{ old('message') }}' }">
                        <textarea id="message" name="message" rows="6" placeholder=" " x-model="value" @input="value = $event.target.value" class="w-full px-3 py-2 rounded bg-white bg-opacity-80 focus:bg-opacity-100 transition h-32 resize-none" required></textarea>
                        <label for="message">Message</label>
                        <x-input-error :messages="$errors->get('message')" class="mt-2" />
                    </div>

                    <div class="flex items-center justify-end">
                        <x-primary-button x-bind:disabled="submitting" x-text="submitting ? 'Envoi en cours...' : 'Envoyer'">
                            {{ __('Envoyer') }}
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

<style>
    .contact-container {
        position: relative;
        width: 100vw;
        min-height: 100vh;
        background-image: url("{{ asset('images/image3.jpeg') }}");
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
    }

    .contact-form-wrapper {
        width: 100%;
    }
    .contact-form {
        display: flex;
        flex-direction: column;
    }

    .contact-form label {
        display: block;
        margin-bottom: 8px;
        font-weight: 600;
        color: #333;
    }

    .contact-form input,
    .contact-form textarea {
        width: 100%;
        padding: 10px 14px;
        margin-bottom: 16px;
        border: 1px solid #ccc;
        border-radius: 8px;
        font-size: 15px;
        font-family: inherit;
        transition: border-color 0.3s;
        background-color: rgba(255, 255, 255, 0.8);
    }

    .contact-form input:focus,
    .contact-form textarea:focus {
        border-color: #0d6efd;
        outline: none;
        box-shadow: 0 0 0 2px rgba(13, 110, 253, 0.2);
    }

    .contact-form textarea {
        min-height: 120px;
        resize: vertical;
    }

    .contact-form button {
        padding: 12px 24px;
        background-color: #0d6efd;
        color: white;
        border: none;
        border-radius: 8px;
        font-size: 16px;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    .contact-form button:hover {
        background-color: #0b5ed7;
    }

    .alert-success {
        background-color: #d1e7dd;
        color: #0f5132;
        padding: 12px 20px;
        margin-bottom: 20px;
        border-left: 5px solid #0f5132;
        border-radius: 8px;
    }

    .error-message {
        color: #d00000;
        font-size: 14px;
        margin-top: -12px;
        margin-bottom: 12px;
    }

    .animate-fadeIn {
        animation: fadeIn 1s;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
        }
        to {
            opacity: 1;
        }
    }

    .animate-lineGrow {
        animation: lineGrow 1s;
    }

    @keyframes lineGrow {
        from {
            width: 0;
        }
        to {
            width: 100%;
        }
    }

    /* Floating label styles */
    .contact-field label {
        position: absolute;
        left: 12px;
        top: 12px;
        background: transparent;
        padding: 0 4px;
        color: #6b7280;
        pointer-events: none;
        transition: all 0.2s ease;
    }
    .contact-field input:focus + label,
    .contact-field textarea:focus + label,
    .contact-field input:not(:placeholder-shown) + label,
    .contact-field textarea:not(:placeholder-shown) + label {
        top: -8px;
        left: 8px;
        font-size: 0.75rem;
        color: #4f46e5;
        background: rgba(255,255,255,0.8);
    }
</style>
