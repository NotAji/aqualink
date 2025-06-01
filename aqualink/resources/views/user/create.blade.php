<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Create') }}
        </h2>
    </x-slot>

    <div class="container display flex flex-col justify-center align-content-center my-10 bg-slate-700 min-h-48 h-fit rounded-2xl w-fit">
            <form action= {{ Route('user.store') }} Method="POST" class="display flex flex-col p-5 gap-4 pl-10 pr-10">
                @csrf
                <label for="name" class="text-white -mb-2 text-xl">Fish</label>
                <input type="text" name="name" placeholder="name your fish" required class="rounded-lg">

                <label for="price" class="text-white -mb-2 text-xl">Price</label>
                <input type="number" name="price" placeholder="name your price" required class="rounded-lg">

                <label for="quantity" class="text-white -mb-2 text-xl">Quantity</label>
                <input type="number" name="quantity" placeholder="how many?" required class="rounded-lg">

                <button type="submit" name="submit" class="text-white bg-cyan-700 p-2 rounded-lg">Add fish</button>
            </form>
    </div>
    
</x-app-layout>