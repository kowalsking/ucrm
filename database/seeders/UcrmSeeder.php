<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class UcrmSeeder extends Seeder
{
    public function run(): void
    {
        // Наповнення doc_acccess
        DB::table('doc_acccess')->insert([
            ['access_name' => 'Публічний'],
            ['access_name' => 'Приватний'],
            ['access_name' => 'Конфіденційний'],
        ]);

        // Наповнення docs_status
        DB::table('docs_status')->insert([
            ['docs_status_name' => 'Чернетка', 'active' => true],
            ['docs_status_name' => 'На розгляді', 'active' => true],
            ['docs_status_name' => 'Затверджено', 'active' => true],
            ['docs_status_name' => 'Архів', 'active' => false],
        ]);

        // Наповнення docs_type
        DB::table('docs_type')->insert([
            ['docs_type_name' => 'Договір', 'active' => true],
            ['docs_type_name' => 'Звіт', 'active' => true],
            ['docs_type_name' => 'Наказ', 'active' => true],
            ['docs_type_name' => 'Заява', 'active' => true],
        ]);

        // Наповнення priority_id
        DB::table('priority_id')->insert([
            ['priority_name' => 'Низький'],
            ['priority_name' => 'Середній'],
            ['priority_name' => 'Високий'],
            ['priority_name' => 'Критичний'],
        ]);

        // Наповнення employee
        DB::table('employee')->insert([
            ['employee_name' => 1], // Іван Петренко
            ['employee_name' => 2], // Марія Коваленко
            ['employee_name' => 3], // Олександр Сидоренко
        ]);

        // Наповнення files
        DB::table('files')->insert([
            [
                'file_path' => 'storage/documents/doc1.pdf',
                'file_type' => 'pdf',
                'size' => 1024,
                'date_created' => now(),
                'hash' => Str::random(32),
                'employee_id' => 1
            ],
            [
                'file_path' => 'storage/documents/doc2.docx',
                'file_type' => 'docx',
                'size' => 2048,
                'date_created' => now(),
                'hash' => Str::random(32),
                'employee_id' => 2
            ],
        ]);

        // Наповнення docs
        DB::table('docs')->insert([
            [
                'docs_hash' => 123456,
                'docs_name' => 'Договір про співпрацю',
                'docs_type_id' => 1,
                'docs_status_id' => 3,
                'access_id' => 1,
                'prioruty_id' => 2,
                'absctract' => 'Договір про співпрацю між компаніями',
                'parent_docs_id' => null,
                'deadline' => now()->addDays(30),
                'date_created' => now(),
                'date_updated' => now(),
            ],
            [
                'docs_hash' => 789012,
                'docs_name' => 'Звіт про виконання',
                'docs_type_id' => 2,
                'docs_status_id' => 2,
                'access_id' => 2,
                'prioruty_id' => 3,
                'absctract' => 'Звіт про виконання проекту',
                'parent_docs_id' => 1,
                'deadline' => now()->addDays(15),
                'date_created' => now(),
                'date_updated' => now(),
            ],
        ]);

        // Наповнення docs_employee
        DB::table('docs_employee')->insert([
            [
                'docs_id' => 1,
                'employee_id' => 1,
                'position_id' => 1,
                'signed' => true
            ],
            [
                'docs_id' => 1,
                'employee_id' => 2,
                'position_id' => 2,
                'signed' => false
            ],
        ]);

        // Наповнення docs_files
        DB::table('docs_files')->insert([
            [
                'docs_id' => 1,
                'file_id' => 1
            ],
            [
                'docs_id' => 2,
                'file_id' => 2
            ],
        ]);
    }
} 