<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Product') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-5xl mx-auto px-2 sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                
                <form action="" method="post">
                    <label for="name" class="block text-sm/6 font-medium">Name</label>
                    <div class="my-2">
                      <input id="name" type="text" name="name" required autocomplete="name" 
                      class="w-full mb-4 block rounded-md bg-white/5 px-3 py-1.5 text-base text-white outline-1 -outline-offset-1 outline-white/10 placeholder:text-gray-500 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-500 sm:text-sm/6" />
                    </div>

                    <label for="price" class="block text-sm/6 font-medium">Price</label>
                    <div class="my-2">
                      <input id="price" type="number" name="price" required autocomplete="price" 
                      class="w-full mb-4 block rounded-md bg-white/5 px-3 py-1.5 text-base text-white outline-1 -outline-offset-1 outline-white/10 placeholder:text-gray-500 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-500 sm:text-sm/6" />
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>

        
        