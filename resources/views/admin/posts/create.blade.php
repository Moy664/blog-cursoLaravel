<x-layouts::app>
    <flux:breadcrumbs class="mb-4">
            <flux:breadcrumbs.item href="{{ route('dashboard') }}">
                Dashboard
            </flux:breadcrumbs.item>
            <flux:breadcrumbs.item href="{{ route('admin.posts.index') }}">
                Post
            </flux:breadcrumbs.item>
            <flux:breadcrumbs.item >
                Nuevo
            </flux:breadcrumbs.item>
        </flux:breadcrumbs>

        <div class="card">
            <form action="{{ route('admin.posts.store')}}"  method="POST" class="space-y-4">
                @csrf
                <div>
                    <flux:input name="title" placeholder="Escribe el titulo del post" label="Titulo" value="{{ old('title') }}"/>
                    
                    <flux:input name="slug" placeholder="Escribe el slug del post" label="Slug" value="{{ old('slug') }}"/>

                    <flux:select name="category_id" label="Categoria">
                        @foreach ($categories as $category )
                            <flux:select.option value="{{$category->id}}">{{ $category->name }}</flux:select.option>

                        @endforeach
                    </flux:select>

                    <div class="flex justify-end">
                        <flux:button variant="primary" type="submit"> 
                            Crear
                        </flux:button>
                    </div>

                </div>
            </form>
        </div>
        
</x-layouts::app>