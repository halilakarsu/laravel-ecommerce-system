<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use function Laravel\Prompts\table;

class SettingsSeeder extends Seeder
{

    public function run(): void
    {
        DB::table('settings')->insert(
            [
                [
                  'settings_description'=>'Başlık',
                  'settings_key' =>'title',
                  'settings_value'=>'E-ticaret Sitesi',
                  'settings_type'=>'text',
                  'settings_sort'=>'0',
                  'settings_delete'=>'0',
                  'settings_status'=>'1'

                ],[
                    'settings_description'=>'Açıklama',
                    'settings_key' =>'description',
                    'settings_value'=>'E ticaret Sistemleri',
                    'settings_type'=>'text',
                    'settings_sort'=>'1',
                    'settings_delete'=>'0',
                    'settings_status'=>'1'

                ],[
                    'settings_description'=>'Logo',
                    'settings_key' =>'Logo',
                    'settings_value'=>'logo.pno',
                    'settings_type'=>'file',
                    'settings_sort'=>'2',
                    'settings_delete'=>'0',
                    'settings_status'=>'1'

                ],[
                    'settings_description'=>'Icon',
                    'settings_key' =>'Icon',
                    'settings_value'=>'icon.ico',
                    'settings_type'=>'file',
                    'settings_sort'=>'3',
                    'settings_delete'=>'0',
                    'settings_status'=>'1'

            ],[
                    'settings_description'=>'Anahtar Kelimeler',
                    'settings_key' =>'keywords',
                    'settings_value'=>'laravel,php,ticaret,ecommerce',
                    'settings_type'=>'text',
                    'settings_sort'=>'4',
                    'settings_delete'=>'0',
                    'settings_status'=>'1'

            ],[
                'settings_description'=>'Telefon',
                'settings_key' =>'keywords',
                'settings_value'=>'+90454',
                'settings_type'=>'text',
                'settings_sort'=>'5',
                'settings_delete'=>'0',
                'settings_status'=>'1'

            ],
                [
                    'settings_description'=>'Mail',
                    'settings_key' =>'mail',
                    'settings_value'=>'abc@hotmail.com',
                    'settings_type'=>'text',
                    'settings_sort'=>'6',
                    'settings_delete'=>'0',
                    'settings_status'=>'1'

                ], [
                    'settings_description'=>'İlçe',
                    'settings_key' =>'ilce',
                    'settings_value'=>'laravel,php,ticaret,ecommerce',
                    'settings_type'=>'text',
                    'settings_sort'=>'7',
                    'settings_delete'=>'0',
                    'settings_status'=>'1'

                ],[
                'settings_description'=>'İl',
                'settings_key' =>'il',
                'settings_value'=>'İstanbul',
                'settings_type'=>'text',
                'settings_sort'=>'8',
                'settings_delete'=>'0',
                'settings_status'=>'1'

            ],[
                    'settings_description'=>'Açık Adres',
                    'settings_key' =>'adress',
                    'settings_value'=>'laravel,php,ticaret,ecommerce',
                    'settings_type'=>'text',
                    'settings_sort'=>'9',
                    'settings_delete'=>'0',
                    'settings_status'=>'1'

                ]
            ]
    );
    }
}
