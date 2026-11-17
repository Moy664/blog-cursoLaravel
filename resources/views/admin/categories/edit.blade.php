<x-layouts::app>
    <flux:breadcrumbs class="mb-4">
            <flux:breadcrumbs.item href="{{ route('dashboard') }}">
                Dashboard
            </flux:breadcrumbs.item>
            <flux:breadcrumbs.item href="{{ route('admin.categories.index') }}">
                Categories
            </flux:breadcrumbs.item>
            <flux:breadcrumbs.item >
                Nuevo
            </flux:breadcrumbs.item>
        </flux:breadcrumbs>

        <div class="card">
            <form action="{{ route('admin.categories.update', $category)}}"  method="POST" class="space-y-4">
                @csrf
                @method('PUT')
                <div>
                    <flux:input name="name" placeholder="Escribe el nombre de la categoria" label="Nombre" value="{{ old('name',$category->name) }}"/>

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