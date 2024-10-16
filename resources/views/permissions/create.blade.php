<x-app-layout>
    <x-slot name="header">
    <div class="flex justify-between">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
           Crear permisos
        </h2>
        <a href="{{route('permissions.index')}}" class="px-4 py-2 bg-blue-500 hover:bg-blue-700 text-white font-bold rounded">Atras</a>
       </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                  <form action="{{ route('permissions.store') }}" method="post">
                    @csrf
                    <div class="mb-3">
                        <label for="" class="text-sm font-medium">Crear Permiso</label>
                        <div class="my-3 w-full lg:w-1/2">
                             <input value="{{ old('name') }}" name="name" placeholder="Nuevo permiso" type="text"
                         class="border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500" >
               
                        @error('name')
                            <p class="text-red-500 font-medium">{{$message}}</p>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Crear</button>
                    </div>
                  </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
