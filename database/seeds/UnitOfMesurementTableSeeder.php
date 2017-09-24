<?php

use Illuminate\Database\Seeder;

class UnitOfMesurementTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $unit = new \App\UnitOfMesurement();
        $unit->name = 'PCS';
        $unit->save();

        $unit = new \App\UnitOfMesurement();
        $unit->name = 'METER';
        $unit->save();
    }
}
