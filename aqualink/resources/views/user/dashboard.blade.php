<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Inventory') }}
        </h2>
    </x-slot>

    <div class="container display flex flex-col justify-center my-10 bg-slate-700 min-h-48 h-fit rounded-2xl w-fit">
        <div class="content-header">
            <h1 class="">{{ $username }}'s Inventory</h1>
        </div>
        <div class="content">
            <table class="table-fixed text-left text-slate-200 border-separate border-spacing-8 text-xl pl-5 pr-5">
                <thead>
                  <tr>
                    <th>Fish</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Updated at</th>
                  </tr>
                </thead>
                <tbody class="text-center">
                    @foreach ($users as $user)
                  <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->price }}</td>
                    <td>{{ $user->quantity}}</td>
                    <td>{{ $user->updated_at}}</td>
                  </tr>   
                  @endforeach                           
                </tbody>
              </table>
        </div>
    </div>

</x-app-layout>
