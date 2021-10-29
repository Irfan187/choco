<?php
namespace App\Http\Controllers\Catalog;
use Illuminate\Support\Facades\Http;
use App\Models\Supplier;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\CrudRepository;

class CustomerController extends Controller
{
    protected $crud_repository;
    protected $model = "User";
    protected $view = 'customer';
    protected $role = 'Customer';
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
       
        $customers = app('App\\Models\\' . $this->model)::role('Customer')->get();
        $view = $this->view;
        return view('mycomponent.datatable', compact('customers', 'view'));
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
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required',
            'password'=>'required',
            'franchise_name'=>'required',
            'mobilenumber' => 'required',
            'address' => 'required',
        ]);
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
        $customer = app('App\\Models\\' . $this->model)->find($id);
        $view = $this->view;
        return view('catalog.'.$this->view.'.create', compact('customer', 'view'));
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
        $message = $this->crud_repository->destroy($id, $this->model);
        return redirect()->route($this->view.'.index')->with('status', $this->model . $message);
    }

    public function status($id)
    {
        $message = $this->crud_repository->status($id, $this->model);
        return redirect()->route($this->view.'.index')->with('status', $this->model . $message);
    }

    public function search(Request $request)
    {
        $view=$this->view;
        $q = $request->get ( 'search' );
        $customers = app('App\\Models\\' . $this->model)::where('first_name','LIKE','%'.$q.'%')->orWhere('last_name','LIKE','%'.$q.'%')->get();  
       
        if(count($customers) > 0)
          return view('mycomponent.datatable',compact('customers','view'));
        else 
        return view('mycomponent.datatable',compact('customers','view'));
    }


    public function getSupplier()
    {
        $suppliers=app('App\\Models\\' . $this->model)::role('Supplier')->get();
        return view('customer.index',compact('suppliers'));
    }
  
}
