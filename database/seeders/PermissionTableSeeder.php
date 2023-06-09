<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            "dashboard" => [
                "dashboard",
                "customer",
                "order-today",
                "income",
                "expense",
                "stockIn",
                "stockOut",
                "stockBalance",
                "promotion",
            ],
            "Product" => [
                "product-list", "product-create", "product-edit", "product-delete",
                "category-list", "category-create", "category-edit", "category-delete",
                "brand-list", "brand-create", "brand-edit", "brand-delete",
                "promotion-list", "promotion-create", "promotion-edit", "promotion-delete",
            ],
            "Stock" => [
                "supplier-list", "supplier-create", "supplier-edit", "supplier-delete",
                "contract-list", "contract-create", "contract-edit", "contract-delete",
                "stockIn-list", "stockIn-create", "stockIn-edit", "stockIn-delete",
                "stockOut-list", "stockOut-create", "stockOut-edit", "stockOut-delete",
            ],
            "Public-Content" => [
                "banner-list", "banner-create", "banner-edit", "banner-delete",
                "advertise-list", "advertise-create", "advertise-edit", "advertise-delete",
                "faqs-list", "faqs-create", "faqs-edit", "faqs-delete",
                "terms-list", "terms-create", "terms-edit", "terms-delete",
                "about-list", "about-create", "about-edit", "about-delete",
            ],
            "Setting" => [
                "permission-list", "permission-create", "permission-edit", "permission-delete",
                "role-list", "role-create", "role-edit", "role-delete",
                "user-list", "user-create", "user-edit", "user-delete",
                "language-list", "language-create", "language-edit", "language-delete"
            ],
            "Report" => [
                "order-list",
                "order-pdf",
                "report-list",
            ],
        ];

        foreach ($permissions as $key => $permission) {
            foreach ($permission as $item) {
                Permission::updateOrCreate([
                    'name' => $item,
                    'group' => $key
                ]);
            }
        }
    }
}
