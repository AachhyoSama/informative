<?php

namespace App\Http\Controllers;

use App\Models\Advertisement;
use App\Models\Album;
use App\Models\AlbumImages;
use App\Models\Bullets;
use App\Models\Downloads;
use App\Models\Membercategory;
use App\Models\Members;
use App\Models\MembershipBenefits;
use App\Models\MissionMessages;
use App\Models\News;
use App\Models\Partners;
use App\Models\Setting;
use App\Models\Slider;

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
        $members = Members::latest()->take(2)->get();
        $albumForIndex = Album::latest()->take(7)->get();
        $partners = Partners::latest()->take(8)->get();
        $features = Bullets::latest()->take(4)->get();
        $member_benefit = MembershipBenefits::first();
        $advertisement = Advertisement::first();
        return view('frontend.index', compact('sliders', 'advertisement', 'member_benefit', 'features', 'partners', 'albumForIndex', 'blogs_index', 'members', 'setting', 'mission_vision', 'first_slider', 'news_index'));
    }

    public function pageSlug($slug)
    {
        if ($slug == "home") {
            return redirect()->route('index');
        }
        else if($slug == "about")
        {
            $setting = Setting::first();
            $mission_vision = MissionMessages::first();
            $member_benefit = MembershipBenefits::first();
            return view('frontend.aboutus', compact('setting', 'member_benefit', 'mission_vision'));
        }
        else if($slug == "founder-message")
        {
            $mission_vision = MissionMessages::first();
            return view('frontend.message', compact('mission_vision'));
        }
        else if($slug == "contact")
        {
            $setting = Setting::first();
            return view('frontend.contact', compact('setting'));
        }
        else if($slug == "news")
        {
            $news = News::latest()->where('news_blogs', 0)->paginate(6);
            return view('frontend.news', compact('news'));
        }
        else if($slug == "blogs")
        {
            $blogs = News::latest()->where('news_blogs', 1)->paginate(6);
            return view('frontend.blogs', compact('blogs'));
        }

        else if($slug == "gallery")
        {
            $albums = Album::latest()->get();
            return view('frontend.gallery', compact('albums'));
        }

        else if($slug == "downloads")
        {
            $downloads = Downloads::latest()->paginate(6);
            return view('frontend.downloads', compact('downloads'));
        }
        else
        {
            $album = Album::where('title_slug', $slug)->first();
            $news = News::where('slug', $slug)->first();
            $member_category = Membercategory::where('slug', $slug)->first();

            if ($album)
            {
                $album_images = AlbumImages::latest()->where('album_id', $album->id)->get();
                return view('frontend.gallery_details', compact('album', 'album_images'));
            }
            else if($news)
            {
                $new_view = $news->view_count + 1;
                $news->update([
                    'view_count' => $new_view
                ]);

                return view('frontend.news_details', compact('news'));
            }
            else if($member_category)
            {
                if($member_category->member_commities == 0)
                {
                    $members = Members::latest()->where('member_id', $member_category->id)->get();
                    return view('frontend.team_members', compact('members', 'member_category'));
                }
                elseif($member_category->member_commities == 1)
                {
                    $commities = Members::latest()->where('commitee_id', $member_category->id)->get();
                    return view('frontend.committee_members', compact('commities', 'member_category'));
                }
            }else
            {
                return redirect()->route('index');
            }
        }
    }

    // public function subMenu($slug, $id)
    // {
    //     if ($slug == "members") {
    //         $member_commitee = Menu::findorFail($id);
    //         $members = Members::latest()->where('member_id', $id)->get();
    //         return view('frontend.team_members', compact('members', 'member_commitee'));
    //     }
    //     else if($slug == "committee")
    //     {
    //         $member_commitee = Menu::findorFail($id);
    //         $commities = Members::latest()->where('commitee_id', $id)->get();
    //         return view('frontend.committee_members', compact('commities', 'member_commitee'));
    //     }
    // }

    // public function aboutus()
    // {
    //     $setting = Setting::first();
    //     $mission_vision = MissionMessages::first();
    //     $member_benefit = MembershipBenefits::first();
    //     return view('frontend.aboutus', compact('setting', 'member_benefit', 'mission_vision'));
    // }

    // public function contact()
    // {
    //     $setting = Setting::first();
    //     return view('frontend.contact', compact('setting'));
    // }

    // public function newsPage()
    // {
    //     $news = News::latest()->where('news_blogs', 0)->paginate(4);
    //     $features = Bullets::latest()->take(4)->get();
    //     return view('frontend.news', compact('news', 'features'));
    // }

    // public function blogsPage()
    // {
    //     $blogs = News::latest()->where('news_blogs', 1)->paginate(6);
    //     return view('frontend.blogs', compact('blogs'));
    // }

    // public function gallery()
    // {
    //     $albums = Album::latest()->get();
    //     return view('frontend.gallery', compact('albums'));
    // }

    // public function gallery_details($slug)
    // {
    //     $album = Album::where('title_slug', $slug)->first();
    //     $album_images = AlbumImages::latest()->where('album_id', $album->id)->get();
    //     return view('frontend.gallery_details', compact('album', 'album_images'));
    // }

    // public function news_details($slug)
    // {
    //     $news = News::where('slug', $slug)->first();
    //     $new_view = $news->view_count + 1;
    //     $news->update([
    //         'view_count' => $new_view
    //     ]);
    //     return view('frontend.news_details', compact('news'));
    // }

    // public function blogs_details($slug)
    // {
    //     $news = News::where('slug', $slug)->first();
    //     $new_view = $news->view_count + 1;
    //     $news->update([
    //         'view_count' => $new_view
    //     ]);
    //     return view('frontend.news_details', compact('news'));
    // }

    // public function members($id)
    // {
    //     $member_commitee = Membercategory::findorFail($id);
    //     $members = Members::latest()->where('member_id', $id)->get();
    //     return view('frontend.team_members', compact('members', 'member_commitee'));
    // }

    // public function committee($id)
    // {
    //     $member_commitee = Membercategory::findorFail($id);
    //     $commities = Members::latest()->where('commitee_id', $id)->get();
    //     return view('frontend.committee_members', compact('commities', 'member_commitee'));
    // }
}
