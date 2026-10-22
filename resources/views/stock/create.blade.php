<x-app-layout>
<x-slot name="header"><h2 class="font-semibold text-xl text-gray-800">Stock Movement</h2></x-slot>
<div class="py-12"><div class="max-w-2xl mx-auto sm:px-6 lg:px-8"><div class="bg-white p-6 rounded-lg shadow">
<form method="POST" action="{{ route('stock.store') }}">@csrf
<div class="mb-4"><label class="block text-sm font-medium mb-2">Product *</label>
<select name="product_id" required class="w-full rounded-md border-gray-300"><option value="">Select product</option>
@foreach($products as $p)<option value="{{ $p->id }}">{{ $p->name }} ({{ $p->sku }}) - Stock: {{ $p->stock }}</option>@endforeach</select>
@error('product_id')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror</div>
<div class="mb-4"><label class="block text-sm font-medium mb-2">Type *</label>
<select name="type" required class="w-full rounded-md border-gray-300">
<option value="in">Stock In (+)</option><option value="out">Stock Out (-)</option><option value="adjustment">Adjustment</option></select></div>
<div class="mb-4"><label class="block text-sm font-medium mb-2">Quantity *</label>
<input type="number" name="quantity" min="1" required class="w-full rounded-md border-gray-300">
@error('quantity')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror</div>
<div class="mb-4"><label class="block text-sm font-medium mb-2">Reason</label>
<input type="text" name="reason" class="w-full rounded-md border-gray-300" placeholder="Purchase, sale, damage, etc."></div>
<div class="mb-6"><label class="block text-sm font-medium mb-2">Notes</label>
<textarea name="notes" rows="3" class="w-full rounded-md border-gray-300"></textarea></div>
<div class="flex gap-3"><button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700">Submit</button>
<a href="{{ route('products.index') }}" class="px-4 py-2 bg-gray-300 text-gray-700 rounded hover:bg-gray-400">Cancel</a></div>
</form></div></div></div>
</x-app-layout>
