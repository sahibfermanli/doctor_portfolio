<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Skills\SkillRequest;
use App\Models\Doctor;
use App\Models\Skill;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\Response;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileDoesNotExist;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileIsTooBig;

class SkillController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Doctor $doctor
     * @return LengthAwarePaginator
     */
    public function index(Doctor $doctor): LengthAwarePaginator
    {
        return $doctor->skills()->paginate(10);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param SkillRequest $request
     * @param Doctor $doctor
     * @return Response
     */
    public function store(SkillRequest $request, Doctor $doctor): Response
    {
        $skill = $doctor->skills()->create($request->validated());

        if($request->hasFile('image') && $request->file('image')?->isValid()){
            try {
                $skill->clearMediaCollection();
                $skill->addMediaFromRequest('image')->toMediaCollection('skills');
            } catch (FileDoesNotExist|FileIsTooBig) {
                //
            }
        }

        return response(['message' => 'Item was successfully added!']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param SkillRequest $request
     * @param Skill $skill
     * @return Response
     */
    public function update(SkillRequest $request, Skill $skill): Response
    {
        $skill->update($request->validated());

        if($request->hasFile('image') && $request->file('image')?->isValid()){
            try {
                $skill->clearMediaCollection();
                $skill->addMediaFromRequest('image')->toMediaCollection('skills');
            } catch (FileDoesNotExist|FileIsTooBig) {
                //
            }
        }

        return response(['message' => 'Item was successfully updated!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Skill $skill
     * @return Response
     */
    public function destroy(Skill $skill): Response
    {
        $skill->delete();

        return response(['message' => 'Item was successfully deleted!']);
    }
}
