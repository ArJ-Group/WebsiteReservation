<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use Illuminate\Http\Request;
use App\Models\CategoryService;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{

    public function index()
    {
        $gallery = Gallery::with('categoryService')->get();
        $categoryService = CategoryService::all();
        return view('admin.galleryIndex', compact('gallery', 'categoryService'));
    }

    public function galleryCustomer()
    {
        $gallery = Gallery::with('categoryService')->get();
        return view('customer.gallery', compact('gallery'));
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        $request->validate([
            'category_service_id' => 'required',
            'image' => 'required',
        ]);

        if ($request->file('image')) {
            $image = $request->file('image')->store('images', 'public');
        }

        $gallery = new Gallery;
        $gallery->image = $image;

        $categoryService = new CategoryService;
        $categoryService->category_service_id = $request->get('category_service_id');

        $gallery->categoryService()->associate($categoryService);
        $gallery->save();


        return redirect()->route('gallery.index')
            ->with('success', 'Gallery Successfully Added');
    }


    public function show(Gallery $gallery)
    {
        //
    }


    public function edit($idgallery)
    {
        $gallery = Gallery::where('gallery_id', $idgallery)
            ->first();
        $categoryService = CategoryService::all();
        return view('admin.galleryEdit', ['gallery' => $gallery, 'categoryService' => $categoryService]);
    }


    public function update(Request $request, $idgallery)
    {
        $request->validate([
            'category_service_id' => 'required',
            'image' => 'nullable',
        ]);

        $gallery = Gallery::where('gallery_id', $idgallery)
            ->first();

        if ($request->file('image')) {
            if ($gallery->image && file_exists(storage_path('app/public/' . $gallery->image))) {
                Storage::delete('public/' . $gallery->image);
                $image = $request->file('image')->store('images', 'public');
                $gallery->image = $image;
            }
        }

        $categoryService = new CategoryService;
        $categoryService->category_service_id = $request->get('category_service_id');

        $gallery->categoryService()->associate($categoryService);
        $gallery->save();


        return redirect()->route('gallery.index')
            ->with('success', 'Gallery Successfully Updated');
    }


    public function destroy($idgallery)
    {
        $gallery = Gallery::where('gallery_id', $idgallery)
            ->first();
        Storage::delete('public/' . $gallery->image);
        $gallery->delete();
        return redirect()->route('gallery.index')
            ->with('success', 'Gallery seccesfully Deleted');
    }
}
