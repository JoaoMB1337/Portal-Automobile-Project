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
        display: block;
        width: 100%;
        padding: 0.375rem 0.75rem;
        line-height: 1.5;
        color: #495057;
        background-color: #fff;
        background-clip: padding-box;
        border-radius: 0.25rem;
    }

    .form-input:focus, .form-control:focus {
        border-color: #888;
        outline: 0;
        box-shadow: 0 0 0 0.2rem rgba(0, 0, 0, 0.25);
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
            <h1>Trip</h1>
        </div>
        <form method="POST" action="{{ route('trips.store') }}" class="space-y-6">
            @csrf

            <div class="form-group">
                <label for="start_date">Data de Início:</label>
                <input type="date" name="start_date" class="form-input" required>
            </div>
            <div class="form-group mt-3">
                <label for="end_date">Data de Fim:</label>
                <input type="date" name="end_date" class="form-input" required>
            </div>
            <div class="form-group">
                <label for="destination">Destino:</label>
                <input type="text" name="destination" class="form-input" required>
            </div>
            <div class="form-group">
                <label for="purpose">Purpose:</label>
                <textarea name="purpose" class="form-control" required></textarea>
            </div>
            <div class="form-group">
                <label for="employee_id">Employee:</label>
                <select name="employee_id" class="form-control">
                    @foreach($employees as $employee)
                        <option value="{{$employee->id}}">{{ $employee->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="project_id">Project:</label>
                <select name="project_id" class="form-control">
                    @foreach($projects as $project)
                        <option value="{{$project->id}}">{{ $project->name }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <button type="submit" class="custom-btn w-full py-2 rounded-md">
                    Criar
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
