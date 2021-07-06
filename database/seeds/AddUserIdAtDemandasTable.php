<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Demanda;
use App\User;
class AddUserIdAtDemandasTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $demandas = Demanda::all();
        $user = User::orderBy('id', 'asc')->first();
        foreach($demandas as $demanda){
            $demanda->user_id = $user->id;
            $demanda->save();
        }
    }
}
