<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('User Management') }}
        </h2>
    </x-slot>

    <div class="container display flex flex-col justify-center my-10 bg-slate-700 min-h-48 h-fit rounded-2xl w-fit">
        <div class="content-header">
            <h1 class="">Users</h1>
        </div>
        <div class="content">
            <table class="table-fixed text-left text-slate-200 border-separate border-spacing-8 text-xl pl-5 pr-5">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Created at</th>
                    <th>Actions</th>
                  </tr>
                </thead>
                <tbody class="text-center">
                    @foreach ($users as $user)
                  <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email}}</td>
                    <td>{{ $user->created_at}}</td>
                    <td><form action={{ Route('admin.remove-user', ['id' => $user->id]) }} method="POST">
                        @csrf
                        @method('DELETE')

                        <button type="submit" class="bg-red-700 p-1 pl-4 pr-4 rounded-lg">Ban</button>
                        </form></td>
                  </tr>   
                    @endforeach                        
                </tbody>
                <div class="page">
                  {{ $users->links() }}
                </div>
              </table>
        </div>
    </div>

</x-app-layout>
