<?php

use App\Http\Controllers\AdvertisementController;
use App\Http\Controllers\AlbumController;
use App\Http\Controllers\BlogsController;
use App\Http\Controllers\BulletsController;
use App\Http\Controllers\DownloadsController;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\MailMessagesController;
use App\Http\Controllers\MembercategoryController;
use App\Http\Controllers\MembersController;
use App\Http\Controllers\MembershipBenefitsController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\PartnersController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\SubscribersController;
use App\Http\Controllers\UserController;
use App\Models\MailMessages;
use App\Models\Members;
use App\Models\News;
use App\Models\Partners;
use App\Models\Subscribers;
use App\Models\User;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Backend

Route::get('/dashboard', function () {
    $news_count = News::where('news_blogs', 0)->get()->count();
    $blogs_count = News::where('news_blogs', 1)->get()->count();
    $members_count = Members::all()->count();
    $users_count = User::all()->count();
    $subscribers = Subscribers::latest()->take(10)->get();
    $partners = Partners::latest()->take(10)->get();
    $messages = MailMessages::latest()->take(10)->get();
    return view('backend.dashboard', compact('news_count', 'messages', 'partners', 'subscribers', 'blogs_count', 'members_count', 'users_count'));
})->name('dashboard')->middleware(['auth:sanctum', 'verified']);

Route::group(['prefix' => 'admin'], function () {
    Route::resource('setting', SettingController::class)->middleware(['auth:sanctum', 'verified']);
    Route::get('socialMedia', [SettingController::class, 'socialMedia'])->name('socialMedia')->middleware(['auth:sanctum', 'verified']);
    Route::get('aboutUs', [SettingController::class, 'aboutUs'])->name('aboutUs')->middleware(['auth:sanctum', 'verified']);
    Route::get('missionVision', [SettingController::class, 'missionVision'])->name('missionVision')->middleware(['auth:sanctum', 'verified']);
    Route::put('updateMissionVision/{id}', [SettingController::class, 'updateMissionVision'])->name('updateMissionVision')->middleware(['auth:sanctum', 'verified']);

    Route::resource('slider', SliderController::class)->middleware(['auth:sanctum', 'verified']);

    Route::resource('menu', MenuController::class)->middleware(['auth:sanctum', 'verified']);

    Route::resource('partner', PartnersController::class)->middleware(['auth:sanctum', 'verified']);

    Route::resource('bullets', BulletsController::class)->middleware(['auth:sanctum', 'verified']);

    Route::resource('benefits', MembershipBenefitsController::class)->middleware(['auth:sanctum', 'verified']);

    Route::resource('advertisements', AdvertisementController::class)->middleware(['auth:sanctum', 'verified']);

    Route::resource('users', UserController::class)->middleware(['auth:sanctum', 'verified']);

    Route::get('subscribers', [SubscribersController::class, 'index'])->name('subscribers.index')->middleware(['auth:sanctum', 'verified']);
    Route::post('subscribers', [SubscribersController::class, 'store'])->name('subscribers.store');

    Route::resource('news', NewsController::class)->middleware(['auth:sanctum', 'verified']);
    Route::resource('blogs', BlogsController::class)->middleware(['auth:sanctum', 'verified']);

    Route::resource('member', MembersController::class)->middleware(['auth:sanctum', 'verified']);

    Route::resource('download', DownloadsController::class)->middleware(['auth:sanctum', 'verified']);

    Route::resource('message', MailMessagesController::class)->middleware(['auth:sanctum', 'verified']);
    Route::post('message', [MailMessagesController::class, 'store'])->name('message.store');

    Route::resource('album', AlbumController::class)->middleware(['auth:sanctum', 'verified']);
    Route::delete('albumImage/{id}', [AlbumController::class, 'deleteAlbumImage'])->name('deleteAlbumImage');

    Route::resource('memberCategory', MembercategoryController::class)->middleware(['auth:sanctum', 'verified']);
    Route::get('commiteeCategory', [MembercategoryController::class, 'commiteeCategory'])->name('commiteeCategory')->middleware(['auth:sanctum', 'verified']);
});

// Frontend

Route::middleware(['localization'])->group(function () {
    Route::get('/lang/{locale}', [LanguageController::class, 'lang'])->name('lang');
    Route::get('/', [FrontController::class, 'index'])->name('index');
    Route::get('{slug}', [FrontController::class, 'pageSlug'])->name('pageSlug');
    Route::post('updateMenu', [MenuController::class, 'updateMenuOrder'])->name('updateMenuOrder');
});



// Route::get('{slug}/{id}', [FrontController::class, 'subMenu'])->name('subMenu');
// Route::get('members/{id}', [FrontController::class, 'members'])->name('members');
// Route::get('committee/{id}', [FrontController::class, 'committee'])->name('committee');

// Route::get('gallery-details/{slug}', [FrontController::class, 'gallery_details'])->name('gallery_details');
// Route::get('news-details/{slug}', [FrontController::class, 'news_details'])->name('news.details');
// Route::get('blogs-details/{slug}', [FrontController::class, 'blogs_details'])->name('blogs.details');






