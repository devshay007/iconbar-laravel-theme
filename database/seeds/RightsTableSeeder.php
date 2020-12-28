<?php
use App\Models\Right;

use Illuminate\Database\Seeder;

class RightsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {	
    	Right::truncate();
    	
        $rights=[
            [
                'title' => 'Master'
            ],
            [
                'title' => 'Provider Master',
                'link' => 'admin/providers',
                'parent_id' =>1,
            ],
            [
                'title' => 'Reference Master',
                'parent_id' =>1,
                'link' => 'admin/references',
            ],
            [
                'title' => 'Dosage Master',
                'parent_id' =>1,
                'link' => 'admin/dosages',
            ],
            [
                'title' => 'Charge Group Master',
                'parent_id' =>1,
                'link' => 'admin/charge_groups',
            ],
            [
                'title' => 'Charge Master',
                'parent_id' =>1,
                'link' => 'admin/charges',
            ],
            [
                'title' => 'Charge Price List',
                'parent_id' =>1,
                'link' => 'admin/charge_prices',
            ],
            [
                'title' => 'Vaccine Group Master',
                'parent_id' =>1,
                'link' => 'admin/vaccine_groups',
            ],
            [
                'title' => 'Vaccine Master',
                'parent_id' =>1,
                'link' => 'admin/vaccines',
            ],
            [
                'title' => 'Holiday Master',
                'parent_id' =>1,
                'link' => 'admin/holidays',
            ],
            [
                'title' => 'Consent Master',
                'parent_id' =>1,
                'link' => 'admin/consents',
            ],
            [
                'title' => 'Tieup Master',
                'parent_id' =>1,
                'link' => 'admin/tieups',
            ],
            [
                'title' => 'ICD Diagnosis Master',
                'parent_id' =>1,
                'link' => 'admin/icd_diagnosis',
            ],
            [
                'title' => 'Diangosis Medicine Link',
                'parent_id' =>1,
                'link' => 'admin/diangosis_medicines',
            ],
            [
                'title' => 'Vital Master',
                'parent_id' =>1,
                'link' => 'admin/vitals',
            ],
            [
                'title' => 'Unit Master',
                'parent_id' =>1,
                'link' => 'admin/units',
            ],
            [
                'title' => 'Drug Master',
                'parent_id' =>1,
                'link' => 'admin/drugs',
            ],
            [
                'title' => 'Medicine Master',
                'parent_id' =>1,
                'link' => 'admin/medicine',
            ],
            [
                'title' => 'Dosage Remarks Master',
                'parent_id' =>1,
                'link' => 'admin/dosage_remarks',
            ],
            [
                'title' => 'Specimen Master',
                'parent_id' =>1,
                'link' => 'admin/specimens',
            ],
            [
                'title' => 'Lab Test Master',
                'parent_id' =>1,
                'link' => 'admin/lab_tests',
            ],
            [
                'title' => 'Invetory Item Category',
                'parent_id' =>1,
                'link' => 'admin/invetory_item_categorories',
            ],
            [
                'title' => 'Inventory Item Master',
                'parent_id' =>1,
                'link' => 'admin/invetory_items',
            ],
            [
                'title' => 'Lookup Master',
                'parent_id' =>1,
                'link' => 'admin/lookups',
            ],
            [
                'title' => 'Tieup Master',
                'parent_id' =>1,
                'link' => 'admin/tieups',
            ],
            [
                'title' => 'Administrator'
            ],
            [
                'title' => 'Hospital Master',
                'parent_id' =>26,
                'link' => 'admin/hospitals',
            ],
            [
                'title' => 'User Management',
                'parent_id' =>26,
            ],
            [
                'title' => 'Permissions',
                'parent_id' =>28,
                'link' => 'admin/permissions',
            ],
            [
                'title' => 'Roles',
                 'parent_id' =>28,
                'link' => 'admin/roles',
            ],
            [
                'title' => 'Users',
                'parent_id' =>28,
                'link' => 'admin/users',
            ]
        ];
        foreach ($rights as $key => $right) {
        	Right::create($right);
        }
    }
}
