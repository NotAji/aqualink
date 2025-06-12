<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="Container">
      <div class="content flex align-items-center">
        <div class="cards text-white flex justify-center flex gap-3 align-items-center">
          <div class="fishes flex justify-center align-items-center text-2xl bg-gray-800 p-5 rounded-xl">
            <h1>Approved Bookings</h1>
            <h1>{{ $fishBooked }}</h1>
          </div>
          <div class="bookingReq flex justify-center align-items-center text-2xl bg-gray-800 p-5 rounded-xl">
            <h1>Booking requests for your fish</h1>
            <h1>{{ $bookingCount }}</h1>
          </div>
          <div class="bookingPen flex justify-center align-items-center text-2xl bg-gray-800 p-5 rounded-xl">
            <h1>Bookings awaiting approval</h1>
            <h1>{{ $waitingApproval }}</h1>
          </div>
        </div>
      </div>

      <div class="container display flex flex-col justify-center my-5 bg-gray-800 min-h-48 h-fit rounded-xl w-fit">
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
                    @foreach ($fishes as $fish)
                  <tr>
                    <td>{{ $fish->name }}</td>
                    <td>{{ $fish->price }}</td>
                    <td>{{ $fish->quantity}}</td>
                    <td>{{ $fish->updated_at}}</td>
                  </tr>   
                  @endforeach                            
                </tbody>
              </table>
        </div>
      </div>
    </div>
  

</x-app-layout>
