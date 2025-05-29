<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Inventory') }}
        </h2>
    </x-slot>

    <div class="container-sm display flex flex-col justify-center my-10 bg-slate-700 min-h-48 h-fit rounded-2xl">
        <div class="content-header">
            <h1 class="">Manage Inventory</h1>
        </div>
        <div class="content">
            <table class="table-fixed text-left text-slate-200 border-separate border-spacing-7">
                <thead>
                  <tr>
                    <th>Fish</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Updated at</th>
                    <th>Actions</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                  <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->price }}</td>
                    <td>{{ $user->quantity}}</td>
                    <td>{{ $user->updated_at}}</td>
                    <td><a href="" class="mr-10 bg-cyan-800 p-2 pl-4 pr-4 rounded-lg">Edit</a></td>
                    <td><a href="" class="-ml-14 bg-red-700 p-2 pl-4 pr-4 rounded-lg">Delete</a></td>
                  </tr>   
                  @endforeach                           
                </tbody>
              </table>
        </div>
    </div>

</x-app-layout>
