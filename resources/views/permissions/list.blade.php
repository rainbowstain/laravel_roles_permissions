<x-app-layout>
    <x-slot name="header">
       <div class="flex justify-between">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Permisos') }}
        </h2>
        <a href="{{route('articles.create')}}" class="px-4 py-2 bg-blue-500 hover:bg-blue-700 text-white font-bold rounded">Crear Nuevo Permiso</a>
     
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
                        <th class="px-6 py-3 text-left" width="120">Fecha Creacion</th>
                        <th class="px-6 py-3 text-center" width="180">Acciones</th>
                    </tr>
                </thead>
                <tbody class="bg-white">
                @if ($permissions->isNotEmpty())
                    @foreach($permissions as $permission)
                    <tr class="border-b">
                        <td class="px-6 py-3">
                            {{ $permission->id }}
                        </td>
                        <td class="px-6 py-3 text-center"> 
                            {{ $permission->name }}</td>
                        <td class="px-5 py-3">
                            {{ \Carbon\Carbon::parse($permission->created_at)->format('d M, y') }}</td>
                        <td class="px-6 py-3 text-center">
                            <a href="{{ route("permissions.edit", $permission->id) }}" class="bg-slate-700 text-sm rounded-md text-white px-3 py-2 mr-2">
                                Edit
                            </a> 
                            <a href="javascript:void(0)" onclick="deletePermission({{ $permission->id }})" 
                                class="bg-red-300 text-sm rounded-md text-white px-3 py-2">
                                Delete
                            </a>
                        </td>
                    </tr>
                    @endforeach
                    @endif

                </tbody>
            </table>
            <div class="mt-3">
            {{ $permissions->links() }}
            </div>
            </div>
        </div>
    </div>
    <x-slot name="script">
        <script type="text/javascript">
            function deletePermission(id){
                if(confirm('¿Estás seguro de que deseas eliminar este permiso?')) {
                    $.ajax({
                        url:'{{ route ("permissions.destroy") }}',
                        type: 'delete',
                        data: {id:id},
                        dataType: 'json',
                        headers: {
                            'x-csrf-token': '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            window.location.href = '{{ route('permissions.index') }}'                         
                        }
                    });
                }
            }
        </script>
    </x-slot>
</x-app-layout>
