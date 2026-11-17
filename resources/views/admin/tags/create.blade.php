<x-layouts::app>
    <flux:breadcrumbs class="mb-4">
            <flux:breadcrumbs.item href="{{ route('dashboard') }}">
                Dashboard
            </flux:breadcrumbs.item>
            <flux:breadcrumbs.item href="{{ route('admin.tags.index') }}">
                Tags
            </flux:breadcrumbs.item>
            <flux:breadcrumbs.item >
                Nuevo
            </flux:breadcrumbs.item>
        </flux:breadcrumbs>

        <div class="card">
            <form action="{{ route('admin.tags.store')}}"  method="POST">
                @csrf
                <div>
                    <flux:input name="name" placeholder="Escribe el nombre de la etiqueta" label="Nombre" value="{{ old('name') }}"/>
                    <div class="flex justify-end mb-4">
                        <flux:button variant="primary" type="submit"> 
                            Crear
                        </flux:button>
                    </div>

                </div>
            </form>
        </div>
        
</x-layouts::app>