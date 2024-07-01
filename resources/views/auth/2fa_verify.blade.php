@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Two-Factor Authentication</h2>
        <form method="POST" action="{{ route('2fa.verify') }}">
            @csrf
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
