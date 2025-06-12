<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="container display flex flex-col justify-center my-10 bg-gray-800 min-h-48 h-fit rounded-2xl w-fit">
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
                    <th>Fishes</th>
                    <th>Bookings</th>
                    <th>Created at</th>
                  </tr>
                </thead>
                <tbody class="text-center">
                    @foreach ($users as $user)
                  <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email}}</td>
                    <td>{{ $user->fish_count }}</td>
                    <td>{{ $user->booking_count}}</td>
                    <td>{{ $user->created_at}}</td>
                  </tr>   
                    @endforeach                        
                </tbody>
                <div class="page">
                  {{ $users->appends(['dashboardPage' => request('dashboardPage')])->links() }}
                </div>
              </table>
        </div>
    </div>

    <div class="Container">
      <div class="content flex align-items-center">
        <div class="cards text-white flex justify-center flex gap-3 align-items-center">
          <div class="fishes flex justify-center align-items-center text-2xl bg-gray-800 p-5 rounded-xl">
            <h1>Total Fishes</h1>
            <h1>{{ $totalFish }}</h1>
          </div>
          <div class="bookingReq flex justify-center align-items-center text-2xl bg-gray-800 p-5 rounded-xl">
            <h1>Total Bookings</h1>
            <h1>{{ $totalBookings }}</h1>
          </div>
          <div class="bookingPen flex justify-center align-items-center text-2xl bg-gray-800 p-5 rounded-xl">
            <h1>Total Users</h1>
            <h1>{{ $totalUsers }}</h1>
          </div>
        </div>
      </div>
    </div>

</x-app-layout>
