<?php

namespace App\Http\Controllers\Admin;

use App\Models\News;
use App\Http\Controllers\Controller;

use App\Models\NewsImage;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Str;

class NewsController extends Controller
{
    public function index()
    {
        $news = News::with( 'news_images')->get();
       /* $brands = Brand::get();
        $categories = Category::get();*/

        return Inertia::render(
            'Admin/News/Index',
            [
                'news' => $news,
               /* 'brands' => $brands,
                'categories' => $categories*/
            ]
        );
    }



    public function store(Request $request)
    {

        $news = new News;
        $news->title = $request->title;
        $news->description = $request->description;
        $news->extrainfo = $request->extrainfo;
       /* $product->category_id = $request->category_id;
        $product->brand_id = $request->brand_id;*/
        $news->save();

        //check if product has images upload

        if ($request->hasFile('news_images')) {
            $newsImages = $request->file('news_images');
            foreach ($newsImages as $image) {
                // Generate a unique name for the image using timestamp and random string
                $uniqueName = time() . '-' . Str::random(10) . '.' . $image->getClientOriginalExtension();
                // Store the image in the public folder with the unique name
                $image->move('news_images', $uniqueName);
                // Create a new product image record with the product_id and unique name
                NewsImage::create([
                    'news_id' => $news->id,
                    'image' => 'news_images/' . $uniqueName,
                ]);
            }
        }
        return redirect()->route('admin.news.index')->with('success', 'News created successfully.');
    }

    //update
    public function update(Request $request, $id)
    {

        $news = News::findOrFail($id);

        // dd($product);
        $news->title = $request->title;
        $news->description = $request->description;
        $news->extrainfo = $request->extrainfo;
      /*  $news->category_id = $request->category_id;
        $news->brand_id = $request->brand_id;*/

        // Check if product images were uploaded

        if ($request->hasFile('news_images')) {
            $newsImages = $request->file('news_images');
            // Loop through each uploaded image
            foreach ($newsImages as $image) {
                // Generate a unique name for the image using timestamp and random string
                $uniqueName = time() . '-' . Str::random(10) . '.' . $image->getClientOriginalExtension();

                // Store the image in the public folder with the unique name
                $image->move('news_images', $uniqueName);

                // Create a new product image record with the product_id and unique name
                NewsImage::create([
                    'news_id' => $news->id,
                    'image' => 'news_images/' . $uniqueName,
                ]);
            }
        }
        $news->update();
        return redirect()->route('admin.news.index')->with('success', 'News updated successfully.');
    }

    public function deleteImage($id)
    {
        $image = NewsImage::where('id', $id)->delete();
        return redirect()->route('admin.news.index')->with('success', 'Image deleted successfully.');
    }

    public function destory($id)
    {
        $news = News::findOrFail($id)->delete();
        return redirect()->route('admin.news.index')->with('success', 'News deleted successfully.');
    }
}
