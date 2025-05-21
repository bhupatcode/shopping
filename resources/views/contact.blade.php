@extends('layouts.app')

@section('title', 'Contact Us')

@section('content')
<style>
.contact-container {
    max-width: 600px;
    margin: auto;
    padding: 40px 20px;
}
.contact-container h2 {
    text-align: center;
    margin-bottom: 30px;
}
.contact-form {
    background: #f8f8f8;
    padding: 25px;
    border-radius: 10px;
    box-shadow: 0 6px 20px rgba(0, 0, 0, 0.05);
}
.contact-form input,
.contact-form textarea {
    width: 100%;
    padding: 12px;
    margin-bottom: 20px;
    border: 1px solid #ccc;
    border-radius: 8px;
}
.contact-form button {
    background: #4e54c8;
    color: white;
    border: none;
    padding: 12px 25px;
    border-radius: 8px;
    cursor: pointer;
}
.contact-form button:hover {
    background: #5f63e1;
}
.success {
    background: #d4edda;
    padding: 15px;
    border-left: 5px solid #28a745;
    margin-bottom: 20px;
}
</style>

<div class="contact-container">
    <h2>Contact Us</h2>

    @if(session('success'))
        <div class="success">{{ session('success') }}</div>
    @endif

    <form class="contact-form" method="POST" action="{{ route('contact.send') }}">
        @csrf
        <input type="text" name="name" placeholder="Your Name" required value="{{ old('name') }}">
        <input type="email" name="email" placeholder="Your Email" required value="{{ old('email') }}">
        <textarea name="message" rows="5" placeholder="Your Message..." required>{{ old('message') }}</textarea>
        <button type="submit">Send Message</button>
    </form>
</div>
@endsection
