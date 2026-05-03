<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // 1. Add category_id column
        Schema::table('products', function (Blueprint $table) {
            $table->foreignId('category_id')->nullable()->after('category')->constrained('categories')->onDelete('set null');
        });

        // 2. Migrate existing data
        $products = DB::table('products')->get();
        foreach ($products as $product) {
            if (!empty($product->category)) {
                // Find or Create Category
                $categoryName = trim($product->category);
                $categorySlug = Str::slug($categoryName);

                $categoryId = DB::table('categories')->where('name', $categoryName)->value('id');

                if (!$categoryId) {
                   $categoryId = DB::table('categories')->insertGetId([
                       'name' => $categoryName,
                       'slug' => $categorySlug,
                       'created_at' => now(),
                       'updated_at' => now()
                   ]);
                }

                // Update Product
                DB::table('products')->where('id', $product->id)->update(['category_id' => $categoryId]);
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropForeign(['category_id']);
            $table->dropColumn('category_id');
        });
    }
};
