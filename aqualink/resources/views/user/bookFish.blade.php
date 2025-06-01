<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Book Fish') }}
        </h2>
    </x-slot>

    <div class="container display flex flex-col justify-center align-content-center my-10 bg-slate-700 min-h-48 h-fit rounded-2xl w-fit">
        <form action="{{ route('user.storeBooking', ['id'=>$booking->id]) }}" method="POST" class="display flex flex-col p-5 gap-4 pl-10 pr-10">
            @csrf
            <label for="seller" class="text-white">Seller: {{ $seller->name }}</label>
        
            <label for="name" class="text-white -mb-2 text-xl">Fish: {{ $booking->name }}</label>
        
            <label for="price" class="text-white -mb-2 text-xl">Price: {{ $booking->price }}</label>
        
            <label for="quantity" class="text-white -mb-2 text-xl">Quantity: {{ $booking->quantity }}</label>
            <input type="number" name="quantity" placeholder="Quantity to book" required class="rounded-lg">
        
            <button type="submit" name="submit" class="text-white bg-cyan-700 p-2 rounded-lg">Book</button>
        </form>
    </div>

</x-app-layout>
