<?php

namespace Database\Seeders;

use App\Models\Advertisement;
use App\Models\MembershipBenefits;
use App\Models\MenuCategory;
use App\Models\MissionMessages;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call(ProvinceTableSeeder::class);
        $this->call(DistrictTableSeeder::class);

        Setting::insert([
            [
                "company_name" => "Kailali Contractors",
                "email" => "contractorskarnali@gmail.com ",
                "contact_no" => "01-42657548",
                "province_no" => "3",
                "district_no" => "23",
                "local_address" => "Gushingal, Kupondole",
                "company_logo" => "noimage.jpg",
                "company_favicon" => "noimage.jpg",
                "pan_vat" => "1542-551-575",
                "clients_satisfied" => "250",
                "award_winner" => "250",
                "projects_completed" => "250",
                "map_url" => "https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3532.9212530847535!2d85.30833201458272!3d27.68882863291339!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39eb1918e77a958d%3A0x8adb3649babf6b7e!2sNectar%20Digit%20Pvt.%20Ltd.!5e0!3m2!1sen!2snp!4v1630559019802!5m2!1sen!2snp"
            ]
        ]);

        MembershipBenefits::insert([
            "title" => "CAK Membership Benefits",
            "descriptive_title" => "25 Years Experience Working",
            "content" => "For each project we establish relationships with partners who we know will help us create added value for your project. As well as bringing together the public and private sectors, we make sector-overarching links to gather knowledge and to learn from each other who we know. For each project we establish relationships with partners who we know will help us create added value for your project. As well as bringing together the public and private sectors.",
            "cover_image" => "noimage.jpg",
        ]);

        MissionMessages::insert([
            [
                "mission_vision" => "Acepteur sintas hae cate sed ipsums cupidates nondui proident sunlt culp qui tempore officia sed ipsum temps eserunt sed ipsum.Acepteur sintas hae cate sed ipsums cupidates nondui proident sunlt culp qui tempore officia sed ipsum temps eserunt sed ipsum.",
                "founder_message" => "Acepteur sintas hae cate sed ipsums cupidates nondui proident sunlt culp qui tempore officia sed ipsum temps eserunt sed ipsum.Acepteur sintas hae cate sed ipsums cupidates nondui proident sunlt culp qui tempore officia sed ipsum temps eserunt sed ipsum.",
                "welcome_title" => "WELCOME TO CONTRACTOR'S ASSOCIATION OF KARNALI",
                "welcome_sub_title" => "A regular member of International Federation of Asian & Western pacific contractors’ Associations (IFAWPCA)",
                "welcome_message" => "Contractors’ of Nepal who are relatively established today started their profession with their own effort without any help, guidance or training were trying to establish their representative organization before two decades or more. It was very difficult to establish such association during the party-less political system (1960-1990). This sector is contributing around 11 percent to the Gross Domestic Product (GDP) of the country after the agriculture, the second largest employer of the country that provides employment opportunity not only to the unemployed but also to the underemployed.Contractors’ of Nepal who are relatively established today started their profession with their own effort without any help, guidance or training were trying to establish their representative organization before two decades or more."
            ]
        ]);

        MenuCategory::insert([
            [
                'name' => 'Home',
                'slug' => Str::slug('Home')
            ],
            [
                'name' => 'About',
                'slug' => Str::slug('About')
            ],
            [
                'name' => 'Members',
                'slug' => Str::slug('Members')
            ],
            [
                'name' => 'News',
                'slug' => Str::slug('News')
            ],
            [
                'name' => 'Committee',
                'slug' => Str::slug('Committee')
            ],
            [
                'name' => 'Gallery',
                'slug' => Str::slug('Gallery')
            ],
            [
                'name' => 'Blogs',
                'slug' => Str::slug('Blogs')
            ],
            [
                'name' => 'Contact',
                'slug' => Str::slug('Contact')
            ],
            [
                'name' => 'Downloads',
                'slug' => Str::slug('Downloads')
            ],
        ]);

        User::insert([
            [
                "name"=>"Nectar Digit",
                "email"=>"nectardigit@admin.com",
                "password"=>Hash::make("Nectar@321"),
                "created_at"=>date('Y-m-d H:i:s'),
                "updated_at"=>date('Y-m-d H:i:s'),
            ],
        ]);

        Advertisement::insert([
            'opening_advertisement' => 'skip-ads.jpg',
            'opening_advertisement_url' => 'https://nectardigit.com/',
            'is_show' => 0,

            'header_advertisement' => 'ads1.gif',
            'header_advertisement_url' => 'https://nectardigit.com/',

            'middle_ad_one' => 'ads1.gif',
            'middle_ad_one_url' => 'https://nectardigit.com/',

            'middle_ad_two' => 'ads1.gif',
            'middle_ad_two_url' => 'https://nectardigit.com/',

            'middle_ad_three' => 'ads1.gif',
            'middle_ad_three_url' => 'https://nectardigit.com/',

            'middle_ad_four' => 'ads1.gif',
            'middle_ad_four_url' => 'https://nectardigit.com/',

            'main_advertisement' => 'ads1.gif',
            'main_advertisement_url' => 'https://nectardigit.com/',
        ]);
    }
}
