<?php

namespace App\Http\Controllers;

use App\Models\Advertisement;
use App\Models\Album;
use App\Models\AlbumImages;
use App\Models\Bullets;
use App\Models\Downloads;
use App\Models\Membercategory;
use App\Models\MemberPDF;
use App\Models\Members;
use App\Models\MembershipBenefits;
use App\Models\Menu;
use App\Models\MissionMessages;
use App\Models\News;
use App\Models\Partners;
use App\Models\PopupNotices;
use App\Models\Setting;
use App\Models\Slider;
use App\Models\SubCategory;
use Illuminate\Support\Facades\Storage;

class FrontController extends Controller
{
    public function index()
    {
        $sliders = Slider::latest()->where('is_active', 1)->get();
        $first_slider = Slider::latest()->where('is_active', 1)->first();
        $news_index = News::latest()->where('news_blogs', 0)->take(4)->get();
        $blogs_index = News::where('news_blogs', 1)->orderBy('view_count', 'DESC')->take(3)->get();
        $mission_vision = MissionMessages::first();
        $setting = Setting::first();
        $members = Members::orderBy('in_order', 'asc')->take(1)->get();
        $albumForIndex = Album::latest()->take(7)->get();
        $partners = Partners::latest()->take(8)->get();
        $popupnotices = PopupNotices::where('status', 1)->get();
        $features = Bullets::latest()->take(4)->get();
        $member_benefit = MembershipBenefits::first();
        $advertisement = Advertisement::first();

        $about_part = strip_tags(getLangValue($setting->aboutus));
        $description = substr($about_part, 0 ,200). "..";

        $meta = [
            'meta_title' => $setting->meta_title ? $setting->meta_title : $setting->company_name['en'],
            'meta_keyword' => $setting->meta_keywords ? $setting->meta_keywords : $setting->company_name['en'],
            'meta_description' => $setting->meta_description ? $setting->meta_description : $description,
            'meta_keyphrase' => $setting->meta_title ? $setting->meta_title : $setting->company_name['en'],
            'og_image' => $setting->og_image ? Storage::disk('uploads')->url($setting->og_image) : Storage::disk('uploads')->url($setting->company_favicon),
            'og_url' => route('index'),
            'og_site_name' => $setting->company_name['en'],
        ];

        return view('frontend.index', compact('meta', 'sliders', 'advertisement', 'popupnotices', 'member_benefit', 'features', 'partners', 'albumForIndex', 'blogs_index', 'members', 'setting', 'mission_vision', 'first_slider', 'news_index'));
    }

    public function pageSlug($slug)
    {
        if ($slug == "home")
        {
            return redirect()->route('index');
        }
        else if($slug == "about")
        {
            $data = Menu::where('category_slug', $slug)->first();
            $setting = Setting::first();
            $mission_vision = MissionMessages::first();
            $member_benefit = MembershipBenefits::first();

            $about_part = strip_tags(getLangValue($setting->aboutus));
            $description = substr($about_part, 0 ,200). "..";

            $meta = [
                'meta_title' => $data->meta_title ? $data->meta_title : $data->name['en'],
                'meta_keyword' => $data->meta_keywords ? $data->meta_keywords : $data->name['en'],
                'meta_description' => $data->meta_description ? $data->meta_description : $description,
                'meta_keyphrase' => $data->meta_keywords ? $data->meta_keywords : $data->name['en'],
                'og_image' => Storage::disk('uploads')->url($data->og_image ? $data->og_image : $setting->company_favicon),
                'og_url' => route('pageSlug', $slug),
                'og_site_name' => $setting->company_name['en'],
            ];
            return view('frontend.aboutus', compact('meta', 'setting', 'member_benefit', 'mission_vision'));
        }
        else if($slug == "founder-message")
        {

            $mission_vision = MissionMessages::first();
            $setting = Setting::first();
            $about_part = strip_tags(getLangValue($mission_vision->founder_message));
            $description = substr($about_part, 0 ,150). "..";
            $meta = [
                'meta_title' => 'Founder Message',
                'meta_keyword' => $setting->company_name['en'],
                'meta_description' => $description,
                'meta_keyphrase' => $setting->company_name['en'],
                'og_image' => Storage::disk('uploads')->url($setting->company_favicon),
                'og_url' => route('pageSlug', $slug),
                'og_site_name' => $setting->company_name['en'],
            ];

            $mission_vision = MissionMessages::first();
            return view('frontend.message', compact('mission_vision', 'meta'));
        }
        else if($slug == "contact")
        {
            $data = Menu::where('category_slug', $slug)->first();
            $setting = Setting::first();
            $about_part = strip_tags(getLangValue($setting->aboutus));
            $description = substr($about_part, 0 ,200). "..";
            $meta = [
                'meta_title' => $data->meta_title ? $data->meta_title : $data->name['en'],
                'meta_keyword' => $data->meta_keywords ? $data->meta_keywords : $data->name['en'],
                'meta_description' => $data->meta_description ? $data->meta_description : $description,
                'meta_keyphrase' => $data->meta_keywords ? $data->meta_keywords : $data->name['en'],
                'og_image' => Storage::disk('uploads')->url($data->og_image ? $data->og_image : $setting->company_favicon),
                'og_url' => route('pageSlug', $slug),
                'og_site_name' => $setting->company_name['en'],
            ];
            return view('frontend.contact', compact('setting', 'meta'));
        }
        else if($slug == "news")
        {
            $data = Menu::where('category_slug', $slug)->first();
            $setting = Setting::first();
            $about_part = strip_tags(getLangValue($setting->aboutus));
            $description = substr($about_part, 0 ,200). "..";
            $meta = [
                'meta_title' => $data->meta_title ? $data->meta_title : $data->name['en'],
                'meta_keyword' => $data->meta_keywords ? $data->meta_keywords : $data->name['en'],
                'meta_description' => $data->meta_description ? $data->meta_description : $description,
                'meta_keyphrase' => $data->meta_keywords ? $data->meta_keywords : $data->name['en'],
                'og_image' => Storage::disk('uploads')->url($data->og_image ? $data->og_image : $setting->company_favicon),
                'og_url' => route('pageSlug', $slug),
                'og_site_name' => $setting->company_name['en'],
            ];

            $news = News::latest()->where('news_blogs', 0)->paginate(6);

            return view('frontend.news', compact('news', 'meta'));
        }
        else if($slug == "blogs")
        {
            $data = Menu::where('category_slug', $slug)->first();
            $setting = Setting::first();
            $about_part = strip_tags(getLangValue($setting->aboutus));
            $description = substr($about_part, 0 ,200). "..";
            $meta = [
                'meta_title' => $data->meta_title ? $data->meta_title : $data->name['en'],
                'meta_keyword' => $data->meta_keywords ? $data->meta_keywords : $data->name['en'],
                'meta_description' => $data->meta_description ? $data->meta_description : $description,
                'meta_keyphrase' => $data->meta_keywords ? $data->meta_keywords : $data->name['en'],
                'og_image' => Storage::disk('uploads')->url($data->og_image ? $data->og_image : $setting->company_favicon),
                'og_url' => route('pageSlug', $slug),
                'og_site_name' => $setting->company_name['en'],
            ];

            $blogs = News::latest()->where('news_blogs', 1)->paginate(6);
            return view('frontend.blogs', compact('blogs', 'meta'));
        }

        else if($slug == "gallery")
        {
            $data = Menu::where('category_slug', $slug)->first();
            $setting = Setting::first();
            $about_part = strip_tags(getLangValue($setting->aboutus));
            $description = substr($about_part, 0 ,200). "..";
            $meta = [
                'meta_title' => $data->meta_title ? $data->meta_title : $data->name['en'],
                'meta_keyword' => $data->meta_keywords ? $data->meta_keywords : $data->name['en'],
                'meta_description' => $data->meta_description ? $data->meta_description : $description,
                'meta_keyphrase' => $data->meta_keywords ? $data->meta_keywords : $data->name['en'],
                'og_image' => Storage::disk('uploads')->url($data->og_image ? $data->og_image : $setting->company_favicon),
                'og_url' => route('pageSlug', $slug),
                'og_site_name' => $setting->company_name['en'],
            ];
            $albums = Album::latest()->get();
            return view('frontend.gallery', compact('albums' , 'meta'));
        }

        else if($slug == "downloads")
        {
            $data = Menu::where('category_slug', $slug)->first();
            $setting = Setting::first();
            $about_part = strip_tags(getLangValue($setting->aboutus));
            $description = substr($about_part, 0 ,200). "..";
            $meta = [
                'meta_title' => $data->meta_title ? $data->meta_title : $data->name['en'],
                'meta_keyword' => $data->meta_keywords ? $data->meta_keywords : $data->name['en'],
                'meta_description' => $data->meta_description ? $data->meta_description : $description,
                'meta_keyphrase' => $data->meta_keywords ? $data->meta_keywords : $data->name['en'],
                'og_image' => Storage::disk('uploads')->url($data->og_image ? $data->og_image : $setting->company_favicon),
                'og_url' => route('pageSlug', $slug),
                'og_site_name' => $setting->company_name['en'],
            ];
            $albums = Album::latest()->get();
            $downloads = Downloads::latest()->paginate(6);
            return view('frontend.downloads', compact('downloads', 'meta'));
        }
        else
        {
            $album = Album::where('title_slug', $slug)->first();
            $news = News::where('slug', $slug)->first();
            $member_category = Membercategory::where('slug', $slug)->first();
            $member_subcategory = SubCategory::where('slug', $slug)->first();

            if ($album)
            {
                $setting = Setting::first();
                $about_part = strip_tags(getLangValue($setting->aboutus));
                $description = substr($about_part, 0 ,200). "..";

                $meta = [
                    'meta_title' => $album->meta_title ? $album->meta_title : $album->album_title['en'],
                    'meta_keyword' => $album->meta_keywords ? $album->meta_keywords : $album->album_title['en'],
                    'meta_description' => $album->meta_description ? $album->meta_description : $description,
                    'meta_keyphrase' => $album->meta_keywords ? $album->meta_keywords : $album->album_title['en'],
                    'og_image' => Storage::disk('uploads')->url($album->og_image ? $album->og_image : $setting->company_favicon),
                    'og_url' => route('pageSlug', $slug),
                    'og_site_name' => $setting->company_name['en'],
                ];

                $albums = Album::latest()->get();

                $album_images = AlbumImages::latest()->where('album_id', $album->id)->get();
                return view('frontend.gallery_details', compact('album', 'album_images', 'meta'));
            }
            else if($news)
            {
                $new_view = $news->view_count + 1;
                $news->update([
                    'view_count' => $new_view
                ]);

                $setting = Setting::first();
                $about_part = strip_tags(getLangValue($setting->aboutus));
                $description = substr($about_part, 0 ,200). "..";

                $meta = [
                    'meta_title' => $news->meta_title ? $news->meta_title : $news->title['en'],
                    'meta_keyword' => $news->meta_keywords ? $news->meta_keywords : $news->title['en'],
                    'meta_description' => $news->meta_description ? $news->meta_description : $description,
                    'meta_keyphrase' => $news->meta_keywords ? $news->meta_keywords : $setting->company_name['en'],
                    'og_image' => Storage::disk('uploads')->url($news->og_image ? $news->og_image : $setting->company_favicon),
                    'og_url' => route('pageSlug', $slug),
                    'og_site_name' => $setting->company_name['en'],
                ];

                return view('frontend.news_details', compact('news', 'meta'));
            }
            else if($member_category)
            {
                $setting = Setting::first();
                $about_part = strip_tags(getLangValue($setting->aboutus));
                $description = substr($about_part, 0 ,200). "..";

                $meta = [
                    'meta_title' => $member_category->meta_title ? $member_category->meta_title : $member_category->category_name['en'],
                    'meta_keyword' => $member_category->meta_keywords ? $member_category->meta_keywords : $member_category->category_name['en'],
                    'meta_description' => $member_category->meta_description ? $member_category->meta_description : $description,
                    'meta_keyphrase' => $member_category->meta_keywords ? $member_category->meta_keywords : $member_category->category_name['en'],
                    'og_image' => Storage::disk('uploads')->url($member_category->og_image ? $member_category->og_image : $setting->company_favicon),
                    'og_url' => route('pageSlug', $slug),
                    'og_site_name' => $setting->company_name['en'],
                ];

                if($member_category->member_commities == 0)
                {
                    $members = Members::orderBy('in_order', 'asc')->where('member_id', $member_category->id)->get();
                    $member_subcategory = null;
                    $memberPDFs = MemberPDF::where('member_id', $member_category->id)->get();
                    if (count($memberPDFs) > 0) {
                        return view('frontend.membersPDF', compact('memberPDFs', 'member_category', 'meta', 'member_subcategory'));
                    } else {
                        return view('frontend.team_members', compact('members', 'member_category', 'meta', 'member_subcategory'));
                    }
                }
                elseif($member_category->member_commities == 1)
                {
                    $commities = Members::orderBy('in_order', 'asc')->where('commitee_id', $member_category->id)->get();
                    $member_subcategory = null;
                    $memberPDFs = MemberPDF::where('committee_id', $member_category->id)->get();
                    if (count($memberPDFs) > 0) {
                        return view('frontend.membersPDF', compact('memberPDFs', 'member_category', 'meta', 'member_subcategory'));
                    } else {
                        return view('frontend.committee_members', compact('commities', 'member_category', 'meta', 'member_subcategory'));
                    }
                }
            }
            else if($member_subcategory)
            {
                $setting = Setting::first();
                $about_part = strip_tags(getLangValue($setting->aboutus));
                $description = substr($about_part, 0 ,200). "..";

                $meta = [
                    'meta_title' => $member_subcategory->meta_title ? $member_subcategory->meta_title : $member_subcategory->sub_category_name['en'],
                    'meta_keyword' => $member_subcategory->meta_keywords ? $member_subcategory->meta_keywords : $member_subcategory->sub_category_name['en'],
                    'meta_description' => $member_subcategory->meta_description ? $member_subcategory->meta_description : $description,
                    'meta_keyphrase' => $member_subcategory->meta_keywords ? $member_subcategory->meta_keywords : $member_subcategory->sub_category_name['en'],
                    'og_image' => Storage::disk('uploads')->url($member_subcategory->og_image ? $member_subcategory->og_image : $setting->company_favicon),
                    'og_url' => route('pageSlug', $slug),
                    'og_site_name' => $setting->company_name['en'],
                ];

                if($member_subcategory->category->member_commities == 0)
                {
                    $members = Members::orderBy('in_order', 'asc')->where('member_subcategory_id', $member_subcategory->id)->get();
                    $member_category = null;
                    $memberPDFs = MemberPDF::where('member_subcategory_id', $member_subcategory->id)->get();

                    if (count($memberPDFs) > 0) {
                        return view('frontend.membersPDF', compact('memberPDFs', 'member_category', 'meta', 'member_subcategory'));
                    } else {
                        return view('frontend.team_members', compact('members', 'member_subcategory', 'meta', 'member_category'));
                    }
                }
                elseif($member_subcategory->category->member_commities == 1)
                {
                    $commities = Members::orderBy('in_order', 'asc')->where('committee_subcategory_id', $member_subcategory->id)->get();
                    $member_category = null;
                    $memberPDFs = MemberPDF::where('committee_subcategory_id', $member_subcategory->id)->get();

                    if (count($memberPDFs) > 0) {
                        return view('frontend.membersPDF', compact('memberPDFs', 'member_category', 'meta', 'member_subcategory'));
                    } else {
                        return view('frontend.committee_members', compact('commities', 'member_subcategory', 'meta', 'member_category'));
                    }
                }
            }
            else
            {
                return redirect()->route('index');
            }
        }
    }
}
