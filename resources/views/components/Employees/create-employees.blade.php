<style>
        .custom-bg {
            background-color: #f5f5f5;
        }

        .custom-card {
            background-color: #ffffff;
            box-shadow: 0px 20px 20px rgba(0, 0, 0, 0.1);
            border-radius: 20px;
            padding: 20px;
            max-width: 800px;
            margin: auto;
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

        .form-input,
        .form-control,
        .form-select,
        .form-textarea {
            border: 2px solid #ccc;
            transition: border-color 0.3s ease;
            padding: 8px;
        }

        .form-input:focus,
        .form-control:focus,
        .form-select:focus,
        .form-textarea:focus {
            border-color: #888;
        }

        .icon {
            color: #888;
            top: 4px;
            margin-right: 8px;
            padding-top: 15px;
        }

        @media (max-width: 1200px) {
            .custom-card {
                width: 90%;
            }
            .form-input,
            .form-control,
            .form-select,
            .form-textarea {
                width: 100%;
            }
        }
        @media (min-height: 900px) {
            .custom-card {
                height: 90vh; /* Define a altura da carta para 90% da altura da janela de visualização */
                overflow-y: auto; /* Adiciona uma barra de rolagem vertical caso a altura da carta seja excedida */
            }
        }

    </style>

<div class="w-full rounded-xl p-7 custom-card mt-12">
    <div class="flex justify-center mb-6">
        <h1>Employee Register</h1>
    </div>

    <form method="POST" action="{{ route('employees.store') }}" class="space-y-6">
        @csrf
        <div>
            <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">Name</label>
            <div class="flex">
                <i class="fas fa-user icon"></i>
                <input id="name" type="text" class="form-input w-full rounded-md border-gray-300 focus:border-gray-400 focus:ring focus:ring-gray-200 @error('name') border-red-500 @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
            </div>
            @error('name')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>
        <div>
            <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">Employee Number</label>
            <div class="flex">
                <i class="fas fa-id-badge icon"></i>
                <input id="employee_number" type="text" class="form-input w-full rounded-md border-gray-300 focus:border-gray-400 focus:ring focus:ring-gray-200 @error('employee_number') border-red-500 @enderror" name="employee_number" value="{{ old('employee_number') }}" required>
            </div>
            @error('employee_number')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
</div>

        <div>
            <label for="gender" class="block text-sm font-semibold text-gray-700 mb-2">Gender</label>
            <div class="flex">
                <i class="fas fa-venus-mars icon"></i>
                <select id="gender" class="form-control w-full rounded-md border-gray-300 focus:border-gray-400 focus:ring focus:ring-gray-200 @error('gender') border-red-500 @enderror" name="gender" required>
                    <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Male</option>
                    <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Female</option>
                    <option value="other" {{ old('gender') == 'other' ? 'selected' : '' }}>Other</option>
                </select>
            </div>
            @error('gender')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="birth_date" class="block text-sm font-semibold text-gray-700 mb-2">Birth Date</label>
            <div class="flex">
                <i class="fas fa-calendar-alt icon"></i>
                <input id="birth_date" type="date" class="form-input w-full rounded-md border-gray-300 focus:border-gray-400 focus:ring focus:ring-gray-200 @error('birth_date') border-red-500 @enderror" name="birth_date" value="{{ old('birth_date') }}" required>
            </div>
            @error('birth_date')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="CC" class="block text-sm font-semibold text-gray-700 mb-2">CC</label>
            <div class="flex">
                <i class="fas fa-id-card icon"></i>
                <input id="CC" type="text" class="form-input w-full rounded-md border-gray-300 focus:border-gray-400 focus:ring focus:ring-gray-200 @error('CC') border-red-500 @enderror" name="CC" value="{{ old('CC') }}" required>
            </div>
            @error('CC')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="NIF" class="block text-sm font-semibold text-gray-700 mb-2">NIF</label>
            <div class="flex">
                <i class="fas fa-id-card icon"></i>
                <input id="NIF" type="text" class="form-input w-full rounded-md border-gray-300 focus:border-gray-400 focus:ring focus:ring-gray-200 @error('NIF') border-red-500 @enderror" name="NIF" value="{{ old('NIF') }}" required>
            </div>
            @error('NIF')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="address" class="block text-sm font-semibold text-gray-700 mb-2">Address</label>
            <div class="flex">
                <i class="fas fa-home icon"></i>
                <input id="address" type="text" class="form-input w-full rounded-md border-gray-300 focus:border-gray-400 focus:ring focus:ring-gray-200 @error('address') border-red-500 @enderror" name="address" value="{{ old('address') }}">
            </div>
            @error('address')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="employee_role_id" class="block text-sm font-semibold text-gray-700 mb-2">Employee Role</label>
            <div class="flex">
                <i class="fas fa-briefcase icon"></i>
                <select id="employee_role_id" class="form-control w-full rounded-md border-gray-300 focus:border-gray-400 focus:ring focus:ring-gray-200 @error('employee_role_id') border-red-500 @enderror" name="employee_role_id" required>
                    @foreach($roles as $role)
                        <option value="{{ $role->id }}" {{ old('employee_role_id') == $role->id ? 'selected' : '' }}>{{ $role->name }}</option>
                    @endforeach
                </select>
            </div>
            @error('employee_role_id')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Email Address Field -->
        <div>
            <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">Email Address</label>
            <div class="flex">
                <i class="fas fa-envelope icon"></i>
                <input id="email" type="email" class="form-input w-full rounded-md border-gray-300 focus:border-gray-400 focus:ring focus:ring-gray-200 @error('email') border-red-500 @enderror" name="email" value="{{ old('email') }}">
            </div>
            @error('email')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Phone Number Field -->
        <div>
            <label for="phone" class="block text-sm font-semibold text-gray-700 mb-2">Phone Number</label>
            <div class="flex">
                <i class="fas fa-phone icon"></i>
                <input id="phone" type="text" class="form-input w-full rounded-md border-gray-300 focus:border-gray-400 focus:ring focus:ring-gray-200 @error('phone') border-red-500 @enderror" name="phone" value="{{ old('phone') }}">
            </div>
            @error('phone')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="contacts" class="block text-sm font-semibold text-gray-700 mb-2">Contacts</label>
            <div id="contacts-container">
                <div class="flex mb-2">
                    <select name="contacts[0][type]" class="form-select mr-2">
                        @foreach($contactTypes as $contactType)
                            <option value="{{ $contactType->id }}">{{ $contactType->type }}</option>
                        @endforeach
                    </select>
                    <input type="text" name="contacts[0][value]" class="form-input w-full rounded-md border-gray-300 focus:border-gray-400 focus:ring focus:ring-gray-200">
                </div>
            </div>
            <button type="button" id="add-contact-btn" class="bg-gray-800 hover:bg-gray-700 text-white font-semibold py-2 px-4 rounded-full custom-btn">Add Contact</button>
        </div>


        <div>
            <label for="driving_licenses" class="block text-sm font-semibold text-gray-700 mb-2">Driving Licenses</label>
            <div class="flex flex-wrap gap-4">
                @foreach($drivingLicenses as $license)
                    <div class="flex items-center">
                        <input id="license{{ $license->id }}" type="checkbox" class="form-checkbox h-5 w-5 text-gray-600" name="driving_licenses[]" value="{{ $license->id }}" {{ in_array($license->id, old('driving_licenses', [])) ? 'checked' : '' }}>
                        <label for="license{{ $license->id }}" class="ml-2 text-gray-700">{{ $license->name }}</label>
                    </div>
                @endforeach
            </div>
            @error('driving_licenses')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="password" class="block text-sm font-semibold text-gray-700 mb-2">Password</label>
            <div class="flex">
                <i class="fas fa-lock icon"></i>
                <input id="password" type="password" class="form-input w-full rounded-md border-gray-300 focus:border-gray-400 focus:ring focus:ring-gray-200 @error('password') border-red-500 @enderror" name="password" required autocomplete="new-password">
            </div>
            @error('password')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="password-confirm" class="block text-sm font-semibold text-gray-700 mb-2">Confirm Password</label>
            <div class="flex">
                <i class="fas fa-lock icon"></i>
                <input id="password-confirm" type="password" class="form-input w-full rounded-md border-gray-300 focus:border-gray-400 focus:ring focus:ring-gray-200" name="password_confirmation" required autocomplete="new-password">
            </div>
        </div>

        <div class="flex justify-center mt-6">
            <button type="submit" class="bg-gray-800 hover:bg-gray-700 text-white font-semibold py-2 px-4 rounded-full custom-btn focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-opacity-50 transition duration-300">
                {{ __('Register') }}
            </button>
        </div>
    </form>
</div>

<script>
    document.getElementById('add-contact-btn').addEventListener('click', function() {
        var container = document.getElementById('contacts-container');
        var index = container.children.length;
        var newContact = document.createElement('div');
        newContact.className = 'flex mb-2';
        newContact.innerHTML = `
            <select name="contacts[${index}][type]" class="form-select mr-2">
                @foreach($contactTypes as $contactType)
                    <option value="{{ $contactType->id }}">{{ $contactType->type }}</option>
                @endforeach
            </select>
            <input type="text" name="contacts[${index}][value]" class="form-input w-full rounded-md border-gray-300 focus:border-gray-400 focus:ring focus:ring-gray-200">
        `;
        container.appendChild(newContact);
    });
</script>
