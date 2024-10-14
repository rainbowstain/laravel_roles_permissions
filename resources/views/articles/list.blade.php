<x-app-layout>
    <x-slot name="header">
       <div class="flex justify-between">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Articulos') }}
        </h2>
        <a href="{{route('articles.create')}}" class="px-4 py-2 bg-blue-500 hover:bg-blue-700 text-white font-bold rounded">Crear Nuevo Articulo</a>
        
    </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
           
              <x-message></x-message>

            <table class="w-full">
                <thead class="bg-gray-100">
                    <tr class="border-b bg-gray-200 rounded-md">
                        <th class="px-6 py-3 text-left" width="60"> #</th>
                        <th class="px-6 py-3 text-left">Titulo</th>
                        <th class="px-6 py-3 text-left">Autor</th>
                        <th class="px-6 py-3 text-left" width="120">Fecha Creacion</th>
                        <th class="px-6 py-3 text-center" width="180">Acciones</th>
                    </tr>
                </thead>
                <tbody class="bg-white">
                @if ($articles->isNotEmpty())
                    @foreach($articles as $article)
                    <tr class="border-b">
                        <td class="px-6 py-3">
                            {{ $article->id }}
                        </td>
                        <td class="px-6 py-3 text-left"> 
                            {{ $article->title }}</td>  
                        <td class="px-6 py-3 text-left"> 
                            {{ $article->author }}</td>
                        <td class="px-5 py-3">
                            {{ \Carbon\Carbon::parse($article->created_at)->format('d M, y') }}</td>
                        <td class="px-6 py-3 text-center">
                            <a href="{{ route("articles.edit", $article->id) }}" class="bg-slate-700 text-sm rounded-md text-white px-3 py-2 mr-2">
                                Edit
                            </a> 
                            <a href="javascript:void(0)" onclick="deleteArticle({{ $article->id }})" 
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
            {{ $articles->links() }}
            </div>
            </div>
        </div>
    </div>
    <x-slot name="script">
        <script type="text/javascript">
            function deleteArticle(id){
                if(confirm('¿Estás seguro de que deseas eliminar este articulo?')) {
                    $.ajax({
                        url:'{{ route ("articles.destroy") }}',
                        type: 'delete',
                        data: {id:id},
                        dataType: 'json',
                        headers: {
                            'x-csrf-token': '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            window.location.href = '{{ route('articles.index') }}'                         
                        }
                    });
                }
            }
        </script>
    </x-slot>
</x-app-layout>
