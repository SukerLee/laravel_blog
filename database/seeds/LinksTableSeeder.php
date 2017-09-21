<?php

use Illuminate\Database\Seeder;

class LinksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
            'link_name' => '音樂網',
            'link_title' => '享受免費暢聽音樂',
            'link_url' => 'http://xxx.xxx.com',
            'link_order' => 1,
            ],
            [
            'link_name' => 'lol戰績網',
            'link_title' => '隨時查看戰績',
            'link_url' => 'http://xxx.ooo.com',
            'link_order' => 2,
            ],
        ];
        DB::table('links')->insert($data);
    }
}
