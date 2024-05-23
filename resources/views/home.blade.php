@extends('components.master.main')

<div class=" mx-auto pl-10 lg:pl-64">

    <div class="p-6">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-6">
            <div class="bg-white rounded-md border border-gray-100 p-6 shadow-md shadow-black/5">
                <div class="flex justify-between mb-6">
                    <div>
                        <div class="flex items-center mb-1">

                            <div class=" font-semibold">
                                <p class="text-gray-800 font-bold">{{ Auth::user()->name }}</p>
                                <p class="text-gray-600">{{ Auth::user()->employee_number }}</p>
                                <p class="text-gray-600">{{ Auth::user()->role->name }}</p>
                                <br>
                                <a href="{{ route('employees.show', Auth::user()->id) }}" class="text-[#f84525] font-medium text-sm hover:text-red-800">Show profile</a>
                            </div>


                        </div>

                    </div>
                    <div class="relative">

                    </div>
                </div>


            </div>
            <div class="bg-white rounded-md border border-gray-100 p-6 shadow-md shadow-black/5">
                <div class="flex justify-between mb-4">
                    <div>
                        <div class="flex items-center mb-1">
                            <div class="text-2xl font-semibold">100</div>
                            <div class="p-1 rounded bg-emerald-500/10 text-emerald-500 text-[12px] font-semibold leading-none ml-2">+30%</div>
                        </div>
                    </div>
                    <div class="dropdown">
                        <button type="button" class="dropdown-toggle text-gray-400 hover:text-gray-600"><i class="ri-more-fill"></i></button>
                        <ul class="dropdown-menu shadow-md shadow-black/5 z-30 hidden py-1.5 rounded-md bg-white border border-gray-100 w-full max-w-[140px]">
                        </ul>
                    </div>
                </div>
                <a href="/dierenartsen" class="text-[#f84525] font-medium text-sm hover:text-red-800">View</a>
            </div>
            <div class="bg-white rounded-md border border-gray-100 p-6 shadow-md shadow-black/5">
                <div class="flex justify-between mb-6">
                    <div>
                        <div class="text-2xl font-semibold mb-1">100</div>
                        <div class="text-sm font-medium text-gray-400">Blogs</div>
                    </div>
                    <div class="dropdown">
                        <button type="button" class="dropdown-toggle text-gray-400 hover:text-gray-600"><i class="ri-more-fill"></i></button>
                        <ul class="dropdown-menu shadow-md shadow-black/5 z-30 hidden py-1.5 rounded-md bg-white border border-gray-100 w-full max-w-[140px]">
                            <li>
                                <a href="#" class="flex items-center text-[13px] py-1.5 px-4 text-gray-600 hover:text-blue-500 hover:bg-gray-50">Profile</a>
                            </li>
                            <li>
                                <a href="#" class="flex items-center text-[13px] py-1.5 px-4 text-gray-600 hover:text-blue-500 hover:bg-gray-50">Settings</a>
                            </li>
                            <li>
                                <a href="#" class="flex items-center text-[13px] py-1.5 px-4 text-gray-600 hover:text-blue-500 hover:bg-gray-50">Logout</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <a href="" class="text-[#f84525] font-medium text-sm hover:text-red-800">View</a>
            </div>
        </div>
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
            <div class="p-6 relative flex flex-col min-w-0 mb-4 lg:mb-0 break-words bg-gray-50 dark:bg-gray-800 w-full shadow-lg rounded">
                <div class="rounded-t mb-0 px-0 border-0">
                    <div class="flex flex-wrap items-center px-4 py-2">
                        <div class="relative w-full max-w-full flex-grow flex-1">
                            <h3 class="font-semibold text-base text-gray-900 dark:text-gray-50">Users</h3>
                        </div>
                    </div>
                    <div class="block w-full overflow-x-auto">
                        <table class="items-center w-full bg-transparent border-collapse">
                            <thead>
                            <tr>
                                <th class="px-4 bg-gray-100 dark:bg-gray-600 text-gray-500 dark:text-gray-100 align-middle border border-solid border-gray-200 dark:border-gray-500 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">Role</th>
                                <th class="px-4 bg-gray-100 dark:bg-gray-600 text-gray-500 dark:text-gray-100 align-middle border border-solid border-gray-200 dark:border-gray-500 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">Amount</th>
                                <th class="px-4 bg-gray-100 dark:bg-gray-600 text-gray-500 dark:text-gray-100 align-middle border border-solid border-gray-200 dark:border-gray-500 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left min-w-140-px"></th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr class="text-gray-700 dark:text-gray-100">
                                <th class="border-t-0 px-4 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4 text-left">Administrator</th>
                                <td class="border-t-0 px-4 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">1</td>
                                <td class="border-t-0 px-4 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
                                    <div class="flex items-center">
                                        <span class="mr-2">70%</span>
                                        <div class="relative w-full">
                                            <div class="overflow-hidden h-2 text-xs flex rounded bg-blue-200">
                                                <div style="width: 70%" class="shadow-none flex flex-col text-center whitespace-nowrap text-white justify-center bg-blue-600"></div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr class="text-gray-700 dark:text-gray-100">
                                <th class="border-t-0 px-4 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4 text-left">User</th>
                                <td class="border-t-0 px-4 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">6</td>
                                <td class="border-t-0 px-4 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
                                    <div class="flex items-center">
                                        <span class="mr-2">40%</span>
                                        <div class="relative w-full">
                                            <div class="overflow-hidden h-2 text-xs flex rounded bg-blue-200">
                                                <div style="width: 40%" class="shadow-none flex flex-col text-center whitespace-nowrap text-white justify-center bg-blue-500"></div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr class="text-gray-700 dark:text-gray-100">
                                <th class="border-t-0 px-4 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4 text-left">User</th>
                                <td class="border-t-0 px-4 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">5</td>
                                <td class="border-t-0 px-4 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
                                    <div class="flex items-center">
                                        <span class="mr-2">45%</span>
                                        <div class="relative w-full">
                                            <div class="overflow-hidden h-2 text-xs flex rounded bg-pink-200">
                                                <div style="width: 45%" class="shadow-none flex flex-col text-center whitespace-nowrap text-white justify-center bg-pink-500"></div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr class="text-gray-700 dark:text-gray-100">
                                <th class="border-t-0 px-4 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4 text-left">User</th>
                                <td class="border-t-0 px-4 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">4</td>
                                <td class="border-t-0 px-4 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
                                    <div class="flex items-center">
                                        <span class="mr-2">60%</span>
                                        <div class="relative w-full">
                                            <div class="overflow-hidden h-2 text-xs flex rounded bg-red-200">
                                                <div style="width: 60%" class="shadow-none flex flex-col text-center whitespace-nowrap text-white justify-center bg-red-500"></div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="bg-white border border-gray-100 shadow-md shadow-black/5 p-6 rounded-md">
                <div class="flex justify-between mb-4 items-start">
                    <div class="font-medium">Activities</div>
                    <div class="dropdown">
                        <button type="button" class="dropdown-toggle text-gray-400 hover:text-gray-600"><i class="ri-more-fill"></i></button>
                        <ul class="dropdown-menu shadow-md shadow-black/5 z-30 hidden py-1.5 rounded-md bg-white border border-gray-100 w-full max-w-[140px]">

                        </ul>
                    </div>
                </div>
                <div class="overflow-hidden">
                    <table class="w-full min-w-[540px]">
                        <tbody>
                        <tr>
                            <td class="py-2 px-4 border-b border-b-gray-50">
                                <div class="flex items-center">
                                    <a href="#" class="text-gray-600 text-sm font-medium hover:text-blue-500 ml-2 truncate">Lorem Ipsum</a>
                                </div>
                            </td>
                            <td class="py-2 px-4 border-b border-b-gray-50">
                                <span class="text-[13px] font-medium text-gray-400">02-02-2024</span>
                            </td>
                            <td class="py-2 px-4 border-b border-b-gray-50">
                                <span class="text-[13px] font-medium text-gray-400">17.45</span>
                            </td>
                            <td class="py-2 px-4 border-b border-b-gray-50">
                                <div class="dropdown">
                                    <button type="button" class="dropdown-toggle text-gray-400 hover:text-gray-600 text-sm w-6 h-6 rounded flex items-center justify-center bg-gray-50"><i class="ri-more-2-fill"></i></button>
                                    <ul class="dropdown-menu shadow-md shadow-black/5 z-30 hidden py-1.5 rounded-md bg-white border border-gray-100 w-full max-w-[140px]">

                                    </ul>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="py-2 px-4 border-b border-b-gray-50">
                                <div class="flex items-center">
                                    <a href="#" class="text-gray-600 text-sm font-medium hover:text-blue-500 ml-2 truncate">Lorem Ipsum</a>
                                </div>
                            </td>
                            <td class="py-2 px-4 border-b border-b-gray-50">
                                <span class="text-[13px] font-medium text-gray-400">02-02-2024</span>
                            </td>
                            <td class="py-2 px-4 border-b border-b-gray-50">
                                <span class="text-[13px] font-medium text-gray-400">17.45</span>
                            </td>
                            <td class="py-2 px-4 border-b border-b-gray-50">
                                <div class="dropdown">
                                    <button type="button" class="dropdown-toggle text-gray-400 hover:text-gray-600 text-sm w-6 h-6 rounded flex items-center justify-center bg-gray-50"><i class="ri-more-2-fill"></i></button>
                                    <ul class="dropdown-menu shadow-md shadow-black/5 z-30 hidden py-1.5 rounded-md bg-white border border-gray-100 w-full max-w-[140px]">

                                    </ul>
                                </div>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

