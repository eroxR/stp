<?php

namespace Database\Factories;

use App\Models\Arl;
use App\Models\BloodType;
use App\Models\Bonding;
use App\Models\Charge;
use App\Models\City;
use App\Models\CompensationBox;
use App\Models\Country;
use App\Models\EconomicActivity;
use App\Models\EducationalLevel;
use App\Models\HealthEntity;
use App\Models\Identification;
use App\Models\Layoffs;
use App\Models\MaritalStatus;
use App\Models\Pension;
use App\Models\ProductAndService;
use App\Models\Province;
use App\Models\Relationship;
use App\Models\ShoeSize;
use App\Models\SupplierCategory;
use App\Models\User;
use App\Models\WorkArea;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;
    protected static array $generatedUsernames = [];
    public $lastsusernames = [];

    /**
     * Un contador estático para generar emails únicos durante el seeding.
     * @var int
     */
    protected static int $emailCounter = 1;
    protected static array $usedUsernames = [];


    /**

     * Genera un nombre de usuario único siguiendo una serie de reglas progresivas.
     *
     * @param string $codeCompany
     * @param string $firstname
     * @param string|null $secondname
     * @param string $lastname
     * @param string|null $motherslastname
     * @return string
     */

    private function AuxiliaryGenerateUsername(string $firstname, ?string $secondname, string $lastname, ?string $motherslastname)
    {

        $letterFirstname = substr($firstname, 0, 1);
        $letterSecondname = !empty($secondname) ? substr($secondname, 0, 1) : '';
        $letterLastname = substr($lastname, 0, 1);
        $letterMotherslastname = !empty($motherslastname) ? substr($motherslastname, 0, 1) : '';
        $cleanFirstname = preg_replace('/\s+/', '', $firstname);
        $cleanSecondname = !empty($secondname) ? preg_replace('/\s+/', '', $secondname) : '';
        $cleanLastname = preg_replace('/\s+/', '', $lastname);
        $cleanMotherslastname = !empty($motherslastname) ? preg_replace('/\s+/', '', $motherslastname) : '';

        $validUser = false;
        $username = '';
        $counter = 1;
        $option = [
            $cleanFirstname,
            $cleanFirstname . $letterLastname,
            $cleanFirstname . $letterLastname . $letterMotherslastname,
            $cleanFirstname . $letterSecondname . $letterLastname . $letterMotherslastname,
            $cleanLastname,
            $cleanLastname . $letterFirstname,
            $cleanLastname . $letterFirstname . $letterMotherslastname,
            $cleanLastname . $letterFirstname . $letterSecondname . $letterMotherslastname,
            $cleanMotherslastname,
            $cleanMotherslastname . $letterFirstname,
            $cleanMotherslastname . $letterFirstname . $letterLastname,
            $cleanMotherslastname . $letterFirstname . $letterLastname . $letterSecondname,
            $cleanSecondname,
            $cleanSecondname . $letterLastname,
            $cleanSecondname . $letterLastname . $letterMotherslastname,
            $cleanSecondname . $letterFirstname . $letterLastname . $letterMotherslastname,
            $cleanFirstname . $cleanLastname,
            $cleanFirstname . $cleanMotherslastname,
            $cleanFirstname . $cleanSecondname,
            $cleanSecondname . $cleanLastname,
            $cleanSecondname . $cleanMotherslastname,
        ];

        for ($i = 0; $i < count($option); $i++) {

            // $username = '@' . $option[$i];
            // if (!User::where('username', $username)->exists()) {
            //     if (!in_array($username, $lastsusername)) {

            //         return $username;
            //     }
            // }

            $username = '@' . $option[$i];
            if (
                !in_array($username, self::$usedUsernames) &&
                !User::where('username', $username)->exists()
            ) {
                self::$usedUsernames[] = $username;
                return $username;
            }
        }

        // do {

        //     $suffix = str_pad($counter, 2, '0', STR_PAD_LEFT);
        //     $username = '@' . $option[0] . $suffix;
        //     if (!User::where('username', $username)->exists()) {
        //         if (!in_array($username, $lastsusername)) {
        //             $validUser = true;
        //             return $username;
        //         }
        //     }
        // } while ($validUser);


        do {
            $username = '@' . strtolower($firstname) . str_pad($counter++, 2, '0', STR_PAD_LEFT);
        } while (
            in_array($username, self::$usedUsernames) ||
            User::where('username', $username)->exists()
        );

        self::$usedUsernames[] = $username;
        return $username;
    }

    // private function generateUniquePersonUsername(string $codeCompany, string $firstname, ?string $secondname, string $lastname, ?string $motherslastname): string
    // {
    //     // Limpiamos y preparamos los componentes del nombre
    //     $fnInitial = substr($firstname, 0, 1);
    //     $lnClean = preg_replace('/\s+/', '', $lastname); // Elimina espacios del apellido
    //     $snInitial = !empty($secondname) ? substr($secondname, 0, 1) : '';
    //     $mlInitial = !empty($motherslastname) ? substr($motherslastname, 0, 1) : '';

    //     // --- Regla 1: {codigo}{inicial_nombre}{apellido} ---
    //     $username = strtolower($codeCompany . $fnInitial . $lnClean);
    //     if (!User::where('username', $username)->exists()) {
    //         self::$generatedUsernames[] = $username; // ¡Lo guardamos en memoria!
    //         return $username;
    //     }

    //     // --- Regla 2: {Regla 1}{inicial_segundo_apellido} ---
    //     if ($mlInitial) {
    //         $username .= strtolower($mlInitial);
    //         if (!User::where('username', $username)->exists()) {
    //             self::$generatedUsernames[] = $username; // ¡Lo guardamos en memoria!
    //             return $username;
    //         }
    //     }

    //     // --- Regla 3: {codigo}{inicial_nombre}{inicial_segundo_nombre}{apellido}{inicial_segundo_apellido} ---
    //     // Volvemos a construirlo para insertar la inicial del segundo nombre
    //     if ($snInitial) {
    //         $username = strtolower($codeCompany . $fnInitial . $snInitial . $lnClean . $mlInitial);
    //         if (!User::where('username', $username)->exists()) {
    //             self::$generatedUsernames[] = $username; // ¡Lo guardamos en memoria!
    //             return $username;
    //         }
    //     }

    //     // --- Regla 4 (Fallback): {último_username_intentado}{contador} ---
    //     // Si todo lo anterior falla, empezamos a añadir números.
    //     $originalUsername = $username;
    //     $counter = 1;
    //     while (User::where('username', $username)->exists()) {
    //         // Formatea el contador con un cero a la izquierda si es menor de 10 (ej: 01, 02)
    //         $suffix = str_pad($counter, 2, '0', STR_PAD_LEFT);
    //         $username = $originalUsername . $suffix;
    //         $counter++;
    //     }

    //     self::$generatedUsernames[] = $username; // ¡Guardamos en memoria el resultado final!
    //     return $username;
    // }

    /**
     * Genera un nombre de usuario único para un PROVEEDOR siguiendo reglas progresivas.
     *
     * @param string $codeCompany El código de la compañía (ej: '001')
     * @param string $supplierName El nombre completo de la empresa proveedora
     * @return string Un nombre de usuario único garantizado.
     */
    // private function generateUniqueSupplierUsername(string $codeCompany, string $supplierName): string
    // {
    //     // 1. Dividimos el nombre de la empresa por varios delimitadores comunes.
    //     // preg_split es ideal para esto. El resultado es un array de palabras.
    //     // Ejemplo: "connelly-emard-and-tillman" -> ['connelly', 'emard', 'and', 'tillman']
    //     $nameParts = preg_split('/[\s\/\-_]+/', strtolower($supplierName));

    //     // 2. Construimos el username base con la primera palabra.
    //     $baseUsername = $codeCompany . $nameParts[0];

    //     // 3. Verificamos si el username base está disponible.
    //     if (!User::where('username', $baseUsername)->exists() && !in_array($baseUsername, self::$generatedUsernames)) {
    //         self::$generatedUsernames[] = $baseUsername;
    //         return $baseUsername;
    //     }

    //     // 4. Si no está disponible, procedemos con la lógica de la segunda palabra.
    //     if (isset($nameParts[1])) {
    //         $secondWord = $nameParts[1];

    //         // Iteramos sobre cada letra de la segunda palabra.
    //         for ($i = 1; $i <= strlen($secondWord); $i++) {
    //             // Tomamos un fragmento de la segunda palabra (1 letra, 2 letras, etc.)
    //             $fragment = substr($secondWord, 0, $i);

    //             // Construimos el username candidato.
    //             $candidateUsername = $baseUsername . $fragment . '...';

    //             // Verificamos disponibilidad.
    //             if (!User::where('username', $candidateUsername)->exists() && !in_array($candidateUsername, self::$generatedUsernames)) {
    //                 self::$generatedUsernames[] = $candidateUsername;
    //                 return $candidateUsername;
    //             }
    //         }

    //         // Si el bucle termina, significa que incluso con la segunda palabra completa ya existía.
    //         // Actualizamos el 'baseUsername' para la siguiente fase de numeración.
    //         $baseUsername = $baseUsername . $secondWord;
    //     }

    //     // 5. Fallback: Si todo lo anterior falla, empezamos a añadir un contador numérico.
    //     $originalUsername = $baseUsername;
    //     $counter = 1;
    //     $usernameWithCounter = $originalUsername . str_pad($counter, 2, '0', STR_PAD_LEFT);

    //     while (User::where('username', $usernameWithCounter)->exists() || in_array($usernameWithCounter, self::$generatedUsernames)) {
    //         $counter++;
    //         $usernameWithCounter = $originalUsername . str_pad($counter, 2, '0', STR_PAD_LEFT);
    //     }

    //     self::$generatedUsernames[] = $usernameWithCounter;
    //     return $usernameWithCounter;
    // }

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    public function definition(): array
    {

        $companyData = $this->faker->randomElement([
            ['id' => 2, 'code' => '001'],
            ['id' => 3, 'code' => '002'],
        ]);


        // --- LÓGICA DEL EMAIL CONSECUTIVO ---
        // Construimos el email usando el valor actual del contador estático.
        $newEmail = 'prueba' . self::$emailCounter . '@example.com';

        if (User::where('email', $newEmail)->exists()) {
        }

        // Incrementamos el contador para que el próximo usuario tenga el siguiente número.
        self::$emailCounter++;

        return [
            // --- Campos que se llenarán con los estados ---
            'username'  => null,
            'identification'  => null,
            'identificationcard'  => null,
            'firstname'  => null,
            'secondname'  => null,
            'lastname'  => null,
            'motherslastname'  => null,
            'birthdate'  => null,
            'age'  => null,
            'type_sex'  => null,
            'country'  => null,
            'department'  => null,
            'city'  => null,
            'address'  => null,
            'phone'  => null,
            'phone_cellular'  => null,
            'blood_type'  => null,
            'user_status'  => null,
            'user_entry_date' => $this->faker->dateTimeBetween('-3 years', 'now'),
            'date_withdrawal_user'  => null,
            'date_refund'  => null,
            'charge'  => null,
            'usertype'  => null,
            'civil_status'  => null,
            'family_document_type'  => null,
            'family_names'  => null,
            'relationship'  => null,
            'family_address'  => null,
            'family_phone'  => null,
            'family_phone_cellular'  => null,
            'city_birth'  => null,
            'place_expedition_identificationcard'  => null,
            'identificationcard_family'  => null,
            'bonding_type'  => null,
            'weight'  => null,
            'pant_size'  => null,
            'shirt_size'  => null,
            'shoe_size'  => null,
            'education_level'  => null,
            'educational_institution'  => null,
            'last_course'  => null,
            'study_end_date'  => null,
            'obtained_title'  => null,
            'last_company_name'  => null,
            'charges_last_company'  => null,
            'start_date_last_company'  => null,
            'date_end_last_company'  => null,
            'functions_performed'  => null,
            'salary'  => null,
            'aid_transport'  => null,
            'work_area'  => null,
            'email' => $newEmail,
            'email_verified_at'  => null,
            'password_changed_at'  => null,
            'license_category'  => null,
            'driver_status'  => null,
            'linked'  => null,
            'isLinked'  => null,


            // --- Campos comunes y por defecto ---
            'password' => static::$password ??= Hash::make($companyData['code'] . 'password'),
            'company_id' => $companyData['id'],
            'code_company' => $companyData['code'],
            'branch_id' => '001',
            'remember_token' => Str::random(10),
            'type_access' => '1',
        ];
    }



    /**
     * Configura el usuario como tipo Cliente (usertype 3)
     */
    public function asCliente()
    {
        return $this->state(function (array $attributes) {
            $firstname = $this->faker->firstName;
            $secondname = $this->faker->optional()->firstName; // Puede ser null
            $lastname = $this->faker->lastName;
            $motherslastname = $this->faker->optional()->lastName; // Puede ser null


            $username = $this->AuxiliaryGenerateUsername($firstname, $secondname, $lastname, $motherslastname);

            return [
                'usertype' => 3,
                'firstname' => $firstname,
                'secondname' => $secondname,
                'lastname' => $lastname,
                'motherslastname' => $motherslastname,
                'username' =>  $username,
                'identification' => Identification::inRandomOrder()->first()->id,
                'identificationcard' => $this->faker->unique()->numerify('##########'),
                'type_sex' => $this->faker->randomElement(['M', 'F']),
                'country' => Country::inRandomOrder()->first()->id,
                'department' => Province::inRandomOrder()->first()->id,
                'city' => City::inRandomOrder()->first()->id,
                'user_status' => '2',
                'user_entry_date' => $this->faker->dateTimeBetween('-2 years', 'now'),
                'email' => $this->faker->unique()->safeEmail(),
                'email_verified_at' => now(),
            ];
        });
    }

    /**
     * Configura el usuario como tipo Vinculado (usertype 6)
     */
    public function asVinculado()
    {
        // La estructura es idéntica a la de Cliente, por lo que podemos reutilizar esa lógica
        return $this->asCliente()->state(['usertype' => 6]);
    }

    /**
     * Configura el usuario como tipo Empleado (usertype 4) con un cargo aleatorio.
     */
    public function asEmpleado()
    {
        return $this->state(function (array $attributes) {
            // Lógica para asegurar consistencia entre Cargo y Área
            $charge = Charge::where('code_charge', '!=', 'CO')->inRandomOrder()->first();
            $workAreaId = $charge->area;

            $firstname = $this->faker->firstName;
            $secondname = $this->faker->optional()->firstName;
            $lastname = $this->faker->lastName;
            $motherslastname = $this->faker->optional()->lastName;
            $birthdate = Carbon::instance($this->faker->dateTimeBetween('-50 years', '-20 years'));

            $userStatus = '2'; // 1: Activo, 2: Incapacitado, 4: Vacaciones
            $startDate = $this->faker->dateTimeBetween('-5 years', 'now');
            $endDate = $this->faker->dateTimeBetween($startDate, '+1 year');

            return array_merge($this->getEmpleadoBaseData($attributes, $firstname, $secondname, $lastname, $motherslastname, $birthdate, $userStatus, $startDate, $endDate), [
                'charge' => $charge->id,
                'work_area' => $workAreaId,
            ]);
        });
    }

    /**
     * Configura el usuario como Empleado de tipo Conductor (usertype 4)
     */
    public function asConductor()
    {
        return $this->state(function (array $attributes) {
            $charge = Charge::where('code_charge', 'CO')->firstOrFail();
            $workAreaId = $charge->area;

            $firstname = $this->faker->firstName;
            $secondname = $this->faker->optional()->firstName;
            $lastname = $this->faker->lastName;
            $motherslastname = $this->faker->optional()->lastName;
            $birthdate = Carbon::instance($this->faker->dateTimeBetween('-60 years', '-25 years'));

            $userStatus = '2';
            $startDate = $this->faker->dateTimeBetween('-10 years', 'now');
            $endDate = $this->faker->dateTimeBetween($startDate, '+2 years');

            return array_merge($this->getEmpleadoBaseData($attributes, $firstname, $secondname, $lastname, $motherslastname, $birthdate, $userStatus, $startDate, $endDate), [
                'charge' => $charge->id,
                'work_area' => $workAreaId,
            ]);
        });
    }

    /**
     * Método auxiliar para no repetir los campos base de un empleado.
     */
    private function getEmpleadoBaseData(array $attributes, string $firstname, ?string $secondname, string $lastname, ?string $motherslastname, Carbon $birthdate, string $userStatus, \DateTime $startDate, \DateTime $endDate): array
    {

        $username = $this->AuxiliaryGenerateUsername($firstname, $secondname, $lastname, $motherslastname);

        return [
            'usertype' => 4,
            'username' => $username,
            'identification' => Identification::inRandomOrder()->first()->id,
            'identificationcard' => $this->faker->unique()->numerify('##########'),
            'firstname' => $firstname,
            'secondname' => $secondname,
            'lastname' => $lastname,
            'motherslastname' => $motherslastname,
            'birthdate' => $birthdate->format('Y-m-d'),
            'age' => $birthdate->age,
            'type_sex' => $this->faker->randomElement(['M', 'F']),
            'country' => Country::where('id', 43)->first()->id, // Colombia
            'department' => Province::inRandomOrder()->first()->id,
            'city' => City::inRandomOrder()->first()->id,
            'address' => $this->faker->streetAddress(),
            'phone' => $this->faker->phoneNumber,
            'phone_cellular' => $this->faker->phoneNumber,
            'user_status' => $userStatus,
            'user_entry_date' => $startDate,
            'date_withdrawal_user' => $userStatus === '1' ? $this->faker->dateTimeBetween('-1 year', 'now') : null, // Status 3 = Retirado
            'civil_status' => MaritalStatus::inRandomOrder()->first()->id,
            'family_document_type' => Identification::inRandomOrder()->first()->id,
            'family_names' =>  $this->faker->name,
            'relationship' => Relationship::inRandomOrder()->first()->id,
            'family_address' => $this->faker->streetAddress(),
            'family_phone' => $this->faker->phoneNumber,
            'family_phone_cellular' => $this->faker->phoneNumber,
            'city_birth' => City::inRandomOrder()->first()->id,
            'place_expedition_identificationcard' => City::inRandomOrder()->first()->city_name,
            'identificationcard_family' => $this->faker->unique()->numerify('##########'),
            'bonding_type' => Bonding::inRandomOrder()->first()->id,
            'weight' => $this->faker->numberBetween(25, 120),
            'pant_size' => $this->faker->randomElement([28, 30, 32, 34, 36, 38, 40]),
            'shirt_size' => $this->faker->randomElement(['S', 'M', 'L', 'XL', 'XXL']),
            'shoe_size' => ShoeSize::inRandomOrder()->first()->id,
            'education_level' => EducationalLevel::inRandomOrder()->first()->id,
            'educational_institution' => $this->faker->company . ' Institute',
            'last_course' => $this->faker->randomElement(['Primero', 'Segundo', 'Tercero', 'Cuarto', 'Quinto', 'Sexto', 'Séptimo', 'Octavo', 'Noveno', 'Décimo', 'Onceavo']),
            'study_end_date' => $this->faker->dateTimeBetween('-5 year', 'now'),
            'obtained_title' => $this->faker->jobTitle(),
            'last_company_name' => $this->faker->company,
            'charges_last_company' => $this->faker->jobTitle(),
            'start_date_last_company' => $startDate,
            'date_end_last_company' => $endDate,
            'functions_performed' => $this->faker->paragraphs(2, true),
            'salary' => $this->faker->numberBetween(1300000, 3500000),
            'aid_transport' => 162000,
            'email' => $this->faker->unique()->safeEmail(),
            'email_verified_at' => now(),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn(array $attributes) => [
            'email_verified_at' => null,
        ]);
    }

    /**
     * Create a specified number of users.
     *
     * @param int $count
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function withUsers(int $count = 1)
    {
        return $this->count($count);
    }
}
