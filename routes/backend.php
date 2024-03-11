<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BackEnd\DashboardController;
use App\Http\Controllers\BackEnd\SettingController;
use App\Http\Controllers\BackEnd\ProfileController;
use App\Http\Controllers\BackEnd\CaptchaController;
use App\Http\Controllers\BackEnd\PageHomeController;
use App\Http\Controllers\BackEnd\PageAboutController;
use App\Http\Controllers\BackEnd\PageFaqController;
use App\Http\Controllers\BackEnd\PageServiceController;
use App\Http\Controllers\BackEnd\PageTestimonialController;
use App\Http\Controllers\BackEnd\PageNewsController;
use App\Http\Controllers\BackEnd\PageEventController;
use App\Http\Controllers\BackEnd\PageContactController;
use App\Http\Controllers\BackEnd\PageSearchController;
use App\Http\Controllers\BackEnd\PageTeamController;
use App\Http\Controllers\BackEnd\PagePortfolioController;
use App\Http\Controllers\BackEnd\PagePhotoGalleryController;
use App\Http\Controllers\BackEnd\PagePricingController;
use App\Http\Controllers\BackEnd\PageTermController;
use App\Http\Controllers\BackEnd\PagePrivacyController;
use App\Http\Controllers\BackEnd\DynamicPagesController;
use App\Http\Controllers\BackEnd\FooterController;
use App\Http\Controllers\BackEnd\MenuController;
use App\Http\Controllers\BackEnd\LanguageController;
use App\Http\Controllers\BackEnd\LangDetailController;
use App\Http\Controllers\BackEnd\LanguageAdminController;
use App\Http\Controllers\BackEnd\CategoryController;
use App\Http\Controllers\BackEnd\NewsController;
use App\Http\Controllers\BackEnd\EventController;
use App\Http\Controllers\BackEnd\SubscriberController;
use App\Http\Controllers\BackEnd\TeamMemberController;
use App\Http\Controllers\BackEnd\SliderController;
use App\Http\Controllers\BackEnd\TestimonialController;
use App\Http\Controllers\BackEnd\PhotoGalleryController;
use App\Http\Controllers\BackEnd\PricingTableController;
use App\Http\Controllers\BackEnd\PortfolioCategoryController;
use App\Http\Controllers\BackEnd\PortfolioController;
use App\Http\Controllers\BackEnd\ClientController;
use App\Http\Controllers\BackEnd\ServiceController;
use App\Http\Controllers\BackEnd\FeatureController;
use App\Http\Controllers\BackEnd\WhyChooseController;
use App\Http\Controllers\BackEnd\FaqController;
use App\Http\Controllers\BackEnd\SocialMediaController;
use App\Http\Controllers\BackEnd\FileController;


Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
/* setting part*/
Route::get('settings',[SettingController::class,'index'])->name('settings.index');
Route::put('settings/{id}/logo',[SettingController::class,'logoUpdate'])
                                ->name('setting.logo.update');
Route::put('settings/{id}/favicon',[SettingController::class,'faviconUpdate'])
                                ->name('setting.favicon.update');
Route::put('settings/{id}/banner',[SettingController::class,'bannerUpdate'])
                                ->name('setting.banner.update');
Route::put('settings/{id}/text-items',[SettingController::class,'textItemsUpdate'])
                                ->name('setting.text.items.update');

/* Profile part*/
Route::get('profile',[ProfileController::class,'index'])->name('profile.index');
Route::put('profile/{id}/info-update',[ProfileController::class,'infoUpdate'])->name('profile.info.update');
Route::put('profile/{id}/password-update',[ProfileController::class,'passwordUpdate'])->name('profile.password.update');

/* Start page section*/
Route::resource('page-homes',PageHomeController::class);
Route::post('page-homes-indep/{id}/update', [PageHomeController::class,'pageIndpUpdate'])
                                            ->name('page.home.indp.update');
Route::post('page-homes-welcome/{id}/update', [PageHomeController::class,'pageIndpUpdate2'])
                                            ->name('page.home.welcome.update');
Route::post('page-homes-counter/{id}/update', [PageHomeController::class,'pageIndpUpdate3'])
                                            ->name('page.home.counter.update');
Route::post('page-homes-booking/{id}/update', [PageHomeController::class,'pageIndpUpdate4'])
                                            ->name('page.home.booking.update');
Route::post('page-homes-testimonial/{id}/update', [PageHomeController::class,'pageIndpUpdate5'])
                                            ->name('page.home.testimonial.update');

Route::resource('page-abouts',PageAboutController::class)->only('index','edit','update');
Route::resource('page-faqs',PageFaqController::class)->only('index','edit','update');
Route::resource('page-services',PageServiceController::class)->only('index','edit','update');
Route::resource('page-testimonials',PageTestimonialController::class)->only('index','edit','update');
Route::resource('page-news',PageNewsController::class)->only('index','edit','update');
Route::resource('page-events',PageEventController::class)->only('index','edit','update');
Route::resource('page-contacts',PageContactController::class)->only('index','edit','update');
Route::resource('page-searchs',PageSearchController::class)->only('index','edit','update');
Route::resource('page-teams',PageTeamController::class)->only('index','edit','update');
Route::resource('page-portfolios',PagePortfolioController::class)->only('index','edit','update');
Route::resource('page-photo-gallerys',PagePhotoGalleryController::class)->only('index','edit','update');
Route::resource('page-pricings',PagePricingController::class)->only('index','edit','update');
Route::resource('page-terms',PageTermController::class)->only('index','edit','update');
Route::resource('page-privacys',PagePrivacyController::class)->only('index','edit','update');
/* End page section*/

/* daynamic page part*/
Route::resource('dynamic-pages',DynamicPagesController::class)->except('show');
/* footer part*/
Route::resource('footers',FooterController::class)->only('index','edit','update');
Route::post('footer-independent/update', [FooterController::class,'independentUpdate'])
                                        ->name('footer.independent.update');
/* menu part*/
Route::get('menus', [MenuController::class,'index'])->name('menus.index');
Route::put('menus/update', [MenuController::class,'update'])->name('menus.update');

/* language part*/
Route::resource('languages',LanguageController::class)->except('show');
Route::get('languages/{id}/detail', [LangDetailController::class,'detail'])
                                    ->name('languages.detail');
Route::post('languages/detail-update', [LangDetailController::class,'Update'])
                                    ->name('languages.detail.update');
/* categories part*/
Route::resource('categories',CategoryController::class)->except('show');
/* news part*/
Route::resource('news',NewsController::class)->except('show');
Route::get('fb/comment', [NewsController::class,'comment'])
                                    ->name('news.comment');
Route::put('fb/{id}/comment-update', [NewsController::class,'commentUpdate'])
                                    ->name('comment.update');
/* event part*/
Route::resource('events',EventController::class)->except('show');
/* subscriber part*/
Route::get('subscribers', [SubscriberController::class,'index'])
                                    ->name('subscribers.index');
Route::delete('subscriber/{id}/destroy', [SubscriberController::class,'destroy'])
                                    ->name('subscribers.destroy');

Route::get('subscribers/send-email', [SubscriberController::class,'view'])
                                    ->name('subscribers.send.email');
Route::post('subscribers/send-email', [SubscriberController::class,'sendEmail'])
                                    ->name('subscribers.email.send');

/* team members part*/
Route::resource('team-members',TeamMemberController::class)->except('show');
/* slider part*/
Route::resource('sliders',SliderController::class)->except('show');
/* testimonial part*/
Route::resource('testimonials',TestimonialController::class)->except('show');
/* photo gallery part*/
Route::resource('photo-gallerys',PhotoGalleryController::class)->except('show');
/* pricing part*/
Route::resource('pricing-tables',PricingTableController::class)->except('show');
/* portfolio category part*/
Route::resource('portfolio-categories',PortfolioCategoryController::class)->except('show');
/* portfolio part*/
Route::resource('portfolios',PortfolioController::class);
 /* client part*/
Route::resource('clients',ClientController::class)->except('show');
/* service part*/
Route::resource('services',ServiceController::class)->except('show');
/* feature part*/
Route::resource('features',FeatureController::class)->except('show');
/* Why Choose part*/
Route::resource('why-chooses',WhyChooseController::class)->except('show');
/* fqa part*/
Route::resource('faqs',FaqController::class)->except('show');
/* social media part*/
Route::get('social-medias',[SocialMediaController::class,'create'])
                                ->name('social-medias.create');
Route::put('social-medias/update',[SocialMediaController::class,'update'])
                                ->name('social-medias.update');
/* file part*/
Route::resource('files',FileController::class)->except('show');
Route::get('files/{id}/download', [FileController::class,'download'])
                                ->name('files.download');


/* Portfolio - Other Photo Delete */
Route::get('portfolios/other-photo-delete/{id}', [PortfolioController::class,'delete_other_photo'])->name('portfolio.other_photo_delete');


Route::get('language/admin/view', [LanguageAdminController::class,'index'])->name('admin_language');

Route::post('language/admin/update', [LanguageAdminController::class,'update'])->name('admin_language_update');