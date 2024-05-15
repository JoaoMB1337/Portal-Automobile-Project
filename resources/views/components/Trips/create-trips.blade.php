@extends('layouts.app')
@extends('components.master.main')

@section('content')

    <style>
        .custom-bg {
            background-color: #f5f5f5;
        }

        .custom-card {
            background-color: #ffffff;
            box-shadow: 0px 20px 20px rgba(0, 0, 0, 0.1);
            border-radius: 20px;
        }

        .custom-logo {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            object-fit: cover;
        }

        .custom-btn {
            background-color: #000;
            color: #fff;
            transition: background-color 0.3s ease;
            border-radius: 30px;
        }

        .custom-btn:hover {
            background-color: #222;
        }
        .form-input, .form-control {
            border: 2px solid #ccc;
            transition: border-color 0.3s ease;
        }

        .form-input:focus, .form-control:focus {
            border-color: #888;
        }

        @media (max-width: 640px) {
            .custom-logo {
                width: 80px;
                height: 80px;
            }
        }
    </style>

    <div class="flex justify-center items-start h-screen custom-bg">
        <div class="max-w-md w-full bg-white rounded-xl p-7 custom-card mt-12">
            <div class="flex justify-center mb-6">
                <h1>Employee Register</h1>
            </div>
            <form method="POST" action="{{ route('trips.store') }}">
        @csrf
        <div class="form-group">
            <label for="start_date">Start Date:</label>
            <input type="date" name="start_date" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="end_date">End Date:</label>
            <input type="date" name="end_date" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="destination">Destination:</label>
            <input type="text" name="destination" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="purpose">Purpose:</label>
            <textarea name="purpose" class="form-control" required></textarea>
        </div>
        <div class="form-group">
            <label for="employee_id">Employee:</label>
            <select name="employee_id" class="form-control">
                @foreach (\App\Models\Employee::all() as $employee)
                    <option value="{{ $employee->id }}">{{ $employee->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="project_id">Project:</label>
            <select name="project_id" class="form-control">
                @foreach (\App\Models\Project::all() as $project)
                    <option value="{{ $project->id }}">{{ $project->name }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
        </div>
    </div>
@endsection


                        

