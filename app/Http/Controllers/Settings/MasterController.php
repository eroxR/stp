<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use App\Models\AlertStatus;
use App\Models\AlertType;
use App\Models\BloodType;
use App\Models\BrakeType;
use App\Models\Charge;
use App\Models\City;
use App\Models\ContractType;
use App\Models\DimensionRim;
use App\Models\EconomicActivity;
use App\Models\EducationalLevel;
use App\Models\Identification;
use App\Models\User;
use App\Models\WorkArea;
use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Models\EconomicActivityCategory;
use App\Models\InspectionCategory;
use App\Models\Country;
use App\Models\Province;
use App\Models\FuelType;
use App\Models\Inspection;
use App\Models\LicenseCategory;
use App\Models\MaritalStatus;
use App\Models\Permission;
use App\Models\productAndService;
use App\Models\Relationship;
use App\Models\ResourceDocument;
use App\Models\Role;
use App\Models\Route;
use App\Models\ShoeSize;
use App\Models\SupplierCategory;
use App\Models\UserType;
use App\Models\VehicleBrand;
use App\Models\VehicleClass;
use App\Models\VehicleLine;
use App\Models\VehicleType;
use Illuminate\Database\Eloquent\Builder;

class MasterController extends Controller
{
    //
    /**
     * Helper para decidir si paginar o listar todo.
     * Umbral definido: 80 registros.
     */
    private function getOrPaginate(Builder $query, string $pageName)
    {
        // Contamos primero (es una consulta ligera)
        $count = $query->count();

        if ($count > 80) {
            // Si supera el umbral, paginamos (Lista Vertical)
            return $query->paginate(20, ['*'], $pageName)->withQueryString();
        }

        // Si es poco, devolvemos todo (Grid)
        return $query->get();
    }

    public function index(Request $request)
    {
        $identifications = $this->getOrPaginate(Identification::orderBy('id', 'asc'), 'identifications_page');
        $educationalLevels = $this->getOrPaginate(EducationalLevel::orderBy('id', 'asc'), 'educational_levels_page');
        $bloodTypes = $this->getOrPaginate(BloodType::orderBy('id', 'asc'), 'blood_types_page');
        $alertTypes = $this->getOrPaginate(AlertType::orderBy('id', 'asc'), 'alert_types_page');
        $alertStatuses = $this->getOrPaginate(AlertStatus::orderBy('code', 'asc'), 'alert_statuses_page');
        $contractTypes = $this->getOrPaginate(ContractType::orderBy('id', 'asc'), 'contract_types_page');
        $brakeTypes = $this->getOrPaginate(BrakeType::orderBy('id', 'asc'), 'brake_types_page');
        $charges = $this->getOrPaginate(Charge::with('workArea')->orderBy('id', 'asc'), 'charges_page');
        $workAreasSelect = $this->getOrPaginate(WorkArea::where('visibility', '1')->orderBy('workarea_description', 'asc'), 'work_areas_select_page');
        $dimensionRims = $this->getOrPaginate(DimensionRim::orderBy('id', 'asc'), 'dimension_rims_page');
        $economicActivities = $this->getOrPaginate(EconomicActivity::orderBy('economicactivity_number', 'asc'), 'economic_activities_page');
        $economicActivityCategories = $this->getOrPaginate(EconomicActivityCategory::orderBy('division', 'asc'), 'economic_activity_categories_page');
        $inspectionCategories = $this->getOrPaginate(InspectionCategory::orderBy('id', 'asc'), 'inspection_categories_page');
        $countries = $this->getOrPaginate(Country::orderBy('country_name', 'asc'), 'countries_page');
        $provinces = $this->getOrPaginate(Province::with('country')->orderBy('department_name', 'asc'), 'provinces_page');
        $cities = $this->getOrPaginate(City::with(['country', 'province'])->orderBy('city_name', 'asc'), 'cities_page');
        $fuelTypes = $this->getOrPaginate(FuelType::orderBy('id', 'asc'), 'fuel_types_page');
        $inspections = $this->getOrPaginate(Inspection::with('category')->orderBy('id', 'asc'), 'inspections_page');
        $licenseCategories = $this->getOrPaginate(LicenseCategory::orderBy('code_licensecategory', 'asc'), 'license_categories_page');
        $vehicleTypes = $this->getOrPaginate(VehicleType::orderBy('vehicle_type_name', 'asc'), 'vehicle_types_page');
        $vehicleBrands = $this->getOrPaginate(VehicleBrand::orderBy('brand_vehicle', 'asc'), 'vehicle_brands_page');
        $workAreas = $this->getOrPaginate(WorkArea::orderBy('workarea_description', 'asc'), 'work_areas_page');
        $maritalStatuses = $this->getOrPaginate(MaritalStatus::orderBy('id', 'asc'), 'marital_statuses_page');
        $permissions = $this->getOrPaginate(Permission::orderBy('name', 'asc'), 'permissions_page');
        $productsAndServices = $this->getOrPaginate(productAndService::with('supplierCategory')->orderBy('productandservice_description', 'asc'), 'products_and_services_page');
        $supplierCategori = $this->getOrPaginate(SupplierCategory::orderBy('id', 'asc'), 'supplier_categories_select_page');
        $relationships = $this->getOrPaginate(Relationship::orderBy('id', 'asc'), 'relationships_page');
        $resourceDocuments = $this->getOrPaginate(ResourceDocument::orderBy('name_document', 'asc'), 'resource_documents_page');
        $roles = $this->getOrPaginate(Role::orderBy('name', 'asc'), 'roles_page');
        $routes = $this->getOrPaginate(Route::orderBy('name_route', 'asc'), 'routes_page');
        $shoeSizes = $this->getOrPaginate(ShoeSize::orderBy('description_shoesize', 'asc'), 'shoe_sizes_page');
        $supplierCategories = $this->getOrPaginate(SupplierCategory::orderBy('description_categorysupplier', 'asc'), 'supplier_categories_page');
        $userTypes = $this->getOrPaginate(UserType::orderBy('description_usertype', 'asc'), 'user_types_page');
        $vehicleClasses = $this->getOrPaginate(VehicleClass::orderBy('vehicle_class_description', 'asc'), 'vehicle_classes_page');
        $vehicleLines = $this->getOrPaginate(VehicleLine::with('brand')->orderBy('line_vehicle', 'asc'), 'vehicle_lines_page');
        
        $workAreasSelect = WorkArea::where('visibility', '1')->orderBy('workarea_description', 'asc')->get();
        $countriesSelect = Country::where('visibility', '1')->orderBy('country_name', 'asc')->get();
        $provincesSelect = Province::where('visibility', '1')->orderBy('department_name', 'asc')->get();
        $inspectionCategoriesSelect = InspectionCategory::where('visibility', '1')->orderBy('id', 'asc')->get();
        $supplierCategoriesSelect = SupplierCategory::orderBy('description_categorysupplier', 'asc')->get();
        $vehicleBrandsSelect = VehicleBrand::orderBy('brand_vehicle', 'asc')->get();
        $economicActivityCategoriesSelect = EconomicActivityCategory::orderBy('division', 'asc')->get();

        // ... consultas anteriores
        // $identifications = Identification::orderBy('id', 'asc')->get();
        // $educationalLevels = EducationalLevel::orderBy('id', 'asc')->get();
        // $bloodTypes = BloodType::orderBy('id', 'asc')->get();
        // $alertTypes = AlertType::orderBy('id', 'asc')->get();
        // $alertStatuses = AlertStatus::orderBy('code', 'asc')->get();
        // $contractTypes = ContractType::orderBy('id', 'asc')->get();
        // $brakeTypes = BrakeType::orderBy('id', 'asc')->get();
        // $charges = Charge::with('workArea')->orderBy('id', 'asc')->get();
        // // $dimensionRims = DimensionRim::orderBy('id', 'desc')->get();
        // $dimensionRims = DimensionRim::orderBy('id', 'asc')
        //     ->paginate(20, ['*'], 'dimension_rims_page')
        //     ->withQueryString();
        // // $economicActivities = EconomicActivity::orderBy('economicactivity_number', 'asc')->get();
        // $economicActivities = EconomicActivity::orderBy('economicactivity_number', 'asc')
        //     ->paginate(20, ['*'], 'economic_activities_page')
        //     ->withQueryString();
        // // $economicActivityCategories = EconomicActivityCategory::orderBy('division', 'asc')->get();
        // $economicActivityCategories = EconomicActivityCategory::orderBy('division', 'asc')
        //     ->paginate(20, ['*'], 'economic_activity_categories_page')
        //     ->withQueryString();
        // $inspectionCategories = InspectionCategory::orderBy('id', 'asc')->get();
        // // $countries = Country::orderBy('country_name', 'asc')->get();
        // $countries = Country::orderBy('country_name', 'asc')
        //     ->paginate(20, ['*'], 'countries_page')
        //     ->withQueryString();
        // // $provinces = Province::with('country')->orderBy('department_name', 'asc')->get();
        // $provinces = Province::with('country')
        //     ->orderBy('department_name', 'asc')
        //     ->paginate(20, ['*'], 'provinces_page')
        //     ->withQueryString();
        // // $cities = City::with(['country', 'province'])->orderBy('city_name', 'asc')->get();
        // $cities = City::with(['country', 'province'])
        //     ->orderBy('city_name', 'asc')
        //     ->paginate(20, ['*'], 'cities_page') // Importante: nombre de página único
        //     ->withQueryString();
        // $fuelTypes = FuelType::orderBy('id', 'asc')->get();
        // $inspections = Inspection::with('category')->orderBy('id', 'asc')->get();
        // $licenseCategories = LicenseCategory::orderBy('code_licensecategory', 'asc')->get();
        // $vehicleTypes = VehicleType::orderBy('vehicle_type_name', 'asc')->get();
        // $vehicleBrands = VehicleBrand::orderBy('brand_vehicle', 'asc')->get();
        // $workAreas = WorkArea::orderBy('workarea_description', 'asc')->get();
        // $maritalStatuses = MaritalStatus::orderBy('id', 'asc')->get();
        // // $permissions = Permission::orderBy('name', 'asc')->get();
        // $permissions = Permission::orderBy('name', 'asc')
        //     ->paginate(20, ['*'], 'permissions_page')
        //     ->withQueryString();
        // $productsAndServices = productAndService::with('supplierCategory')
        //     ->orderBy('productandservice_description', 'asc')
        //     ->get();
        // $supplierCategoriesSelect = SupplierCategory::orderBy('id', 'asc')->get();
        // $relationships = Relationship::orderBy('id', 'asc')->get();
        // $resourceDocuments = ResourceDocument::orderBy('name_document', 'asc')->get();
        // $roles = Role::orderBy('name', 'asc')->get();
        // // $routes = Route::orderBy('name_route', 'asc')->get();
        // $routes = Route::orderBy('name_route', 'asc')
        //     ->paginate(20, ['*'], 'routes_page')
        //     ->withQueryString();
        // $shoeSizes = ShoeSize::orderBy('description_shoesize', 'asc')->get();
        // $supplierCategories = SupplierCategory::orderBy('description_categorysupplier', 'asc')->get();
        // $userTypes = UserType::orderBy('description_usertype', 'asc')->get();
        // $vehicleClasses = VehicleClass::orderBy('vehicle_class_description', 'asc')->get();
        // $vehicleLines = VehicleLine::with('brand')->orderBy('line_vehicle', 'asc')->paginate(20, ['*'], 'lines_page') // Nombre único para la página
        //     ->withQueryString();

        $currentTab = $request->input('tab', 'item1');

        return Inertia::render('settings/masterTables/main', [
            'identifications' => $identifications,
            'educationalLevels' => $educationalLevels,
            'bloodTypes' => $bloodTypes,
            'alertTypes' => $alertTypes,
            'alertStatuses' => $alertStatuses,
            'contractTypes' => $contractTypes,
            'brakeTypes' => $brakeTypes,
            'charges' => $charges,
            'workAreasSelect' => $workAreasSelect,
            'dimensionRims' => $dimensionRims,
            'economicActivities' => $economicActivities,
            'economicActivityCategoriesSelect' => $economicActivityCategoriesSelect,
            'economicActivityCategories' => $economicActivityCategories,
            'inspectionCategories' => $inspectionCategories,
            'countries' => $countries,
            'provinces' => $provinces,
            'countriesSelect' => $countriesSelect,
            'cities' => $cities,
            'fuelTypes' => $fuelTypes,
            'inspections' => $inspections,
            'inspectionCategoriesSelect' => $inspectionCategoriesSelect,
            'licenseCategories' => $licenseCategories,
            'vehicleTypes' => $vehicleTypes,
            'vehicleBrands' => $vehicleBrands,
            'workAreas' => $workAreas,
            'maritalStatuses' => $maritalStatuses,
            'permissions' => $permissions,
            'productsAndServices' => $productsAndServices,
            'supplierCategoriesSelect' => $supplierCategoriesSelect,
            'relationships' => $relationships,
            'resourceDocuments' => $resourceDocuments,
            'roles' => $roles,
            'routesData' => $routes,
            'shoeSizes' => $shoeSizes,
            'supplierCategories' => $supplierCategories,
            'userTypes' => $userTypes,
            'vehicleClasses' => $vehicleClasses,
            'vehicleLines' => $vehicleLines,
            'vehicleBrandsSelect' => $vehicleBrandsSelect,
            'currentTab' => $currentTab,
        ]);
    }
}
