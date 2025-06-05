<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Reports & Analytics') }}
        </h2>
    </x-slot>

    <div class="container display flex flex-col justify-center my-10 bg-slate-700 min-h-48 h-fit rounded-2xl w-fit">
        <div class="content-header">
            <h1 class="">Reported Fish</h1>
        </div>
        <div class="content">
            <table class="table-fixed text-left text-slate-200 border-separate border-spacing-8 text-xl pl-5 pr-5">
                <thead>
                  <tr>
                    <th>User ID</th>
                    <th>Fish ID</th>
                    <th>Seller</th>
                    <th>Fish</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody class="text-center">
                    @foreach ($reports as $report)
                  <tr>
                    <td>{{ $report->users_id }}</td>
                    <td>{{ $report->fish_id }}</td>
                    <td>{{ $report->sellerName}}</td>
                    <td>{{ $report->fishName }}</td>
                    <td><form action={{ Route('admin.remove-reports', ['id' => $report->fish_id]) }} method="POST">
                       @csrf
                       @method('DELETE')
                       <button type="submit" class="bg-red-700 p-1 pl-4 pr-4 rounded-lg">Remove</button> 
                    </form></td>
                  </tr>   
                  @endforeach                            
                </tbody>
              </table>
        </div>
    </div>

</x-app-layout>
