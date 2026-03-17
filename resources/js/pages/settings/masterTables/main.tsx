/* eslint-disable @typescript-eslint/no-explicit-any */
import SidebarLayout from '@/components/sidebar-layout';
import AppLayout from '@/layouts/app-layout';
import { Head, router } from '@inertiajs/react';
import { useState } from 'react';
import AlertStatusMaster from './alert-status-master';
import AlertTypeMaster from './alert-type-master';
import BloodTypeMaster from './blood-type-master';
import BrakeTypeMaster from './brake-type-master';
import ChargeMaster from './charge-master';
import CityMaster from './city-master';
import ContractTypeMaster from './contract-type-master';
import CountryMaster from './country-master';
import DimensionRimMaster from './dimension-rim-master';
import EconomicActivityCategoryMaster from './economic-activity-category-master';
import EconomicActivityMaster from './economic-activity-master';
import EducationalLevelMaster from './educational-level-master';
import FuelTypeMaster from './fuel-type-master';
import IdentificationsMaster from './identifications-master';
import InspectionCategoryMaster from './inspection-category-master';
import InspectionMaster from './inspection-master';
import LicenseCategoryMaster from './license-category-master';
import MaritalStatusMaster from './marital-status-master';
import PermissionMaster from './permission-master';
import ProductServiceMaster from './product-service-master';
import ProvinceMaster from './province-master';
import RelationshipMaster from './relationship-master';
import ResourceDocumentMaster from './resource-document-master';
import RoleMaster from './role-master';
import RouteMaster from './route-master';
import ShoeSizeMaster from './shoe-size-master';
import SupplierCategoryMaster from './supplier-category-master';
import UserTypeMaster from './user-type-master';
import VehicleBrandMaster from './vehicle-brand-master';
import VehicleClassMaster from './vehicle-class-master';
import VehicleLineMaster from './vehicle-line-master';
import VehicleTypeMaster from './vehicle-type-master';
import WorkAreaMaster from './work-area-master';

// 1. Definimos el tipo base para un registro (tiene ID y cualquier otra cosa)
type MasterRecord = { id: number } & Record<string, unknown>;

// 2. Definimos la estructura de la paginación de forma Genérica <T>
// Esto es necesario para poder escribir PaginatedData<MasterRecord>
interface PaginatedData<T> {
    data: T[];
    links: {
        url: string | null;
        label: string;
        active: boolean;
    }[];
    meta: {
        current_page: number;
        from: number;
        last_page: number;
        path: string;
        per_page: number;
        to: number;
        total: number;
        links?: any[]; // Opcional si ya usas 'links' fuera de meta
        [key: string]: any;
    };
}

// 3. Definimos el tipo híbrido (puede ser lista simple O paginada)
type HybridData = MasterRecord[] | PaginatedData<MasterRecord>;

// --- Definición de Interfaces ---
// 1. Identificación
// interface Identification {
//     id: number;
//     description_identification: string;
//     visibility: string;
//     company_view: number[] | string[] | null;
// }

// // 2. Nivel Educativo
// interface EducationalLevel {
//     id: number;
//     description_leveleducation: string;
//     visibility: string;
//     company_view: number[] | string[] | null;
// }

// // 3. Tipo de Sangre (NUEVO)
// interface BloodType {
//     id: number;
//     blood_type_description: string;
//     visibility: string;
//     company_view: number[] | string[] | null;
// }

// interface AlertType {
//     id: number;
//     name: string;
//     description: string | null;
//     severity_level: string;
//     icon: string | null;
//     visibility: string;
//     company_view: number[] | string[] | null;
// }

// interface AlertStatus {
//     id: number;
//     code: number;
//     name: string;
//     icon_description: string | null;
//     description: string | null;
//     visibility: string;
//     company_view: number[] | string[] | null;
// }

// interface ContractType {
//     id: number;
//     contract_name: string;
//     description_typecontract: string | null;
//     start_contract: number | null;
//     contract_limit: number | null;
//     visibility: string;
//     company_view: number[] | string[] | null;
// }

// interface BrakeType {
//     id: number;
//     brake_type_description: string;
//     visibility: string;
//     company_view: number[] | string[] | null;
// }

// interface WorkArea {
//     id: number;
//     workarea_description: string;
// }

// interface Charge {
//     id: number;
//     area: number | null;
//     code_charge: string;
//     description_charge: string;
//     visibility: string;
//     company_view: number[] | string[] | null;
//     work_area?: WorkArea;
// }

// interface DimensionRim {
//     id: number;
//     type_rims: string;
//     inch: string;
//     visibility: string;
//     company_view: number[] | string[] | null;
// }

// interface EconomicActivity {
//     // <--- Nueva interfaz
//     id: number;
//     economicactivity_number: string;
//     description_economicactivity: string;
//     category_id: string;
//     visibility: string;
//     company_view: number[] | string[] | null;
// }

// interface EconomicActivityCategory {
//     // <--- Nueva interfaz
//     id: number;
//     division: string;
//     groups: string;
//     description: string;
//     visibility: string;
//     company_view: number[] | string[] | null;
// }

// interface InspectionCategory {
//     // <--- Nueva interfaz
//     id: number;
//     name_description: string;
//     visibility: string;
//     company_view: number[] | string[] | null;
// }

// interface Country {
//     // <--- Nueva interfaz
//     id: number;
//     code_country: string;
//     country_name: string;
//     visibility: string;
//     company_view: number[] | string[] | null;
//     countries: Country[];
// }

// interface Province {
//     // <--- Nueva interfaz
//     id: number;
//     department_name: string;
//     partner_country: number;
//     visibility: string;
//     company_view: number[] | string[] | null;
//     country?: Country;
// }

// interface City {
//     // <--- Nueva interfaz
//     id: number;
//     city_name: string;
//     partner_country: number;
//     associate_department: number;
//     visibility: string;
//     company_view: number[] | string[] | null;
//     country?: Country;
//     province?: Province;
// }

// interface FuelType {
//     // <--- Nueva interfaz
//     id: number;
//     fuel_types_description: string;
//     visibility: string;
//     company_view: number[] | string[] | null;
// }

// interface Inspection {
//     // <--- Nueva interfaz
//     id: number;
//     name_description: string;
//     category_id: number;
//     visibility: string;
//     company_view: number[] | string[] | null;
//     category?: InspectionCategory;
// }

// interface LicenseCategory {
//     // <--- Nueva interfaz
//     id: number;
//     code_licensecategory: string;
//     description_licensecategory: string;
//     visibility: string;
//     company_view: number[] | string[] | null;
// }

// interface VehicleType {
//     // <--- Nueva interfaz
//     id: number;
//     vehicle_type_name: string;
//     visibility: string;
//     company_view: number[] | string[] | null;
// }

// interface VehicleBrand {
//     // <--- Nueva interfaz
//     id: number;
//     code_brand_vehicle: string;
//     brand_vehicle: string;
//     visibility: string;
//     company_view: number[] | string[] | null;
// }

// interface WorkArea {
//     // <--- Asegúrate de tener esta interfaz (ya la usábamos en Charge)
//     id: number;
//     workarea_description: string; // Nota: En el paso de 'Charge' la llamamos 'name', verifica tu modelo.
//     // Si en DB es workarea_description, usa eso. He ajustado el componente WorkAreaMaster para usar workarea_description.
//     visibility: string;
//     company_view: number[] | string[] | null;
// }

// interface MaritalStatus {
//     // <--- Nueva interfaz
//     id: number;
//     description_maritalstatus: string;
//     visibility: string;
//     company_view: number[] | string[] | null;
// }

// interface Permission {
//     // <--- Nueva interfaz
//     id: number;
//     name: string;
//     guard_name: string;
//     visibility: string;
//     company_view: number[] | string[] | null;
// }

// interface SupplierCategory {
//     id: number;
//     supplier_category_description?: string;
//     name?: string;
// }

// interface ProductAndService {
//     // <--- Nueva interfaz
//     id: number;
//     supplier_category: number | null;
//     productandservice_description: string;
//     visibility: string;
//     company_view: number[] | string[] | null;
//     supplierCategory?: SupplierCategory;
// }

// interface Relationship {
//     // <--- Nueva interfaz
//     id: number;
//     description_relationship: string;
//     visibility: string;
//     company_view: number[] | string[] | null;
// }

// interface ResourceDocument {
//     id: number;
//     name_document: string;
//     visibility: string;
//     company_view: number[] | string[] | null;
// }

// interface Role {
//     // <--- Nueva interfaz
//     id: number;
//     name: string;
//     guard_name: string;
//     visibility: string;
//     company_view: number[] | string[] | null;
// }

// interface RouteData {
//     // <--- Nueva interfaz (usamos RouteData para no confundir con route de ziggy)
//     id: number;
//     name_route: string;
//     description_route: string | null;
//     type_route: string;
//     visibility: string;
//     company_view: number[] | string[] | null;
// }

// interface ShoeSize {
//     // <--- Nueva interfaz
//     id: number;
//     description_shoesize: string;
//     visibility: string;
//     company_view: number[] | string[] | null;
// }

// interface SupplierCategory {
//     // <--- Ya debería existir por el paso de Productos, pero asegúrate que tenga esta estructura
//     id: number;
//     description_categorysupplier: string; // Nota: en productos quizás lo llamaste diferente en la interfaz, unifica nombres
//     visibility: string;
//     company_view: number[] | string[] | null;
// }

// interface UserType {
//     // <--- Nueva interfaz
//     id: number;
//     description_usertype: string;
//     visibility: string;
//     company_view: number[] | string[] | null;
// }

// interface VehicleClass {
//     // <--- Nueva interfaz
//     id: number;
//     vehicle_class_description: string;
//     visibility: string;
//     company_view: number[] | string[] | null;
// }

// interface VehicleLine {
//     // <--- Nueva interfaz
//     id: number;
//     brand_vehicle: string;
//     line_vehicle: string;
//     visibility: string;
//     company_view: number[] | string[] | null;
//     brand?: VehicleBrand;
// }

interface Props {
    // identifications: Identification[];
    // educationalLevels: EducationalLevel[];
    // bloodTypes: BloodType[];
    // alertTypes: AlertType[];
    // alertStatuses: AlertStatus[];
    // contractTypes: ContractType[];
    // brakeTypes: BrakeType[];
    // charges: Charge[];
    // workAreas: WorkArea[];
    // dimensionRims: DimensionRim[];
    // economicActivities: EconomicActivity[];
    // economicActivityCategories: EconomicActivityCategory[];
    // inspectionCategories: InspectionCategory[];
    // countries: Country[];
    // provinces: Province[];
    // cities: City[];
    // fuelTypes: FuelType[];
    // inspections: Inspection[];
    // licenseCategories: LicenseCategory[];
    // vehicleTypes: VehicleType[];
    // vehicleBrands: VehicleBrand[];
    // maritalStatuses: MaritalStatus[];
    // permissions: Permission[];
    // productsAndServices: ProductAndService[];
    // supplierCategories: SupplierCategory[];
    // relationships: Relationship[];
    // resourceDocuments: ResourceDocument[];
    // roles: Role[];
    // routesData: RouteData[];
    // shoeSizes: ShoeSize[];
    // userTypes: UserType[];
    // vehicleClasses: VehicleClass[];
    // vehicleLines: PaginatedData<MasterRecord>;
    // currentTab?: string;
    //  workAreas: WorkArea[];
    // Listas simples
    // identifications: any[];
    // educationalLevels: any[];
    // bloodTypes: any[];
    // alertStatuses: any[];
    // alertTypes: any[];
    // contractTypes: any[];
    // brakeTypes: any[];
    // charges: any[];
    // workAreas: any[];
    // dimensionRims: any[];
    // economicActivities: any[];
    // economicActivityCategories: any[];
    // inspectionCategories: any[];
    // countries: any[];
    // provinces: any[];
    // fuelTypes: any[];
    // inspections: any[];
    // licenseCategories: any[];
    // vehicleTypes: any[];
    // vehicleBrands: any[];
    // maritalStatuses: any[];
    // productsAndServices: any[];
    // supplierCategories: any[];
    // relationships: any[];
    // resourceDocuments: any[];
    // roles: any[];
    // shoeSizes: any[];
    // userTypes: any[];
    // vehicleClasses: any[];

    // // Datos Paginados
    // permissions: PaginatedData;
    // vehicleLines: PaginatedData;
    // routesData: PaginatedData;
    // cities: PaginatedData;

    identifications: HybridData;
    educationalLevels: HybridData;
    bloodTypes: HybridData;
    alertStatuses: HybridData;
    alertTypes: HybridData;
    contractTypes: HybridData;
    brakeTypes: HybridData;
    charges: HybridData;
    workAreas: HybridData;
    dimensionRims: HybridData;
    economicActivities: HybridData;
    economicActivityCategories: HybridData;
    inspectionCategories: HybridData;
    countries: HybridData;
    provinces: HybridData;
    fuelTypes: HybridData;
    inspections: HybridData;
    licenseCategories: HybridData;
    vehicleTypes: HybridData;
    vehicleBrands: HybridData;
    maritalStatuses: HybridData;
    productsAndServices: HybridData;
    supplierCategories: HybridData;
    relationships: HybridData;
    resourceDocuments: HybridData;
    roles: HybridData;
    shoeSizes: HybridData;
    userTypes: HybridData;
    vehicleClasses: HybridData;
    permissions: HybridData;
    vehicleLines: HybridData;
    routesData: HybridData;
    cities: HybridData;
    // 1.PARA LOS SELECTS
    workAreasSelect: any[];
    countriesSelect: any[];
    provincesSelect: any[];
    inspectionCategoriesSelect: any[];
    supplierCategoriesSelect: any[];
    vehicleBrandsSelect: any[];
    economicActivityCategoriesSelect: any[];

    currentTab?: string;
}

// export default function MainMaster({
//     identifications,
//     educationalLevels,
//     bloodTypes,
//     alertTypes,
//     alertStatuses,
//     contractTypes,
//     brakeTypes,
//     charges,
//     workAreas,
//     dimensionRims,
//     economicActivities,
//     economicActivityCategories,
//     inspectionCategories,
//     countries,
//     provinces,
//     cities,
//     fuelTypes,
//     inspections,
//     licenseCategories,
//     vehicleTypes,
//     vehicleBrands,
//     maritalStatuses,
//     permissions,
//     productsAndServices,
//     supplierCategories,
//     relationships,
//     resourceDocuments,
//     roles,
//     routesData,
//     shoeSizes,
//     userTypes,
//     vehicleClasses,
//     vehicleLines,
//     currentTab = 'item1',
//     // Valor por defecto
// }: Props)
export default function MainMaster(props: Props) {
    const { currentTab = 'item1', ...dataProps } = props;
    const [activeItem, setActiveItem] = useState(currentTab);

    const handleTabChange = (itemId: string) => {
        setActiveItem(itemId);

        router.get(
            '/settings/masterTables/main', // Asegúrate que este sea el nombre de tu ruta en web.php
            { tab: itemId },
            {
                preserveState: true, // Mantiene el estado de React
                preserveScroll: true, // Mantiene la posición del scroll
                replace: true, // Reemplaza la historia para no llenar el botón "Atrás"
                // only: [], // Recarga todo lo necesario (o puedes optimizar cargando solo lo necesario)
            },
        );
    };

    const menuSections = [
        {
            title: 'Listado tablas Maestras',
            items: [
                { id: 'item1', label: 'Maestra de Tipo de Identificaciones' },
                { id: 'item2', label: 'Maestra de Niveles Educativos' },
                { id: 'item3', label: 'Maestra de Tipo de Sangre' },
                { id: 'item4', label: 'Maestra de Estados de Alertas' },
                { id: 'item5', label: 'Maestra de Tipo de Alertas' },
                { id: 'item6', label: 'Maestra de Tipo de Contrato' },
                { id: 'item7', label: 'Maestra de Tipo de Frenos' },
                { id: 'item8', label: 'Maestra de Cargos Empresariales' },
                { id: 'item9', label: 'Maestra de Dimensiones de Rin' },
                { id: 'item10', label: 'Maestra de Actividades Economicas' },
                { id: 'item11', label: 'Maestra de Categoria de Actividades Economicas' },
                { id: 'item12', label: 'Maestra de Categoria de Inspecciones' },
                { id: 'item13', label: 'Maestra de Paises' },
                { id: 'item14', label: 'Maestra de Departamentos' },
                { id: 'item15', label: 'Maestra de Ciudades' },
                { id: 'item16', label: 'Maestra de Tipo de Combustibles' },
                { id: 'item17', label: 'Maestra de Inspecciones' },
                { id: 'item18', label: 'Maestra de Categoria de licencias' },
                { id: 'item19', label: 'Maestra de Tipos de Vehiculos' },
                { id: 'item20', label: 'Maestra de Marcas de Vehiculos' },
                { id: 'item21', label: 'Maestra de Areas Laborales' },
                { id: 'item22', label: 'Maestra de Estado Civil' },
                { id: 'item23', label: 'Maestra de Permisos' },
                { id: 'item24', label: 'Maestra de Productos y Servicios' },
                { id: 'item25', label: 'Maestra de parentezcos' },
                { id: 'item26', label: 'Maestra de Documentos del Recurso' },
                { id: 'item27', label: 'Maestra de Roles' },
                { id: 'item28', label: 'Maestra de Rutas' },
                { id: 'item29', label: 'Maestra de Tallas de Zapatos' },
                { id: 'item30', label: 'Maestra de Categoria de Proveedores' },
                { id: 'item31', label: 'Maestra de Tipos de Usuarios' },
                { id: 'item32', label: 'Maestra de Clase de Vehiculos' },
                { id: 'item33', label: 'Maestra de Lineas Vehicular' },
            ],
        },
    ];

    // Lógica para renderizar el contenido según el item activo
    // const renderContent = () => {
    //     switch (activeItem) {
    //         case 'item1':
    //             return <IdentificationsMaster data={identifications} />;
    //         case 'item2':
    //             return <EducationalLevelMaster data={educationalLevels} />;
    //         case 'item3':
    //             return <BloodTypeMaster data={bloodTypes} />;
    //         case 'item4':
    //             return <AlertStatusMaster data={alertStatuses} />;
    //         case 'item5':
    //             return <AlertTypeMaster data={alertTypes} />;
    //         case 'item6':
    //             return <ContractTypeMaster data={contractTypes} />;
    //         case 'item7':
    //             return <BrakeTypeMaster data={brakeTypes} />;
    //         case 'item8': // <--- Nuevo case
    //             return <ChargeMaster data={charges} workAreas={workAreas} />;
    //         case 'item9':
    //             return <DimensionRimMaster data={dimensionRims} />;
    //         case 'item10':
    //             return <EconomicActivityMaster data={economicActivities} />;
    //         case 'item11':
    //             return <EconomicActivityCategoryMaster data={economicActivityCategories} />;
    //         case 'item12':
    //             return <InspectionCategoryMaster data={inspectionCategories} />;
    //         case 'item13':
    //             return <CountryMaster data={countries} />;
    //         case 'item14':
    //             return <ProvinceMaster data={provinces} countries={countries} />;
    //         case 'item15':
    //             return <CityMaster data={cities} countries={countries} provinces={provinces} />;
    //         case 'item16':
    //             return <FuelTypeMaster data={fuelTypes} />;
    //         case 'item17':
    //             return <InspectionMaster data={inspections} categories={inspectionCategories} />;
    //         case 'item18':
    //             return <LicenseCategoryMaster data={licenseCategories} />;
    //         case 'item19':
    //             return <VehicleTypeMaster data={vehicleTypes} />;
    //         case 'item20':
    //             return <VehicleBrandMaster data={vehicleBrands} />;
    //         case 'item21':
    //             return <WorkAreaMaster data={workAreas} />;
    //         case 'item22':
    //             return <MaritalStatusMaster data={maritalStatuses} />;
    //         case 'item23':
    //             return <PermissionMaster data={permissions} />;
    //         case 'item24':
    //             return <ProductServiceMaster data={productsAndServices} supplierCategories={supplierCategories} />;
    //         case 'item25':
    //             return <RelationshipMaster data={relationships} />;
    //         case 'item26':
    //             return <ResourceDocumentMaster data={resourceDocuments} />;
    //         case 'item27':
    //             return <RoleMaster data={roles} />;
    //         case 'item28':
    //             return <RouteMaster data={routesData} />;
    //         case 'item29':
    //             return <ShoeSizeMaster data={shoeSizes} />;
    //         case 'item30':
    //             return <SupplierCategoryMaster data={supplierCategories} />;
    //         case 'item31':
    //             return <UserTypeMaster data={userTypes} />;
    //         case 'item32':
    //             return <VehicleClassMaster data={vehicleClasses} />;
    //         case 'item33':
    //             return <VehicleLineMaster data={vehicleLines as any} brands={vehicleBrands as any[]} />;
    //         default:
    //             return <div className="p-4 text-gray-500">Selecciona una tabla maestra del menú.</div>;
    //     }
    // };
    const renderContent = () => {
        // Gracias a la línea 1 (eslint-disable), ahora podemos castear a 'any'
        // sin que el compilador se queje. Esto conecta los datos genéricos
        // con los componentes específicos.
        switch (activeItem) {
            case 'item1':
                return <IdentificationsMaster data={dataProps.identifications} />;
            case 'item2':
                return <EducationalLevelMaster data={dataProps.educationalLevels} />;
            case 'item3':
                return <BloodTypeMaster data={dataProps.bloodTypes} />;
            case 'item4':
                return <AlertStatusMaster data={dataProps.alertStatuses} />;
            case 'item5':
                return <AlertTypeMaster data={dataProps.alertTypes} />;
            case 'item6':
                return <ContractTypeMaster data={dataProps.contractTypes} />;
            case 'item7':
                return <BrakeTypeMaster data={dataProps.brakeTypes} />;
            case 'item8':
                return <ChargeMaster data={dataProps.charges} workAreasSelect={dataProps.workAreasSelect as any[]} />;
            case 'item9':
                return <DimensionRimMaster data={dataProps.dimensionRims} />;
            case 'item10':
                return (
                    <EconomicActivityMaster
                        data={dataProps.economicActivities}
                        economicActivityCategoriesSelect={dataProps.economicActivityCategoriesSelect}
                    />
                );
            case 'item11':
                return <EconomicActivityCategoryMaster data={dataProps.economicActivityCategories} />;
            case 'item12':
                return <InspectionCategoryMaster data={dataProps.inspectionCategories} />;
            case 'item13':
                return <CountryMaster data={dataProps.countries} />;
            case 'item14':
                return <ProvinceMaster data={dataProps.provinces} countriesSelect={dataProps.countriesSelect} />;
            case 'item15':
                return <CityMaster data={dataProps.cities} countriesSelect={dataProps.countriesSelect} provincesSelect={dataProps.provincesSelect} />;
            case 'item16':
                return <FuelTypeMaster data={dataProps.fuelTypes} />;
            case 'item17':
                return <InspectionMaster data={dataProps.inspections} inspectionCategoriesSelect={dataProps.inspectionCategoriesSelect} />;
            case 'item18':
                return <LicenseCategoryMaster data={dataProps.licenseCategories} />;
            case 'item19':
                return <VehicleTypeMaster data={dataProps.vehicleTypes} />;
            case 'item20':
                return <VehicleBrandMaster data={dataProps.vehicleBrands} />;
            case 'item21':
                return <WorkAreaMaster data={dataProps.workAreas} />;
            case 'item22':
                return <MaritalStatusMaster data={dataProps.maritalStatuses} />;
            case 'item23':
                return <PermissionMaster data={dataProps.permissions} />;
            case 'item24':
                return <ProductServiceMaster data={dataProps.productsAndServices} supplierCategoriesSelect={dataProps.supplierCategoriesSelect} />;
            case 'item25':
                return <RelationshipMaster data={dataProps.relationships} />;
            case 'item26':
                return <ResourceDocumentMaster data={dataProps.resourceDocuments} />;
            case 'item27':
                return <RoleMaster data={dataProps.roles} />;
            case 'item28':
                return <RouteMaster data={dataProps.routesData} />;
            case 'item29':
                return <ShoeSizeMaster data={dataProps.shoeSizes} />;
            case 'item30':
                return <SupplierCategoryMaster data={dataProps.supplierCategories} />;
            case 'item31':
                return <UserTypeMaster data={dataProps.userTypes} />;
            case 'item32':
                return <VehicleClassMaster data={dataProps.vehicleClasses} />;
            case 'item33':
                return <VehicleLineMaster data={dataProps.vehicleLines} vehicleBrandsSelect={dataProps.vehicleBrandsSelect} />;
            default:
                return (
                    <div className="flex h-full items-center justify-center p-4 text-gray-500">
                        <p>Selecciona una tabla maestra del menú lateral para comenzar.</p>
                    </div>
                );
        }
    };

    return (
        <AppLayout>
            <Head title="Tablas Maestras" />
            <SidebarLayout
                title="Tablas Maestras"
                version="v2.0.0"
                versions={[{ id: 'v2.0.0', label: 'v2.0.0', current: true }]}
                menuSections={menuSections}
                activeMenuItem={activeItem}
                onMenuItemChange={handleTabChange} // USAMOS LA NUEVA FUNCIÓN
                // children={undefined}
            >
                {/* Tu contenido aquí */}
                <div className="h-full p-2">{renderContent()}</div>
            </SidebarLayout>
        </AppLayout>
    );
}
