<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tags = [
            [
                "name" => "إدارة البريد الإلكتروني",
                "slug" => "email-handling",
            ],
            [
                "name" => "الفوتوشوب",
                "slug" => "photoshop",
            ],
            [
                "name" => "العربية",
                "slug" => "arabic",
            ],
            [
                "name" => "الإنجليزية",
                "slug" => "english",
            ],
            [
                "name" => "تصميم الفوتوشوب",
                "slug" => "photoshop-design",
            ],
            [
                "name" => "Illustrator",
                "slug" => "illustrator",
            ],
            [
                "name" => "Microsoft Word",
                "slug" => "microsoft-word",
            ],
            [
                "name" => "تصميم الشعارات",
                "slug" => "logo-design",
            ],
            [
                "name" => "تصميم الجرافيك",
                "slug" => "graphic-design",
            ],
            [
                "name" => "إعادة كتابة المقالات",
                "slug" => "article-rewriting",
            ],
            [
                "name" => "التصميم الإبداعي",
                "slug" => "creative-design",
            ],
            [
                "name" => "الترجمة",
                "slug" => "translation",
            ],
            [
                "name" => "تصميم الإعلانات",
                "slug" => "advertisement-design",
            ],
            [
                "name" => "إدخال البيانات ",
                "slug" => "data-entry",
            ],
            [
                "name" => "Microsoft Office",
                "slug" => "microsoft-office",
            ],
            [
                "name" => "تعديل الصور",
                "slug" => "photo-editing",
            ],
            [
                "name" => "البحث في الويب",
                "slug" => "web-search",
            ],
            [
                "name" => "البحث على الإنترنت",
                "slug" => "internet-research",
            ],
            [
                "name" => "Microsoft Excel",
                "slug" => "excel",
            ],
            [
                "name" => "تصميم البوسترات",
                "slug" => "poster-design",
            ],
            [
                "name" => "HTML",
                "slug" => "html",
            ],
            [
                "name" => "CSS",
                "slug" => "css",
            ],
            [
                "name" => "كتابة المحتوى",
                "slug" => "content-writing",
            ],
            [
                "name" => "أندرويد",
                "slug" => "android",
            ],
            [
                "name" => "PHP",
                "slug" => "php",
            ],
            [
                "name" => "تصميم البنرات",
                "slug" => "banner-design",
            ],
            [
                "name" => "PDF",
                "slug" => "pdf",
            ],
            [
                "name" => "المقالات",
                "slug" => "articles",
            ],
            [
                "name" => "التسويق عبر الإنترنت",
                "slug" => "internet-marketing",
            ],
            [
                "name" => "تصميم الأفكار",
                "slug" => "concept-design",
            ],
            [
                "name" => "الكتابة على الإنترنت",
                "slug" => "online-writing",
            ],
            [
                "name" => "التدقيق اللغوي",
                "slug" => "proofreading",
            ],
            [
                "name" => "تصميم المواقع الإلكترونية",
                "slug" => "website-design",
            ],
            [
                "name" => "إنتاج الفيديو",
                "slug" => "video-production",
            ],
            [
                "name" => "التسويق الرقمي",
                "slug" => "digital-marketing",
            ],
            [
                "name" => "تحرير الفيديو",
                "slug" => "video-editing",
            ],
            [
                "name" => "JavaScript",
                "slug" => "javascript",
            ],
            [
                "name" => "تصميم الشخصيات",
                "slug" => "character-design",
            ],
            [
                "name" => "التصوير الفوتوغرافي",
                "slug" => "photography",
            ],
            [
                "name" => "تصميم الأيقونات",
                "slug" => "icon-design",
            ],
            [
                "name" => "WordPress",
                "slug" => "wordpress",
            ],
            [
                "name" => "تصميم الشبكات",
                "slug" => "network-design",
            ],

        ];
//        \App\Models\Tag::truncate();
        \App\Models\Tag::insert(collect($tags)->unique('slug')->all());

    }
}
