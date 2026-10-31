<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800">Add Inventory Product</h2>
            <a href="{{ route('products.index') }}" class="text-sm text-indigo-600 hover:text-indigo-800">← Back to Inventory</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 rounded-lg shadow">
                <form method="POST" action="{{ route('products.store') }}" class="space-y-4">
                    @csrf
                    <div>
                        <label class="block text-sm font-medium mb-1">SKU / Barcode *</label>
                        <input type="text" name="sku" value="{{ old('sku') }}" placeholder="e.g. PRD-001" required class="w-full rounded-md border-gray-300">
                        @error('sku')<p class="text-red-600 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium mb-1">Product Name *</label>
                        <input type="text" name="name" value="{{ old('name') }}" placeholder="Item description / name" required class="w-full rounded-md border-gray-300">
                        @error('name')<p class="text-red-600 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium mb-1">Supplier</label>
                            <select name="supplier_id" class="w-full rounded-md border-gray-300">
                                <option value="">Select Supplier</option>
                                @foreach($suppliers as $s)
                                    <option value="{{ $s->id }}" {{ old('supplier_id') == $s->id ? 'selected' : '' }}>{{ $s->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium mb-1">Unit Price (Rp) *</label>
                            <input type="number" name="unit_price" value="{{ old('unit_price') }}" min="0" required class="w-full rounded-md border-gray-300">
                            @error('unit_price')<p class="text-red-600 text-xs mt-1">{{ $message }}</p>@enderror
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium mb-1">Initial Stock *</label>
                            <input type="number" name="stock" value="{{ old('stock', 10) }}" min="0" required class="w-full rounded-md border-gray-300">
                            @error('stock')<p class="text-red-600 text-xs mt-1">{{ $message }}</p>@enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium mb-1">Minimum Alert Threshold *</label>
                            <input type="number" name="min_stock" value="{{ old('min_stock', 5) }}" min="0" required class="w-full rounded-md border-gray-300">
                            @error('min_stock')<p class="text-red-600 text-xs mt-1">{{ $message }}</p>@enderror
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium mb-1">Description (optional)</label>
                        <textarea name="description" rows="3" class="w-full rounded-md border-gray-300">{{ old('description') }}</textarea>
                    </div>

                    <div class="flex gap-3 pt-2">
                        <button type="submit" class="px-6 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700 font-semibold">Save Product</button>
                        <a href="{{ route('products.index') }}" class="px-4 py-2 bg-gray-300 text-gray-700 rounded hover:bg-gray-400">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
