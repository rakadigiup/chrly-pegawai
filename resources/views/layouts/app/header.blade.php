<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
    <head>
        @include('partials.head')
    </head>
    <body class="min-h-screen bg-white dark:bg-zinc-800">
        <flux:header container class="border-b border-zinc-200 bg-zinc-50 dark:border-zinc-700 dark:bg-zinc-900">
            <flux:sidebar.toggle class="lg:hidden mr-2" icon="bars-2" inset="left" />

            <x-app-logo href="{{ route('dashboard') }}" wire:navigate />

            <flux:navbar class="-mb-px max-lg:hidden">
                <flux:navbar.item icon="layout-grid" :href="route('dashboard')" :current="request()->routeIs('dashboard')" wire:navigate>
                    {{ __('Dashboard') }}
                </flux:navbar.item>
                @if(auth()->user()->role === 'admin')
                    <flux:navbar.item icon="users" :href="route('users.index')" :current="request()->routeIs('users.index')" wire:navigate>
                        {{ __('User') }}
                    </flux:navbar.item>
                @endif

                <flux:navbar.item icon="briefcase" :href="route('pekerjaan.index')" :current="request()->routeIs('pekerjaan.index')" wire:navigate>
                    {{ __('Pekerjaan') }}
                </flux:navbar.item>

                @if(auth()->user()->role === 'admin')
                    <flux:navbar.item icon="archive-box" :href="route('inventaris.index')" :current="request()->routeIs('inventaris.index')" wire:navigate>
                        {{ __('Inventaris') }}
                    </flux:navbar.item>
                @endif
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
                <flux:sidebar.group :heading="__('Manajemen')">
                    <flux:sidebar.item icon="layout-grid" :href="route('dashboard')" :current="request()->routeIs('dashboard')" wire:navigate>
                        {{ __('Dashboard')  }}
                    </flux:sidebar.item>
                    @if(auth()->user()->role === 'admin')
                        <flux:sidebar.item icon="users" :href="route('users.index')" :current="request()->routeIs('users.index')" wire:navigate>
                            {{ __('Manajemen User') }}
                        </flux:sidebar.item>
                    @endif

                    <flux:sidebar.item icon="briefcase" :href="route('pekerjaan.index')" :current="request()->routeIs('pekerjaan.index')" wire:navigate>
                        {{ __('Manajemen Pekerjaan') }}
                    </flux:sidebar.item>

                    @if(auth()->user()->role === 'admin')
                        <flux:sidebar.item icon="archive-box" :href="route('inventaris.index')" :current="request()->routeIs('inventaris.index')" wire:navigate>
                            {{ __('Manajemen Inventaris') }}
                        </flux:sidebar.item>
                    @endif
                </flux:sidebar.group>
            </flux:sidebar.nav>


        </flux:sidebar>

        {{ $slot }}

        @persist('toast')
            <flux:toast.group>
                <flux:toast />
            </flux:toast.group>
        @endpersist

        @fluxScripts
    </body>
</html>
