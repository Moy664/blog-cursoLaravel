<x-layouts::app>
    <flux:breadcrumbs class="mb-4">
            <flux:breadcrumbs.item href="{{ route('dashboard') }}">
                Dashboard
            </flux:breadcrumbs.item>
            <flux:breadcrumbs.item href="{{ route('admin.posts.index') }}">
                Post
            </flux:breadcrumbs.item>
            <flux:breadcrumbs.item >
                Editar
            </flux:breadcrumbs.item>
        </flux:breadcrumbs>

        <form action="{{ route('admin.posts.update',$post)}}"  method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class = "relative mb-2">
                
                {{-- <img class="w-full aspect-video object-cover object-center" src="https://static.vecteezy.com/system/resources/thumbnails/022/059/000/small_2x/no-image-available-icon-vector.jpg" alt="No image"> --}}
                <img class="w-full aspect-video object-cover object-center" src="{{ $post->image_path ? Storage::url($post->image_path) : "https://static.vecteezy.com/system/resources/thumbnails/022/059/000/small_2x/no-image-available-icon-vector.jpg"}}" alt="No image"> 
    
                <div class="absolute top-8 right-8">
                    <label  class="bg-white px-4 py-2 rounded-lg cursor-pointer" for="image">
                        <input type="file" name="image" class="hidden" id="image" accept="image/*">
                        Cambiar imagen
                    </input>
                    </label>
                </div>
            </div>

            <div class="card space-y-4">
                <div>
                    <flux:input name="title" placeholder="Escribe el titulo del post" label="Titulo" value="{{ old('title', $post->title) }}" oninput="string_to_slug(this.value, '#slug')"/>
                    
                    <flux:input id="slug" name="slug" placeholder="Escribe el slug del post" label="Slug" value="{{ old('slug', $post->slug) }}"/>

                    <flux:select name="category_id" label="Categoria">
                        @foreach ($categories as $category )
                            <flux:select.option value="{{$category->id}}" selected="{{$category->id == old('categoria_id', $post->categoria_id)}}">{{ $category->name }}</flux:select.option>

                        @endforeach
                    </flux:select>

                    <flux:textarea label="Resumen" name="excerpt">
                        {{ old('excerpt',$post->excerpt) }}
                    </flux:textarea>

                    <flux:textarea label="Contenido" name="content" rows="16">
                        {{ old('content',$post->content) }}
                    </flux:textarea>

                    <div class="flex space-x-3">
                        <label class="flex items-center">
                            <input type="radio" name="is_published" value="0" @checked(old('is_published',$post->is_published) == 0)>
                            <span class="ml-1">No publicado</span>
                        </label>
                        <label class="flex items-center">
                            <input type="radio" name="is_published" value="1" @checked(old('is_published',$post->is_published) == 1)> 
                            <span class="ml-1">Publicado</span>
                        </label>
                        
                    </div>

                    <div class="flex justify-end">
                        <flux:button variant="primary" type="submit"> 
                            Modificar
                        </flux:button>
                    </div>

                </div>
            </div>
        </form>
        
</x-layouts::app>