<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\OutForDeliveryMail;
use App\Mail\ProductDeliveredMail;
use App\Models\About;
use App\Models\Admin;
use App\Models\Blog;
use App\Models\Customer;
use App\Models\CartEnquiry;
use App\Models\Catelogue;
use App\Models\Color;
use App\Models\CustomEnquiry;
use App\Models\Faq;
use App\Models\MainCategory;
use App\Models\ProductEnquiry;
use App\Models\Offer;
use App\Models\Partner;
use App\Models\Contact;
use App\Models\Order;
use App\Models\Product;
use App\Models\ScrollBanners;
use App\Models\Size;
use App\Models\Social;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Response;

class AdminController extends Controller
{
    public function registerView()
    {
        return view('Admin.admin-register');
    }

    public function register(Request $request)
    {
        try {
            // Validate input
            $validated = Validator::make($request->all(), [
                'name'     => 'required|string|max:255',
                'email'    => 'required|string|email|max:255|unique:admins,email',
                'password' => 'required|string|min:6',
            ])->validate();

            // Create the admin
            Admin::create([
                'name'     => $validated['name'],
                'email'    => $validated['email'],
                'password' => bcrypt($validated['password']),
            ]);

            // Redirect on success
            return redirect()->route('admin.login')->with('success', 'Registered successfully.');
        } catch (ValidationException $e) {
            // Redirect back with validation errors
            return redirect()->back()->withErrors($e->validator)->withInput();
        } catch (QueryException $e) {
            // Log and show DB-related error (e.g., duplicate key, SQL issues)
            Log::error('DB Error during admin registration: ' . $e->getMessage());
            return redirect()->back()->withErrors(['Something went wrong. Please try again.'])->withInput();
        } catch (\Exception $e) {
            // Catch any other unexpected errors
            Log::error('Error during admin registration: ' . $e->getMessage());
            return redirect()->back()->withErrors(['Unexpected error occurred. Please try again.'])->withInput();
        }
    }
    public function loginView()
    {
        return view('Admin.admin-login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::guard('admins')->attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->route('admin.dashboard')->with('success', 'Login successful.');
        }


        return back()->withErrors([
            'email' => 'Invalid email or password.',
        ])->withInput(); // Keeps old input
    }


    public function logout(Request $request)
    {
        Auth::guard('admins')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login')->with('success', 'Logged out successfully.');
    }

    public function dashboardView()
    {
        $catelogue = Catelogue::first();
        $about = About::first();

        return view('Admin.admin-dashboard', compact('catelogue', 'about'));
    }

    // Scroll Banners==============================================================>
    public function scrollBannersView()
    {
        $scrollBanners = ScrollBanners::all();

        return view('Admin.admin-scroll-banners', compact('scrollBanners'));
    }


    public function addScrollBanner(Request $request)
    {
        // Validate image
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        // Store the image in 'public/scroll_banners' (maps to storage/app/public/scroll_banners)
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('scroll_banners', 'public'); // stores inside storage/app/public/scroll_banners

            // Save to DB
            ScrollBanners::create([
                'image' => $path, // only relative path needed
            ]);

            return back()->with('success', 'Scroll banner added successfully!');
        }

        return back()->with('error', 'Image upload failed.');
    }


    public function editScrollBanner(Request $request, $id)
    {
        // Validate image
        $request->validate([
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        // Find the banner
        $banner = ScrollBanners::findOrFail($id);

        // If a new image is uploaded
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($banner->image && Storage::disk('public')->exists($banner->image)) {
                Storage::disk('public')->delete($banner->image);
            }

            // Store new image
            $path = $request->file('image')->store('scroll_banners', 'public');
            $banner->image = $path;
        }

        $banner->save();

        return back()->with('success', 'Scroll banner updated successfully!');
    }

    public function deleteScrollBanner($id)
    {
        // Find the banner
        $banner = ScrollBanners::findOrFail($id);

        // Delete the image file if it exists
        if ($banner->image && Storage::disk('public')->exists($banner->image)) {
            Storage::disk('public')->delete($banner->image);
        }

        // Delete the banner record from the database
        $banner->delete();

        return back()->with('success', 'Scroll banner deleted successfully!');
    }

    // Offers Add==============================================================>
    public function offersAddView()
    {
        $offers = Offer::all();
        return view('Admin.admin-offers-add', compact('offers'));
    }

    public function addOffers(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
            'link' => 'nullable|string|max:255',
            'offer_percentage' => 'nullable|string|max:100',
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('offers', 'public');

            Offer::create([
                'image' => $path,
                'link' => $request->link,
                'offer_percentage' => $request->offer_percentage,
            ]);

            return back()->with('success', 'Offer added successfully!');
        }

        return back()->with('error', 'Image upload failed.');
    }

    public function editOffers(Request $request, $id)
    {
        $request->validate([
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'link' => 'nullable|string|max:255',
            'offer_percentage' => 'nullable|string|max:100',
        ]);

        $offer = Offer::findOrFail($id);

        if ($request->hasFile('image')) {
            if ($offer->image && Storage::disk('public')->exists($offer->image)) {
                Storage::disk('public')->delete($offer->image);
            }

            $path = $request->file('image')->store('offers', 'public');
            $offer->image = $path;
        }

        // Always update these fields regardless of image presence
        $offer->link = $request->link;
        $offer->offer_percentage = $request->offer_percentage;

        $offer->save();

        return back()->with('success', 'Offer updated successfully!');
    }

    public function deleteOffers($id)
    {
        // Find the banner
        $banner = Offer::findOrFail($id);

        // Delete the image file if it exists
        if ($banner->image && Storage::disk('public')->exists($banner->image)) {
            Storage::disk('public')->delete($banner->image);
        }

        // Delete the banner record from the database
        $banner->delete();

        return back()->with('success', 'Scroll banner deleted successfully!');
    }

    // Main Category==============================================================>
    public function mainCategoryView()
    {
        $maincategories = MainCategory::all();
        return view('Admin.admin-main-category', compact('maincategories'));
    }


    public function addMainCategory(Request $request)
    {
        // Validate input
        $request->validate([
            'main_category_name' => 'required|string|max:255|unique:main_categories,main_category_name',
        ]);

        // Create new main category
        MainCategory::create([
            'main_category_name' => $request->main_category_name,
            'slug' => Str::slug($request->main_category_name),
        ]);

        return back()->with('success', 'Main category added successfully!');
    }

    public function editMainCategory(Request $request, $id)
    {
        // Validate input
        $request->validate([
            'main_category_name' => 'required|string|max:255|unique:main_categories,main_category_name,' . $id,
        ]);

        // Find the main category
        $mainCategory = MainCategory::findOrFail($id);

        // Update main category
        $mainCategory->update([
            'main_category_name' => $request->main_category_name,
            'slug' => Str::slug($request->main_category_name),
        ]);

        return back()->with('success', 'Main category updated successfully!');
    }

    public function deleteMainCategory($id)
    {
        // Find the main category
        $mainCategory = MainCategory::findOrFail($id);

        // Delete the main category
        $mainCategory->delete();

        return back()->with('success', 'Main category deleted successfully!');
    }

    // Sub Category==============================================================>

    public function subCategoryView()
    {
        $subcategories = SubCategory::with('mainCategory')->get();
        $maincategories = MainCategory::get();
        return view('Admin.admin-sub-category', compact('subcategories', 'maincategories'));
    }

    public function addSubCategory(Request $request)
    {
        // Validate input
        $request->validate([
            'sub_category_name' => 'required|string|max:255|unique:sub_categories,sub_category_name',
            'main_category_id' => 'required|exists:main_categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        // Create new sub category
        SubCategory::create([
            'sub_category_name' => $request->sub_category_name,
            'main_category_id' => $request->main_category_id,
            'slug' => Str::slug($request->sub_category_name),
            'image' => $request->hasFile('image') ? $request->file('image')->store('sub_categories', 'public') : null,
        ])->save();
        return back()->with('success', 'Sub category added successfully!');
    }

    public function editSubCategory(Request $request, $id)
    {
        // Validate input
        $request->validate([
            'sub_category_name' => 'required|string|max:255|unique:sub_categories,sub_category_name,' . $id,
            'main_category_id' => 'required|exists:main_categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        // Find the subcategory
        $subCategory = SubCategory::findOrFail($id);

        // If new image is uploaded
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($subCategory->image && Storage::disk('public')->exists($subCategory->image)) {
                Storage::disk('public')->delete($subCategory->image);
            }

            // Store new image
            $newImagePath = $request->file('image')->store('sub_categories', 'public');
        } else {
            $newImagePath = $subCategory->image; // keep old image
        }

        // Update the subcategory
        $subCategory->update([
            'sub_category_name' => $request->sub_category_name,
            'main_category_id' => $request->main_category_id,
            'slug' => Str::slug($request->sub_category_name),
            'image' => $newImagePath,
        ]);

        return back()->with('success', 'Sub category updated successfully!');
    }


    public function deleteSubCategory($id)
    {
        // Find the sub category
        $subCategory = SubCategory::findOrFail($id);

        // Delete the image file if it exists
        if ($subCategory->image && Storage::disk('public')->exists($subCategory->image)) {
            Storage::disk('public')->delete($subCategory->image);
        }

        // Delete the sub category record from the database
        $subCategory->delete();

        return back()->with('success', 'Sub category deleted successfully!');
    }

    // Products==============================================================>
    public function getSubCategories(Request $request)
    {
        $subcategories = SubCategory::where('main_category_id', $request->main_category_id)->get();
        return response()->json(['subcategories' => $subcategories]);
    }

    public function productsView()
    {

        $mainCategories = MainCategory::with('subCategories')->get();
        $subCategories = SubCategory::with('mainCategory')->get();
        $products = Product::with('subCategory')->get();
        $colors = Color::all();
        $sizes = Size::all();

        return view('Admin.admin-products', compact('mainCategories', 'products', 'subCategories', 'colors', 'sizes'));
    }


    public function addProduct(Request $request)
    {
        try {
            // Validation with custom messages
            $request->validate([
                'sub_category_id' => 'required|exists:sub_categories,id',
                'product_name' => 'required|string|max:255|unique:products,product_name',
                'product_code' => 'required|string|max:255|unique:products,product_code',
                'images.*' => 'nullable|image',
                'sizes' => 'nullable|string',
                'colors' => 'nullable|string',
                'actual_price' => 'required|numeric',
                'selling_price' => 'required|numeric',
                'description' => 'nullable|string',
                'front_selected_cords' => 'nullable|string',
                'back_selected_cords' => 'nullable|string',
                'information' => 'nullable|string',
                'size_chart_image' => 'nullable|image',
                'front_customize' => 'nullable|image',
                'back_customize' => 'nullable|image',
                'min_purchase' => 'nullable|integer|min:1',
            ], [
                'product_name.unique' => 'Product name already exists. Please use a different name like "Safety Jacket | Green | Sale Type".',
                'product_code.unique' => 'Product code already exists. Use a unique code for this product.',
            ]);

            // Initialize file paths
            $imagePaths = [];
            $sizeChartPath = $frontCustomizePath = $backCustomizePath = null;

            // Handle multiple product images
            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $file) {
                    $filename = time() . '_' . $file->getClientOriginalName();
                    $path = $file->storeAs('products/images', $filename, 'public');
                    $imagePaths[] = $path;
                }
            }

            // Size chart image
            if ($request->hasFile('size_chart_image')) {
                $file = $request->file('size_chart_image');
                $filename = time() . '_' . $file->getClientOriginalName();
                $sizeChartPath = $file->storeAs('products/size_charts', $filename, 'public');
            }

            // Front customize image
            if ($request->hasFile('front_customize')) {
                $file = $request->file('front_customize');
                $filename = time() . '_' . $file->getClientOriginalName();
                $frontCustomizePath = $file->storeAs('products/front_customize', $filename, 'public');
            }

            // Back customize image
            if ($request->hasFile('back_customize')) {
                $file = $request->file('back_customize');
                $filename = time() . '_' . $file->getClientOriginalName();
                $backCustomizePath = $file->storeAs('products/back_customize', $filename, 'public');
            }

            // Save product to database
            Product::create([
                'sub_category_id' => $request->sub_category_id,
                'product_name' => $request->product_name,
                'product_code' => $request->product_code,
                'images' => json_encode($imagePaths),
                'sizes' => $request->sizes,
                'colors' => $request->colors,
                'actual_price' => $request->actual_price,
                'selling_price' => $request->selling_price,
                'description' => $request->description,
                'front_selected_cords' => $request->front_selected_cords,
                'back_selected_cords' => $request->back_selected_cords,
                'information' => $request->information,
                'size_chart_image' => $sizeChartPath,
                'slug' => Str::slug($request->product_name),
                'front_customize' => $frontCustomizePath,
                'back_customize' => $backCustomizePath,
                'min_purchase' => $request->min_purchase,
            ]);

            return back()->with('success', 'Product saved successfully.');
        } catch (\Illuminate\Validation\ValidationException $e) {
            return back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            return back()->with('error', 'Something went wrong: ' . $e->getMessage())->withInput();
        }
    }



    public function editProduct(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        // 1. Validation
        $request->validate([
            'sub_category_id' => 'required|exists:sub_categories,id',
            'product_name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('products', 'product_name')->ignore($product->id),
            ],
            'product_code' => [
                'required',
                'string',
                'max:255',
                Rule::unique('products', 'product_code')->ignore($product->id),
            ],
            'images.*' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'front_customize' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'back_customize' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'size_chart_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'sizes' => 'nullable|string',
            'colors' => 'nullable|string',
            'actual_price' => 'required|numeric',
            'selling_price' => 'required|numeric',
            'description' => 'nullable|string',
            'information' => 'nullable|string',
            'stock_status' => 'required|in:stock,out_of_stock',
            'min_purchase' => 'nullable|integer|min:1',
        ], [
            'product_name.unique' => 'A product with this name already exists.',
            'product_code.unique' => 'A product with this code already exists.',
        ]);

        // 2. Handle Deleted Images
        $deletedImages = json_decode($request->deleted_images ?? '[]', true);
        $oldImages = json_decode($product->images ?? '[]', true);

        if (!empty($deletedImages)) {
            foreach ($deletedImages as $img) {
                if (in_array($img, $oldImages)) {
                    Storage::disk('public')->delete($img);
                    $oldImages = array_diff($oldImages, [$img]);
                }
            }
        }

        // 3. Add New Images
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $file) {
                $filename = time() . '_' . $file->getClientOriginalName();
                $path = $file->storeAs('products/images', $filename, 'public');
                $oldImages[] = $path;
            }
        }

        $imagePaths = array_values($oldImages); // final image array

        // 4. Front Image
        $frontCustomizePath = $product->front_customize;
        if ($request->hasFile('front_customize')) {
            if ($frontCustomizePath) {
                Storage::disk('public')->delete($frontCustomizePath);
            }
            $file = $request->file('front_customize');
            $filename = time() . '_' . $file->getClientOriginalName();
            $frontCustomizePath = $file->storeAs('products/front_customize', $filename, 'public');
        }

        // 5. Back Image
        $backCustomizePath = $product->back_customize;
        if ($request->hasFile('back_customize')) {
            if ($backCustomizePath) {
                Storage::disk('public')->delete($backCustomizePath);
            }
            $file = $request->file('back_customize');
            $filename = time() . '_' . $file->getClientOriginalName();
            $backCustomizePath = $file->storeAs('products/back_customize', $filename, 'public');
        }

        // 6. Size Chart Image
        $sizeChartPath = $product->size_chart_image;
        if ($request->hasFile('size_chart_image')) {
            if ($sizeChartPath) {
                Storage::disk('public')->delete($sizeChartPath);
            }
            $file = $request->file('size_chart_image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $sizeChartPath = $file->storeAs('products/size_charts', $filename, 'public');
        }

        // 7. Update Product
        $product->update([
            'sub_category_id' => $request->sub_category_id,
            'product_name' => $request->product_name,
            'product_code' => $request->product_code,
            'images' => json_encode($imagePaths),
            'front_customize' => $frontCustomizePath,
            'back_customize' => $backCustomizePath,
            'size_chart_image' => $sizeChartPath,
            'sizes' => $request->sizes,
            'colors' => $request->colors,
            'actual_price' => $request->actual_price,
            'selling_price' => $request->selling_price,
            'description' => $request->description,
            'information' => $request->information,
            'stock_status' => $request->stock_status,
            'min_purchase' => $request->min_purchase,
            'slug' => Str::slug($request->product_name),
        ]);

        return back()->with('success', 'Product updated successfully.');
    }


    public function deleteProduct($id)
    {
        $product = Product::find($id);
        if ($product) {
            $images = json_decode($product->images ?? '[]', true);
            foreach ($images as $image) {
                Storage::disk('public')->delete($image);
            }
            if ($product->size_chart_image) {
                Storage::disk('public')->delete($product->size_chart_image);
            }
            $product->delete();
            return back()->with('success', 'Product deleted successfully.');
        }
        return back()->with('error', 'Product not found.');
    }

    // Blogs==============================================================>
    public function blogsView()
    {
        $blogs = Blog::all();
        return view('Admin.admin-blogs', compact('blogs'));
    }

    public function addBlog(Request $request)
    {

        $request->validate([
            'blog_name' => 'required|string|max:255',
            'description' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp',
        ]);


        Blog::create([
            'blog_name' => $request->blog_name,
            'description' => $request->description,
            'slug' => Str::slug($request->blog_name),
            'posted_date' => now(),
            'image' => $request->hasFile('image') ? $request->file('image')->store('blogs', 'public') : null,
        ])->save();
        return back()->with('success', 'Blog added successfully!');
    }

    public function editBlog(Request $request, $id)
    {
        // Validate input
        $request->validate([
            'blog_name' => 'required|string|max:255',
            'description' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp',
        ]);

        $blog = Blog::findOrFail($id);

        // If new image is uploaded
        if ($request->hasFile('image')) {

            if ($blog->image && Storage::disk('public')->exists($blog->image)) {
                Storage::disk('public')->delete($blog->image);
            }

            // Store new image
            $newImagePath = $request->file('image')->store('blogs', 'public');
        } else {
            $newImagePath = $blog->image; // keep old image
        }

        // Update the subcategory
        $blog->update([
            'blog_name' => $request->blog_name,
            'description' => $request->description,
            'slug' => Str::slug($request->blog_name),
            'posted_date' => now(),
            'image' => $newImagePath,
        ]);

        return back()->with('success', 'Blog updated successfully!');
    }

    public function deleteBlog($id)
    {
        // Find the blog
        $blog = Blog::findOrFail($id);

        // Delete the image file if it exists
        if ($blog->image && Storage::disk('public')->exists($blog->image)) {
            Storage::disk('public')->delete($blog->image);
        }


        $blog->delete();

        return back()->with('success', 'Blog deleted successfully!');
    }

    // Customers==============================================================>
    public function customersView()
    {

        $users = Customer::all();
        return view('Admin.admin-users', compact('users'));
    }

    public function deleteCustomer($id)
    {

        $users = Customer::findOrFail($id);

        $users->delete();

        return back()->with('success', 'User deleted successfully!');
    }

    // Partners==============================================================>
    public function partnersView()
    {

        $partners = Partner::all();
        return view('Admin.admin-partners', compact('partners'));
    }

    public function addPartner(Request $request)
    {

        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,webp',
        ]);
        $partner = new Partner();
        $partner->image = $request->file('image')->store('partners', 'public');
        $partner->save();

        return back()->with('success', 'Partner added successfully!');
    }

    public function editPartner(Request $request, $id)
    {
        $partner = Partner::findOrFail($id);

        $request->validate([
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp',
        ]);

        if ($request->hasFile('image')) {
            if ($partner->image && Storage::disk('public')->exists($partner->image)) {
                Storage::disk('public')->delete($partner->image);
            }
            $partner->image = $request->file('image')->store('partners', 'public');
        }

        $partner->save();

        return back()->with('success', 'Partner updated successfully!');
    }

    public function deletePartner($id)
    {
        $partner = Partner::findOrFail($id);
        if ($partner->image && Storage::disk('public')->exists($partner->image)) {
            Storage::disk('public')->delete($partner->image);
        }
        $partner->delete();
        return back()->with('success', 'Partner deleted successfully!');
    }

    // About Page =============================================================>
    public function aboutView()
    {
        $abouts = About::all();
        return view('Admin.admin-about', compact('abouts'));
    }

    public function addAboutUs(Request $request)
    {
        $request->validate([
            'header_logo' => 'nullable|image|mimes:jpeg,png,jpg,webp',
            'footer_logo' => 'nullable|image|mimes:jpeg,png,jpg,webp',
            'breadcrumb' => 'nullable|image|mimes:jpeg,png,jpg,webp',
            'side_image' => 'nullable|image|mimes:jpeg,png,jpg,webp',
            'map_iframe_view' => 'required',
            'moto' => 'required',
            'vision' => 'required',
        ]);


        About::create([
            'header_logo' => $request->hasFile('header_logo') ? $request->file('header_logo')->store('abouts', 'public') : null,
            'footer_logo' => $request->hasFile('footer_logo') ? $request->file('footer_logo')->store('abouts', 'public') : null,
            'breadcrumb' => $request->hasFile('breadcrumb') ? $request->file('breadcrumb')->store('abouts', 'public') : null,
            'side_image' => $request->hasFile('side_image') ? $request->file('side_image')->store('abouts', 'public') : null,
            'map_iframe_view' => $request->map_iframe_view,
            'moto' => $request->moto,
            'vision' => $request->vision,

        ])->save();
        return back()->with('success', 'About detaila added successfully!');
    }

    public function editAboutUs(Request $request, $id)
    {
        $about = About::findOrFail($id);

        $request->validate([
            'header_logo' => 'nullable|image|mimes:jpeg,png,jpg,webp',
            'footer_logo' => 'nullable|image|mimes:jpeg,png,jpg,webp',
            'breadcrumb' => 'nullable|image|mimes:jpeg,png,jpg,webp',
            'side_image' => 'nullable|image|mimes:jpeg,png,jpg,webp',
            'map_iframe_view' => 'required',
            'moto' => 'required',
            'vision' => 'required',
        ]);

        if ($request->hasFile('header_logo')) {
            if ($about->header_logo && Storage::disk('public')->exists($about->header_logo)) {
                Storage::disk('public')->delete($about->header_logo);
            }
            $about->header_logo = $request->file('header_logo')->store('abouts', 'public');
        }

        if ($request->hasFile('footer_logo')) {
            if ($about->footer_logo && Storage::disk('public')->exists($about->footer_logo)) {
                Storage::disk('public')->delete($about->footer_logo);
            }
            $about->footer_logo = $request->file('footer_logo')->store('abouts', 'public');
        }

        if ($request->hasFile('breadcrumb')) {
            if ($about->breadcrumb && Storage::disk('public')->exists($about->breadcrumb)) {
                Storage::disk('public')->delete($about->breadcrumb);
            }
            $about->breadcrumb = $request->file('breadcrumb')->store('abouts', 'public');
        }

        if ($request->hasFile('side_image')) {
            if ($about->side_image && Storage::disk('public')->exists($about->side_image)) {
                Storage::disk('public')->delete($about->side_image);
            }
            $about->side_image = $request->file('side_image')->store('abouts', 'public');
        }

        $about->map_iframe_view = $request->map_iframe_view;
        $about->moto = $request->moto;
        $about->vision = $request->vision;
        $about->save();

        return back()->with('success', 'About detaila updated successfully!');
    }

    public function deleteAboutUs($id)
    {
        $about = About::findOrFail($id);

        if ($about->header_logo && Storage::disk('public')->exists($about->header_logo)) {
            Storage::disk('public')->delete($about->header_logo);
        }
        if ($about->footer_logo && Storage::disk('public')->exists($about->footer_logo)) {
            Storage::disk('public')->delete($about->footer_logo);
        }
        if ($about->breadcrumb && Storage::disk('public')->exists($about->breadcrumb)) {
            Storage::disk('public')->delete($about->breadcrumb);
        }
        if ($about->side_image && Storage::disk('public')->exists($about->side_image)) {
            Storage::disk('public')->delete($about->side_image);
        }
        $about->delete();
        return back()->with('success', 'About detaila deleted successfully!');
    }

    // FAQ ====================================================================>
    public function faqView()
    {
        $faqs = Faq::all();
        return view('Admin.admin-faq', compact('faqs'));
    }

    public function addFaq(Request $request)
    {
        $request->validate([
            'question' => 'required',
            'answer' => 'required',
        ]);

        Faq::create([
            'question' => $request->question,
            'answer' => $request->answer,
        ])->save();

        return back()->with('success', 'Faq added successfully!');
    }

    public function editFaq(Request $request, $id)
    {
        $faq = Faq::findOrFail($id);

        $request->validate([
            'question' => 'required',
            'answer' => 'required',
        ]);

        $faq->question = $request->question;
        $faq->answer = $request->answer;
        $faq->save();

        return back()->with('success', 'Faq updated successfully!');
    }

    public function deleteFaq($id)
    {
        $faq = Faq::findOrFail($id);
        $faq->delete();
        return back()->with('success', 'Faq deleted successfully!');
    }

    // Social ===========================================================>
    public function socialView()
    {
        $socialHandels = Social::all();
        return view('Admin.admin-social-handels', compact('socialHandels'));
    }

    public function addSocial(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'mobile' => 'required|string|max:20',
            'address' => 'required|string',
            'link' => 'nullable|url',
            'fb' => 'nullable|url',
            'insta' => 'nullable|url',
            'twitter' => 'nullable|url',
            'linkedin' => 'nullable|url',
        ]);

        Social::create([
            'email' => $request->email,
            'mobile' => $request->mobile,
            'address' => $request->address,
            'link' => $request->link,
            'fb' => $request->fb,
            'insta' => $request->insta,
            'twitter' => $request->twitter,
            'linkedin' => $request->linkedin,
        ]);

        return back()->with('success', 'Social handle added successfully!');
    }

    public function editSocial(Request $request, $id)
    {
        $request->validate([
            'email' => 'required|email',
            'mobile' => 'required|string|max:20',
            'address' => 'required|string',
            'link' => 'nullable|url',
            'fb' => 'nullable|url',
            'insta' => 'nullable|url',
            'twitter' => 'nullable|url',
            'linkedin' => 'nullable|url',
        ]);

        $social = Social::findOrFail($id);
        $social->update([
            'email' => $request->email,
            'mobile' => $request->mobile,
            'address' => $request->address,
            'link' => $request->link,
            'fb' => $request->fb,
            'insta' => $request->insta,
            'twitter' => $request->twitter,
            'linkedin' => $request->linkedin,
        ]);

        return back()->with('success', 'Social handle updated successfully!');
    }

    public function deleteSocial($id)
    {
        $social = Social::findOrFail($id);
        $social->delete();

        return back()->with('success', 'Social handle deleted successfully!');
    }

    // Cart Enquiry ===========================================================>
    public function cartEnquiryView()
    {
        $cartEnquiries = CartEnquiry::with('customer')->latest()->get();

        return view('Admin.admin-cart-enquiry', compact('cartEnquiries'));
    }

    public function deleteCartEnquiry($id)
    {
        $cartEnquiry = CartEnquiry::findOrFail($id);
        $cartEnquiry->delete();

        return redirect()->back()->with('success', 'Cart enquiry deleted successfully.');
    }

    public function cartEnquiryRemark($id)
    {
        $enquiry = CartEnquiry::findOrFail($id);

        if ($enquiry->remark === 'not read') {
            $enquiry->remark = 'read';
            $enquiry->save();
        }

        return redirect()->back()->with('success', 'Marked as read');
    }

    // Product Enquiry ===========================================================>
    public function productEnquiryView()
    {
        $enquiries = ProductEnquiry::latest()->get();
        return view('Admin.admin-product-enquiry', compact('enquiries'));
    }

    public function deleteProductEnquiry($id)
    {
        $cartEnquiry = ProductEnquiry::findOrFail($id);
        $cartEnquiry->delete();

        return redirect()->back()->with('success', 'Product enquiry deleted successfully.');
    }

    public function productEnquiryRemark($id)
    {
        $enquiry = ProductEnquiry::findOrFail($id);

        if ($enquiry->remark === 'not read') {
            $enquiry->remark = 'read';
            $enquiry->save();
        }

        return redirect()->back()->with('success', 'Marked as read');
    }

    // Custom Product Enquiry ===========================================================>
    public function customProductEnquiryView()
    {

        $enquiries = CustomEnquiry::latest()->get();

        return view('Admin.admin-custom-product-enquiry', compact('enquiries'));
    }

    public function deleteCustomEnquiry($id)
    {
        $enquiry = CustomEnquiry::findOrFail($id);

        // Optionally delete image files
        if ($enquiry->company_logo && Storage::disk('public')->exists($enquiry->company_logo)) {
            Storage::disk('public')->delete($enquiry->company_logo);
        }
        if ($enquiry->product_customize_image && Storage::disk('public')->exists($enquiry->product_customize_image)) {
            Storage::disk('public')->delete($enquiry->product_customize_image);
        }

        $enquiry->delete();

        return redirect()->back()->with('success', 'Custom enquiry deleted successfully.');
    }

    public function customEnquiryRemark($id)
    {
        $enquiry = CustomEnquiry::findOrFail($id);

        if ($enquiry->remark === 'not read') {
            $enquiry->remark = 'read';
            $enquiry->save();
        }

        return redirect()->back()->with('success', 'Marked as read');
    }

    // Contact Us ===========================================================>
    public function contactEnquiryView()
    {

        $enquiries = Contact::latest()->get();
        return view('Admin.admin-contact-enquiry', compact('enquiries'));
    }

    public function deleteContact($id)
    {
        $enquiry = Contact::findOrFail($id);
        $enquiry->delete();

        return redirect()->back()->with('success', 'Enquiry deleted successfully.');
    }

    public function contactEnquiryRemark($id)
    {
        $enquiry = Contact::findOrFail($id);

        if ($enquiry->remark === 'not read') {
            $enquiry->remark = 'read';
            $enquiry->save();
        }

        return redirect()->back()->with('success', 'Marked as read');
    }

    // Color ===============================================================>
    public function colorView()
    {
        $colors = Color::get();
        return view('Admin.admin-colors', compact('colors'));
    }

    public function addColor(Request $request)
    {
        // Validate input
        $request->validate([
            'color' => 'required|string|max:255',
        ]);

        // Create new main category
        Color::create([
            'color' => $request->color,
        ]);

        return back()->with('success', 'Color added successfully!');
    }

    public function editColor(Request $request, $id)
    {
        // Validate input
        $request->validate([
            'color' => 'required|string|max:255' . $id,
        ]);

        // Find the main category
        $color = Color::findOrFail($id);

        // Update main category
        $color->update([
            'color' => $request->color,
        ]);

        return back()->with('success', 'Color updated successfully!');
    }

    public function deleteColor($id)
    {
        // Find the main category
        $color = Color::findOrFail($id);

        // Delete the main category
        $color->delete();

        return back()->with('success', 'Color deleted successfully!');
    }

    // Size ===============================================================>
    public function sizeView()
    {
        $sizes = Size::get();
        return view('Admin.admin-sizes', compact('sizes'));
    }

    public function addSize(Request $request)
    {
        // Validate input
        $request->validate([
            'size' => 'required|string|max:255',
        ]);

        // Create new main category
        Size::create([
            'size' => $request->size,
        ]);

        return back()->with('success', 'Size added successfully!');
    }

    public function editSize(Request $request, $id)
    {
        // Validate input
        $request->validate([
            'size' => 'required|string|max:255' . $id,
        ]);

        // Find the main category
        $size = Size::findOrFail($id);

        // Update main category
        $size->update([
            'size' => $request->size,
        ]);

        return back()->with('success', 'Size updated successfully!');
    }

    public function deleteSize($id)
    {
        // Find the main category
        $size = Size::findOrFail($id);

        // Delete the main category
        $size->delete();

        return back()->with('success', 'Size deleted successfully!');
    }

    // Catelogue ==============================================================>
    public function catelogueAdd(Request $request)
    {
        $request->validate([
            'catelogue' => 'required|file|mimes:pdf,doc,docx',
        ]);
        $catelogue = new Catelogue();
        $catelogue->catelogue = $request->file('catelogue')->store('catelogue', 'public');
        $catelogue->save();

        return back()->with('success', 'Catelogue added successfully!');
    }

    public function catelogUpdate(Request $request, $id)
    {
        $request->validate([
            'catelogue' => 'required|file|mimes:pdf,doc,docx',
        ]);

        $catelogue = Catelogue::findOrFail($id);

        // Delete old file if it exists
        if ($catelogue->catelogue && Storage::disk('public')->exists($catelogue->catelogue)) {
            Storage::disk('public')->delete($catelogue->catelogue);
        }

        // Store new file and update the record
        $filePath = $request->file('catelogue')->store('catelogue', 'public');
        $catelogue->catelogue = $filePath;
        $catelogue->save();

        return back()->with('success', 'Catelogue updated successfully!');
    }

    // Orders ==============================================================>
    public function ordersView()
    {

        $orders = Order::with('customer')
            ->orderBy('id', 'desc')
            ->get();


        return view('Admin.admin-orders', compact('orders'));
    }

    public function shipmentStatusUpdate(Request $request, $id)
    {
        $request->validate([
            'shipment_status' => 'required|string'
        ]);

        $order = Order::findOrFail($id);
        $order->shipment_status = $request->shipment_status;
        $order->save();

        // Send emails based on the updated status
        if ($request->shipment_status === 'outForDelivery') {
            Mail::to($order->customer->email)->send(new OutForDeliveryMail($order));
        } elseif ($request->shipment_status === 'delivered') {
            Mail::to($order->customer->email)->send(new ProductDeliveredMail($order));
        }

        return back()->with('success', 'Order status updated successfully!');
    }

    public function exportPendingOrders()
    {
        $orders = Order::where('shipment_status', 'pending')
            ->with('customer')
            ->get();

        $csvFileName = 'pending_orders_' . date('Ymd') . '.csv';

        $callback = function () use ($orders) {
            $handle = fopen('php://output', 'w');

            // CSV Header
            fputcsv($handle, [
                'Customer Name',
                'Customer Email',
                'Order Date',
                'Product Details',
                'Overall Order Amount',
                'Payment Status',
                'Shipment Status'
            ]);

            foreach ($orders as $order) {
                // Handle array or JSON
                $products = is_array($order->product_details)
                    ? $order->product_details
                    : json_decode($order->product_details, true);

                // Merge products into one string
                $productDetails = '';
                if (is_array($products)) {
                    foreach ($products as $product) {
                        $productDetails .= sprintf(
                            "Name: %s, Code: %s, Color: %s, Rate: %s, Size: %s, Quantity: %s, Total: %s\n",
                            $product['product_name'] ?? '',
                            $product['product_code'] ?? '',
                            $product['product_color'] ?? '',
                            $product['product_rate'] ?? '',
                            $product['product_size'] ?? '',
                            $product['product_quantity'] ?? '',
                            $product['total_amount'] ?? ''
                        );
                    }
                    // Remove last newline
                    $productDetails = trim($productDetails);
                }

                fputcsv($handle, [
                    optional($order->customer)->name,
                    optional($order->customer)->email,
                    $order->order_date,
                    $productDetails,
                    $order->overall_amount,
                    $order->payment_status,
                    $order->shipment_status
                ]);
            }

            fclose($handle);
        };

        return Response::stream($callback, 200, [
            "Content-Type" => "text/csv",
            "Content-Disposition" => "attachment; filename={$csvFileName}"
        ]);
    }

    public function exportOutForDeliveryOrders()
    {
        $orders = Order::where('shipment_status', 'outForDelivery')
            ->with('customer')
            ->get();

        $csvFileName = 'out_for_delivery_orders_' . date('Ymd') . '.csv';

        $callback = function () use ($orders) {
            $handle = fopen('php://output', 'w');

            // CSV Header
            fputcsv($handle, [
                'Customer Name',
                'Customer Email',
                'Order Date',
                'Product Details',
                'Overall Order Amount',
                'Payment Status',
                'Shipment Status'
            ]);

            foreach ($orders as $order) {
                $products = is_array($order->product_details)
                    ? $order->product_details
                    : json_decode($order->product_details, true);

                $productDetails = '';
                if (is_array($products)) {
                    foreach ($products as $product) {
                        $productDetails .= sprintf(
                            "Name: %s, Code: %s, Color: %s, Rate: %s, Size: %s, Quantity: %s, Total: %s\n",
                            $product['product_name'] ?? '',
                            $product['product_code'] ?? '',
                            $product['product_color'] ?? '',
                            $product['product_rate'] ?? '',
                            $product['product_size'] ?? '',
                            $product['product_quantity'] ?? '',
                            $product['total_amount'] ?? ''
                        );
                    }
                    $productDetails = trim($productDetails);
                }

                fputcsv($handle, [
                    optional($order->customer)->name,
                    optional($order->customer)->email,
                    $order->order_date,
                    $productDetails,
                    $order->overall_amount,
                    $order->payment_status,
                    $order->shipment_status
                ]);
            }

            fclose($handle);
        };

        return Response::stream($callback, 200, [
            "Content-Type" => "text/csv",
            "Content-Disposition" => "attachment; filename={$csvFileName}"
        ]);
    }

    public function exportDeliveredOrders()
    {
        $orders = Order::where('shipment_status', 'delivered')
            ->with('customer')
            ->get();

        $csvFileName = 'delivered_orders_' . date('Ymd') . '.csv';

        $callback = function () use ($orders) {
            $handle = fopen('php://output', 'w');

            // CSV Header
            fputcsv($handle, [
                'Customer Name',
                'Customer Email',
                'Order Date',
                'Product Details',
                'Overall Order Amount',
                'Payment Status',
                'Shipment Status'
            ]);

            foreach ($orders as $order) {
                $products = is_array($order->product_details)
                    ? $order->product_details
                    : json_decode($order->product_details, true);

                $productDetails = '';
                if (is_array($products)) {
                    foreach ($products as $product) {
                        $productDetails .= sprintf(
                            "Name: %s, Code: %s, Color: %s, Rate: %s, Size: %s, Quantity: %s, Total: %s\n",
                            $product['product_name'] ?? '',
                            $product['product_code'] ?? '',
                            $product['product_color'] ?? '',
                            $product['product_rate'] ?? '',
                            $product['product_size'] ?? '',
                            $product['product_quantity'] ?? '',
                            $product['total_amount'] ?? ''
                        );
                    }
                    $productDetails = trim($productDetails);
                }

                fputcsv($handle, [
                    optional($order->customer)->name,
                    optional($order->customer)->email,
                    $order->order_date,
                    $productDetails,
                    $order->overall_amount,
                    $order->payment_status,
                    $order->shipment_status
                ]);
            }

            fclose($handle);
        };

        return Response::stream($callback, 200, [
            "Content-Type" => "text/csv",
            "Content-Disposition" => "attachment; filename={$csvFileName}"
        ]);
    }
}
