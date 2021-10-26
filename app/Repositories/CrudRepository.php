<?php

namespace App\Repositories;

use Exception;
use GrahamCampbell\ResultType\Success;
use Illuminate\Support\Facades\DB;

class CrudRepository
{
    private $model;

    public function storeWithSingleImage($request, $model)
    {
        DB::beginTransaction();
        try {
            $this->model = app('App\\Models\\' . $model);
            $data = $this->model->create($request->only($this->model->getFillable()));
            $imageName = time() . rand(1, 10000) . '.' . $request->image->getClientOriginalExtension();
            $request->image->move(public_path('images/' . $model), $imageName);
            $data->update([
                'image' => $imageName
            ]);
            DB::commit();
            return trans('message.Success_created');
        } catch (Exception $e) {
            DB::rollback();
            return $e->getMessage();
        }
    }

    public function storeWithOutImage($request, $model)
    {
        DB::beginTransaction();
        try {
            $this->model = app('App\\Models\\' . $model);
            $this->model->create($request->only($this->model->getFillable()));
            DB::commit();
            return trans('message.Success_created');
        } catch (Exception $e) {
            DB::rollback();
            return $e->getMessage();
        }
    }

    public function update($request, $id, $model)
    {
        DB::beginTransaction();
        try {
            $this->model = app('App\\Models\\' . $model);
            $data = $this->model::find($id);
            //delete image in array by value "image"
            $fill = $this->model->getFillable();
            if (($key = array_search("image", $fill)) !== false) {
                unset($fill[$key]);
            }
            $data->update($request->only($fill));
            
            if ($request->has('image')) {
                if(file_exists(public_path('images/' . $model).$data->image)){
                    unlink(public_path('images/' . $model) . $data->image);
                }
                $imageName = time() . rand(1, 10000) . '.' . $request->image->getClientOriginalExtension();
                $request->image->move(public_path('images/' . $model), $imageName);
                $data->update([
                    'image' => $imageName
                ]);
            }
            DB::commit();
            return trans('message.Success_updated');
        } catch (Exception $e) {
            DB::rollback();
            return $e->getMessage();
        }
    }

    public function destroy($id, $model)
    {
        DB::beginTransaction();
        try {
            $this->model = app('App\\Models\\' . $model);
            $data = $this->model::find($id);
            $data->delete();
            DB::commit();
            return trans('message.Success_deleted');
        } catch (Exception $e) {
            DB::rollback();
            return $e->getMessage();
        }
    }
    public function getAllData($model)
    {
            $this->model = app('App\\Models\\' . $model);
            $entries = $this->model::get();
            return $entries;

    }
    public function getById($id, $model)
    {
            $this->model = app('App\\Models\\' . $model);
            $entry = $this->model::find($id);
            return $entry;

    }
    

    public function status($id, $model)
    {
        DB::beginTransaction();
        try {
            $this->model = app('App\\Models\\' . $model);
            $data = $this->model::find($id);

            if ($data->isActive == 1)
                $data->update([
                    'isActive' => 0
                ]);
            else
                $data->update([
                    'isActive' => 1
                ]);
            DB::commit();
            return trans('message.Success_status');
        } catch (Exception $e) {
            DB::rollback();
            return $e->getMessage();
        }
    }
}
