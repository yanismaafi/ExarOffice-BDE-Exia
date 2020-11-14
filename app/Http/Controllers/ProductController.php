<?php

namespace App\Http\Controllers;

use App\Order;
use App\Product;
use App\Category;
use Cocur\Slugify\Slugify;
use Illuminate\Http\Request;
use App\Http\Requests\SearchRequest;
use App\Http\Requests\ProductRequest;

class ProductController extends Controller
{

    public function __construct()
    {
        $this->middleware('admin')->except(['index','show','search']);
    }


    public function index()
    {
        $products = Product::paginate(6);

        return view('products.index',compact('products'));
    }

    public function listProduct()
    {
        $products = Product::paginate(6);

        return view('admin.product',compact('products'));
    }

    public function CommandList()
    {
        $orders = Order::paginate(6);
        
        return view('admin.order',compact('orders'));
    }


    public function show($slug)
    {
        $product = Product::where('slug',$slug)->firstOrFail();

        return view('products.show',compact('product'));
    }

    public function create()
    {
        $categories = Category::all();

        return view('products.create',compact('categories'));
    }


    public function edit($slug)
    {
        $product = Product::where('slug',$slug)->firstOrfail();
        $categories = Category::all();

        return view('products.edit',compact('product','categories'));
    }


    public function store(ProductRequest $request)
    {
         /* Image file */
        $image = $request->file('image');
        $imageFullName = $image->getClientOriginalName();
        $imageName = pathinfo($imageFullName, PATHINFO_FILENAME);
        $extension = $image->getClientOriginalExtension();
        $file = time() . '_' . $imageName . '.' . $extension;
        $image->move('images/products',$file);

        $slug = new Slugify();

        Product::create([
            'title' => ucfirst($request->title),
            'slug'  => $slug->slugify($request->title),
            'subtitle' => $request->subtitle,
            'stock' => $request->stock,
            'price' => $request->price,
            'category_id' => $request->category_id,
            'image'       => $file,
            'description' => ucfirst($request->description),
        ]);

        return response()->json('added');
    }


    public function update(ProductRequest $request, $slug)
    {
        $product = Product::where('slug',$slug)->firstOrfail();
        $slug = new slugify();

        $product->title = $request->input('title');
        $product->slug =  $slug->slugify($product->title);
        $product->subtitle = $request->input('subtitle');
        $product->stock = $request->input('stock');
        $product->price = $request->input('price');
        $product->category_id = $request->input('category_id');
        $product->description = $request->input('description');

        if( $request->file('image') )
         {
            $image = $request->file('image');
            $imageFullName = $image->getClientOriginalName();
            $imageName = pathinfo($imageFullName, PATHINFO_FILENAME);
            $extension = $image->getClientOriginalExtension();
            $file = time() . '_' . $imageName . '.' . $extension;
            $image->move('images/products',$file);
    
            $product->image = $file;
         }

         $product->save();
    }

  
    public function destroy($id)
    {
        $product = Product::find($id);
        $image_path = public_path('images/products/'.$product->image);
        unlink($image_path);
        $product->delete();

        return response()->json('deleted');

    }

    public function search(SearchRequest $request)
    {
        $query = $request->input("q");

        $products =  Product::where('title','like', "%$query%")
                            ->orWhere('description','like',"%$query%")
                            ->paginate(6);

        return view('products.search',compact('products'));

    }



}
