<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

use App\Models\Paperwork;
use App\Models\PaperworkDetails;

class PaperworkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PaperworkDetails::create([
        ]);

        $paperworkDetailsId = PaperworkDetails::latest()->first()->id;

        DB::table('paperworks')->insert([
            'name' => 'Kertas Kerja 1',
            'isGenerated' => 1,
            'clubId' => 2,
            'status' => 0,
            'progressStates' => "[]",
            'currentProgressState' => 0,
            'isOneDay' => 1,
            'paperworkDetailsId' => $paperworkDetailsId,
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
