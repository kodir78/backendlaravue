<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Requests\ProductRequest;
use Illuminate\Support\Str;
use App\Models\Product;
use App\Imports\ProductImport;
use App\Models\ProductGallery;
use Spatie\Permission\Traits\HasRoles;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Session;


class ProductController extends Controller
{
    /**
    * Create a new controller instance.
    *
    * @return void
    */
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index()
    {
        $items = Product::all();
        return view('pages.products.index', compact('items'));
    }
    
    /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function create()
    {
        
        return view('pages.products.create');
    }
    
    /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function store(ProductRequest $request)
    {
        $data = $request->all();
        $data['slug'] = Str::slug($request->name);
        
        Product::create($data);
        
        return redirect()->route('products.index');
        
    }
    
    /**
    * Display the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function show($id)
    {
        
        
    }
    
    /**
    * Show the form for editing the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function edit($id)
    {
        //
        $item = Product::findOrFail($id);
        return view('pages.products.edit', compact('item'));
    }
    
    /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function update(ProductRequest $request, $id)
    {
        //
        $data = $request->all();
        $data['slug'] = Str::slug($request->name);
        
        $item = Product::findOrFail($id);
        
        $item->update($data);
        
        return redirect()->route('products.index');
    }
    
    /**
    * Remove the specified resource from storage.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function destroy($id)
    {
        $item = Product::findOrFail($id);
        $item->delete();
        
        ProductGallery::where('products_id', $id)->delete();
        
        return redirect()->route('products.index');
        
    }
    
    public function gallery(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $items = ProductGallery::with('product')
        ->where('products_id', $id)
        ->get();
        
        return view('pages.products.gallery', compact('product', 'items'));
        
    }
    
    public function import_excel(Request $request)
    {
        // validasi
        $this->validate($request, [
            'file' => 'required|mimes:csv,xls,xlsx'
            ]);
            
            // menangkap file excel
            $file = $request->file('file');
            
                      
            if ($request->hasFile('file')) {
                
                $file = $request->file('file'); //GET MENANGKAP FILE EXCEL
                
                $nama_file = rand().$file->getClientOriginalName();  // membuat nama file unik
                
                $file->move('file_product',$nama_file); // upload ke folder file_product di dalam folder public
                
                Excel::import(new ProductImport, public_path('/file_product/'.$nama_file)); // import data
                
                unlink(public_path('/file_product/'.$nama_file)); //MENGHAPUS FILE EXCEL YANG TELAH DI-UPLOAD
                
                // notifikasi dengan session
                Session::flash('success','Data Product Berhasil Diimport!');
                
                // alihkan halaman kembali
                return redirect('/products');
            }  
            
            // notifikasi dengan session
            Session::flash('error','Please choose file before or Cek dplikasi data');
           
            return redirect()->back();
            
        }
    }
    