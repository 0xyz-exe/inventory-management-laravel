<x-app-layout>
<x-slot name="header"><div class="flex justify-between items-center"><h2 class="font-semibold text-xl text-gray-800">Inventory</h2>
<div class="flex gap-2"><a href="{{ route('stock.create') }}" class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">Stock In/Out</a>
<a href="{{ route('products.create') }}" class="px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700">+ New Product</a></div></div></x-slot>
<div class="py-12"><div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
@if(session('success'))<div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">{{ session('success') }}</div>@endif
@if($lowStock > 0)<div class="mb-4 bg-orange-100 border border-orange-400 text-orange-700 px-4 py-3 rounded">⚠️ {{ $lowStock }} product(s) low on stock</div>@endif

<div class="bg-white rounded-lg shadow overflow-hidden"><div class="p-4 border-b flex justify-between">
<form method="GET" class="flex gap-2"><input type="text" name="search" placeholder="Search..." value="{{ request('search') }}" class="rounded-md border-gray-300">
<button type="submit" class="px-4 py-2 bg-gray-200 rounded hover:bg-gray-300">Search</button></form>
<a href="{{ route('stock.index') }}" class="text-indigo-600 hover:text-indigo-800">View Stock History</a>
</div>

<table class="w-full"><thead class="bg-gray-50"><tr><th class="text-left px-6 py-3 text-xs font-medium text-gray-500 uppercase">SKU</th>
<th class="text-left px-6 py-3 text-xs font-medium text-gray-500 uppercase">Name</th>
<th class="text-left px-6 py-3 text-xs font-medium text-gray-500 uppercase">Supplier</th>
<th class="text-left px-6 py-3 text-xs font-medium text-gray-500 uppercase">Stock</th>
<th class="text-left px-6 py-3 text-xs font-medium text-gray-500 uppercase">Min Stock</th>
<th class="text-left px-6 py-3 text-xs font-medium text-gray-500 uppercase">Price</th>
<th class="text-right px-6 py-3 text-xs font-medium text-gray-500 uppercase">Actions</th></tr></thead>
<tbody class="divide-y">@foreach($products as $p)
<tr class="{{ $p->isLowStock() ? 'bg-orange-50' : '' }}"><td class="px-6 py-4 font-mono text-sm">{{ $p->sku }}</td>
<td class="px-6 py-4 font-medium">{{ $p->name }}</td><td class="px-6 py-4">{{ $p->supplier->name ?? '-' }}</td>
<td class="px-6 py-4"><span class="{{ $p->isLowStock() ? 'text-orange-600 font-bold' : '' }}">{{ $p->stock }}</span></td>
<td class="px-6 py-4">{{ $p->min_stock }}</td><td class="px-6 py-4">Rp {{ number_format($p->unit_price, 0) }}</td>
<td class="px-6 py-4 text-right"><a href="{{ route('products.edit', $p) }}" class="text-blue-600 hover:text-blue-800 mr-2">Edit</a>
<form method="POST" action="{{ route('products.destroy', $p) }}" class="inline" onsubmit="return confirm('Delete?')">@csrf @method('DELETE')
<button type="submit" class="text-red-600 hover:text-red-800">Delete</button></form></td>
</tr>@endforeach</tbody></table>
<div class="px-6 py-4">{{ $products->links() }}</div>
</div></div></div>
</x-app-layout>
