<x-app-layout>
    @if(request()->is('admin*'))
        @include('admin.index') 
    @else
        @include('customer.index') 
    @endif
</x-app-layout>