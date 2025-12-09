<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Vehicle;
use App\Models\VehicleLine;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);


        $this->call([
            CompanySeeder::class,
            BranchSeeder::class,
            PeriodSeeder::class,
            CountrySeeder::class,
            ProvinceSeeder::class,
            CitySeeder::class,
            ArlSeeder::class,
            BloodTypeSeeder::class,
            BondingSeeder::class,
            WorkAreaSeeder::class,
            ChargeSeeder::class,
            CompensationBoxSeeder::class,
            EconomicActivityCategorySeeder::class,
            EconomicActivitySeeder::class,
            EducationalLevelSeeder::class,
            HealthEntitySeeder::class,
            IdentificationSeeder::class,
            LayoffsSeeder::class,
            LicenseCategorySeeder::class,
            MaritalStatusSeeder::class,
            PensionSeeder::class,
            ProductAndServiceSeeder::class,
            RelationshipSeeder::class,
            SupplierCategorySeeder::class,
            UsertypeSeeder::class,
            BrakeTypeSeeder::class,
            DimensionRimSeeder::class,
            VehicleClassSeeder::class,
            VehicleTypeSeeder::class,
            VehicleBrandSeeder::class,
            VehicleLineSeeder::class,
            ContractTypeSeeder::class,
            AlertStatusSeeder::class,
            AlertTypeSeeder::class,
            InspectionCategorySeeder::class,
            InspectionSeeder::class,
            ShoeSizeSeeder::class,
            RouteSeeder::class,
            RoleandPermissionSeeder::class,
            // UserSeeder::class,
            // RoleSeeder::class,
        ]);

        User::insert(
            [
                'username' => '000erenteria',
                'identification' => 1,
                'identificationcard' => '1088286',
                'firstname' => 'Eiro',
                'secondname' => 'Isaac',
                'lastname' => 'Renteria',
                'motherslastname' => 'Rivas',
                'type_sex' => 'M',
                'usertype' => 1,
                'email' => 'erox@gmail.com',
                'password' => Hash::make('12345'),
                'company_id' => 1,
                'code_company' => '000',
                'branch_id' => '001',
            ]
        );

        // --- REQUISITO ESPECIAL: Crear exactamente 75 conductores ---
        User::factory()->count(75)->asConductor()->create();

        // --- Crear otros tipos de usuarios en las cantidades que necesites ---

        // Crear 100 empleados con cargos aleatorios (que no serán conductores)
        User::factory()->count(100)->asEmpleado()->create();

        // Crear 50 clientes
        User::factory()->count(50)->asCliente()->create();

        // Crear 30 proveedores
        User::factory()->count(30)->asProveedor()->create();

        // Crear 20 vinculados
        User::factory()->count(20)->asVinculado()->create();

        $this->call([
            OrderSeeder::class,
            DriverSeeder::class,
            VehicleSeeder::class,
            ContractSeeder::class,
            PermitSeeder::class,
            AccidentSeeder::class,
            BeneficiarySeeder::class,
            VehicleInspectionSeeder::class,
        ]);
    }
}
