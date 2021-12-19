<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Education\EducationRequest;
use App\Models\Doctor;
use App\Models\EducationalQualification;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\Response;

class EducationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Doctor $doctor
     * @return LengthAwarePaginator
     */
    public function index(Doctor $doctor): LengthAwarePaginator
    {
        return $doctor->education()->paginate(10);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param EducationRequest $request
     * @param Doctor $doctor
     * @return Response
     */
    public function store(EducationRequest $request, Doctor $doctor): Response
    {
        $doctor->education()->create($request->validated());

        return response(['message' => 'Item was successfully added!']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param EducationRequest $request
     * @param EducationalQualification $education
     * @return Response
     */
    public function update(EducationRequest $request, EducationalQualification $education): Response
    {
        $education->update($request->validated());

        return response(['message' => 'Item was successfully updated!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param EducationalQualification $education
     * @return Response
     */
    public function destroy(EducationalQualification $education): Response
    {
        $education->delete();

        return response(['message' => 'Item was successfully deleted!']);
    }
}
