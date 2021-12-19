<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Social\SocialAccountRequest;
use App\Models\Doctor;
use App\Models\SocialAccount;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\Response;

class SocialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Doctor $doctor
     * @return LengthAwarePaginator
     */
    public function index(Doctor $doctor): LengthAwarePaginator
    {
        return $doctor->socials()->paginate(10);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param SocialAccountRequest $request
     * @param Doctor $doctor
     * @return Response
     */
    public function store(SocialAccountRequest $request, Doctor $doctor): Response
    {
        $doctor->socials()->create($request->validated());

        return response(['message' => 'Item was successfully added!']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param SocialAccountRequest $request
     * @param SocialAccount $social
     * @return Response
     */
    public function update(SocialAccountRequest $request, SocialAccount $social): Response
    {
        $social->update($request->validated());

        return response(['message' => 'Item was successfully updated!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param SocialAccount $social
     * @return Response
     */
    public function destroy(SocialAccount $social): Response
    {
        $social->delete();

        return response(['message' => 'Item was successfully deleted!']);
    }
}
