<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Doctor\UpdateDoctorRequest;
use App\Models\Doctor;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\Response;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileDoesNotExist;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileIsTooBig;

class DoctorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return LengthAwarePaginator
     */
    public function index(): LengthAwarePaginator
    {
        return Doctor::query()->paginate(10);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateDoctorRequest $request
     * @param Doctor $doctor
     * @return Response
     */
    public function update(UpdateDoctorRequest $request, Doctor $doctor): Response
    {
        $doctor->update($request->validated());

        if($request->hasFile('image') && $request->file('image')?->isValid()){
            try {
                $doctor->clearMediaCollection();
                $doctor->addMediaFromRequest('image')->toMediaCollection('doctors');
            } catch (FileDoesNotExist|FileIsTooBig) {
                //
            }
        }

        return response(['message' => 'Item was successfully updated!']);
    }
}
