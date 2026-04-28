<x-layouts::app :title="__('Manajemen User')">
    @php abort_if(auth()->user()->role !== 'admin', 403); @endphp
    @livewire('management.users')
</x-layouts::app>
