<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800">Stock Movements History</h2>
            <div class="flex gap-2">
                <a href="{{ route('stock.create') }}" class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700">+ Record Movement</a>
                <a href="{{ route('products.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-700 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-800">← Back to Inventory</a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            @if(session('success'))
                <div class="p-4 bg-green-100 border border-green-400 text-green-700 rounded-lg">{{ session('success') }}</div>
            @endif

            <div class="bg-white rounded-lg shadow overflow-hidden">
                <table class="w-full text-left text-sm">
                    <thead class="bg-gray-50 border-b">
                        <tr>
                            <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase">Timestamp</th>
                            <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase">Product</th>
                            <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase">Type</th>
                            <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase">Qty</th>
                            <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase">Before &rarr; After</th>
                            <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase">Reason / User</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y">
                        @forelse($movements as $m)
                        <tr>
                            <td class="px-6 py-4 text-gray-500">{{ $m->created_at->format('M d, Y H:i') }}</td>
                            <td class="px-6 py-4 font-medium text-gray-900">
                                <div>{{ $m->product->name ?? '—' }}</div>
                                <div class="text-xs text-gray-500 font-mono">{{ $m->product->sku ?? '' }}</div>
                            </td>
                            <td class="px-6 py-4">
                                @if($m->type === 'in')
                                    <span class="px-2 py-1 text-xs rounded font-semibold bg-green-100 text-green-800">STOCK IN</span>
                                @elseif($m->type === 'out')
                                    <span class="px-2 py-1 text-xs rounded font-semibold bg-red-100 text-red-800">STOCK OUT</span>
                                @else
                                    <span class="px-2 py-1 text-xs rounded font-semibold bg-blue-100 text-blue-800">ADJUSTMENT</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 font-bold {{ $m->type === 'in' ? 'text-green-600' : 'text-red-600' }}">
                                {{ $m->type === 'in' ? '+' : '-' }}{{ $m->quantity }}
                            </td>
                            <td class="px-6 py-4 text-gray-700">
                                {{ $m->stock_before }} &rarr; <strong class="text-gray-900">{{ $m->stock_after }}</strong>
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-gray-900">{{ $m->reason ?: 'Regular operation' }}</div>
                                <div class="text-xs text-gray-500">Recorded by {{ $m->user->name ?? 'System' }}</div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="px-6 py-8 text-center text-gray-500">No stock movements recorded yet.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
                <div class="px-6 py-4">{{ $movements->links() }}</div>
            </div>
        </div>
    </div>
</x-app-layout>
