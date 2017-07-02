<?php

use Illuminate\Database\Seeder;

class ConfigsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Config::truncate();
        //创建相应的权限
        $config = [
            [
                'name'=>'shop_title',
                'value'=>'尤为商城',
                'inc_type'=>'shop_info'
            ],

            [
                'name'=>'shop_keyword',
                'value'=>'韩国海购,尤为商城',
                'inc_type'=>'shop_info'
            ],

            [
                'name'=>'shop_desc',
                'value'=>'尤为商城为韩国海外直购，实时跟踪明星的小物件',
                'inc_type'=>'shop_info'
            ],

            [
                'name'=>'shop_mark',
                'value'=>'\public\templates',
                'inc_type'=>'shop_info'
            ],
            [
                'name'=>'shop_uploads',
                'value'=>'\public\Uploads',
                'inc_type'=>'shop_info'
            ],
            [
                'name'=>'shop_copyright',
                'value'=>'黎宝宝  版权所有',
                'inc_type'=>'shop_info'
            ],
            [
                'name'=>'shop_number',
                'value'=>'3135131',
                'inc_type'=>'shop_info'
            ],
            [
                'name'=>'stats_code',
                'value'=>'切切胜多负少的',
                'inc_type'=>'shop_info'
            ],
            [
                'name'=>'access_ip',
                'value'=>'',
                'inc_type'=>'shop_safety'
            ],
            [
                'name'=>'max_num',
                'value'=>'',
                'inc_type'=>'shop_safety'
            ],
            [
                'name'=>'send_mode',
                'value'=>'smtp',
                'inc_type'=>'sms'
            ],
            [
                'name'=>'smtp_server',
                'value'=>'smtp.163.com',
                'inc_type'=>'sms'
            ],
            [
                'name'=>'smtp_port',
                'value'=>'25',
                'inc_type'=>'sms'
            ],
            [
                'name'=>'smtp_user',
                'value'=>'nietzsche_nc@163.com',
                'inc_type'=>'sms'
            ],
            [
                'name'=>'smtp_pwd',
                'value'=>'li6565697',
                'inc_type'=>'sms'
            ],
            [
                'name'=>'test_eamil',
                'value'=>'nietzsche_nc@163.com',
                'inc_type'=>'sms'
            ],
            [
                'name'=>'open',
                'value'=>'0',
                'inc_type'=>'open'
            ],

        ];

        foreach ($config as $value){
            \App\Models\Config::create($value);
        }

    }
}
