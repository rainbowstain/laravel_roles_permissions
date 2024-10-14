<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Editar Usuario
            </h2>
            <a href="{{route('users.index')}}" class="px-4 py-2 bg-blue-500 hover:bg-blue-700 text-white font-bold rounded">Atras</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('users.update', $user->id) }}" method="post">
                        @csrf
                      
                        <div class="mb-3">
                            <label for="" class="text-sm font-medium">Editar Nombre</label>
                            <div class="my-3">
                                <input value="{{ old('name', $user->name) }}" name="name" placeholder="{{ $user->name }}" type="text"
                                    class="border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            
                                @error('name')
                                    <p class="text-red-500 font-medium">{{$message}}</p>
                                @enderror
                            </div>

                            <label for="" class="text-sm font-medium">Editar Email</label>
                            <div class="my-3">
                                <input value="{{ old('email', $user->email) }}" name="email" placeholder="{{ $user->email }}" type="text"
                                    class="border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            
                                @error('email')
                                    <p class="text-red-500 font-medium">{{$message}}</p>
                                @enderror
                            </div>

                        </div>

                        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-4 p-4 bg-gray-50 rounded-md shadow-sm">
                            @if ($roles->isNotEmpty())
                                @foreach ($roles as $role)
                                    <div class="flex items-center">
                                      
                                        <input   {{ $hasRoles->contains($role->id) ? 'checked' : '' }} type="checkbox" id="role-{{$role->id}}" name="role[]"
                                               value="{{$role->name}}" class="rounded mr-2">

                                        <label for="role-{{$role->id}}">{{$role->name}}</label>
                                    </div>
                                @endforeach
                            @endif
                        </div>

                        <div class="mt-4">
                            <button type="submit" class="px-4 py-2 bg-blue-500 hover:bg-blue-700 text-white font-bold rounded">
                                Actualizar
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
