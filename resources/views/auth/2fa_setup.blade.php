@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Setup Two-Factor Authentication</h2>
        <p>Scan the QR code with your Google Authenticator app or enter the secret key manually.</p>
        <div>
            <img src="{{ $qrCodeUrl }}" alt="QR Code">
            <p>Secret Key: {{ $secret }}</p>
        </div>
        <form method="POST" action="{{ route('2fa.completeSetup') }}">
            @csrf
            <input type="hidden" name="secret" value="{{ $secret }}">

            <div class="form-group">
                <label for="one_time_password">One Time Password</label>
                <input type="text" name="one_time_password" id="one_time_password" class="form-control" required>
                @error('one_time_password')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Verify</button>


        </form>
    </div>
@endsection
