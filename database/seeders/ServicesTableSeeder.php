<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ServicesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('services')->delete();
        
        \DB::table('services')->insert(array (
            0 => 
            array (
                'id' => 1,
                'published' => 1,
                'title' => '3D Body Scanner',
                'subtitle' => NULL,
                'intro' => 'Weight scales often mislead you into thinking you\'re not making progress. Nothing is more illustrative and more motivating then to actually see your body transform.',
                'content' => NULL,
                'created_at' => '2024-01-29 22:31:49',
                'updated_at' => '2024-01-29 22:31:49',
                'deleted_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'published' => 1,
                'title' => 'EMSCULPT NEO',
                'subtitle' => NULL,
                'intro' => NULL,
                'content' => NULL,
                'created_at' => '2024-01-29 22:32:42',
                'updated_at' => '2024-01-29 22:32:42',
                'deleted_at' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'published' => 1,
                'title' => 'New Red Laser Machine',
                'subtitle' => NULL,
                'intro' => 'FDA Approved and Clinically Proven for Non-invasive Weight Loss, Cellulite Removal, Body Contouring and Aesthetics Weight Loss invisa-RED™ is the only non-invasive device with clinically proven evidence of weight reduction, fat reduction and inch loss. Aesthetics invisa-RED™ is the latest innovation in body slimming technology used to remove fat from areas that are unresponsive.',
                'content' => 'FDA Approved and Clinically Proven for Non-invasive Weight Loss, Cellulite Removal, Body Contouring and Aesthetics',
                'created_at' => '2024-01-29 22:41:41',
                'updated_at' => '2024-01-29 22:41:41',
                'deleted_at' => NULL,
            ),
            3 => 
            array (
                'id' => 4,
                'published' => 1,
                'title' => 'Weight Loss',
                'subtitle' => 'Non Surgical Weight Loss Therapy',
                'intro' => NULL,
                'content' => NULL,
                'created_at' => '2024-01-29 22:42:07',
                'updated_at' => '2024-01-29 22:42:07',
                'deleted_at' => NULL,
            ),
            4 => 
            array (
                'id' => 5,
                'published' => 1,
                'title' => 'Skin Tightening',
                'subtitle' => NULL,
                'intro' => 'Laser Skin Tightening Machines for Younger Looking, Glowing Skin',
                'content' => NULL,
                'created_at' => '2024-01-29 22:42:36',
                'updated_at' => '2024-01-29 22:42:36',
                'deleted_at' => NULL,
            ),
            5 => 
            array (
                'id' => 6,
                'published' => 1,
                'title' => 'Stretch Mark Removal',
                'subtitle' => NULL,
                'intro' => NULL,
                'content' => NULL,
                'created_at' => '2024-01-29 22:42:54',
                'updated_at' => '2024-01-29 22:42:54',
                'deleted_at' => NULL,
            ),
            6 => 
            array (
                'id' => 7,
                'published' => 1,
                'title' => 'Cellulite Reduction',
                'subtitle' => NULL,
                'intro' => NULL,
                'content' => NULL,
                'created_at' => '2024-01-29 22:43:21',
                'updated_at' => '2024-01-29 22:43:21',
                'deleted_at' => NULL,
            ),
            7 => 
            array (
                'id' => 8,
                'published' => 1,
                'title' => 'Body Slimming',
                'subtitle' => NULL,
                'intro' => NULL,
                'content' => NULL,
                'created_at' => '2024-01-29 22:43:52',
                'updated_at' => '2024-01-29 22:43:52',
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}