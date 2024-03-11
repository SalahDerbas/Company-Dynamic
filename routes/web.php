<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontEnd\HomeController;
use App\Http\Controllers\FrontEnd\SearchController;
use App\Http\Controllers\FrontEnd\LangController;
use App\Http\Controllers\FrontEnd\TermAndConditionController;
use App\Http\Controllers\FrontEnd\PrivacyPolicyController;
use App\Http\Controllers\FrontEnd\AboutController;
use App\Http\Controllers\FrontEnd\TeamController;
use App\Http\Controllers\FrontEnd\EventController;
use App\Http\Controllers\FrontEnd\TestimonialController;
use App\Http\Controllers\FrontEnd\FaqController;
use App\Http\Controllers\FrontEnd\PricingController;
use App\Http\Controllers\FrontEnd\PhotoGalleryController;
use App\Http\Controllers\FrontEnd\ServiceController;
use App\Http\Controllers\FrontEnd\PortfolioController;
use App\Http\Controllers\FrontEnd\NewsController;
use App\Http\Controllers\FrontEnd\ContactController;
use App\Http\Controllers\FrontEnd\SubscriberController;


Route::get('admin', function () {return redirect('admin/login');});

Route::group(['prefix' => 'admin'], function(){
    Auth::routes(['register' => false]);
});

Route::get('/', [HomeController::class,'index'])->name('home.page');
Route::get('/home/page/{slug}', [HomeController::class,'dynamicPage'])->name('home.dynamic.page');
Route::post('/home/send-email', [HomeController::class,'sendEmail'])->name('home.send.email');

/*-- Contact part --*/
Route::post('/search', [SearchController::class,'getData'])->name('home.search');

/*-- lang part --*/
Route::post('/lang-change', [LangController::class,'change'])
                                    ->name('lang.change');

/*-- terms-and-condition part --*/
Route::get('/terms-and-conditions', [TermAndConditionController::class,'index'])
                                    ->name('term.and.condition');
/*-- privacy-policy part --*/
Route::get('/privacy-policy', [PrivacyPolicyController::class,'index'])
                                ->name('privacy.policy');
/*-- about part --*/
Route::get('/about', [AboutController::class,'index'])->name('home.about');

/*-- team part --*/
Route::get('/team', [TeamController::class,'index'])->name('home.team');
Route::get('/team-member/{id}/{slug}', [TeamController::class,'teamMember'])
                                    ->name('home.team.member');
/*-- event part --*/
Route::get('/event', [EventController::class,'index'])->name('home.event');
Route::get('/event/{slug}', [EventController::class,'view'])->name('event.view');

/*-- testimonial part --*/
Route::get('/testimonial', [TestimonialController::class,'index'])->name('home.testimonial');

/*-- faq part --*/
Route::get('/faq', [FaqController::class,'index'])->name('home.faq');

/*-- pricing part --*/
Route::get('/pricing', [PricingController::class,'index'])->name('home.pricing');

/*-- photo-gallery part --*/
Route::get('/photo-gallery', [PhotoGalleryController::class,'index'])->name('home.photo.gallery');

/*-- service part --*/
Route::get('/service', [ServiceController::class,'index'])->name('home.service');
Route::get('/service/{slug}', [ServiceController::class,'view'])->name('service.view');
Route::post('/service/send-email', [ServiceController::class,'sendEmail'])->name('service.send.email');

/*-- portfolio part --*/
Route::get('/portfolio', [PortfolioController::class,'index'])->name('home.portfolio');
Route::get('/portfolio/{slug}', [PortfolioController::class,'view'])->name('portfolio.view');
Route::post('/portfolio/send-email', [PortfolioController::class,'sendEmail'])->name('portfolio.send.email');

/*-- news part --*/
Route::get('/news', [NewsController::class,'index'])->name('home.news');
Route::get('/news/{slug}', [NewsController::class,'view'])->name('news.view');
Route::get('/news-category/{slug}', [NewsController::class,'categoryWiseview'])->name('news.category.view');

/*-- Contact part --*/
Route::get('/contact', [ContactController::class,'index'])->name('home.contact');
Route::post('/contact/send-email', [ContactController::class,'sendEmail'])->name('contact.send.email');

/*-- Contact part --*/
Route::post('/subscriber', [SubscriberController::class,'store'])->name('home.subscriber');
Route::get('/subscriber/verify/{token}', [SubscriberController::class,'verify'])->name('verify.subscriber');
Route::get('/subscriber/remove-pending', [SubscriberController::class,'pending'])->name('remove.subscriber.pending');

Route::get('/subscriber/export-csv', [SubscriberController::class,'exportIntoCSV'])->name('subscriber.export.csv');