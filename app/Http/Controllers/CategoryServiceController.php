<?php

namespace App\Http\Controllers;

use App\Models\CategoryService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CategoryServiceController extends Controller
{

    public function index(Request $request)
    {
        $search = $request->get('search');
        if ($request->get('search')) {
            $categoryService = CategoryService::search(['name'], $search)->get();
        } else {
            $categoryService = CategoryService::get();
        }
        return view('admin.serviceCategoryIndex', compact('categoryService'));
    }


    public function categoryServiceCustomer()
    {
        $categoryService = CategoryService::get();
        return view('customer.CategoryService', compact('categoryService'));
    }


    public function create()
    {
        //
    }

    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required',
            'image' => 'nullable',
        ]);
        $categoryService = new CategoryService;
        if ($request->file('image')) {
            $image = $request->file('image')->store('images', 'public');
            $categoryService->image = $image;
        }
        // dd($image);


        $categoryService->name = $request->get('name');
        $categoryService->save();


        return redirect()->route('categoryService.index')
            ->with('success', 'New Category Service Added Succesfully');
    }


    public function show(CategoryService $categoryService)
    {
        //
    }


    public function edit($id_categoryService)
    {
        $categoryService = CategoryService::where('category_service_id', $id_categoryService)
            ->first();
        return view('admin.serviceCategoryEdit', ['categoryService' => $categoryService]);
    }


    public function update(Request $request,  $idcs)
    {
        $request->validate([
            'name' => 'required',
            'image' => 'nullable',

        ]);

        $categoryService = CategoryService::where('category_service_id', $idcs)
            ->first();

        if ($request->file('image')) {
            if ($categoryService->image && file_exists(storage_path('app/public/' . $categoryService->image))) {
                if ($categoryService->image !== 'images/serviceCategoryDefault.jpg') {
                    Storage::delete('public/' . $categoryService->image);
                }
                $image = $request->file('image')->store('images', 'public');
                $categoryService->image = $image;
            }
        }

        $categoryService->name = $request->get('name');
        $categoryService->save();

        return redirect()->route('categoryService.index')
            ->with('success', 'Category Service seccesfully Updated');
    }


    public function destroy($idcs)
    {
        $categoryService = CategoryService::where('category_service_id', $idcs)->first();
        if ($categoryService->image !== 'images/serviceCategoryDefault.jpg') {
            Storage::delete('public/' . $categoryService->image);
        }
        $categoryService->delete();
        return redirect()->route('categoryService.index')
            ->with('success', 'Category Service seccesfully Deleted');
    }
}
