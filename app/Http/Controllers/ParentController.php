<?php

namespace App\Http\Controllers;

use App\Traits\ResponseTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class ParentController extends Controller
{
    
    use ResponseTrait;
    protected $service;
    protected $model;

    public function dataTable(Request $request, $query = null): JsonResponse
    {
        $attributes = $request->all();
        return $this->success($this->service->getData($attributes, $query));
    }

    public function all(): JsonResponse
    {
        return $this->success($this->service->getList()); // check in service
    }

    public function getById($id): JsonResponse
    {
        $object = $this->service->getById($id);
        if ($object) {
            return $this->success($object);
        }
        return $this->badRequest("Given ID is not exist.");
    }

    public function getByIdWithRelation($id, $relations = []): JsonResponse
    {
        $object = $this->service->getByIdWithRelation($id, $relations);
        if ($object) {
            return $this->success($object);
        }
        return $this->badRequest("Given ID is not exist.");
    }

    public function getWithRelation($relations = []): JsonResponse
    {
        $object = $this->service->getWithRelation($relations);
        if ($object) {
            return $this->success($object);
        }
        return $this->badRequest("Data is not exist.");
    }

    public function create(Request $request): JsonResponse
    {
        try {
            // 1. Validate if the attributes are processable
            $this->validate($request, $this->model::rulesToCreate(), $this->model::rulesToCreateMessages());
            DB::beginTransaction();
            $attributes = $request->all();
            // 2. Try to create the records
            $createdObject = $this->service->create($attributes);
            // 3. If everything is fine, response success to user and commit the data to database
            if ($createdObject) {
                DB::commit();
                return $this->success($createdObject);
            }
            // 4. Say sorry as something went wrong and rollback data.
            DB::rollBack();
            return $this->error();
        } catch (ValidationException $validate) {
            DB::rollBack();
            return $this->unprocessable($validate->errors());
        }
    }

    public function update(Request $request, $id): JsonResponse
    {
        try {
            $object = $this->service->getById($id);
            if ($object) {
                // 1. Validate if the attributes are processable
                $this->validate($request, $this->model::rulesToUpdate(),
                $this->model::rulesToUpdateMessages());
                DB::beginTransaction();
                $attributes = $request->all();
                // 2. Try to update the records
                $updatedObject = $this->service->updateById($id, $attributes);
                // 3. If everything is fine, response success to user and commit the data to database
                if ($updatedObject) {
                    DB::commit();
                    return $this->success($updatedObject);
                }
                // 4. Say sorry as something went wrong.
                DB::rollBack();
                return $this->error();
            }
            DB::rollBack();
            return $this->badRequest("Given ID is not exist.");
        } catch (ValidationException $validate) {
            DB::rollBack();
            return $this->unprocessable($validate->errors());
        }
    }

    public function delete($id): JsonResponse
    {
        // 1. Check if id is valid
        $object = $this->service->getById($id);
        if ($object) {
            // 2. Try to delete the records
            $deleteOk = $this->service->delete($id);
            // 3. If everything is fine, response success to user
            if ($deleteOk) {
                return $this->success($deleteOk);
            }
            // 4. Say sorry as something went wrong.
            return $this->error();
        }
        return $this->badRequest("Given ID is not exist.");
    }
}
