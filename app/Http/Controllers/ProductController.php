<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

use Illuminate\Support\Facades\File;
use App\Http\Controllers\IdGenerator;
// use Picqer\Barcode\BarcodeGeneratorHTML;
use SimpleSoftwareIO\QrCode\Facades\QrCode;


class ProductController extends Controller
{
    // public function index(Request $request)
    public function index(Request $request)
    {
        $search = $request->input('search');
        $row = (int) $request->input('row', 10); // Default 10 rows per page

        // Validate row range (1 - 100)
        if ($row < 1 || $row > 100) {
            abort(400, 'The per-page parameter must be an integer between 1 and 100.');
        }

        return view('products.index', [
            'products' => Product::with(['category', 'supplier'])
                ->filter(request(['search']))
                ->orderBy('id', 'desc')
                ->sortable()->paginate($row)
                ->appends(request()
                ->query()),
            ]);
    }


    public function show(Product $product)
    {
        // Barcode Generator
        // $generator = new BarcodeGeneratorHTML();
        // $barcode = $generator->getBarcode($product->product_code, $generator::TYPE_CODE_128);
        $barcode = QrCode::size(200)->generate($product->product_code);

        return view('products.show', ['product' => $product,'barcode' => $barcode,]);
    }

    public function edit(Product $product)
    {
        return view('products.edit', ['categories' => Category::all(),'suppliers' => Supplier::all(),'product' => $product]);
    }

    public function update(Request $request, Product $product)
    {
        $rules = [
            'product_image' => 'image|file|max:1024|nullable',
            'product_name' => 'required|string',
            'category_id' => 'required|integer',
            'supplier_id' => 'required|integer',
            'product_garage' => 'string|nullable',
            'product_store' => 'string|nullable',
            'buying_date' => 'date_format:Y-m-d|nullable',
            'expire_date' => 'date_format:Y-m-d|nullable',
            'buying_price' => 'required|integer',
            'selling_price' => 'required|integer',
        ];
    
        $validatedData = $request->validate($rules);    
        /**
         * Handle image upload manually in `public/images`
         */
        if ($file = $request->file('product_image')) {
            $fileName = hexdec(uniqid()) . '.' . $file->getClientOriginalExtension();
            $path = public_path('images/products/');
    
            // Delete old image if exists
            if ($product->product_image && file_exists($path . $product->product_image)) {
                unlink($path . $product->product_image);
            }
    
            // Move new image to public/images/
            $file->move($path, $fileName);
            $validatedData['product_image'] = $fileName;
        }
    
        // Update product with new data
        $product->fill($validatedData);
    
        // Check if product_name exists
        if (!$product->product_name) {
            return back()->with('error', 'Product name is required!');
        }
    
        $product->save();
    
        return Redirect::route('products.index')->with('success', 'Product has been updated!');
    }

    public function destroy(Product $product)
    {
        /**
         * Delete photo if exists.
         */
        if ($product->product_image) {
            $imagePath = public_path('images/' . $product->product_image);
    
            // Check if file exists before deleting
            if (File::exists($imagePath)) {
                File::delete($imagePath);
            }
        }
    
        // Delete record from database
        $product->delete();

        return Redirect::route('products.index')->with('success', 'Product has been deleted!');
    }

    public function create()
    {
        return view('products.create', ['categories' => Category::all(),'suppliers' => Supplier::all(),]);
    }

    public function store(Request $request)
    {
        $rules = [
            'product_image' => 'image|file|max:1024',
            'product_name' => 'required|string',
            'category_id' => 'required|integer',
            'supplier_id' => 'required|integer',
            'product_code' => 'string|nullable',
            'product_garage' => 'string|nullable',
            'product_store' => 'string|nullable',
            'buying_date' => 'date_format:Y-m-d|max:10|nullable',
            'expire_date' => 'date_format:Y-m-d|max:10|nullable',
            'buying_price' => 'required|integer',
            'selling_price' => 'required|integer',
        ];

        $validatedData = $request->validate($rules);

        /**
         * Handle upload image with Storage.
         */
        if ($file = $request->file('product_image')) {
            $image = $request->file('product_image');
            $imageName = time().'.'.$image->getClientOriginalExtension();

            $image->move(public_path('images/products/'), $imageName);
            $validatedData['product_image'] = $imageName;
        }

        Product::create($validatedData);

        return Redirect::route('products.index')->with('success', 'Product has been created!');
    }
}

