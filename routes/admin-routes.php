<?php

use App\Http\Controllers\Admin\AdminController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::middleware('guest:admins')->group(function () {

    Route::get('/admin/register', [AdminController::class, 'registerView'])->name('admin.register');
    Route::post('/admin/register', [AdminController::class, 'register'])->name('admin.register.post');
    Route::get('/admin/login', [AdminController::class, 'loginView'])->name('admin.login');
    Route::post('/admin/login', [AdminController::class, 'login'])->name('admin.login.post');
});



Route::middleware(['auth:admins'])->group(function () {

    Route::get('/admin/dashboard', [AdminController::class, 'dashboardView'])->name('admin.dashboard');
    Route::post('/admin/logout', [AdminController::class, 'logout'])->name('admin.logout');

    // Scroll Banners
    Route::get('/admin/scroll-banners', [AdminController::class, 'scrollBannersView'])->name('admin.scroll-banners');
    Route::post('/admin/scroll-banners', [AdminController::class, 'addScrollBanner'])->name('admin.scroll-banners.store');
    Route::post('/admin/scroll-banner/edit/{id}', [AdminController::class, 'editScrollBanner'])->name('admin.scroll-banner.edit');
    Route::post('/admin/scroll-banner/delete/{id}', [AdminController::class, 'deleteScrollBanner'])->name('admin.scroll-banner.delete');

    // Offers Post
    Route::get('/admin/offers-add', [AdminController::class, 'offersAddView'])->name('admin.offers');
    Route::post('/admin/offers-adds', [AdminController::class, 'addOffers'])->name('admin.offer.store');
    Route::post('/admin/offers-add/edit/{id}', [AdminController::class, 'editOffers'])->name('admin.offer.edit');
    Route::post('/admin/offers-add/delete/{id}', [AdminController::class, 'deleteOffers'])->name('admin.offer.delete');

    // Main Category
    Route::get('/admin/main-category', [AdminController::class, 'mainCategoryView'])->name('admin.main-category');
    Route::post('/admin/main-category', [AdminController::class, 'addMainCategory'])->name('admin.main-category.store');
    Route::post('/admin/main-category/edit/{id}', [AdminController::class, 'editMainCategory'])->name('admin.main-category.edit');
    Route::post('/admin/main-category/delete/{id}', [AdminController::class, 'deleteMainCategory'])->name('admin.main-category.delete');

    // Sub Category
    Route::get('/admin/sub-category', [AdminController::class, 'subCategoryView'])->name('admin.sub-category');
    Route::get('/admin/get-sub-categories', [AdminController::class, 'getSubCategories'])->name('getSubCategories');

    Route::post('/admin/sub-category', [AdminController::class, 'addSubCategory'])->name('admin.sub-category.store');
    Route::put('/admin/sub-category/edit/{id}', [AdminController::class, 'editSubCategory'])->name('admin.sub-category.edit');
    Route::delete('/admin/sub-category/delete/{id}', [AdminController::class, 'deleteSubCategory'])->name('admin.sub-category.delete');

    // Products
    Route::get('/admin/products', [AdminController::class, 'productsView'])->name('admin.products');
    Route::post('/admin/products', [AdminController::class, 'addProduct'])->name('admin.product.store');
    Route::post('/admin/product/update/{id}', [AdminController::class, 'editProduct'])->name('admin.product.update');
    Route::post('/admin/product/delete/{id}', [AdminController::class, 'deleteProduct'])->name('admin.product.delete');

    // Blogs
    Route::get('/admin/blogs', [AdminController::class, 'blogsView'])->name('admin.blogs');
    Route::post('/admin/blogs', [AdminController::class, 'addBlog'])->name('admin.blog.store');
    Route::put('/admin/blog/update/{id}', [AdminController::class, 'editBlog'])->name('admin.blog.update');
    Route::delete('/admin/blog/delete/{id}', [AdminController::class, 'deleteBlog'])->name('admin.blog.delete');

    // Customers
    Route::get('admin/all-users', [AdminController::class, 'customersView'])->name('admin.user');
    Route::delete('admin/all-users/delete/{id}', [AdminController::class, 'deleteCustomer'])->name('admin.user.delete');

    // Partners
    Route::get('/admin/all-partners', [AdminController::class, 'partnersView'])->name('admin.partners');
    Route::post('/admin/partner', [AdminController::class, 'addPartner'])->name('admin.partner.store');
    Route::put('/admin/partner/update/{id}', [AdminController::class, 'editPartner'])->name('admin.partner.update');
    Route::delete('/admin/partner/delete/{id}', [AdminController::class, 'deletePartner'])->name('admin.partner.delete');

    // About Page Details
    Route::get('/admin/about-us', [AdminController::class, 'aboutView'])->name('admin.about');
    Route::post('/admin/about-us', [AdminController::class, 'addAboutUs'])->name('admin.about.store');
    Route::put('/admin/about-us/update/{id}', [AdminController::class, 'editAboutUs'])->name('admin.about.update');
    Route::delete('/admin/about-us/delete/{id}', [AdminController::class, 'deleteAboutUs'])->name('admin.about.delete');

    // FAQ
    Route::get('/admin/faq', [AdminController::class, 'faqView'])->name('admin.faq');
    Route::post('/admin/faq', [AdminController::class, 'addFaq'])->name('admin.faq.store');
    Route::put('/admin/faq/update/{id}', [AdminController::class, 'editFaq'])->name('admin.faq.update');
    Route::delete('/admin/faq/delete/{id}', [AdminController::class, 'deleteFaq'])->name('admin.faq.delete');

    // Social Media
    Route::get('/admin/social-handels', [AdminController::class, 'socialView'])->name('admin.social');
    Route::post('/admin/social-handel', [AdminController::class, 'addSocial'])->name('admin.social.store');
    Route::put('/admin/social-handel/update/{id}', [AdminController::class, 'editSocial'])->name('admin.social.update');
    Route::delete('/admin/social-handel/delete/{id}', [AdminController::class, 'deleteSocial'])->name('admin.social.delete');

    // Cart Enquiry
    Route::get('/admin/cart-inquiry', [AdminController::class, 'cartEnquiryView'])->name('admin.cart-enquiry');
    Route::post('/admin/cart-enquiry/delete/{id}', [AdminController::class, 'deleteCartEnquiry'])->name('admin.cart-enquiry.delete');
    Route::put('/admin/cart-enquiry/remark/{id}', [AdminController::class, 'cartEnquiryRemark'])->name('admin.cart-enquiry.remark');

    // Product Enquiry
    Route::get('/admin/product-inquiry', [AdminController::class, 'productEnquiryView'])->name('admin.product-enquiry');
    Route::post('/admin/product-enquiry/delete/{id}', [AdminController::class, 'deleteProductEnquiry'])->name('admin.product-enquiry.delete');
    Route::put('/admin/product-enquiry/remark/{id}', [AdminController::class, 'productEnquiryRemark'])->name('admin.product-enquiry.remark');

    // Custom Product Enquiry
    Route::get('/admin/customization-inquiry', [AdminController::class, 'customProductEnquiryView'])->name('admin.custom-product-enquiry');
    Route::post('/admin/customization-inquiry/delete/{id}', [AdminController::class, 'deleteCustomEnquiry'])->name('admin.custom-product-enquiry.delete');
    Route::put('/admin/customization-inquiry/remark/{id}', [AdminController::class, 'customEnquiryRemark'])->name('admin.custom-product-enquiry.remark');

    // Contact Enquiry
    Route::get('/admin/contact-us/inquiry', [AdminController::class, 'contactEnquiryView'])->name('admin.contact-enquiry');
    Route::delete('/admin/contact-us/inquiry/delete/{id}', [AdminController::class, 'deleteContact'])->name('admin.contact-enquiry.delete');
    Route::put('/admin/contact-us/inquiry/remark/{id}', [AdminController::class, 'contactEnquiryRemark'])->name('admin.contact-enquiry.remark');

    // Color
    Route::get('/admin/colors', [AdminController::class, 'colorView'])->name('admin.color');
    Route::post('/admin/colors', [AdminController::class, 'addColor'])->name('admin.color.store');
    Route::post('/admin/color/edit/{id}', [AdminController::class, 'editColor'])->name('admin.color.edit');
    Route::post('/admin/color/delete/{id}', [AdminController::class, 'deleteColor'])->name('admin.color.delete');

    // Size
    Route::get('/admin/sizes', [AdminController::class, 'sizeView'])->name('admin.size');
    Route::post('/admin/sizes', [AdminController::class, 'addSize'])->name('admin.size.store');
    Route::post('/admin/size/edit/{id}', [AdminController::class, 'editSize'])->name('admin.size.edit');
    Route::post('/admin/size/delete/{id}', [AdminController::class, 'deleteSize'])->name('admin.size.delete');

    // Catelogue
    Route::post('/admin/catelog', [AdminController::class, 'catelogueAdd'])->name('admin.catelog.store');
    Route::put('/admin/catalogue/update/{id}', [AdminController::class, 'catelogUpdate'])->name('admin.catelog.update');

    // Orders
    Route::get('/admin/orders', [AdminController::class, 'ordersView'])->name('admin.orders');
    Route::put('/admin/orders/{id}/shipment-status', [AdminController::class, 'shipmentStatusUpdate'])->name('admin.orders.shipment-status');
    Route::get('/admin/orders/export-pending', [AdminController::class, 'exportPendingOrders'])->name('admin.orders.export.pending');
    Route::get('/admin/orders/export-out-for-delivery', [AdminController::class, 'exportOutForDeliveryOrders'])->name('admin.orders.export.out_for_delivery');
    Route::get('/admin/orders/export-delivered', [AdminController::class, 'exportDeliveredOrders'])->name('admin.orders.export.delivered');



});
