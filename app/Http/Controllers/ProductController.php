<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\Category;
use Cocur\Slugify\Slugify;
use Illuminate\Http\Request;
use App\Helpers\ToastNotifier;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{

    public function __construct()
    {
        $this->middleware('admin')->except(['index','show','search']);
    }


    public function index()
    {
        $products = Product::orderByDesc('title')->paginate(6);

        return view('products.index',compact('products'));
    }


    public function listProducts()
    {
        $products = Product::orderByDesc('title')->paginate(6);

        return view('admin.product',compact('products'));
    }


    public function CommandList()
    {
        $orders = Order::oderByDesc('created_at')->paginate(6);
        
        return view('admin.order',compact('orders'));
    }


    public function show($id)
    {
        $product = Product::findOrFail($id);

        return view('products.show',compact('product'));
    }


    public function create()
    {
        $categories = Category::all();

        return view('products.create', compact('categories'));
    }


    public function edit($id)
    {   
        $product = Product::findOrFail($id);
        $categories = Category::all();

        return view('products.edit',compact('product','categories'));
    }


    public function store(Request $request)
    {
        if(request()->ajax())
        {
            $request->validate([
                'title' => 'required|string|min:2|max:120',
                'subtitle' => 'nullable|string|min:2|max:100',
                'category_id' => 'exists:categories,id',
                'image' =>   'required|mimes:jpg,jpeg,png,webp,gif,svg|max:8388608',
                'price' => 'required|numeric|min:1',
                'stock' => 'required|integer',
                'description' => 'required|string|min:8',
            ]);

            $product = new Product();
            $product->title = ucfirst($request->title);
            $slug = new Slugify();
            $product->slug = $slug->slugify($request->title);
            $product->subtitle = ucfirst($request->subtitle);
            $product->price = $request->price;
            $product->stock = $request->stock;
            $product->description = $request->description;
            $this->storeImage($request,$product);
            $product->category()->associate($request->category_id);

            $product->save();

            $notification = new ToastNotifier('success','Produit ajouté','Le produit a été ajouté avec succès',null,null);
            return $notification->toJson();
        }
    }


    public function update(Request $request, $id)
    {
        if(request()->ajax())
        {
            $request->validate([
                'title' => 'required|string|min:2|max:120',
                'subtitle' => 'nullable|string|min:2|max:100',
                'image' =>   'sometimes|mimes:jpg,jpeg,png,webp,gif,svg|max:8388608',
                'price' => 'required|numeric|min:1',
                'stock' => 'required|integer',
                'description' => 'required|string|min:8',
            ]);

            $product = Product::findOrfail($id);
           
            $product->title = ucfirst($request->title);
            $slug = new slugify();
            $product->slug =  $slug->slugify($product->title);
            $product->subtitle = ucfirst($request->subtitle);
            $product->stock = $request->stock;
            $product->price = $request->price;
            $product->description = ucfirst($request->description);
            $this->storeImage($request,$product);
            $product->category()->associate($request->category_id);

            $product->save();

            $notification = new ToastNotifier('success', 'Produit modifié', 'Le produit a été modifié avec succès', 'redirectToProductList', null);
            return $notification->toJson();
        }

    }

    public function search(Request $request)
    {
        $request->validate([
            'q' => 'required|string|alpha_num',
        ]);
        
        $query = $request->input("q");

        $products =  Product::where('title','like', "%$query%")
                            ->orWhere('description','like',"%$query%")
                            ->paginate(6);

        return view('products.search',compact('products'));

    }
  
    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        $image_path = storage_path('app/public/'.$product->image);
      
        if(Storage::disk('public')->exists($product->image))
        {
            Storage::disk('public')->delete($product->image);
        }

        $product->delete();

        $notification = new ToastNotifier('success','Produit supprimé','Le produit a été supprimé avec succès','removeTableRow',$product->id);
        return $notification->toJson();  
    }


    private function storeImage(Request $request, Product $product) 
    {
        if($request->image) 
        {
          $product->image = $request->image->store('Product','public');
        }
    }

}
