<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    public function run()
    {
        $permissions = [
            [
                'id'    => 1,
                'title' => 'user_management_access',
            ],
            [
                'id'    => 2,
                'title' => 'permission_create',
            ],
            [
                'id'    => 3,
                'title' => 'permission_edit',
            ],
            [
                'id'    => 4,
                'title' => 'permission_show',
            ],
            [
                'id'    => 5,
                'title' => 'permission_delete',
            ],
            [
                'id'    => 6,
                'title' => 'permission_access',
            ],
            [
                'id'    => 7,
                'title' => 'role_create',
            ],
            [
                'id'    => 8,
                'title' => 'role_edit',
            ],
            [
                'id'    => 9,
                'title' => 'role_show',
            ],
            [
                'id'    => 10,
                'title' => 'role_delete',
            ],
            [
                'id'    => 11,
                'title' => 'role_access',
            ],
            [
                'id'    => 12,
                'title' => 'user_create',
            ],
            [
                'id'    => 13,
                'title' => 'user_edit',
            ],
            [
                'id'    => 14,
                'title' => 'user_show',
            ],
            [
                'id'    => 15,
                'title' => 'user_delete',
            ],
            [
                'id'    => 16,
                'title' => 'user_access',
            ],
            [
                'id'    => 17,
                'title' => 'product_management_access',
            ],
            [
                'id'    => 18,
                'title' => 'product_category_create',
            ],
            [
                'id'    => 19,
                'title' => 'product_category_edit',
            ],
            [
                'id'    => 20,
                'title' => 'product_category_show',
            ],
            [
                'id'    => 21,
                'title' => 'product_category_delete',
            ],
            [
                'id'    => 22,
                'title' => 'product_category_access',
            ],
            [
                'id'    => 23,
                'title' => 'product_tag_create',
            ],
            [
                'id'    => 24,
                'title' => 'product_tag_edit',
            ],
            [
                'id'    => 25,
                'title' => 'product_tag_show',
            ],
            [
                'id'    => 26,
                'title' => 'product_tag_delete',
            ],
            [
                'id'    => 27,
                'title' => 'product_tag_access',
            ],
            [
                'id'    => 28,
                'title' => 'product_create',
            ],
            [
                'id'    => 29,
                'title' => 'product_edit',
            ],
            [
                'id'    => 30,
                'title' => 'product_show',
            ],
            [
                'id'    => 31,
                'title' => 'product_delete',
            ],
            [
                'id'    => 32,
                'title' => 'product_access',
            ],
            [
                'id'    => 33,
                'title' => 'content_management_access',
            ],
            [
                'id'    => 34,
                'title' => 'content_category_create',
            ],
            [
                'id'    => 35,
                'title' => 'content_category_edit',
            ],
            [
                'id'    => 36,
                'title' => 'content_category_show',
            ],
            [
                'id'    => 37,
                'title' => 'content_category_delete',
            ],
            [
                'id'    => 38,
                'title' => 'content_category_access',
            ],
            [
                'id'    => 39,
                'title' => 'content_tag_create',
            ],
            [
                'id'    => 40,
                'title' => 'content_tag_edit',
            ],
            [
                'id'    => 41,
                'title' => 'content_tag_show',
            ],
            [
                'id'    => 42,
                'title' => 'content_tag_delete',
            ],
            [
                'id'    => 43,
                'title' => 'content_tag_access',
            ],
            [
                'id'    => 44,
                'title' => 'content_page_create',
            ],
            [
                'id'    => 45,
                'title' => 'content_page_edit',
            ],
            [
                'id'    => 46,
                'title' => 'content_page_show',
            ],
            [
                'id'    => 47,
                'title' => 'content_page_delete',
            ],
            [
                'id'    => 48,
                'title' => 'content_page_access',
            ],
            [
                'id'    => 49,
                'title' => 'product_type_create',
            ],
            [
                'id'    => 50,
                'title' => 'product_type_edit',
            ],
            [
                'id'    => 51,
                'title' => 'product_type_show',
            ],
            [
                'id'    => 52,
                'title' => 'product_type_delete',
            ],
            [
                'id'    => 53,
                'title' => 'product_type_access',
            ],
            [
                'id'    => 54,
                'title' => 'static_seo_create',
            ],
            [
                'id'    => 55,
                'title' => 'static_seo_edit',
            ],
            [
                'id'    => 56,
                'title' => 'static_seo_show',
            ],
            [
                'id'    => 57,
                'title' => 'static_seo_delete',
            ],
            [
                'id'    => 58,
                'title' => 'static_seo_access',
            ],
            [
                'id'    => 59,
                'title' => 'post_create',
            ],
            [
                'id'    => 60,
                'title' => 'post_edit',
            ],
            [
                'id'    => 61,
                'title' => 'post_show',
            ],
            [
                'id'    => 62,
                'title' => 'post_delete',
            ],
            [
                'id'    => 63,
                'title' => 'post_access',
            ],
            [
                'id'    => 64,
                'title' => 'slider_create',
            ],
            [
                'id'    => 65,
                'title' => 'slider_edit',
            ],
            [
                'id'    => 66,
                'title' => 'slider_show',
            ],
            [
                'id'    => 67,
                'title' => 'slider_delete',
            ],
            [
                'id'    => 68,
                'title' => 'slider_access',
            ],
            [
                'id'    => 69,
                'title' => 'setting_create',
            ],
            [
                'id'    => 70,
                'title' => 'setting_edit',
            ],
            [
                'id'    => 71,
                'title' => 'setting_show',
            ],
            [
                'id'    => 72,
                'title' => 'setting_delete',
            ],
            [
                'id'    => 73,
                'title' => 'setting_access',
            ],
            [
                'id'    => 74,
                'title' => 'service_create',
            ],
            [
                'id'    => 75,
                'title' => 'service_edit',
            ],
            [
                'id'    => 76,
                'title' => 'service_show',
            ],
            [
                'id'    => 77,
                'title' => 'service_delete',
            ],
            [
                'id'    => 78,
                'title' => 'service_access',
            ],
            [
                'id'    => 79,
                'title' => 'testimonial_create',
            ],
            [
                'id'    => 80,
                'title' => 'testimonial_edit',
            ],
            [
                'id'    => 81,
                'title' => 'testimonial_show',
            ],
            [
                'id'    => 82,
                'title' => 'testimonial_delete',
            ],
            [
                'id'    => 83,
                'title' => 'testimonial_access',
            ],
            [
                'id'    => 84,
                'title' => 'faq_management_access',
            ],
            [
                'id'    => 85,
                'title' => 'faq_category_create',
            ],
            [
                'id'    => 86,
                'title' => 'faq_category_edit',
            ],
            [
                'id'    => 87,
                'title' => 'faq_category_show',
            ],
            [
                'id'    => 88,
                'title' => 'faq_category_delete',
            ],
            [
                'id'    => 89,
                'title' => 'faq_category_access',
            ],
            [
                'id'    => 90,
                'title' => 'faq_question_create',
            ],
            [
                'id'    => 91,
                'title' => 'faq_question_edit',
            ],
            [
                'id'    => 92,
                'title' => 'faq_question_show',
            ],
            [
                'id'    => 93,
                'title' => 'faq_question_delete',
            ],
            [
                'id'    => 94,
                'title' => 'faq_question_access',
            ],
            [
                'id'    => 95,
                'title' => 'profile_password_edit',
            ],
            [
                'id'    => 96,
                'title' => 'menu_access',
            ],
            [
                'id'    => 97,
                'title' => 'redirector_access',
            ],
            [
                'id'    => 98,
                'title' => 'redirector_show',
            ],
            [
                'id'    => 99,
                'title' => 'redirector_edit',
            ],
            [
                'id'    => 100,
                'title' => 'redirector_delete',
            ],
            [
                'id'    => 101,
                'title' => 'redirector_create',
            ],
            [
                'id'    => 102,
                'title' => 'content_section_create',
            ],
            [
                'id'    => 103,
                'title' => 'content_section_delete',
            ],
            [
                'id'    => 104,
                'title' => 'content_section_edit',
            ],
            [
                'id'    => 105,
                'title' => 'content_section_show',
            ],
            [
                'id'    => 106,
                'title' => 'content_section_access',
            ],
            [
                'id'    => 107,
                'title' => 'pagesection_create',
            ],
            [
                'id'    => 108,
                'title' => 'pagesection_delete',
            ],
            [
                'id'    => 109,
                'title' => 'pagesection_edit',
            ],
            [
                'id'    => 110,
                'title' => 'pagesection_show',
            ],
            [
                'id'    => 111,
                'title' => 'pagesection_access',
            ],
            [
                'id'    => 112,
                'title' => 'success_story_create',
            ],
            [
                'id'    => 113,
                'title' => 'success_story_edit',
            ],
            [
                'id'    => 114,
                'title' => 'success_story_show',
            ],
            [
                'id'    => 115,
                'title' => 'success_story_delete',
            ],
            [
                'id'    => 116,
                'title' => 'success_story_access',
            ],
            [
                'id'    => 117,
                'title' => 'media_library_create',
            ],
            [
                'id'    => 118,
                'title' => 'media_library_access',
            ],
            [
                'id'    => 119,
                'title' => 'comment_create',
            ],
            [
                'id'    => 120,
                'title' => 'comment_edit',
            ],
            [
                'id'    => 121,
                'title' => 'comment_show',
            ],
            [
                'id'    => 122,
                'title' => 'comment_delete',
            ],
            [
                'id'    => 123,
                'title' => 'comment_access',
            ],
        ];

        Permission::insert($permissions);
    }
}
