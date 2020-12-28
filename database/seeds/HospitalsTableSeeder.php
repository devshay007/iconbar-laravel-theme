<?php
use App\Models\Hospital;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class HospitalsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {	
    	Hospital::truncate();
    	
        $hospitals=
            [   'hospid'=>(string) Str::uuid(),
                'hospcode'=>'1',
                'hospname'=>'Appolo',
                'hospaddr1'=>'Ambavadi',
                'hospcity'=>'Ahmedabad',
                'hospstate'=>'Gujarat',
                'hospcontry'=>'INDIA',
                'hospphone'=>'7878978',
                'hospmobile1'=>'4655456',
                'hospemail'=>'appolo@gmail.com',
                'hospweb'=>'http://appolo.com'
            ];

        Hospital::create($hospitals);
    }
}
