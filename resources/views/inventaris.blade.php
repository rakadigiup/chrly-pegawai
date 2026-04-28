<x-layouts::app :title="__('Manajemen Inventaris')">
    @php abort_if(auth()->user()->role !== 'admin', 403); @endphp
    @livewire('management.inventaris-table')
</x-layouts::app>
