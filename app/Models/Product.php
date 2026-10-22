<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = ['supplier_id', 'sku', 'name', 'description', 'stock', 'min_stock', 'unit_price'];
    protected $casts = ['unit_price' => 'decimal:2'];
    
    public function supplier() { return $this->belongsTo(Supplier::class); }
    public function stockMovements() { return $this->hasMany(StockMovement::class); }
    
    public function scopeLowStock($query) { return $query->whereRaw('stock <= min_stock'); }
    public function isLowStock() { return $this->stock <= $this->min_stock; }
}
