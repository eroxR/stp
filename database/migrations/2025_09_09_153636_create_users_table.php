<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
	/**
	 * Run the migrations.
	 */
	public function up(): void
	{
		Schema::create('users', function (Blueprint $table) {//tabla usuarios
			$table->id();

            $table->string('username', 25)->nullable()->unique()->comment('{nombre_usuario} nombre de usuario');
            $table->foreignId('identification')->nullable()->constrained('identifications')->comment('{tipo_documento} tipo_documento');
            $table->string('identificationcard')->nullable()->unique()->comment('{numero_documento} numero_documento');
            $table->string('firstname', 25)->nullable()->comment('{primer_nombre} primer nombre del usuario');
            $table->string('secondname', 25)->nullable()->comment('{segundo_nombre} segundo nombre del usuario');
            $table->string('lastname', 25)->nullable()->comment('{apellido_paterno} apellido paterno del usuario');
            $table->string('motherslastname', 25)->nullable()->comment('{apellido_materno} apellido materno del usuario');
            $table->date('birthdate')->nullable()->comment('{fecha_nacimiento} fecha de nacimiento del usuario');
            $table->integer('age')->nullable()->comment('{edad} edad del usuario');
            $table->enum('type_sex', ['F', 'M'])->nullable()->comment('{tipo_sexo} tipo de sexo del usuario');
            $table->foreignId('country')->nullable()->constrained('countries')->comment('{pais_residencia} pais de residencia');
            $table->foreignId('Department')->nullable()->constrained('provinces')->comment('{departamento_residencia} departamento o provincia de residencia');
            $table->foreignId('city')->nullable()->constrained('cities')->comment('{ciudad_residencia} ciudad de residencia');
            $table->string('address')->nullable()->comment('{direccion} direccion del usuario');
            $table->string('phone')->nullable()->comment('{telefono} telefono del usuario');
            $table->string('phone_cellular')->nullable()->comment('{telefono_celular} telefono celular del usuario');
            $table->foreignId('eps')->nullable()->constrained('health_entities')->comment('{eps} eps o entidad de salud del usuario');
            $table->date('date_eps')->nullable()->comment('{fecha_eps} fecha eps de afiliacion y renovacion');
            $table->foreignId('blood_type')->nullable()->constrained('blood_types')->comment('{tipo_sangre} tipo de sangre del usuario');
            $table->foreignId('pension')->nullable()->constrained('pensions')->comment('{pension} pension del usuario');
            $table->date('date_pension')->nullable()->comment('{fecha_pension} fecha pension de afiliacion y renovacion');
            $table->foreignId('layoffs')->nullable()->constrained('layoffs')->comment('{cesantias} cesantias del usuario');
            $table->date('date_layoffs')->nullable()->comment('{fecha_cesantias} fecha cesantias de afiliacion y renovacion');
            $table->foreignId('arl')->nullable()->constrained('arls')->comment('{arl} arl del usuario');
            $table->date('arl_date')->nullable()->comment('{fecha_arl} fecha arl de afiliacion y renovacion');
            $table->foreignId('compensationbox')->nullable()->constrained('compensation_boxes')->comment('{caja_compensacion} caja compensacion del usuario');
            $table->date('date_compensationbox')->nullable()->comment('{fecha_caja_compensacion} fecha caja compensacion de afiliacion y renovacion');
            $table->enum('user_status', ['1', '2', '3', '4'])->nullable()->comment('{estado_usuario} estado[Inactivo,Activo,Bloqueado,Vacaciones,Incapacitado,Suspendido,Retirado,Prestamo,Desactualizado]');
            $table->date('user_entry_date')->nullable()->comment('{fecha_ingreso_usuario} fecha de ingreso del usuario');
            $table->date('date_withdrawal_user')->nullable()->comment('{fecha_retiro_usuario} fecha de retiro del usuario');
            $table->date('date_refund')->nullable()->comment('{fecha_reintegro_usuario} fecha de reintegro del usuario');
            $table->foreignId('charge')->nullable()->constrained('charges')->comment('{cargo_usuario} cargo del usuario');
            $table->foreignId('usertype')->nullable()->constrained('user_types')->comment('{tipo_usuario} tipo de usuario');
            $table->foreignId('civil_status')->nullable()->constrained('marital_statuses')->comment('{estado_civil} estado civil del usuario');
            $table->foreignId('family_document_type')->nullable()->constrained('identifications')->comment('{tipo_documento_familiar} tipo de documento familiar');
            $table->string('family_names')->nullable()->comment('{nombres_completos_familiar} nombres completos familiar del usuario');
            $table->foreignId('relationship')->nullable()->constrained('relationships')->comment('{parentesco} parentezco');
            $table->string('family_address', 150)->nullable()->comment('{direccion_familiar} direccion familiar del usuario');
            $table->string('family_phone')->nullable()->comment('{telefono_familiar} telefono familiar del usuario');
            $table->string('family_phone_cellular')->nullable()->comment('{telefono_celular_familiar} celular familiar del usuario');
            $table->foreignId('city_birth')->nullable()->constrained('cities')->comment('{ciudad_nacimiento} ciudad nacimiento del usuario');
            $table->string('place_expedition_identificationcard')->nullable()->comment('{lugar_expedicion_documento} lugar expedicion documento del usuario');
            $table->string('identificationcard_family')->nullable()->comment('{cedula_familiar} cedula del familiar del usuario');
            $table->foreignId('bonding_type')->nullable()->constrained('bondings')->comment('{tipo_vinculacion} tipo vinculacion o contrato');
            $table->decimal('weight')->nullable()->comment('{peso} peso del usuario');
            $table->decimal('pant_size', 5, 2)->nullable()->comment('{talla_pantalon} talla pantalon del usuario');
            $table->string('shirt_size', 4)->nullable()->comment('{talla_camisa} talla camisa del usuario');
            $table->foreignId('shoe_size')->nullable()->constrained('shoe_sizes')->comment('{talla_zapato} talla zapato del usuario');
            $table->foreignId('education_level')->nullable()->constrained('educational_levels')->comment('{nivel_educativo} nivel educativo del usuario');
            $table->string('educational_institution', 150)->nullable()->comment('{institucion_educativa} institucion educativa del usuario');
            $table->string('last_course')->nullable()->comment('{ultimo_año} ultimo año de estudio de usuario (Primero, Segundo, etc.)');
            $table->date('study_end_date')->nullable()->comment('{fecha_finalizacion} fecha finalizacion o del ultimo grado del estudio');
            $table->string('obtained_title')->nullable()->comment('{titulacion_obtenida} titulacion obtenida por el usuario');
            $table->string('last_company_name', 150)->nullable()->comment('{nombre_ultima_empresa} nombre ultima empresa donde laboro el usuario');
            $table->string('charges_last_company')->nullable()->comment('{cargo_ultima_empresa} cargo ultima empresa donde laboro el usuario');
            $table->date('start_date_last_company')->nullable()->comment('{fecha_inicio_ultima_empresa} fecha inicio de la ultima empresa donde laboro el usuario');
            $table->date('date_end_last_company')->nullable()->comment('{fecha_finalizacion_ultima_empresa} fecha finalizacion del contrato de la ultima empresa');
            $table->text('functions_performed')->nullable()->comment('{funciones_desempenadas_ultima_empresa} funciones desempeñadas en la ultima empresa');
            $table->decimal('salary', 12, 2)->nullable()->comment('{salario} salario del usuario');
            $table->decimal('aid_transport', 12, 2)->nullable()->comment('{auxilio_transporte} auxilio transporte del usuario');
            $table->foreignId('work_area')->nullable()->constrained('work_areas')->comment('{area_trabajo} area de trabajo del usuario');

            $table->string('email')->unique()->comment('{email} email del usuario');
            $table->timestamp('email_verified_at')->nullable()->comment('{email_verificado_en} fecha de verificación del email');
            $table->string('password')->comment('{password} contraseña del usuario');

            $table->string('nit')->unique()->nullable()->comment('{nit} NIT de empresa o proveedor aliado');
            $table->string('supplier_name', 150)->nullable()->comment('{nombre_proveedor} nombre de empresa o proveedor aliado');
            $table->string('company_name_provider', 150)->nullable()->comment('{razon_social_proveedor} razon social de empresa o proveedor aliado');
            $table->string('commercial_reason_supplier', 150)->nullable()->comment('{razon_comercial_proveedor} razon comercial de empresa o proveedor aliado');
            $table->string('supplier_web_page')->nullable()->comment('{pagina_web_proveedor} pagina web de empresa o proveedor aliado');
            $table->foreignId('supplier_category')->nullable()->constrained('supplier_categories')->comment('{categoria_proveedor} categoria de la empresa o proveedor aliado');
            $table->foreignId('economic_activity')->nullable()->constrained('economic_activities')->comment('{actividad_economica_proveedor} actividad economica de la empresa o proveedor aliado');
            $table->foreignId('products_and_services')->nullable()->constrained('product_and_services')->comment('{productos_y_servicios_proveedor} productos y servicios de la empresa o proveedor aliado');
            $table->text('supplier_description')->nullable()->comment('{descripcion_proveedor} descripcion de la empresa o proveedor aliado');
            $table->foreignId('company_id')->constrained('companies')->comment('{id_compañia} relación con la tabla empresas');
            $table->string('code_company')->comment('{codigo_compañia} relación con la tabla empresas');
            $table->foreignId('branch_id')->constrained('branches')->comment('{id_sucursal} relación con la tabla sucursales');

			$table->rememberToken();
			$table->timestamps();
		});

        Schema::create('password_reset_tokens', function (Blueprint $table) { //tabla tokens para restablecer contraseñas
            $table->string('email')->primary()->comment('{email} email del usuario');
            $table->string('token')->comment('{token} token para restablecer contraseña');
            $table->timestamp('created_at')->nullable()->comment('{fecha_creacion} fecha de creación del token');
		});

		Schema::create('sessions', function (Blueprint $table) {//tabla sesiones de usuarios
 $table->string('id')->primary()->comment('{id} id de la sesión');
            $table->foreignId('user_id')->nullable()->index()->comment('{user_id} id del usuario');
            $table->string('ip_address', 45)->nullable()->comment('{direccion_ip} dirección IP del usuario conectado');
            $table->text('user_agent')->nullable()->comment('{user_agent} información del agente de usuario');
            $table->longText('payload')->comment('{payload} datos adicionales de la sesión');
            $table->integer('last_activity')->index()->comment('{ultima_actividad} marca de tiempo de la última actividad');
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		Schema::dropIfExists('users');
		Schema::dropIfExists('password_reset_tokens');
		Schema::dropIfExists('sessions');
	}
};
