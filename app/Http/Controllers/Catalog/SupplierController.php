<?php

namespace App\Http\Controllers\Catalog;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\CrudRepository;
use App\Models\Order;
use App\Models\Cart;

class SupplierController extends Controller
{
    protected $crud_repository;
    protected $model = "User";
    protected $role = "Supplier";
    protected $view = 'supplier';
    // index
    // edit
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(CrudRepository $crud_repository)
    {
        $this->crud_repository = $crud_repository;
    }
    public function index()
    {
        $suppliers = app('App\\Models\\' . $this->model)::role('Supplier')->get();
        $view = $this->view;
        return view('mycomponent.datatable', compact('suppliers', 'view'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       
        return view('catalog.'.$this->view.'.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $request->validate([
        //     'name' => 'required',
        //     'image' => 'required',
        // ]);

        $message = $this->crud_repository->registerNewUser($request, $this->model, $this->role);

        return redirect()->route($this->view.'.index')->with('status', $this->model . $message);
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
        $supplier = app('App\\Models\\' . $this->model)->find($id);
        $view = $this->view;
        return view('catalog.'.$this->view.'.create', compact('supplier', 'view'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $message = $this->crud_repository->update($request, $id, $this->model);
        return redirect()->route($this->view.'.index')->with('status', $this->model . $message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $ca = Cart::where('supplier_id',$id)->get();
            $oa = Order::where('supplier_id',$id)->get();
            foreach($ca as $c){
                $c->delete();
            }
            foreach($oa as $o){
                $o->delete();
            }
        $message = $this->crud_repository->destroy($id, $this->model);
        return redirect()->route($this->view.'.index')->with('status', $this->model . $message);
    }

    public function status($id)
    {
        // dd($id);
        $message = $this->crud_repository->status($id, $this->model);
        return redirect()->route($this->view.'.index')->with('status', $this->model . $message);
    }
    public function search(Request $request)
    {
        $view=$this->view;
        $q = $request->get('search');
        
        $suppliers = app('App\\Models\\' . $this->model)::where('first_name','LIKE','%'.$q.'%')->orWhere('last_name','LIKE','%'.$q.'%')->get();  
        if(count($suppliers) > 0)
          return view('mycomponent.datatable',compact('suppliers','view'));
        else 
        return view('mycomponent.datatable',compact('suppliers','view'));
    }
}
