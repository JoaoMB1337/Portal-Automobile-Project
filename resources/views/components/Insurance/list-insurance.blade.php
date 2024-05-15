<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

<div class="flex justify-center">
    <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 w-full">
                <thead>
                <tr>
                    <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-sm font-medium text-gray-500 uppercase tracking-wider">
                        Company
                    </th>
                    <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-sm font-medium text-gray-500 uppercase tracking-wider">
                        Policy Number
                    </th>
                    <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-sm font-medium text-gray-500 uppercase tracking-wider">
                        Start Date
                    </th>
                    <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-sm font-medium text-gray-500 uppercase tracking-wider">
                        End Date
                    </th>
                    <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-sm font-medium text-gray-500 uppercase tracking-wider">
                        Cost
                    </th>
                    <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-sm font-medium text-gray-500 uppercase tracking-wider">
                        Vehicle Plate
                    </th>
                    <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-sm font-medium text-gray-500 uppercase tracking-wider">
                        Actions
                    </th>
                </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                <a href="{{ route('insurances.create') }}" class="bg-gray-800 hover:bg-gray-700 text-white font-semibold py-2 px-4 rounded-full custom-btn">
                    Create Insurance
                </a>

                @foreach ($insurance as $ins)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $ins->insurance_company }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $ins->policy_number }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $ins->start_date }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $ins->end_date }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $ins->cost }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $ins->vehicle->plate }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-lg font-medium">
                            <a href="{{ route('insurances.show', $ins->id) }}" class="text-indigo-600 hover:text-indigo-900" title="View">
                                <i class="fas fa-eye"></i>
                            </a>

                            <a href="{{ route('insurances.edit', $ins->id) }}" class="text-indigo-600 hover:text-indigo-900 ml-2" title="Edit">
                                <i class="fas fa-edit"></i>
                            </a>

                            <form action="{{ route('insurances.destroy', $ins->id) }}" method="POST" style="display: inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-900 ml-2" title="Delete">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
