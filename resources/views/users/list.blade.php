<x-app-layout>
    <x-slot name="header">
       <div class="flex justify-between">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Usuarios') }}
        {{-- </h2>
        <a href="{{route('roles.create')}}" class="px-4 py-2 bg-blue-500 hover:bg-blue-700 text-white font-bold rounded">Crear Nuevo Usuario</a>
      --}}
    </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
           
              <x-message></x-message>

              <table class="w-full">
                <thead class="bg-gray-100">
                    <tr class="border-b bg-gray-200 rounded-md">
                        <th class="px-6 py-3 text-left" width="60"> #</th>
                        <th class="px-6 py-3 text-left">Nombre</th>
                        <th class="px-6 py-3 text-left">Email</th>
                        <th class="px-6 py-3 text-left">Roles</th>
                        <th class="px-6 py-3 text-left" width="120">Fecha Creacion</th>
                        <th class="px-6 py-3 text-center" width="180">Acciones</th>
                    </tr>
                </thead>
                <tbody class="bg-white">
                @if ($users->isNotEmpty())
                    @foreach($users as $user)
                    <tr class="border-b">
                        <td class="px-6 py-3">
                            {{ $user->id }}
                        </td>
                        <td class="px-6 py-3 text-left"> 
                            {{ $user->name }}</td>

                        <td class="px-6 py-3">  
                            {{$user->email}}
                        </td>
                        

                        <td class="px-5 py-3">
                            {{ $user->roles->pluck('name')->implode(', ') }}
                        </td>
                        <td class="px-5 py-3">
                            {{ \Carbon\Carbon::parse($user->created_at)->format('d M, y') }}</td>
                        <td class="px-6 py-3 text-center">
                        @can('edit users')
                         <a href="{{ route("users.edit", $user->id) }}" class="bg-slate-700 text-sm rounded-md text-white px-3 py-2 mr-2">
                                    Edit
                                </a> 
                        @endcan
                        @can('delete users')
                                <a href="javascript:void(0)" onclick="deleteUser({{ $user->id }})" 
                                    class="bg-red-300 text-sm rounded-md text-white px-3 py-2">
                                    Delete
                                </a> 
                            </td>
                        @endcan

                    </tr>
                    @endforeach
                    @endif

                </tbody>
            </table>



            <div class="mt-3">
                  {{$users->links()}}
            </div>


            </div>
        </div>
    </div>
    {{-- <x-slot name="script">
        <script type="text/javascript">
            function deleteUser(id){
                if(confirm('¿Estás seguro de que deseas eliminar este usuario?')) {
                    $.ajax({
                        url:'{{ route ("users.destroy") }}',
                        type: 'delete',
                        data: {id:id},
                        dataType: 'json',
                        headers: {
                            'x-csrf-token': '{{ csrf_token() }}'
                        },
                        success: function(response) {
                                window.location.href = '{{ route('users.index') }}'                         
                        }
                    });
                }
            }
        </script>
    </x-slot> --}}
</x-app-layout>
