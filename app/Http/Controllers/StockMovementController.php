<?php
namespace App\Http\Controllers;
use App\Models\{Product, StockMovement};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StockMovementController extends Controller
{
    public function index()
    {
        $movements = StockMovement::with('product', 'user')->latest()->paginate(20);
        return view('stock.index', compact('movements'));
    }
    
    public function create() { return view('stock.create', ['products' => Product::all()]); }
    
    public function store(Request $request)
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'type' => 'required|in:in,out,adjustment',
            'quantity' => 'required|integer|min:1',
            'reason' => 'nullable|max:255',
            'notes' => 'nullable|max:1000',
        ]);
        
        DB::transaction(function() use ($validated) {
            $product = Product::lockForUpdate()->find($validated['product_id']);
            
            if ($validated['type'] === 'out' && $product->stock < $validated['quantity']) {
                throw new \Exception('Insufficient stock');
            }
            
            $stockBefore = $product->stock;
            $quantity = $validated['quantity'];
            
            if ($validated['type'] === 'in') {
                $product->stock += $quantity;
            } else {
                $product->stock -= $quantity;
            }
            
            $product->save();
            
            StockMovement::create([
                'product_id' => $product->id,
                'user_id' => auth()->id(),
                'type' => $validated['type'],
                'quantity' => $quantity,
                'stock_before' => $stockBefore,
                'stock_after' => $product->stock,
                'reason' => $validated['reason'],
                'notes' => $validated['notes'],
            ]);
        });
        
        return redirect()->route('stock.index')->with('success', 'Stock updated.');
    }
}
