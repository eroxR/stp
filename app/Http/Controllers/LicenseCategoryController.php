<?php

namespace App\Http\Controllers;

use App\Models\LicenseCategory;
use App\Http\Requests\StoreLicenseCategoryRequest;
use App\Http\Requests\UpdateLicenseCategoryRequest;

class LicenseCategoryController extends Controller
{
    public function store(StoreLicenseCategoryRequest $request)
    {
        LicenseCategory::create($request->validated());
        return redirect()->back()->with('success', 'Categoría de licencia creada correctamente.');
    }

    public function update(UpdateLicenseCategoryRequest $request, LicenseCategory $licenseCategory)
    {
        $licenseCategory->update($request->validated());
        return redirect()->back()->with('success', 'Categoría de licencia actualizada correctamente.');
    }

    public function destroy(LicenseCategory $licenseCategory)
    {
        $licenseCategory->delete();
        return redirect()->back()->with('success', 'Categoría de licencia eliminada correctamente.');
    }

}
