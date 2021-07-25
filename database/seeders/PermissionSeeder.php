<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->modules() as $module) {
            foreach ($this->methods() as $method) {
                $label = "{$module} {$method}";
                $name = Str::slug($label, '_');

                Permission::factory()->create(compact('label', 'name'));
            }
        }
    }

    /**
     * @return string[]
     */
    private function modules(): array
    {
        return [
            'User',
            'Role',
            'Permission',
        ];
    }

    /**
     * @return string[]
     */
    private function methods(): array
    {
        return [
            'Index',
            'Store',
            'Update',
            'Destroy',
        ];
    }
}
