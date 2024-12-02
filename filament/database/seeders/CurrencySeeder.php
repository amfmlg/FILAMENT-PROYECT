<?php

// database/seeders/CurrencySeeder.php

namespace Database\Seeders;

use App\Models\Currency;  // Asegúrate de que el modelo de Currency está importado
use Illuminate\Database\Seeder;

class CurrencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Inserta algunas monedas de ejemplo
        Currency::create(['name' => 'USD']);  // Dólar estadounidense
        Currency::create(['name' => 'EUR']);  // Euro
        Currency::create(['name' => 'MXN']);  // Peso mexicano
        Currency::create(['name' => 'GBP']);  // Libra esterlina
    }
}
