<x-app-layout>
    <x-slot name="header">
    <div class="flex justify-between">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
           Editar Articulos
        </h2>
        <a href="{{route('articles.index')}}" class="px-4 py-2 bg-blue-500 hover:bg-blue-700 text-white font-bold rounded">Atras</a>
       </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                  <form action="{{ route('articles.update', $article->id) }}" method="post">
                    @csrf
                    <div class="mb-3">
                      
                        <label for="" class="text-sm font-medium">Titulo del Articulo</label>
                        <div class="my-3 w-full lg:w-1/2">
                             <input value="{{ old('title', $article->title) }}" name="title" placeholder="Nuevo Titulo" type="text"
                         class="border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500" >
               
                        @error('title')
                            <p class="text-red-500 font-medium">{{$message}}</p>
                        @enderror
                    </div>

                    <label for="" class="text-sm font-medium">Contenido del Articulo</label>
                    <div class="my-3 w-full lg:w-1/2">
                        <textarea name="text" id="text" class="border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500" cols="30" rows="10" >{{ old('text', $article->text) }}</textarea>
                      
                        
                        <div class="my-3 w-full lg:w-1/2">
                                 <label for="" class="text-sm font-medium">Autor del Articulo</label>
                             <input value="{{ old('author', $article->author) }}" name="author" placeholder="Ingrese el autor" type="text"
                         class="border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500" >
               
                        @error('author')  
                            <p class="text-red-500 font-medium">{{$message}}</p>
                        @enderror
                    </div>
                   
                </div>

                    <div class="mb-3">
                        <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Editar</button>
                    </div>
                  </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>