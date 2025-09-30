<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Mail\ContactConfirmationMail;
use App\Mail\CustomerCartEnquiryMail;
use App\Mail\CustomerCartEnquiryRecieverMail;
use App\Mail\CustomerPasswordResetOtpMail;
use App\Mail\CustomizeEnquiryRecieverMail;
use App\Mail\CustomizeEnquirySenderMail;
use App\Mail\OrderPlacedMail;
use App\Mail\ProductEnquiryMail;
use App\Mail\ProductEnquiryMailSender;
use App\Mail\UpdatePasswordMail;
use App\Mail\WelcomeCustomerMail;
use Illuminate\Support\Facades\Auth;
use App\Models\Customer;
use App\Models\MainCategory;
use App\Models\Offer;
use App\Models\Partner;
use App\Models\Product;
use App\Models\About;
use App\Models\Blog;
use App\Models\Cart;
use App\Models\CartEnquiry;
use App\Models\Catelogue;
use App\Models\Color;
use App\Models\Contact;
use App\Models\CustomEnquiry;
use App\Models\Faq;
use App\Models\ProductEnquiry;
use App\Models\ScrollBanners;
use App\Models\Social;
use App\Models\SubCategory;
use Illuminate\Database\QueryException;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Stripe\Stripe;
use Stripe\Charge;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Order;
use Carbon\Carbon;

class CustomerController extends Controller
{
    // Handles customer login and registration=========================================>
    public function loginView()
    {
        $maincategories = MainCategory::with('subCategory')->get();
        $subCategories = SubCategory::with('products', 'mainCategory')->get();
        $offers = Offer::all();
        $partners = Partner::all();
        $socials = Social::all();
        $abouts = About::all();

        return view('login', compact('maincategories', 'subCategories', 'offers', 'partners', 'socials', 'abouts'));
    }

    public function registerView()
    {
        $maincategories = MainCategory::with('subCategory')->get();
        $subCategories = SubCategory::with('products', 'mainCategory')->get();
        $offers = Offer::all();
        $partners = Partner::all();
        $socials = Social::all();
        $abouts = About::all();

        return view('register', compact('maincategories', 'subCategories', 'offers', 'partners', 'socials', 'abouts'));
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|string|email|max:255|unique:customers,email',
            'mobile'   => 'required',
            'address'  => 'required',
            'password' => 'required|string|min:6',
        ]);

        try {
            $customer = Customer::create([
                'name'     => $validated['name'],
                'email'    => $validated['email'],
                'mobile'   => $validated['mobile'],
                'address'  => $validated['address'],
                'password' => bcrypt($validated['password']),
            ]);

            Mail::to($customer->email)->send(new WelcomeCustomerMail($customer->name));



            return redirect()->route('customer.login')->with('success', 'Registered successfully.');
        } catch (QueryException $e) {

            if ($e->errorInfo[1] == 1062) {
                return back()->withInput()->withErrors(['email' => 'This email is already registered.']);
            }

            return back()->withInput()->withErrors(['general' => 'Something went wrong. Please try again.']);
        }
    }

    public function login(Request $request)
    {
        try {
            // Validate request
            $request->validate([
                'email' => 'required|email',
                'password' => 'required',
            ]);

            $credentials = $request->only('email', 'password');

            if (Auth::guard('customers')->attempt($credentials)) {
                $request->session()->regenerate();
                return redirect()->intended(route('home'))->with('success', 'Login successful.');
            }

            // If credentials are incorrect
            return back()->withInput()->withErrors([
                'email' => 'Invalid credentials. Please check your email or password.',
            ]);
        } catch (ValidationException $e) {

            throw $e;
        } catch (QueryException $e) {
            return back()->withInput()->withErrors([
                'general' => 'A system error occurred. Please try again later.',
            ]);
        } catch (\Exception $e) {
            return back()->withInput()->withErrors([
                'general' => 'Unexpected error. Contact support if this continues.',
            ]);
        }
    }

    public function logout(Request $request)
    {
        Auth::guard('customers')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home')->with('success', 'Logged out successfully.');
    }
    // Handles customer login and registration=========================================>

    // About Page=======================================================>
    public function aboutView()
    {
        $maincategories = MainCategory::with('subCategory')->get();
        $subCategories = SubCategory::with('products', 'mainCategory')->get();
        $offers = Offer::all();
        $partners = Partner::all();
        $socials = Social::all();
        $abouts = About::all();

        $user = Auth::guard('customers')->user();

        $customerId = Auth::guard('customers')->id();
        $cartCount = Cart::where('customer_id', $customerId)->count();


        return view('about', compact('maincategories', 'subCategories', 'offers', 'partners', 'socials', 'abouts', 'user', 'cartCount'));
    }

    public function homeView()
    {
        $scrollingBanners = ScrollBanners::all();
        $maincategories = MainCategory::with('subCategory')->get();
        $subCategories = SubCategory::with('products', 'mainCategory')->get();
        $offers = Offer::all();
        $partners = Partner::all();
        $socials = Social::all();
        $customerId = Auth::guard('customers')->id();
        $cartCount = Cart::where('customer_id', $customerId)->count();


        $products = Product::with('subCategory', 'mainCategory')
            ->inRandomOrder()
            ->take(8)
            ->get();

        foreach ($products as $product) {
            $decoded = json_decode($product->images, true);
            $product->image = isset($decoded[0]) ? str_replace('\\/', '/', $decoded[0]) : null;
        }


        if (Auth::guard('customers')->check()) {
            return view('customer-home', compact('scrollingBanners', 'offers', 'maincategories', 'subCategories', 'products', 'partners', 'socials', 'cartCount'));
        }
        return view('home', compact('scrollingBanners', 'offers', 'maincategories', 'subCategories', 'products', 'partners', 'socials', 'cartCount'));
    }

    public function allProductsView(Request $request, $mainSlug, $subSlug)
    {
        $mainCategory = MainCategory::where('slug', $mainSlug)->firstOrFail();
        $subCategory = SubCategory::where('slug', $subSlug)
            ->where('main_category_id', $mainCategory->id)
            ->firstOrFail();

        $query = Product::where('sub_category_id', $subCategory->id);

        // Apply color filter
        if ($request->has('colors')) {
            $colors = array_map('strtolower', $request->input('colors', []));
            $query->where(function ($q) use ($colors) {
                foreach ($colors as $color) {
                    $q->orWhereRaw("LOWER(colors) LIKE ?", ["%$color%"]);
                }
            });
        }

        // Apply size filter
        if ($request->has('sizes')) {
            $sizes = array_map('strtolower', $request->input('sizes', []));
            $query->where(function ($q) use ($sizes) {
                foreach ($sizes as $size) {
                    $q->orWhereRaw("LOWER(sizes) LIKE ?", ["%$size%"]);
                }
            });
        }

        $products = $query->get();

        // Get unique colors and sizes from all products under this subcategory
        $allProducts = Product::where('sub_category_id', $subCategory->id)->get();

        $uniqueColors = collect();
        $uniqueSizes = collect();

        foreach ($allProducts as $product) {
            $colors = explode(',', strtolower($product->colors));
            $sizes = explode(',', strtolower($product->sizes));

            $uniqueColors = $uniqueColors->merge(array_map('trim', $colors));
            $uniqueSizes = $uniqueSizes->merge(array_map('trim', $sizes));
        }

        $uniqueColors = $uniqueColors->unique()->sort()->values();
        $uniqueSizes = $uniqueSizes->unique()->sort()->values();

        $maincategories = MainCategory::with('subCategory')->get();
        $subCategories = SubCategory::with('products', 'mainCategory')->get();
        $offers = Offer::all();
        $partners = Partner::all();
        $socials = Social::all();
        $customerId = Auth::guard('customers')->id();
        $cartCount = Cart::where('customer_id', $customerId)->count();

        return view('all-products', compact(
            'mainCategory',
            'subCategory',
            'products',
            'offers',
            'partners',
            'socials',
            'maincategories',
            'subCategories',
            'cartCount',
            'uniqueColors',
            'uniqueSizes'
        ));
    }


    public function productDetailsView($mainSlug, $subSlug, $productSlug)
    {

        $mainCategory = MainCategory::where('slug', $mainSlug)->first();
        if (!$mainCategory) {
            abort(404, "Main category not found");
        }

        $subCategory = SubCategory::where('slug', $subSlug)
            ->where('main_category_id', $mainCategory->id)
            ->first();

        if (!$subCategory) {
            abort(404, "Sub category not found");
        }

        $product = Product::where('slug', $productSlug)
            ->where('sub_category_id', $subCategory->id)
            ->first();

        if (!$product) {
            abort(404, "Product not found");
        }

        $maincategories = MainCategory::with('subCategory')->get();
        $subCategories = SubCategory::with('products', 'mainCategory')->get();
        $offers = Offer::all();
        $partners = Partner::all();
        $socials = Social::all();

        $customerId = Auth::guard('customers')->id();
        $cartCount = Cart::where('customer_id', $customerId)->count();

        $allProducts = Product::with('subCategory', 'mainCategory')
            ->inRandomOrder()
            ->get();

        return view('product-details', compact('mainCategory', 'subCategory', 'product', 'offers', 'partners', 'socials', 'maincategories', 'subCategories', 'allProducts', 'cartCount'));
    }

    public function productCategoriesViews(Request $request)
    {
        $maincategories = MainCategory::with('subCategory')->get();
        $subCategories = SubCategory::with('products', 'mainCategory')->get();
        $offers = Offer::all();
        $partners = Partner::all();
        $socials = Social::all();
        $abouts = About::all();

        $customerId = Auth::guard('customers')->id();
        $cartCount = Cart::where('customer_id', $customerId)->count();

        $productsQuery = Product::with(['subCategory.mainCategory']);

        // Apply main category filters if available
        if ($request->has('main_categories')) {
            $mainCategoryIds = $request->main_categories;

            $productsQuery->whereHas('subCategory.mainCategory', function ($query) use ($mainCategoryIds) {
                $query->whereIn('id', $mainCategoryIds);
            });
        }

        $products = $productsQuery->latest()->paginate(12)->withQueryString();

        return view('products-categories', compact(
            'maincategories',
            'subCategories',
            'offers',
            'partners',
            'socials',
            'abouts',
            'cartCount',
            'products'
        ));
    }


    public function blogsView()
    {
        $maincategories = MainCategory::with('subCategory')->get();
        $subCategories = SubCategory::with('products', 'mainCategory')->get();
        $offers = Offer::all();
        $partners = Partner::all();
        $socials = Social::all();
        $abouts = About::all();
        $blogs = Blog::all();
        $lastOneBlog = Blog::latest()->first();

        $customerId = Auth::guard('customers')->id();
        $cartCount = Cart::where('customer_id', $customerId)->count();

        return view('blogs', compact('maincategories', 'subCategories', 'offers', 'partners', 'socials', 'abouts', 'blogs', 'lastOneBlog', 'cartCount'));
    }

    public function blogDetailsView($blogSlug)
    {
        $blog = Blog::where('slug', $blogSlug)->first();
        if (!$blog) {
            abort(404, "Blog not found");
        }

        $maincategories = MainCategory::with('subCategory')->get();
        $subCategories = SubCategory::with('products', 'mainCategory')->get();
        $offers = Offer::all();
        $partners = Partner::all();
        $socials = Social::all();
        $abouts = About::all();
        $blogs = Blog::all();
        $lastOneBlog = Blog::latest()->first();

        $customerId = Auth::guard('customers')->id();
        $cartCount = Cart::where('customer_id', $customerId)->count();

        return view('blog-details', compact('blog', 'maincategories', 'subCategories', 'offers', 'partners', 'socials', 'abouts', 'lastOneBlog', 'blogs', 'cartCount'));
    }

    public function faqView()
    {
        $maincategories = MainCategory::with('subCategory')->get();
        $subCategories = SubCategory::with('products', 'mainCategory')->get();
        $offers = Offer::all();
        $partners = Partner::all();
        $socials = Social::all();
        $abouts = About::all();
        $blogs = Blog::all();
        $lastOneBlog = Blog::latest()->first();
        $faqs = Faq::all();

        $customerId = Auth::guard('customers')->id();
        $cartCount = Cart::where('customer_id', $customerId)->count();

        return view('faq', compact('maincategories', 'subCategories', 'offers', 'partners', 'socials', 'abouts', 'lastOneBlog', 'blogs', 'faqs', 'cartCount'));
    }

    public function contactView()
    {
        $maincategories = MainCategory::with('subCategory')->get();
        $subCategories = SubCategory::with('products', 'mainCategory')->get();
        $offers = Offer::all();
        $partners = Partner::all();
        $socials = Social::all();
        $abouts = About::all();

        $customerId = Auth::guard('customers')->id();
        $cartCount = Cart::where('customer_id', $customerId)->count();

        return view('contact', compact('maincategories', 'subCategories', 'offers', 'partners', 'socials', 'abouts', 'cartCount'));
    }


    public function contactFormSend(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        $contact = Contact::create($validated);

        // Send confirmation mail to user
        Mail::to($validated['email'])->send(new ContactConfirmationMail($validated));

        return redirect()->route('customer.contact')->with('success', 'Your message has been sent successfully.');
    }

    public function cartView()
    {
        $maincategories = MainCategory::with('subCategory')->get();
        $subCategories = SubCategory::with('products', 'mainCategory')->get();
        $offers = Offer::all();
        $partners = Partner::all();
        $socials = Social::all();
        $abouts = About::all();

        $customerId = Auth::guard('customers')->id();
        $customer = Auth::guard('customers')->user();


        $cartItems = Cart::with('product')
            ->where('customer_id', $customerId)
            ->get();

        $totalQuantity = 0;
        $totalRate = 0;
        $totalAmount = 0;

        foreach ($cartItems as $item) {
            $qty = $item->quantity;
            $price = $item->product->selling_price ?? 0;

            $totalQuantity += $qty;
            $totalRate += $price;
            $totalAmount += $price * $qty;
        }

        $cartCount = Cart::where('customer_id', $customerId)->count();

        return view('cart', compact(
            'maincategories',
            'subCategories',
            'offers',
            'partners',
            'socials',
            'abouts',
            'cartItems',
            'cartCount',
            'customer',
            'totalQuantity',
            'totalRate',
            'totalAmount'
        ));
    }


    public function addToCart(Request $request)
    {
        // First find the product to know min_purchase
        $product = Product::findOrFail($request->product_id);

        // Validate using product's min_purchase
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:' . $product->min_purchase,
            'size' => 'nullable|string',
            'color' => 'nullable|string',
        ], [
            'quantity.min' => 'The minimum purchase quantity for this product is ' . $product->min_purchase . '.',
        ]);


        $customerId = Auth::guard('customers')->id();

        $exists = Cart::where('customer_id', $customerId)
            ->where('product_id', $request->product_id)
            ->where('size', $request->size)
            ->where('color', $request->color)
            ->exists();

        if ($exists) {
            return redirect()->back()->with('error', 'This product (same size & color) is already in your cart.');
        }

        Cart::create([
            'customer_id' => $customerId,
            'product_id' => $request->product_id,
            'quantity' => $request->quantity,
            'size' => $request->size,
            'color' => $request->color,
        ]);

        return redirect()->back()->with('success', 'Product added to cart!');
    }


    public function removeFromCart(Request $request)
    {
        $customerId = Auth::guard('customers')->id();
        Cart::where('customer_id', $customerId)->where('id', $request->cart_id)->delete();
        return redirect()->back()->with('success', 'Product removed from cart!');
    }

    public function submitCartEnquiry(Request $request)
    {
        $customerId = Auth::guard('customers')->id();
        $customerEmail = Auth::guard('customers')->user()->email;
        $customerName = Auth::guard('customers')->user()->name;

        $cartItems = Cart::with('product')->where('customer_id', $customerId)->get();

        if ($cartItems->isEmpty()) {
            return redirect()->back()->with('error', 'Your cart is empty.');
        }

        $enquiryProducts = [];
        $overallAmount = 0;

        foreach ($cartItems as $item) {
            $product = $item->product;
            $totalAmount = $product->selling_price * $item->quantity;

            $enquiryProducts[] = [
                'product_name' => $product->product_name,
                'product_code' => $product->product_code,
                'product_color' => $item->color,
                'product_rate' => $product->selling_price,
                'enquiry_size' => $item->size,
                'product_quantity' => $item->quantity,
                'total_amount' => $totalAmount,
            ];

            $overallAmount += $totalAmount;
        }

        // Save the enquiry in DB
        $enquiry = CartEnquiry::create([
            'customer_id' => $customerId,
            'customer_name' => $customerName,
            'customer_email' => $customerEmail,
            'enquiry_data' => json_encode($enquiryProducts),
            'overall_amount' => $overallAmount,
            'enquiry_date' => now()->toDateString(),
        ]);

        // Prepare data for email
        $enquiryData = [
            'customer_id' => $customerId,
            'customer_email' => $customerEmail,
            'customer_name' => $customerName,
            'products' => $enquiryProducts,
            'overall_amount' => $overallAmount,
            'enquiry_date' => $enquiry->enquiry_date,
        ];

        // Send email
        Mail::to('info@aleefpro.com')->send(new CustomerCartEnquiryMail($enquiryData));

        Mail::to($customerEmail)->send(new CustomerCartEnquiryRecieverMail($enquiryData));

        // Clear cart after enquiry
        Cart::where('customer_id', $customerId)->delete();

        return redirect()->back()->with('success', 'Enquiry submitted successfully!');
    }

    public function profileView()
    {
        $maincategories = MainCategory::with('subCategory')->get();
        $subCategories = SubCategory::with('products', 'mainCategory')->get();
        $offers = Offer::all();
        $partners = Partner::all();
        $socials = Social::all();
        $abouts = About::all();

        $customerId = Auth::guard('customers')->id();
        $cartCount = Cart::where('customer_id', $customerId)->count();

        // Get the authenticated customer
        $customer = Auth::guard('customers')->user();

        return view('profile', compact(
            'maincategories',
            'subCategories',
            'offers',
            'partners',
            'socials',
            'abouts',
            'customer',
            'cartCount'
        ));
    }

    public function updateProfile(Request $request)
    {
        $customer = Auth::guard('customers')->user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:customers,email,' . $customer->id,
            'mobile' => 'required|string|max:15',
            'address' => 'required|string',
        ]);

        try {
            $customer->update($request->only('name', 'email', 'mobile', 'address'));

            return redirect()->back()->with('success', 'Profile updated successfully.');
        } catch (QueryException $e) {
            return redirect()->back()->withErrors(['general' => 'Something went wrong. Please try again.']);
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['general' => 'Unexpected error. Contact support if this continues.']);
        }
    }

    public function updatePassword(Request $request)
    {
        $customer = Auth::guard('customers')->user();

        $request->validate([
            'current_password' => 'required|string',
            'new_password' => 'required|string|min:8|confirmed',
        ]);

        if (!Hash::check($request->current_password, $customer->password)) {
            return redirect()->back()->withErrors(['current_password' => 'Current password is incorrect.']);
        }

        try {
            $customer->update(['password' => Hash::make($request->new_password)]);

            // Send email
            $enquiryData = [
                'name' => $customer->name,
                'email' => $customer->email,
            ];

            Mail::to($customer->email)->send(new UpdatePasswordMail($enquiryData));

            return redirect()->back()->with('success', 'Password updated successfully.');
        } catch (QueryException $e) {
            return redirect()->back()->withErrors(['general' => 'Something went wrong. Please try again.']);
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['general' => 'Unexpected error. Contact support if this continues.']);
        }
    }

    public function resetPasswordView()
    {
        $maincategories = MainCategory::with('subCategory')->get();
        $subCategories = SubCategory::with('products', 'mainCategory')->get();
        $offers = Offer::all();
        $partners = Partner::all();
        $socials = Social::all();
        $abouts = About::all();

        return view('reset-password', compact('maincategories', 'subCategories', 'offers', 'partners', 'socials', 'abouts'));
    }

    public function sendOtp(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $customer = Customer::where('email', $request->email)->first();
        if (!$customer) {
            return redirect()->back()->with('error', 'Customer not exist.');
        }

        $otp = rand(100000, 999999);
        $customer->otp = $otp;
        $customer->save();

        Mail::to($customer->email)->send(new CustomerPasswordResetOtpMail($customer->name, $otp));

        return redirect()->back()->with('success', 'OTP sent successfully.');
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'otp' => 'required',
            'new_password' => 'required|string|min:8|confirmed',
        ]);

        $customer = Customer::where('email', $request->email)
            ->where('otp', $request->otp)
            ->first();

        if (!$customer) {
            return back()->withErrors(['otp' => 'Invalid OTP or email.']);
        }

        $customer->password = Hash::make($request->new_password);
        $customer->otp = null; // clear OTP after use
        $customer->save();

        return redirect()->route('customer.login')->with('success', 'Password reset successful.');
    }

    public function productEnquiryView($mainSlug, $subSlug, $productSlug)
    {
        $maincategories = MainCategory::with('subCategory')->get();
        $subCategories = SubCategory::with('products', 'mainCategory')->get();
        $offers = Offer::all();
        $partners = Partner::all();
        $socials = Social::all();
        $abouts = About::all();
        $customer = Auth::guard('customers')->user();

        $customerId = Auth::guard('customers')->id();
        $cartCount = Cart::where('customer_id', $customerId)->count();

        $colors = Color::all();

        $product = Product::where('slug', $productSlug)
            ->whereHas('subCategory', function ($q) use ($subSlug, $mainSlug) {
                $q->where('slug', $subSlug)
                    ->whereHas('mainCategory', function ($q2) use ($mainSlug) {
                        $q2->where('slug', $mainSlug);
                    });
            })
            ->with('subCategory.mainCategory')
            ->firstOrFail();

        return view('product-enquiry', compact(
            'maincategories',
            'subCategories',
            'offers',
            'partners',
            'socials',
            'abouts',
            'cartCount',
            'product',
            'customer',
            'colors'
        ));
    }

    public function productEnquirySend(Request $request)
    {
        $validated = $request->validate([
            'product_name'     => 'required|string|max:255',
            'product_code'     => 'required|string|max:255',
            'price'            => 'required|numeric',
            'main_sub_category'    => 'required|string|max:255',
            'colors'           => 'nullable|string',
            'sizes'            => 'nullable|string',
            'units'            => 'required|numeric',
            'customer_name'    => 'required|string|max:255',
            'customer_email'   => 'required|email',
            'customer_mobile'  => 'required|string|max:15',
            'customer_address' => 'required|string',
            'detail_enquiry'   => 'nullable|string',
        ]);

        $validated['enquiry_date'] = now();
        $enquiry = ProductEnquiry::create($validated);

        // Prepare email data
        $mailData = [
            'product_name'     => $enquiry->product_name,
            'product_code'     => $enquiry->product_code,
            'main_sub_category' => $enquiry->main_sub_category,
            'product_color'    => $enquiry->colors,
            'enquiry_size'     => $enquiry->sizes,
            'product_rate'     => $enquiry->price,
            'product_quantity' => $enquiry->units,
            'total_amount'     => $enquiry->price * $enquiry->units,
            'customer_name'    => $enquiry->customer_name,
            'customer_email'   => $enquiry->customer_email,
            'customer_mobile'  => $enquiry->customer_mobile,
            'customer_address' => $enquiry->customer_address,
            'detail_enquiry'   => $enquiry->detail_enquiry,
        ];

        // Send email to customer
        Mail::to($enquiry->customer_email)->send(new ProductEnquiryMail($mailData));

        // Send email to admin
        Mail::to('info@aleefpro.com')->send(new ProductEnquiryMailSender($mailData));

        return redirect()->back()->with('success', 'Enquiry submitted and email sent successfully.');
    }

    public function productCustomizationEnquiryView($mainSlug, $subSlug, $productSlug)
    {
        $maincategories = MainCategory::with('subCategory')->get();
        $subCategories = SubCategory::with('products', 'mainCategory')->get();
        $offers = Offer::all();
        $partners = Partner::all();
        $socials = Social::all();
        $abouts = About::all();
        $customer = Auth::guard('customers')->user();

        $customerId = Auth::guard('customers')->id();
        $cartCount = Cart::where('customer_id', $customerId)->count();

        $product = Product::where('slug', $productSlug)
            ->whereHas('subCategory', function ($q) use ($subSlug, $mainSlug) {
                $q->where('slug', $subSlug)
                    ->whereHas('mainCategory', function ($q2) use ($mainSlug) {
                        $q2->where('slug', $mainSlug);
                    });
            })
            ->with('subCategory.mainCategory')
            ->firstOrFail();

        return view('product-customization-enquiry', compact(
            'maincategories',
            'subCategories',
            'offers',
            'partners',
            'socials',
            'abouts',
            'cartCount',
            'customer',
            'product'
        ));
    }

public function productCustomizationEnquirySend(Request $request)
{
    // Normalize numeric-like inputs BEFORE validation
    // Remove commas, currency symbols and spaces from price
    if ($request->has('price')) {
        $priceRaw = (string) $request->input('price');
        $normalizedPrice = str_replace([',', '₹', '$', ' '], '', $priceRaw);
        $request->merge(['price' => $normalizedPrice]);
    }

    try {
        $validated = $request->validate([
            'company_logo'             => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:5048',
            'product_customize_image'  => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:5048',
            'logo_placement'           => 'required|string|max:255',
            'logo_type'                => 'required|string|in:image,text,both',
            'logo_size'                => 'required|string|max:255',
            'print_quality'            => 'required|string|max:255',
            'product_name'             => 'required|string|max:255',
            'product_code'             => 'required|string|max:255',
            'price'                    => 'required|numeric',
            'main_sub_category'        => 'required|string|max:255',
            'colors'                   => 'nullable|string',
            'sizes'                    => 'nullable|string',
            'units'                    => 'required|numeric',
            'customer_name'            => 'required|string|max:255',
            'customer_email'           => 'required|email',
            'customer_mobile'          => 'required|string|max:15',
            'customer_address'         => 'required|string',
            'detail_enquiry'           => 'nullable|string',
            'font_name'                => 'nullable|string',
            'company_text_logo'        => 'nullable|string',
            'company_text_color_code'  => 'nullable|string',
            'logo_position_x'          => 'nullable|numeric',
            'logo_position_y'          => 'nullable|numeric',
            'logo_rotation'            => 'nullable|numeric',
            'logo_width'               => 'nullable|numeric',
            'logo_height'              => 'nullable|numeric',
            'text_logo_position_x'     => 'nullable|numeric',
            'text_logo_position_y'     => 'nullable|numeric',
            'text_logo_rotation'       => 'nullable|numeric',
            'text_logo_width'          => 'nullable|numeric',
            'text_logo_height'         => 'nullable|numeric',
        ]);

        // Conditionally nullify fields based on logo_type
        if ($validated['logo_type'] === 'image') {
            $validated['font_name'] = null;
            $validated['company_text_logo'] = null;
            $validated['company_text_color_code'] = null;
            $validated['text_logo_position_x'] = null;
            $validated['text_logo_position_y'] = null;
            $validated['text_logo_rotation'] = null;
            $validated['text_logo_width'] = null;
            $validated['text_logo_height'] = null;
        } elseif ($validated['logo_type'] === 'text') {
            $validated['company_logo'] = null;
            $validated['logo_position_x'] = null;
            $validated['logo_position_y'] = null;
            $validated['logo_rotation'] = null;
            $validated['logo_width'] = null;
            $validated['logo_height'] = null;
        }

        // Upload files
        $attachments = [];

        if ($request->hasFile('company_logo') && ($validated['logo_type'] === 'image' || $validated['logo_type'] === 'both')) {
            $file = $request->file('company_logo');
            $filename = time() . '_company_' . $file->getClientOriginalName();
            $path = $file->storeAs('enquiry/company_logos', $filename, 'public');
            $validated['company_logo'] = $path;

            $attachments[] = [
                'file' => storage_path('app/public/' . $path),
                'options' => [
                    'as' => basename($path),
                    'mime' => $file->getMimeType() ?? 'image/webp'
                ]
            ];
        }

        if ($request->hasFile('product_customize_image')) {
            $file = $request->file('product_customize_image');
            $filename = time() . '_customize_' . $file->getClientOriginalName();
            $path = $file->storeAs('enquiry/company_logos', $filename, 'public');
            $validated['product_customize_image'] = $path;

            $attachments[] = [
                'file' => storage_path('app/public/' . $path),
                'options' => [
                    'as' => basename($path),
                    'mime' => $file->getMimeType() ?? 'image/webp'
                ]
            ];
        }

        $validated['enquiry_date'] = now();

        $enquiry = CustomEnquiry::create($validated);

        $mailData = [
            'product_name'     => $validated['product_name'],
            'product_code'     => $validated['product_code'],
            'main_sub_category' => $validated['main_sub_category'],
            'product_color'    => $validated['colors'] ?? '-',
            'enquiry_size'     => $validated['sizes'] ?? '-',
            'product_rate'     => $validated['price'],
            'product_quantity' => $validated['units'],
            'total_amount'     => $validated['price'] * $validated['units'],
            'customer_name'    => $validated['customer_name'],
            'customer_email'   => $validated['customer_email'],
            'customer_mobile'  => $validated['customer_mobile'],
            'customer_address' => $validated['customer_address'],
            'detail_enquiry'   => $validated['detail_enquiry'] ?? 'N/A',

            'company_logo' => $validated['company_logo'] ?? null,
            'product_customize_image' => $validated['product_customize_image'] ?? null,
            'logo_placement' => $validated['logo_placement'],
            'logo_type' => $validated['logo_type'],
            'logo_size' => $validated['logo_size'],
            'print_quality' => $validated['print_quality'],
            'font_name' => $validated['font_name'] ?? null,
            'company_text_logo' => $validated['company_text_logo'] ?? null,
            'company_text_color_code' => $validated['company_text_color_code'] ?? null,
            'logo_position_data' => [
                'image' => [
                    'x' => $validated['logo_position_x'] ?? null,
                    'y' => $validated['logo_position_y'] ?? null,
                    'rotation' => $validated['logo_rotation'] ?? null,
                    'width' => $validated['logo_width'] ?? null,
                    'height' => $validated['logo_height'] ?? null,
                ],
                'text' => [
                    'x' => $validated['text_logo_position_x'] ?? null,
                    'y' => $validated['text_logo_position_y'] ?? null,
                    'rotation' => $validated['text_logo_rotation'] ?? null,
                    'width' => $validated['text_logo_width'] ?? null,
                    'height' => $validated['text_logo_height'] ?? null,
                ]
            ]
        ];

        Mail::to($validated['customer_email'])->send(new CustomizeEnquiryRecieverMail($mailData, $attachments));
        Mail::to('info@aleefpro.com')->send(new CustomizeEnquirySenderMail($mailData, $attachments));

        return redirect()->back()->with('success', 'Customization enquiry submitted and email sent successfully.');

    } catch (ValidationException $ve) {
        // Return validation errors to the form so @error / $errors work
        return redirect()->back()->withErrors($ve->validator)->withInput();
    } catch (\Throwable $e) {
        // Log the error (very useful in production)
        \Log::error('Customization enquiry error: '.$e->getMessage(), ['exception' => $e]);
        return redirect()->back()->with('error', 'Something went wrong: ' . $e->getMessage());
    }
}


    public function searchProducts(Request $request)
    {

        $maincategories = MainCategory::with('subCategory')->get();
        $subCategories = SubCategory::with('products', 'mainCategory')->get();
        $offers = Offer::all();
        $partners = Partner::all();
        $socials = Social::all();
        $abouts = About::all();
        $customer = Auth::guard('customers')->user();

        $customerId = Auth::guard('customers')->id();
        $cartCount = Cart::where('customer_id', $customerId)->count();

        $search = strtolower(trim($request->input('query')));

        if (empty($search)) {
            return redirect()->back()->with('error', 'Please enter a search term.');
        }

        $products = Product::whereRaw('LOWER(product_name) LIKE ?', ["%$search%"])
            ->orWhereHas('subCategory', function ($q) use ($search) {
                $q->whereRaw('LOWER(sub_category_name) LIKE ?', ["%$search%"])
                    ->orWhereHas('mainCategory', function ($q2) use ($search) {
                        $q2->whereRaw('LOWER(main_category_name) LIKE ?', ["%$search%"]);
                    });
            })
            ->get();

        return view('search-products', compact('products', 'search', 'maincategories', 'subCategories', 'offers', 'partners', 'socials', 'abouts', 'cartCount', 'customer'));
    }

    public function downloadCatelogue()
    {
        $catelogue = Catelogue::latest()->first();

        if (!$catelogue || !Storage::disk('public')->exists($catelogue->catelogue)) {
            return response()->json(['error' => 'Catalogue not found.'], 404);
        }

        $filePath = storage_path('app/public/' . $catelogue->catelogue);
        return response()->download($filePath);
    }


    // Payment
    public function process(Request $request)
    {
        Stripe::setApiKey(config('services.stripe.secret'));

        $customerId = Auth::guard('customers')->id();
        $customerEmail = Auth::guard('customers')->user()->email;
        $customerName = Auth::guard('customers')->user()->name;

        // Fetch cart items
        $cartItems = Cart::with('product')->where('customer_id', $customerId)->get();

        if ($cartItems->isEmpty()) {
            return redirect()->back()->with('error', 'Your cart is empty.');
        }

        // Build product details & calculate amount
        $productDetails = [];
        $overallAmount = 0;

        foreach ($cartItems as $item) {
            $product = $item->product;
            $totalAmount = $product->selling_price * $item->quantity;

            $productDetails[] = [
                'product_name'     => $product->product_name,
                'product_code'     => $product->product_code,
                'product_color'    => $item->color,
                'product_rate'     => $product->selling_price,
                'product_size'     => $item->size,
                'product_quantity' => $item->quantity,
                'total_amount'     => $totalAmount,
            ];

            $overallAmount += $totalAmount;
        }

        try {
            // Stripe requires amount in cents
            $amountInCents = intval($overallAmount * 100);

            // Create Stripe charge
            $charge = Charge::create([
                'amount'      => $amountInCents,
                'currency'    => 'usd',
                'source'      => $request->stripeToken,
                'description' => 'Cart Purchase by ' . $customerName,
            ]);

            // Save order
            $order  = Order::create([
                'customer_id'     => $customerId,
                'product_details' => $productDetails,
                'overall_amount'  => $overallAmount,
                'payment_id'      => $charge->id,
                'amount'          => $charge->amount / 100,
                'currency'        => $charge->currency,
                'payment_status'  => $charge->status,
                'shipment_status' => 'pending',
                'order_date'      => now(),
            ]);


            // Now update with unique order_id
            $order->update([
                'order_id' => 'ORD-ALP-' . $order->id
            ]);

            // Order Placed Email
            Mail::to($customerEmail)->send(new OrderPlacedMail($order));
            Mail::to('info@aleefpro.com')->send(new OrderPlacedMail($order));

            // Clear cart
            Cart::where('customer_id', $customerId)->delete();

            return redirect()->back()->with('success', 'Payment Successful!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    // Order History
    public function ordersView(Request $request)
    {
        $maincategories = MainCategory::with('subCategory')->get();
        $subCategories = SubCategory::with('products', 'mainCategory')->get();
        $offers = Offer::all();
        $partners = Partner::all();
        $socials = Social::all();
        $abouts = About::all();
        $customer = Auth::guard('customers')->user();

        $customerId = Auth::guard('customers')->id();
        $cartCount = Cart::where('customer_id', $customerId)->count();

        $products = Product::with('subCategory', 'mainCategory')->get();
        $search = strtolower(trim($request->input('query')));


        $orders = Order::where('customer_id', Auth::id())
            ->orderBy('id', 'desc')
            ->get();


        return view('orders', compact('maincategories', 'subCategories', 'offers', 'partners', 'socials', 'abouts', 'cartCount', 'customer', 'orders', 'search'));
    }

    public function orderProductDetailsView($productCode)
    {

        $product = Product::where('product_code', $productCode)->first();

        // Check if product exists
        if (!$product) {
            return redirect()->back()->with('error', 'Product not found.');
        }

        $maincategories = MainCategory::with('subCategory')->get();
        $subCategories = SubCategory::with('products', 'mainCategory')->get();
        $offers = Offer::all();
        $partners = Partner::all();
        $socials = Social::all();

        $customerId = Auth::guard('customers')->id();
        $cartCount = Cart::where('customer_id', $customerId)->count();

        $allProducts = Product::with('subCategory', 'mainCategory')
            ->inRandomOrder()
            ->get();

        return view('order-product-details', compact('product', 'offers', 'partners', 'socials', 'maincategories', 'subCategories', 'allProducts', 'cartCount'));
    }

    public function downloadInvoice($order_id)
    {
        // Fetch the order
        $order = Order::where('order_id', $order_id)->firstOrFail();

        // If casted in model, product_details is already an array
        $products = is_array($order->product_details)
            ? $order->product_details
            : json_decode($order->product_details, true);

        // Load PDF view
        $pdf = Pdf::loadView('invoice-download', [
            'order' => $order,
            'products' => $products
        ]);

        // Download file
        return $pdf->download("Invoice-{$order->order_id}.pdf");
    }
}
