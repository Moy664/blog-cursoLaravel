<x-layouts::app.sidebar :title="$title ?? null">
    <flux:main>
        {{ $slot }}
    </flux:main>

    @if (session('swal'))
        <script>
            Swal.fire(@json(session('swal')));
        </script>
    @endif

    @stack('js')
</x-layouts::app.sidebar>
