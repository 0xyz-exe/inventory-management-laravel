<?php
namespace App\Http\Controllers;
use App\Models\{Product, Supplier};
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $lowStock = Product::lowStock()->count();
        $products = Product::with('supplier')->when(request('search'), fn($q, $s) => $q->where('name', 'like', "%$s%")->orWhere('sku', 'like', "%$s%"))->paginate(20);
        return view('products.index', compact('products', 'lowStock'));
    }
    
    public function create() { return view('products.create', ['suppliers' => Supplier::all()]); }
    
    public function store(Request $request)
    {
        $validated = $request->validate([
            'supplier_id' => 'nullable|exists:suppliers,id',
            'sku' => 'required|unique:products|max:100',
            'name' => 'required|max:255',
            'description' => 'nullable|max:1000',
            'stock' => 'required|integer|min:0',
            'min_stock' => 'required|integer|min:0',
            'unit_price' => 'required|numeric|min:0',
        ]);
        
        Product::create($validated);
        return redirect()->route('products.index')->with('success', 'Product created.');
    }
    
    public function show(Product $product) { return view('products.show', compact('product')); }
    public function edit(Product $product) { return view('products.edit', compact('product'), ['suppliers' => Supplier::all()]); }
    
    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'supplier_id' => 'nullable|exists:suppliers,id',
            'sku' => 'required|max:100|unique:products,sku,'.$product->id,
            'name' => 'required|max:255',
            'description' => 'nullable|max:1000',
            'min_stock' => 'required|integer|min:0',
            'unit_price' => 'required|numeric|min:0',
        ]);
        
        $product->update($validated);
        return redirect()->route('products.index')->with('success', 'Product updated.');
    }
    
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Product deleted.');
    }
}
