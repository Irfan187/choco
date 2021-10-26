<?php

namespace App\Http\Controllers\Catalog;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\CrudRepository;


class UnitController extends Controller
{
    protected $crud_repository;
    protected $model = "Unit";
    protected $view = 'unit';
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
        $units = $this->crud_repository->getAllData($this->model);
        $view = $this->view;
        return view('mycomponent.datatable', compact('units', 'view'));
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
            'name' => 'required'
        ]);

        $message = $this->crud_repository->storeWithOutImage($request, $this->model);
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $unit = $this->crud_repository->getById($id , $this->model);
        $view = $this->view;
        return view('catalog.'.$this->view.'.create', compact('unit', 'view'));

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
        $units = app('App\\Models\\' . $this->model)::where('name','LIKE','%'.$q.'%')->get();  
       
        if(count($units) > 0)
          return view('mycomponent.datatable',compact('units','view'));
        else 
        return view('mycomponent.datatable',compact('units','view'));
    }
}
