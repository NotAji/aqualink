<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Manage Bookings') }}
        </h2>
    </x-slot>

    <div class="container display flex flex-col justify-center bg-slate-700 min-h-48 h-fit rounded-2xl w-fit"> 
      <div class="content-header">
            <h1 class="">Fish you booked</h1>
        </div>
        <div class="content">
            <table class="table-fixed text-left text-slate-200 border-separate border-spacing-8 text-xl pl-5 pr-5">
                <thead>
                  <tr>
                    <th>Seller</th>
                    <th>Fish</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody class="text-center">
                    @foreach ($bookings as $book)
                  <tr>
                    <td>{{ $book->seller_name }}</td>
                    <td>{{ $book->fish->name }}</td>
                    <td>{{ ($book->fish->price * $book->quantity) }}PHP</td>
                    <td>{{ $book->quantity}}</td>
                    <td>{{ $book->status}}</td>
                    <td>
                      <form action= {{ Route('user.destroyBooking', $book->id) }} Method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-700 p-1 pl-3 pr-3 rounded-lg -ml-3">Cancel</button>
                      </form>
                    </td>
                  </tr>   
                  @endforeach                            
                </tbody>
                <div class="page">
                  {{ $bookings->appends(['bookingPage' => request('bookingPage')])->links() }}
                </div>
              </table>
        </div>
    </div>
    
    <div class="container display flex flex-col justify-center my-5 bg-slate-700 min-h-48 h-fit rounded-2xl w-fit"> 
      <div class="content-header">
            <h1 class="">Fish users' booked</h1>
        </div>
        <div class="content">
            <table class="table-fixed text-left text-slate-200 border-separate border-spacing-8 text-xl pl-5 pr-5">
                <thead>
                  <tr>
                    <th>Buyer</th>
                    <th>Fish</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody class="text-center">
                    @foreach ($buyers as $buyer)
                  <tr>
                    <td>{{ $buyer->user->name}}</td>
                    <td>{{ $buyer->fish_name }}</td>
                    <td>{{ ($buyer->fish->price * $buyer->quantity) }}PHP</td>
                    <td>{{ $buyer->quantity }}</td>
                    <td>
                      <form action= {{ route('user.approveBooking', $buyer->id) }} method="POST">
                        @csrf
                        @method('PUT')
                        <button type="submit" class="bg-cyan-900 p-1 pl-4 pr-4 rounded-lg">Approve</button>
                      </form>
                    </td>
                    <td><form action={{ route('user.declineBooking', $buyer->id) }} method="POST">
                      @csrf
                      @method('PUT')
                      <button type="submit" class="bg-red-700 p-1 pl-3 pr-3 rounded-lg -ml-3">Decline</button>  
                    </form></td>
                  </tr>   
                  @endforeach                            
                </tbody>
                <div class="page">
                  {{ $buyers->appends(['buyerPage' => request('buyerPage')])->links() }}
                </div>
              </table>
        </div>
    </div>

</x-app-layout>
