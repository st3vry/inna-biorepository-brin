<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\InputFormType;

class InputFormTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //InputFormType
        InputFormType::create([
            'name'=>'text'
        ]);
        InputFormType::create([
            'name'=>'textarea'
        ]);
        InputFormType::create([
            'name'=>'select'
        ]);
        InputFormType::create([
            'name'=>'date'
        ]);
        InputFormType::create([
            'name'=>'radio'
        ]);
        InputFormType::create([
            'name'=>'checkbox'
        ]);
        InputFormType::create([
            'name'=>'selectDB'
        ]);
    }
}