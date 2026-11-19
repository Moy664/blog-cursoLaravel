@php
    $links = [
        [
            'name'=>'Posts',
            'icon'=> 'book-open',
            'url' => route('posts.index'),
            'current' => request()->routeIs('posts.*'),
        ],
        
    ]
@endphp

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />

        <title>
            {{ filled($title ?? null) ? $title.' - '.config('app.name', 'Laravel') : config('app.name', 'Laravel') }}
        </title>

        <link rel="icon" href="/favicon.ico" sizes="any">
        <link rel="icon" href="/favicon.svg" type="image/svg+xml">
        <link rel="apple-touch-icon" href="/apple-touch-icon.png">
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        @fonts
        @stack('css')
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @fluxAppearance
    </head>
    <body class="min-h-screen bg-white dark:bg-zinc-800">
        <flux:header container class="border-b border-zinc-200 bg-zinc-50 dark:border-zinc-700 dark:bg-zinc-900">
            <flux:sidebar.toggle class="lg:hidden mr-2" icon="bars-2" inset="left" />

            <x-app-logo href="{{ route('dashboard') }}" wire:navigate />

            <flux:navbar class="-mb-px max-lg:hidden">
                @foreach ($links as $link )    
                    <flux:sidebar.item icon="{{ $link['icon'] }}" :href="$link['url']" :current="$link['current']" wire:navigate>
                        {{ $link['name'] }}
                    </flux:sidebar.item>
                @endforeach
            </flux:navbar>

            <flux:spacer />

           
            <x-desktop-user-menu />

        </flux:header>

        <!-- Mobile Menu -->
 
        <flux:sidebar collapsible="mobile" sticky class="lg:hidden border-e border-zinc-200 bg-zinc-50 dark:border-zinc-700 dark:bg-zinc-900">
            <flux:sidebar.header>
                <x-app-logo :sidebar="true" href="{{ route('dashboard') }}" wire:navigate />
                <flux:sidebar.collapse class="in-data-flux-sidebar-on-desktop:not-in-data-flux-sidebar-collapsed-desktop:-mr-2" />
            </flux:sidebar.header>

            <flux:sidebar.nav>
                <flux:sidebar.group :heading="__('Platform')">
                    @foreach ($links as $link )    
                        <flux:sidebar.item icon="{{ $link['icon'] }}" :href="$link['url']" :current="$link['current']" wire:navigate>
                            {{ $link['name'] }}
                        </flux:sidebar.item>
                    @endforeach
                </flux:sidebar.group>
            </flux:sidebar.nav>

            <flux:spacer />
        </flux:sidebar>

        <flux:main>
            {{ $slot }}
        </flux:main>

        @persist('toast')
            <flux:toast.group>
                <flux:toast />
            </flux:toast.group>
        @endpersist

        @fluxScripts

        @if (session('swal'))
        <script>
            Swal.fire(@json(session('swal')));
        </script>
        @endif

        @stack('js')
    </body>
</html>
