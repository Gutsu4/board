<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ClassRoom;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

class ClassRoomSeeder extends Seeder
{
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        DB::table('class_rooms')->truncate();
        $classrooms = [
            '赤羽',
            '池袋',
            '新宿',
            '渋谷',
            '青山',
            '成城学園前',
            '三軒茶屋',
            '中目黒',
            '自由が丘',
            '蒲田',
            '水道橋',
            '秋葉原',
            '豊洲',
            '押上',
            '吉祥寺',
            '立川',
            '町田',
            '川崎',
            '横浜',
            '桜木町',
            'たまプラーザ',
            '大宮',
            '津田沼',
        ];

        foreach ($classrooms as $classroom) {
            ClassRoom::create([
                'name' => $classroom,
                'password' => Hash::make('Lita0601'),
            ]);
        }
        Schema::enableForeignKeyConstraints();
    }
}
