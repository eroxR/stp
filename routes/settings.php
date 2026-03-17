<?php

use App\Http\Controllers\AlertStatusController;
use App\Http\Controllers\AlertTypeController;
use App\Http\Controllers\BloodTypeController;
use App\Http\Controllers\BrakeTypeController;
use App\Http\Controllers\ChargeController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\ContractTypeController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\DimensionRimController;
use App\Http\Controllers\EconomicActivityCategoryController;
use App\Http\Controllers\EconomicActivityController;
use App\Http\Controllers\EducationalLevelController;
use App\Http\Controllers\FuelTypeController;
use App\Http\Controllers\IdentificationController;
use App\Http\Controllers\InspectionCategoryController;
use App\Http\Controllers\InspectionController;
use App\Http\Controllers\LicenseCategoryController;
use App\Http\Controllers\MaritalStatusController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ProductAndServiceController;
use App\Http\Controllers\ProvinceController;
use App\Http\Controllers\RelationshipController;
use App\Http\Controllers\ResourceDocumentController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\RouteController;
use App\Http\Controllers\Settings\MasterController;
use App\Http\Controllers\Settings\PasswordController;
use App\Http\Controllers\Settings\ProfileController;
use App\Http\Controllers\ShoeSizeController;
use App\Http\Controllers\UserTypeController;
use App\Http\Controllers\VehicleBrandController;
use App\Http\Controllers\VehicleClassController;
use App\Http\Controllers\VehicleLineController;
use App\Http\Controllers\VehicleTypeController;
use App\Http\Controllers\SupplierCategoryController;
use App\Http\Controllers\WorkAreaController;
use App\Models\Company;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::middleware('auth')->group(function () {
    Route::redirect('settings', '/settings/profile');

    Route::get('settings/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('settings/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('settings/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('settings/password', [PasswordController::class, 'edit'])->name('password.edit');

    Route::put('settings/password', [PasswordController::class, 'update'])
        ->middleware('throttle:6,1')
        ->name('password.update');

    Route::get('settings/appearance', function () {
        return Inertia::render('settings/appearance');
    })->name('appearance');

    Route::put('/password/force-update', [PasswordController::class, 'forceUpdate'])->name('password.force-update');

    Route::get('/settings/permissions', [PermissionController::class, 'index'])->name('permissions');
    // Route::post('/permissions', [PermissionController::class, 'store'])->name('manage.permissions');
    Route::post('/settings/permissions/toggle', [PermissionController::class, 'togglePermission'])->name('permissions.toggle');
    Route::post('/settings/permissions/sync', [PermissionController::class, 'syncPermissions'])->name('permissions.sync');
    Route::post('/settings/permissions/copy', [PermissionController::class, 'copyPermissions'])->name('permissions.copy');

    Route::get('/settings/company-info', [CompanyController::class, 'index'])->name('companyInfo');
    Route::put('/settings/company-info', [CompanyController::class, 'update'])->name('company.update');

    Route::get('/settings/masterTables/main', [MasterController::class, 'index'])->name('mainMaster');

    Route::post('/settings/masterTables/identifications', [IdentificationController::class, 'store'])->name('identifications.store');
    Route::put('/settings/masterTables/identifications/{identification}', [IdentificationController::class, 'update'])->name('identifications.update');
    Route::delete('/settings/masterTables/identifications/{identification}', [IdentificationController::class, 'destroy'])->name('identifications.destroy');

    Route::post('/settings/masterTables/educational-levels', [EducationalLevelController::class, 'store'])->name('educational-levels.store');
    Route::put('/settings/masterTables/educational-levels/{educationalLevel}', [EducationalLevelController::class, 'update'])->name('educational-levels.update');
    Route::delete('/settings/masterTables/educational-levels/{educationalLevel}', [EducationalLevelController::class, 'destroy'])->name('educational-levels.destroy');

    Route::post('/settings/masterTables/blood-types', [BloodTypeController::class, 'store'])->name('blood-types.store');
    Route::put('/settings/masterTables/blood-types/{bloodType}', [BloodTypeController::class, 'update'])->name('blood-types.update');
    Route::delete('/settings/masterTables/blood-types/{bloodType}', [BloodTypeController::class, 'destroy'])->name('blood-types.destroy');

    Route::post('/settings/masterTables/alert-types', [AlertTypeController::class, 'store'])->name('alert-types.store');
    Route::put('/settings/masterTables/alert-types/{alertType}', [AlertTypeController::class, 'update'])->name('alert-types.update');
    Route::delete('/settings/masterTables/alert-types/{alertType}', [AlertTypeController::class, 'destroy'])->name('alert-types.destroy');

    Route::post('/settings/masterTables/alert-statuses', [AlertStatusController::class, 'store'])->name('alert-statuses.store');
    Route::put('/settings/masterTables/alert-statuses/{alertStatus}', [AlertStatusController::class, 'update'])->name('alert-statuses.update');
    Route::delete('/settings/masterTables/alert-statuses/{alertStatus}', [AlertStatusController::class, 'destroy'])->name('alert-statuses.destroy');

    Route::post('/settings/masterTables/contract-types', [ContractTypeController::class, 'store'])->name('contract-types.store');
    Route::put('/settings/masterTables/contract-types/{contractType}', [ContractTypeController::class, 'update'])->name('contract-types.update');
    Route::delete('/settings/masterTables/contract-types/{contractType}', [ContractTypeController::class, 'destroy'])->name('contract-types.destroy');

    Route::post('/settings/masterTables/brake-types', [BrakeTypeController::class, 'store'])->name('brake-types.store');
    Route::put('/settings/masterTables/brake-types/{brakeType}', [BrakeTypeController::class, 'update'])->name('brake-types.update');
    Route::delete('/settings/masterTables/brake-types/{brakeType}', [BrakeTypeController::class, 'destroy'])->name('brake-types.destroy');

    Route::post('/settings/masterTables/charges', [ChargeController::class, 'store'])->name('charges.store');
    Route::put('/settings/masterTables/charges/{charge}', [ChargeController::class, 'update'])->name('charges.update');
    Route::delete('/settings/masterTables/charges/{charge}', [ChargeController::class, 'destroy'])->name('charges.destroy');

    Route::post('/settings/masterTables/dimension-rims', [DimensionRimController::class, 'store'])->name('dimension-rims.store');
    Route::put('/settings/masterTables/dimension-rims/{dimensionRim}', [DimensionRimController::class, 'update'])->name('dimension-rims.update');
    Route::delete('/settings/masterTables/dimension-rims/{dimensionRim}', [DimensionRimController::class, 'destroy'])->name('dimension-rims.destroy');

    Route::post('/settings/masterTables/economic-activities', [EconomicActivityController::class, 'store'])->name('economic-activities.store');
    Route::put('/settings/masterTables/economic-activities/{economicActivity}', [EconomicActivityController::class, 'update'])->name('economic-activities.update');
    Route::delete('/settings/masterTables/economic-activities/{economicActivity}', [EconomicActivityController::class, 'destroy'])->name('economic-activities.destroy');

    Route::post('/settings/masterTables/economic-activity-categories', [EconomicActivityCategoryController::class, 'store'])->name('economic-activity-categories.store');
    Route::put('/settings/masterTables/economic-activity-categories/{category}', [EconomicActivityCategoryController::class, 'update'])->name('economic-activity-categories.update');
    Route::delete('/settings/masterTables/economic-activity-categories/{category}', [EconomicActivityCategoryController::class, 'destroy'])->name('economic-activity-categories.destroy');

    Route::post('/settings/masterTables/inspection-categories', [InspectionCategoryController::class, 'store'])->name('inspection-categories.store');
    Route::put('/settings/masterTables/inspection-categories/{inspectionCategory}', [InspectionCategoryController::class, 'update'])->name('inspection-categories.update');
    Route::delete('/settings/masterTables/inspection-categories/{inspectionCategory}', [InspectionCategoryController::class, 'destroy'])->name('inspection-categories.destroy');

    Route::post('/settings/masterTables/countries', [CountryController::class, 'store'])->name('countries.store');
    Route::put('/settings/masterTables/countries/{country}', [CountryController::class, 'update'])->name('countries.update');
    Route::delete('/settings/masterTables/countries/{country}', [CountryController::class, 'destroy'])->name('countries.destroy');

    Route::post('/settings/masterTables/provinces', [ProvinceController::class, 'store'])->name('provinces.store');
    Route::put('/settings/masterTables/provinces/{province}', [ProvinceController::class, 'update'])->name('provinces.update');
    Route::delete('/settings/masterTables/provinces/{province}', [ProvinceController::class, 'destroy'])->name('provinces.destroy');

    Route::post('/settings/masterTables/cities', [CityController::class, 'store'])->name('cities.store');
    Route::put('/settings/masterTables/cities/{city}', [CityController::class, 'update'])->name('cities.update');
    Route::delete('/settings/masterTables/cities/{city}', [CityController::class, 'destroy'])->name('cities.destroy');

    Route::post('/settings/masterTables/fuel-types', [FuelTypeController::class, 'store'])->name('fuel-types.store');
    Route::put('/settings/masterTables/fuel-types/{fuelType}', [FuelTypeController::class, 'update'])->name('fuel-types.update');
    Route::delete('/settings/masterTables/fuel-types/{fuelType}', [FuelTypeController::class, 'destroy'])->name('fuel-types.destroy');

    Route::post('/settings/masterTables/inspections', [InspectionController::class, 'store'])->name('inspections.store');
    Route::put('/settings/masterTables/inspections/{inspection}', [InspectionController::class, 'update'])->name('inspections.update');
    Route::delete('/settings/masterTables/inspections/{inspection}', [InspectionController::class, 'destroy'])->name('inspections.destroy');

    Route::post('/settings/masterTables/license-categories', [LicenseCategoryController::class, 'store'])->name('license-categories.store');
    Route::put('/settings/masterTables/license-categories/{licenseCategory}', [LicenseCategoryController::class, 'update'])->name('license-categories.update');
    Route::delete('/settings/masterTables/license-categories/{licenseCategory}', [LicenseCategoryController::class, 'destroy'])->name('license-categories.destroy');

    Route::post('/settings/masterTables/vehicle-types', [VehicleTypeController::class, 'store'])->name('vehicle-types.store');
    Route::put('/settings/masterTables/vehicle-types/{vehicleType}', [VehicleTypeController::class, 'update'])->name('vehicle-types.update');
    Route::delete('/settings/masterTables/vehicle-types/{vehicleType}', [VehicleTypeController::class, 'destroy'])->name('vehicle-types.destroy');

    Route::post('/settings/masterTables/vehicle-brands', [VehicleBrandController::class, 'store'])->name('vehicle-brands.store');
    Route::put('/settings/masterTables/vehicle-brands/{vehicleBrand}', [VehicleBrandController::class, 'update'])->name('vehicle-brands.update');
    Route::delete('/settings/masterTables/vehicle-brands/{vehicleBrand}', [VehicleBrandController::class, 'destroy'])->name('vehicle-brands.destroy');

    Route::post('/settings/masterTables/work-areas', [WorkAreaController::class, 'store'])->name('work-areas.store');
    Route::put('/settings/masterTables/work-areas/{workArea}', [WorkAreaController::class, 'update'])->name('work-areas.update');
    Route::delete('/settings/masterTables/work-areas/{workArea}', [WorkAreaController::class, 'destroy'])->name('work-areas.destroy');

    Route::post('/settings/masterTables/marital-statuses', [MaritalStatusController::class, 'store'])->name('marital-statuses.store');
    Route::put('/settings/masterTables/marital-statuses/{maritalStatus}', [MaritalStatusController::class, 'update'])->name('marital-statuses.update');
    Route::delete('/settings/masterTables/marital-statuses/{maritalStatus}', [MaritalStatusController::class, 'destroy'])->name('marital-statuses.destroy');

    Route::post('/settings/masterTables/permissions', [PermissionController::class, 'store'])->name('permissions.store');
    Route::put('/settings/masterTables/permissions/{permission}', [PermissionController::class, 'update'])->name('permissions.update');
    Route::delete('/settings/masterTables/permissions/{permission}', [PermissionController::class, 'destroy'])->name('permissions.destroy');

    Route::post('/settings/masterTables/products-and-services', [ProductAndServiceController::class, 'store'])->name('products-and-services.store');
    Route::put('/settings/masterTables/products-and-services/{productAndService}', [ProductAndServiceController::class, 'update'])->name('products-and-services.update');
    Route::delete('/settings/masterTables/products-and-services/{productAndService}', [ProductAndServiceController::class, 'destroy'])->name('products-and-services.destroy');

    Route::post('/settings/masterTables/relationships', [RelationshipController::class, 'store'])->name('relationships.store');
    Route::put('/settings/masterTables/relationships/{relationship}', [RelationshipController::class, 'update'])->name('relationships.update');
    Route::delete('/settings/masterTables/relationships/{relationship}', [RelationshipController::class, 'destroy'])->name('relationships.destroy');

    Route::post('/settings/masterTables/resource-documents', [ResourceDocumentController::class, 'store'])->name('resource-documents.store');
    Route::put('/settings/masterTables/resource-documents/{resourceDocument}', [ResourceDocumentController::class, 'update'])->name('resource-documents.update');
    Route::delete('/settings/masterTables/resource-documents/{resourceDocument}', [ResourceDocumentController::class, 'destroy'])->name('resource-documents.destroy');

    Route::post('/settings/masterTables/roles', [RoleController::class, 'store'])->name('roles.store');
    Route::put('/settings/masterTables/roles/{role}', [RoleController::class, 'update'])->name('roles.update');
    Route::delete('/settings/masterTables/roles/{role}', [RoleController::class, 'destroy'])->name('roles.destroy');

    Route::post('/settings/masterTables/routes', [RouteController::class, 'store'])->name('routes.store');
    Route::put('/settings/masterTables/routes/{route}', [RouteController::class, 'update'])->name('routes.update');
    Route::delete('/settings/masterTables/routes/{route}', [RouteController::class, 'destroy'])->name('routes.destroy');

    Route::post('/settings/masterTables/shoe-sizes', [ShoeSizeController::class, 'store'])->name('shoe-sizes.store');
    Route::put('/settings/masterTables/shoe-sizes/{shoeSize}', [ShoeSizeController::class, 'update'])->name('shoe-sizes.update');
    Route::delete('/settings/masterTables/shoe-sizes/{shoeSize}', [ShoeSizeController::class, 'destroy'])->name('shoe-sizes.destroy');

    Route::post('/settings/masterTables/user-types', [UserTypeController::class, 'store'])->name('user-types.store');
    Route::put('/settings/masterTables/user-types/{userType}', [UserTypeController::class, 'update'])->name('user-types.update');
    Route::delete('/settings/masterTables/user-types/{userType}', [UserTypeController::class, 'destroy'])->name('user-types.destroy');

    Route::post('/settings/masterTables/vehicle-classes', [VehicleClassController::class, 'store'])->name('vehicle-classes.store');
    Route::put('/settings/masterTables/vehicle-classes/{vehicleClass}', [VehicleClassController::class, 'update'])->name('vehicle-classes.update');
    Route::delete('/settings/masterTables/vehicle-classes/{vehicleClass}', [VehicleClassController::class, 'destroy'])->name('vehicle-classes.destroy');

    Route::post('/settings/masterTables/vehicle-lines', [VehicleLineController::class, 'store'])->name('vehicle-lines.store');
    Route::put('/settings/masterTables/vehicle-lines/{vehicleLine}', [VehicleLineController::class, 'update'])->name('vehicle-lines.update');
    Route::delete('/settings/masterTables/vehicle-lines/{vehicleLine}', [VehicleLineController::class, 'destroy'])->name('vehicle-lines.destroy');

    Route::post('/settings/masterTables/supplier-categories', [SupplierCategoryController::class, 'store'])->name('supplier-categories.store');
    Route::put('/settings/masterTables/supplier-categories/{supplierCategory}', [SupplierCategoryController::class, 'update'])->name('supplier-categories.update');
    Route::delete('/settings/masterTables/supplier-categories/{supplierCategory}', [SupplierCategoryController::class, 'destroy'])->name('supplier-categories.destroy');
});
