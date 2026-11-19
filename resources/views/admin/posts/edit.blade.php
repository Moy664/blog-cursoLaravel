<x-layouts::app>
    @push('css')
        <link href="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.snow.css" rel="stylesheet" />
    @endpush
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
                
                <img id="imgPreview" class="w-full aspect-video object-cover object-center" src="{{ $post->image_path ? Storage::url($post->image_path) : "https://static.vecteezy.com/system/resources/thumbnails/022/059/000/small_2x/no-image-available-icon-vector.jpg"}}" alt="No image"> 
    
                <div class="absolute top-8 right-8">
                    <label  class="bg-white px-4 py-2 rounded-lg cursor-pointer" for="image">
                        <input type="file" name="image" class="hidden" id="image" accept="image/*" onchange="previewImage(event, '#imgPreview')">
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

                    {{-- <flux:textarea label="Contenido" name="content" rows="16">
                        {{ old('content',$post->content) }}
                    </flux:textarea> --}}
                    <div>
                        <p class="font-medium text-sm mb-1">Contenido</p>
                        <div id="editor">{ !! old('content',$post->content) !! }</div>
                        <textarea name="content" id="content" class="hidden">{{ old('content',$post->content) }} </textarea>
                    </div>

                    <div>
                        <p class="text-sm font-medium mb-1">Etiquetas</p>
                        <ul>
                            @foreach ($tags as $tag )
                                <li>
                                    <label for="" class="flex item-center space-x-2">
                                        <input type="checkbox" name="tags[]" value="{{ $tag->id }}" @checked(in_array($tag->id,old('tags',$post->tags()->pluck('tag_id')->toArray()) ) )> 
                                        <span>
                                            {{ $tag->name }}
                                        </span>
                                    </label>
                                </li>
                            @endforeach
                        </ul>
                    </div>

                    <div>
                        <p class="text-sm font-medium mb-1">Estado</p>
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
                    </div>

                    <div class="flex justify-end">
                        <flux:button variant="primary" type="submit"> 
                            Modificar
                        </flux:button>
                    </div>

                </div>
            </div>
        </form>
        @push('js')
            <script src="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.js"></script>
            <!-- Initialize Quill editor -->
            <script>
                const quill = new Quill('#editor', {
                    theme: 'snow'
                });
                quill.on('text-change',function(){
                    document.querySelector('#content').value = quill.root.innerHTML;
                })    
            </script>
        @endpush
</x-layouts::app>