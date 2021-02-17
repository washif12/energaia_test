<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
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
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    /* Redirect based on role*/
    public function index()
    {
        if(auth()->user()->role == '1'){
            return redirect('/user');
        }
        else if(auth()->user()->role == '2'){
            return redirect('/supplier');
        }
    }
    /* Redirect to Supplier page */
    public function indexSupplier()
    {
        $products = DB::table('suppliers')->get();
        return view('supplierHome', compact('products'));
    }
    /* Redirect to User page */
    public function indexUser()
    {
        $products = DB::table('suppliers')->get();
        $received = DB::table('received_products')->get();
        return view('home', compact('products', 'received'));
    }
    /* Order products from supplier */
    public function orderProduct(Request $request)
    {
        $storeInfo = [
            'gallery' => $request->pName,
            'email' => $request->quantity,
            'path' => $request->pId
        ];
        //dd($storeInfo);
        $updateInfo = [
            'ordered' => '1',
            'demand' => $request->quantity,
        ];
        DB::table('suppliers')->where('id',$request->pId)->update($updateInfo);

        return redirect('/user');
    }
    /* Send Ordered Products to user  */
    public function deliverProduct(Request $request)
    {
        $storeInfo = [
            'product' => $request->pName,
            'quantity' => $request->quantity,
            'updated_at' => now()
        ];
        
        $product = DB::table('suppliers')->where('id',$request->pId)->get();
        $updateInfo = [
            'ordered' => '0',
            'demand' => '0',
            'quantity' => $product['0']->quantity-$request->quantity,
        ];
        DB::table('suppliers')->where('id',$request->pId)->update($updateInfo);
        DB::table('received_products')->insert($storeInfo);
        return redirect('/supplier');
    }
}
