<?php

namespace App\Http\Controllers\Admin;

use App\Models\Atlethe;
use App\Http\Controllers\Controller;

use App\Models\AtletheImage;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Str;

class AtletheController extends Controller
{
    public function index()
    {
        $atlethes = Atlethe::with( 'atlethe_images')->get();
       /* $brands = Brand::get();
        $categories = Category::get();*/

        return Inertia::render(
            'Admin/Atlethe/Index',
            [
                'atlethes' => $atlethes,
               /* 'brands' => $brands,
                'categories' => $categories*/
            ]
        );
    }



    public function store(Request $request)
    {

        $atlethe = new Atlethe;
        $atlethe->title = $request->title;
        $atlethe->description = $request->description;
        $atlethe->extrainfo = $request->extrainfo;
       /* $product->category_id = $request->category_id;
        $product->brand_id = $request->brand_id;*/
        $atlethe->save();

        //check if product has images upload

        if ($request->hasFile('atlethe_images')) {
            $atletheImages = $request->file('atlethe_images');
            foreach ($atletheImages as $image) {
                // Generate a unique name for the image using timestamp and random string
                $uniqueName = time() . '-' . Str::random(10) . '.' . $image->getClientOriginalExtension();
                // Store the image in the public folder with the unique name
                $image->move('atlethe_images', $uniqueName);
                // Create a new product image record with the product_id and unique name
                AtletheImage::create([
                    'atlethe_id' => $atlethe->id,
                    'image' => 'atlethe_images/' . $uniqueName,
                ]);
            }
        }
        return redirect()->route('admin.atlethes.index')->with('success', 'Atlethe created successfully.');
    }

    //update
    public function update(Request $request, $id)
    {

        $atlethe = Atlethe::findOrFail($id);

        // dd($product);
        $atlethe->title = $request->title;
        $atlethe->description = $request->description;
        $atlethe->extrainfo = $request->extrainfo;
      /*  $news->category_id = $request->category_id;
        $news->brand_id = $request->brand_id;*/

        // Check if product images were uploaded

        if ($request->hasFile('atlethe_images')) {
            $atletheImages = $request->file('atlethe_images');
            // Loop through each uploaded image
            foreach ($atletheImages as $image) {
                // Generate a unique name for the image using timestamp and random string
                $uniqueName = time() . '-' . Str::random(10) . '.' . $image->getClientOriginalExtension();

                // Store the image in the public folder with the unique name
                $image->move('atlethe_images', $uniqueName);

                // Create a new product image record with the product_id and unique name
                AtletheImage::create([
                    'atlethe_id' => $atlethe->id,
                    'image' => 'atlethe_images/' . $uniqueName,
                ]);
            }
        }
        $atlethe->update();
        return redirect()->route('admin.atlethes.index')->with('success', 'Atlethe updated successfully.');
    }

    public function deleteImage($id)
    {
        $image = AtletheImage::where('id', $id)->delete();
        return redirect()->route('admin.atlethes.index')->with('success', 'Image deleted successfully.');
    }

    public function destory($id)
    {
        $atlethe = Atlethe::findOrFail($id)->delete();
        return redirect()->route('admin.atlethes.index')->with('success', 'Atlethe deleted successfully.');
    }
}
