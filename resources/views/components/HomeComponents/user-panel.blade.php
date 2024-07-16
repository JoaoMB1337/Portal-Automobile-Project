
<div class="bg-white rounded-lg border border-gray-200 p-4 shadow-sm">
    <div class="flex flex-col justify-between mb-4">
        <div>
            <div class="flex items-center mb-4">
                <div class="font-semibold text-center w-full">
                    <p class="text-gray-900 text-lg font-bold">{{ Auth::user()->name }}</p>
                    <p class="text-gray-700">{{ Auth::user()->employee_number }}</p>
                    <p class="text-gray-700">{{ Auth::user()->role->name }}</p>
                    <br>
                    <a href="{{ route('employees.show', Auth::user()->id) }}" class="text-[#f84525] font-medium text-sm hover:text-red-700">Ver perfil</a>
                </div>
            </div>
        </div>
    </div>
</div>
