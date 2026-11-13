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

        <div class="card">
            <form action="{{ route('admin.posts.update',$post)}}"  method="POST" class="space-y-4">
                @csrf
                @method('PUT')
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
            </form>
        </div>
        
</x-layouts::app>