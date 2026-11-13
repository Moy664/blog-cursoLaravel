<x-layouts::app>
    <flux:breadcrumbs class="mb-4">
            <flux:breadcrumbs.item href="{{ route('dashboard') }}">
                Dashboard
            </flux:breadcrumbs.item>
            <flux:breadcrumbs.item href="{{ route('admin.categories.index') }}">
                Categories
            </flux:breadcrumbs.item>
            <flux:breadcrumbs.item >
                Editar
            </flux:breadcrumbs.item>
        </flux:breadcrumbs>

        <div class="card">
            <form action="{{ route('admin.categories.update', $category)}}"  method="POST">
                @csrf
                @method('PUT')
                <div>
                    <flux:input label="Nombre" name="name" placeholder="Escribe el nombre de la categoria" value="{{ old('name',$category->name) }}" class="text-black"/>
                    <div class="flex justify-end mb-4">
                        <flux:button variant="primary" type="submit"> 
                            Editar
                        </flux:button>
                    </div>

                </div>
            </form>
        </div>
        
</x-layouts::app>