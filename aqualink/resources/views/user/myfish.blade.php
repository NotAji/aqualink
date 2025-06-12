<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Manage Fish') }}
        </h2>
    </x-slot>

    <div class="container display flex flex-col justify-center my-10 bg-slate-700 min-h-48 h-fit rounded-2xl w-fit">
        <div class="content-header display flex justify-between align-content-center">
            <h1>{{ $username }}'s Inventory</h1>
            <a href={{ Route('user.create') }} class="p-1 pl-2 pr-2 bg-cyan-800 mr-5 rounded-lg">Add Fish</a>
        </div>
        <div class="content">
            <table class="table-fixed text-left text-slate-200 border-separate border-spacing-8 text-xl pl-5 pr-5">
                <thead>
                  <tr>
                    <th>Fish</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Updated at</th>
                    <th>Actions</th>
                  </tr>
                </thead>
                <tbody class="text-center">
                    @foreach ($fishes as $fish)
                  <tr>
                    <td>{{ $fish->name }}</td>
                    <td>{{ $fish->price }}</td>
                    <td>{{ $fish->quantity}}</td>
                    <td>{{ $fish->updated_at}}</td>
                    <td><a href={{ Route('user.edit',$fish->id) }} class="bg-cyan-900 p-1 pl-4 pr-4 rounded-lg">Edit</a></td>
                    <td><form action="{{ route('user.destroy', $fish->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this fish?');">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="bg-red-700 p-1 pl-4 pr-4 rounded-lg -ml-5">Delete</button>
                  </form></td>
                  </tr>   
                  @endforeach                            
                </tbody>
              </table>
        </div>
    </div>

</x-app-layout>
