@extends('layouts.app')



@section('content')
<div class="terms-container">
    <h2 class="terms-title">Terms and Conditions</h2>
    <div class="terms-card">
        <p><strong>1. Acceptance of Terms:</strong> By accessing and using our services, you accept and agree to be bound by these terms.</p>

        <p><strong>2. User Responsibilities:</strong> Users are responsible for maintaining the confidentiality of their account and password.</p>

        <p><strong>3. Product Availability:</strong> We do not guarantee that all products will always be in stock. Availability may change at any time.</p>

        <p><strong>4. Payment:</strong> All payments must be made via the payment methods provided. Orders will only be processed after successful payment.</p>

        <p><strong>5. Returns & Refunds:</strong> Refunds or returns will be handled as per our policy outlined in the refund section.</p>

        <p><strong>6. Privacy:</strong> Your personal data is handled with care. Please refer to our privacy policy for more details.</p>

        <p><strong>7. Changes:</strong> We may update these terms from time to time. Continued use of the site means acceptance of the revised terms.</p>

        <p class="mt-4">If you have any questions regarding these terms, feel free to <a href="{{ route('contact.form') }}">contact us</a>.</p>
    </div>
</div>
@endsection
