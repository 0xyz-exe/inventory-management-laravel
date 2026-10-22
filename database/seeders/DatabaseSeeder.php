<?php
namespace Database\Seeders;
use App\Models\{User, Supplier, Product, StockMovement};
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::factory()->create(['name' => 'Admin', 'email' => 'admin@example.com']);
        
        $supplier1 = Supplier::create(['name' => 'PT Supplier A', 'contact_person' => 'John', 'email' => 'contact@suppliera.com', 'phone' => '021-123456']);
        $supplier2 = Supplier::create(['name' => 'PT Supplier B', 'contact_person' => 'Jane', 'email' => 'info@supplierb.com', 'phone' => '021-654321']);
        
        $p1 = Product::create(['supplier_id' => $supplier1->id, 'sku' => 'PROD-001', 'name' => 'Laptop Dell XPS', 'stock' => 15, 'min_stock' => 5, 'unit_price' => 15000000]);
        $p2 = Product::create(['supplier_id' => $supplier1->id, 'sku' => 'PROD-002', 'name' => 'Mouse Wireless', 'stock' => 3, 'min_stock' => 10, 'unit_price' => 150000]);
        $p3 = Product::create(['supplier_id' => $supplier2->id, 'sku' => 'PROD-003', 'name' => 'Keyboard Mechanical', 'stock' => 25, 'min_stock' => 8, 'unit_price' => 750000]);
        
        StockMovement::create(['product_id' => $p1->id, 'user_id' => $user->id, 'type' => 'in', 'quantity' => 15, 'stock_before' => 0, 'stock_after' => 15, 'reason' => 'Initial stock']);
    }
}
