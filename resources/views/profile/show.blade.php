@extends('layouts.app')

@section('content')
<div class="profile-container">
    <h2>My Profile</h2>

    @if(session('success'))
        <div class="success-message">{{ session('success') }}</div>
    @endif

    <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
        @csrf

        {{-- Profile Image --}}
        <div class="profile-image-box">
            <img id="profilePreview" src="{{ Auth::user()->profile_image ? asset('storage/' . Auth::user()->profile_image) : asset('default-avatar.png') }}" alt="Profile Image">
            <input type="file" name="profile_image" onchange="previewImage(event)">
        </div>

        {{-- Personal Info --}}
        <div class="form-group">
            <label>Name</label>
            <input type="text" name="name" value="{{ old('name', $user->name) }}" required>
        </div>

        <div class="form-group">
            <label>Email (readonly)</label>
            <input type="email" value="{{ $user->email }}" readonly>
        </div>

        <div class="form-group">
            <label>Address</label>
            <textarea name="address" rows="3">{{ old('address', $user->address ?? '') }}</textarea>
        </div>

        {{-- Password --}}
        <div class="form-group">
            <label>New Password</label>
            <input type="password" name="password" placeholder="Leave blank to keep same">
        </div>

        <div class="form-group">
            <label>Confirm Password</label>
            <input type="password" name="password_confirmation" placeholder="Confirm New Password">
        </div>

        <button type="submit" class="btn-update">Update Profile</button>

        <a href="{{ route('orders.index') }}" class="btn-orders">My Orders</a>
    </form>
</div>
@endsection


@section('scripts')
<script>
function previewImage(event) {
    const output = document.getElementById('profilePreview');
    output.src = URL.createObjectURL(event.target.files[0]);
    output.onload = () => URL.revokeObjectURL(output.src);
}
</script>
@endsection
