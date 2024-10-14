<x-app-layout>
    <x-slot name="header">
    <div class="flex justify-between">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
           Permissions | Editar
        </h2>
        <a href="{{route('permissions.index')}}" class="px-4 py-2 bg-blue-500 hover:bg-blue-700 text-white font-bold rounded">Atras</a>
       </div>
    </x-slot>

    <div class="py-12">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                  <form action="{{ route('permissions.update', $permission->id) }}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="" class="text-sm font-medium">Name</label>
                        <div class="my-3">
                             <input value="{{ old('name', $permission->name) }}" name="name" placeholder="Ingresa el nombre del permiso" type="text"
                         class="border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500" >
               
                        @error('name')
                            <p class="text-red-500 font-medium">{{$message}}</p>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Guardar</button>
                    </div>
                  </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
