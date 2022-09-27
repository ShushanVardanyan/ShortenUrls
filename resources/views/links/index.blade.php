<x-app-layout>
    <x-slot name="header">
        My Links
    </x-slot>
    <a href="/downloadCsv" class="btn btn-primary">Export as CSV</a>

    <div class="">
        <div class="-my-2 overflow-x-auto sm:-mx-8 lg:-mx-12">
            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50 dark:bg-gray-600 dark:text-gray-200">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-200 uppercase tracking-wider">Id</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-200 uppercase tracking-wider">Web Url</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-200 uppercase tracking-wider">Short Url</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-200 uppercase tracking-wider">Qr code</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-200 uppercase tracking-wider">Creation Date</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-200 uppercase tracking-wider">User</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-200 uppercase tracking-wider">Email</th>
                        </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                        <tr></tr>
                        @foreach($links as $link)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">{{$link->id}}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{$link->original_url}}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{url($link->short_url)}}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                {!! QrCode::size(100)->backgroundColor(255,90,0)->generate(url($link->short_url)) !!}
                            </td>
                            <td class="px-6 py-4 text-right text-sm">{{$link->created_at}}</td>
                            <td class="px-6 py-4 text-right text-sm">{{$link->name}}</td>
                            <td class="px-6 py-4 text-right text-sm">{{$link->email}}</td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <div class="m-2 p-2">Pagination</div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
