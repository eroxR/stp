<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleandPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        // Role::insert(['name' => 'Admin']);

        $SuperUsuario =  Role::create(['name' => 'Super Usuario']);
        $Administrador =  Role::create(['name' => 'Administrador']);
        $Cliente =  Role::create(['name' => 'Cliente']);
        $Empleado =  Role::create(['name' => 'Empleado']);
        $Proveedor =  Role::create(['name' => 'Proveedor']);
        $Vinculado =  Role::create(['name' => 'Vinculado']);
        $Monitor =  Role::create(['name' => 'Monitor(a)']);
        $Practicante =  Role::create(['name' => 'Practicante']);
        $Auxiliar =  Role::create(['name' => 'Auxiliar']);
        $CoordinadorRecursosHumanos =  Role::create(['name' => 'Coordinador(a) de Recursos Humanos']);
        $AuxiliarRecursosHumanos =  Role::create(['name' => 'Auxiliar de Recursos Humanos']);
        $CoordinadorComprasSuministros =  Role::create(['name' => 'Coordinador(a) Compras y Suministros']);
        $AuxiliarComprasSuministros =  Role::create(['name' => 'Auxiliar de Compras y Suministros']);
        $CoordinadorOperativo =  Role::create(['name' => 'Coordinador(a) Operativo']);
        $AuxiliarOperativo =  Role::create(['name' => 'Auxiliar Operativo']);
        $Conductor =  Role::create(['name' => 'Conductor(a)']);
        $CoordinadorSeguridadSalud =  Role::create(['name' => 'Coordinador(a) de Seguridad y salud en el trabajo']);
        $AuxiliarSeguridadSalud =  Role::create(['name' => 'Auxiliar de Seguridad y salud en el trabajo']);
        $GerenteGeneral =  Role::create(['name' => 'Gerente General']);
        $AuxiliarGerencia =  Role::create(['name' => 'Auxiliar de Gerencia']);
        $AuditorInterno =  Role::create(['name' => 'Auditor(a) Interno']);
        $AuxiliarAuditoria =  Role::create(['name' => 'Auxiliar de Auditoria']);
        $AuditorExterno =  Role::create(['name' => 'Auditor(a) Externo']);
        $CoordinadorInfraestructura =  Role::create(['name' => 'Coordinador(a) de Infraestructura']);
        $AuxiliarInfraestructura =  Role::create(['name' => 'Auxiliar de Infraestructura']);
        $CoordinadorLogistica =  Role::create(['name' => 'Coordinador(a) de Logistica']);
        $AuxiliarLogistica =  Role::create(['name' => 'Auxiliar Logistico']);
        $CoordinadorContabilidad =  Role::create(['name' => 'Coordinador(a) de Contabilidad']);
        $AuxiliarContable =  Role::create(['name' => 'Auxiliar Contable']);
        $CoordinadorFacturacion =  Role::create(['name' => 'Coordinador(a) de Facturación']);
        $AuxiliarFacturacion =  Role::create(['name' => 'Auxiliar Facturación']);
        $CoordinadorTesoreria =  Role::create(['name' => 'Coordinador(a) de Tesoreria']);
        $AuxiliarTesoreria =  Role::create(['name' => 'Auxiliar Tesoreria']);
        $CoordinadorTecnologia =  Role::create(['name' => 'Coordinador(a) de Tecnologia']);
        $AuxiliarTecnologia =  Role::create(['name' => 'Auxiliar de Tecnologia']);
        $CoordinadorAtencionCliente =  Role::create(['name' => 'Coordinador(a) de Atencion al Cliente']);
        $AuxiliarAtencionCliente =  Role::create(['name' => 'Auxiliar Atencion al Cliente']);
        $CoordinadorServiciosGenerales =  Role::create(['name' => 'Coordinador(a) de Servicios Generales']);
        $AuxiliarServiciosGenerales =  Role::create(['name' => 'Auxiliar de Servicios Generales']);
        $CoordinadorVinculacion =  Role::create(['name' => 'Coordinador(a) de Vinculación']);
        $AuxiliarVinculacion =  Role::create(['name' => 'Auxiliar de Vinculación']);

        // usuarios
        Permission::create(['name' => 'administrarPermisos'])->syncRoles([$SuperUsuario, $GerenteGeneral, $Administrador]);
        Permission::create(['name' => 'crearPermisos'])->syncRoles([$SuperUsuario, $GerenteGeneral, $Administrador]);
        Permission::create(['name' => 'editarPermisos'])->syncRoles([$SuperUsuario, $GerenteGeneral, $Administrador]);
        Permission::create(['name' => 'eliminarPermisos'])->syncRoles([$SuperUsuario, $GerenteGeneral, $Administrador]);

        Permission::create(['name' => 'administrarMaestros'])->syncRoles([$SuperUsuario]);
        Permission::create(['name' => 'crearMaestros'])->syncRoles([$SuperUsuario]);
        Permission::create(['name' => 'editarMaestros'])->syncRoles([$SuperUsuario]);
        Permission::create(['name' => 'eliminarMaestros'])->syncRoles([$SuperUsuario]);

        Permission::create(['name' => 'administrarInfoEmpresa'])->syncRoles([$SuperUsuario, $Administrador, $GerenteGeneral]);
        Permission::create(['name' => 'crearInfoEmpresa'])->syncRoles([$SuperUsuario, $Administrador, $GerenteGeneral]);
        Permission::create(['name' => 'editarInfoEmpresa'])->syncRoles([$SuperUsuario, $Administrador, $GerenteGeneral]);
        Permission::create(['name' => 'eliminarInfoEmpresa'])->syncRoles([$SuperUsuario, $Administrador, $GerenteGeneral]);

        Permission::create(['name' => 'administrarEmpleados'])->syncRoles([$CoordinadorRecursosHumanos, $AuxiliarRecursosHumanos]);
        Permission::create(['name' => 'crearEmpleados'])->syncRoles([$CoordinadorRecursosHumanos, $AuxiliarRecursosHumanos]);
        Permission::create(['name' => 'editarEmpleados'])->syncRoles([$CoordinadorRecursosHumanos, $AuxiliarRecursosHumanos]);
        Permission::create(['name' => 'eliminarEmpleados'])->syncRoles([$CoordinadorRecursosHumanos, $AuxiliarRecursosHumanos]);

        Permission::create(['name' => 'administrarVinculados'])->syncRoles([$CoordinadorRecursosHumanos, $AuxiliarRecursosHumanos]);
        Permission::create(['name' => 'crearVinculados'])->syncRoles([$CoordinadorRecursosHumanos, $AuxiliarRecursosHumanos]);
        Permission::create(['name' => 'editarVinculados'])->syncRoles([$CoordinadorRecursosHumanos, $AuxiliarRecursosHumanos]);
        Permission::create(['name' => 'eliminarVinculados'])->syncRoles([$CoordinadorRecursosHumanos, $AuxiliarRecursosHumanos]);

        Permission::create(['name' => 'administrarPlantillaDocumental'])->syncRoles([$CoordinadorRecursosHumanos, $AuxiliarRecursosHumanos]);
        Permission::create(['name' => 'crearPlantillaDocumental'])->syncRoles([$CoordinadorRecursosHumanos, $AuxiliarRecursosHumanos]);
        Permission::create(['name' => 'editarPlantillaDocumental'])->syncRoles([$CoordinadorRecursosHumanos, $AuxiliarRecursosHumanos]);
        Permission::create(['name' => 'eliminarPlantillaDocumental'])->syncRoles([$CoordinadorRecursosHumanos, $AuxiliarRecursosHumanos]);

        Permission::create(['name' => 'administrarTerceros'])->syncRoles([$CoordinadorRecursosHumanos, $AuxiliarRecursosHumanos]);
        Permission::create(['name' => 'crearTerceros'])->syncRoles([$CoordinadorRecursosHumanos, $AuxiliarRecursosHumanos]);
        Permission::create(['name' => 'editarTerceros'])->syncRoles([$CoordinadorRecursosHumanos, $AuxiliarRecursosHumanos]);
        Permission::create(['name' => 'eliminarTerceros'])->syncRoles([$CoordinadorRecursosHumanos, $AuxiliarRecursosHumanos]);

        Permission::create(['name' => 'administrarConductores'])->syncRoles([$CoordinadorRecursosHumanos, $AuxiliarRecursosHumanos, $CoordinadorOperativo, $AuxiliarOperativo]);
        Permission::create(['name' => 'crearConductores'])->syncRoles([$CoordinadorRecursosHumanos, $AuxiliarRecursosHumanos, $CoordinadorOperativo, $AuxiliarOperativo]);
        Permission::create(['name' => 'editarConductores'])->syncRoles([$CoordinadorRecursosHumanos, $AuxiliarRecursosHumanos, $CoordinadorOperativo, $AuxiliarOperativo]);
        Permission::create(['name' => 'eliminarConductores'])->syncRoles([$CoordinadorRecursosHumanos, $AuxiliarRecursosHumanos, $CoordinadorOperativo, $AuxiliarOperativo]);

        Permission::create(['name' => 'administrarVehiculos'])->syncRoles([$CoordinadorInfraestructura, $AuxiliarInfraestructura]);
        Permission::create(['name' => 'crearVehiculos'])->syncRoles([$CoordinadorInfraestructura, $AuxiliarInfraestructura]);
        Permission::create(['name' => 'editarVehiculos'])->syncRoles([$CoordinadorInfraestructura, $AuxiliarInfraestructura]);
        Permission::create(['name' => 'eliminarVehiculos'])->syncRoles([$CoordinadorInfraestructura, $AuxiliarInfraestructura]);

        Permission::create(['name' => 'administrarPlanRodamiento'])->syncRoles([$CoordinadorInfraestructura, $AuxiliarInfraestructura]);
        Permission::create(['name' => 'crearPlanRodamiento'])->syncRoles([$CoordinadorInfraestructura, $AuxiliarInfraestructura]);
        Permission::create(['name' => 'editarPlanRodamiento'])->syncRoles([$CoordinadorInfraestructura, $AuxiliarInfraestructura]);
        Permission::create(['name' => 'eliminarPlanRodamiento'])->syncRoles([$CoordinadorInfraestructura, $AuxiliarInfraestructura]);

        Permission::create(['name' => 'administrarInspeccionDiaria'])->syncRoles([$CoordinadorInfraestructura, $AuxiliarInfraestructura]);
        Permission::create(['name' => 'crearInspeccionDiaria'])->syncRoles([$CoordinadorInfraestructura, $AuxiliarInfraestructura]);
        Permission::create(['name' => 'editarInspeccionDiaria'])->syncRoles([$CoordinadorInfraestructura, $AuxiliarInfraestructura]);
        Permission::create(['name' => 'eliminarInspeccionDiaria'])->syncRoles([$CoordinadorInfraestructura, $AuxiliarInfraestructura]);

        Permission::create(['name' => 'administrarOrden'])->syncRoles([$CoordinadorLogistica, $AuxiliarLogistica]);
        Permission::create(['name' => 'crearOrden'])->syncRoles([$CoordinadorLogistica, $AuxiliarLogistica]);
        Permission::create(['name' => 'editarOrden'])->syncRoles([$CoordinadorLogistica, $AuxiliarLogistica]);
        Permission::create(['name' => 'eliminarOrden'])->syncRoles([$CoordinadorLogistica, $AuxiliarLogistica]);

        Permission::create(['name' => 'administrarContratoGrupoPadres'])->syncRoles([$CoordinadorOperativo, $AuxiliarOperativo, $CoordinadorOperativo, $AuxiliarOperativo]);
        Permission::create(['name' => 'crearContratoGrupoPadres'])->syncRoles([$CoordinadorOperativo, $AuxiliarOperativo, $CoordinadorOperativo, $AuxiliarOperativo]);
        Permission::create(['name' => 'editarContratoGrupoPadres'])->syncRoles([$CoordinadorOperativo, $AuxiliarOperativo, $CoordinadorOperativo, $AuxiliarOperativo]);
        Permission::create(['name' => 'eliminarContratoGrupoPadres'])->syncRoles([$CoordinadorOperativo, $AuxiliarOperativo, $CoordinadorOperativo, $AuxiliarOperativo]);

        Permission::create(['name' => 'administrarContratoEmpresa'])->syncRoles([$CoordinadorOperativo, $AuxiliarOperativo, $CoordinadorOperativo, $AuxiliarOperativo]);
        Permission::create(['name' => 'crearContratoEmpresa'])->syncRoles([$CoordinadorOperativo, $AuxiliarOperativo, $CoordinadorOperativo, $AuxiliarOperativo]);
        Permission::create(['name' => 'editarContratoEmpresa'])->syncRoles([$CoordinadorOperativo, $AuxiliarOperativo, $CoordinadorOperativo, $AuxiliarOperativo]);
        Permission::create(['name' => 'eliminarContratoEmpresa'])->syncRoles([$CoordinadorOperativo, $AuxiliarOperativo, $CoordinadorOperativo, $AuxiliarOperativo]);

        Permission::create(['name' => 'administrarContratoOcacional'])->syncRoles([$CoordinadorOperativo, $AuxiliarOperativo, $CoordinadorOperativo, $AuxiliarOperativo]);
        Permission::create(['name' => 'crearContratoOcacional'])->syncRoles([$CoordinadorOperativo, $AuxiliarOperativo, $CoordinadorOperativo, $AuxiliarOperativo]);
        Permission::create(['name' => 'editarContratoOcacional'])->syncRoles([$CoordinadorOperativo, $AuxiliarOperativo, $CoordinadorOperativo, $AuxiliarOperativo]);
        Permission::create(['name' => 'eliminarContratoOcacional'])->syncRoles([$CoordinadorOperativo, $AuxiliarOperativo, $CoordinadorOperativo, $AuxiliarOperativo]);

        Permission::create(['name' => 'administrarContratoVinculaciónTercero'])->syncRoles([$CoordinadorRecursosHumanos, $AuxiliarRecursosHumanos]);
        Permission::create(['name' => 'crearContratoVinculaciónTercero'])->syncRoles([$CoordinadorRecursosHumanos, $AuxiliarRecursosHumanos]);
        Permission::create(['name' => 'editarContratoVinculaciónTercero'])->syncRoles([$CoordinadorRecursosHumanos, $AuxiliarRecursosHumanos]);
        Permission::create(['name' => 'eliminarContratoVinculaciónTercero'])->syncRoles([$CoordinadorRecursosHumanos, $AuxiliarRecursosHumanos]);

        Permission::create(['name' => 'administrarContratoVinculaciónPersonal'])->syncRoles([$CoordinadorRecursosHumanos, $AuxiliarRecursosHumanos]);
        Permission::create(['name' => 'crearContratoVinculaciónPersonal'])->syncRoles([$CoordinadorRecursosHumanos, $AuxiliarRecursosHumanos]);
        Permission::create(['name' => 'editarContratoVinculaciónPersonal'])->syncRoles([$CoordinadorRecursosHumanos, $AuxiliarRecursosHumanos]);
        Permission::create(['name' => 'eliminarContratoVinculaciónPersonal'])->syncRoles([$CoordinadorRecursosHumanos, $AuxiliarRecursosHumanos]);

        Permission::create(['name' => 'administrarContratoColegios'])->syncRoles([$CoordinadorOperativo, $AuxiliarOperativo]);
        Permission::create(['name' => 'crearContratoColegios'])->syncRoles([$CoordinadorOperativo, $AuxiliarOperativo]);
        Permission::create(['name' => 'editarContratoColegios'])->syncRoles([$CoordinadorOperativo, $AuxiliarOperativo]);
        Permission::create(['name' => 'eliminarContratoColegios'])->syncRoles([$CoordinadorOperativo, $AuxiliarOperativo]);

        Permission::create(['name' => 'administrarContratoGrupoEstudiantes'])->syncRoles([$CoordinadorOperativo, $AuxiliarOperativo]);
        Permission::create(['name' => 'crearContratoGrupoEstudiantes'])->syncRoles([$CoordinadorOperativo, $AuxiliarOperativo]);
        Permission::create(['name' => 'editarContratoGrupoEstudiantes'])->syncRoles([$CoordinadorOperativo, $AuxiliarOperativo]);
        Permission::create(['name' => 'eliminarContratoGrupoEstudiantes'])->syncRoles([$CoordinadorOperativo, $AuxiliarOperativo]);

        Permission::create(['name' => 'administrarContratoGrupoPersonasNatural'])->syncRoles([$CoordinadorOperativo, $AuxiliarOperativo]);
        Permission::create(['name' => 'crearContratoGrupoPersonasNatural'])->syncRoles([$CoordinadorOperativo, $AuxiliarOperativo]);
        Permission::create(['name' => 'editarContratoGrupoPersonasNatural'])->syncRoles([$CoordinadorOperativo, $AuxiliarOperativo]);
        Permission::create(['name' => 'eliminarContratoGrupoPersonasNatural'])->syncRoles([$CoordinadorOperativo, $AuxiliarOperativo]);

        Permission::create(['name' => 'administrarContratoVinculaciónTenedor'])->syncRoles([$CoordinadorVinculacion, $AuxiliarVinculacion]);
        Permission::create(['name' => 'crearContratoVinculaciónTenedor'])->syncRoles([$CoordinadorVinculacion, $AuxiliarVinculacion]);
        Permission::create(['name' => 'editarContratoVinculaciónTenedor'])->syncRoles([$CoordinadorVinculacion, $AuxiliarVinculacion]);
        Permission::create(['name' => 'eliminarContratoVinculaciónTenedor'])->syncRoles([$CoordinadorVinculacion, $AuxiliarVinculacion]);

        Permission::create(['name' => 'administrarContratoVinculaciónVehiculo'])->syncRoles([$CoordinadorVinculacion, $AuxiliarVinculacion]);
        Permission::create(['name' => 'crearContratoVinculaciónVehiculo'])->syncRoles([$CoordinadorVinculacion, $AuxiliarVinculacion]);
        Permission::create(['name' => 'editarContratoVinculaciónVehiculo'])->syncRoles([$CoordinadorVinculacion, $AuxiliarVinculacion]);
        Permission::create(['name' => 'eliminarContratoVinculaciónVehiculo'])->syncRoles([$CoordinadorVinculacion, $AuxiliarVinculacion]);

        Permission::create(['name' => 'administrarFuec'])->syncRoles([$CoordinadorOperativo, $AuxiliarOperativo]);
        Permission::create(['name' => 'crearFuec'])->syncRoles([$CoordinadorOperativo, $AuxiliarOperativo]);
        Permission::create(['name' => 'editarFuec'])->syncRoles([$CoordinadorOperativo, $AuxiliarOperativo]);
        Permission::create(['name' => 'eliminarFuec'])->syncRoles([$CoordinadorOperativo, $AuxiliarOperativo]);

        Permission::create(['name' => 'administrarInfoPersonal'])->syncRoles([$Cliente, $Proveedor, $Vinculado, $Practicante, $Auxiliar]);
        Permission::create(['name' => 'crearInfoPersonal'])->syncRoles([$Cliente, $Proveedor, $Vinculado, $Practicante, $Auxiliar]);
        Permission::create(['name' => 'editarInfoPersonal'])->syncRoles([$Cliente, $Proveedor, $Vinculado, $Practicante, $Auxiliar]);
        Permission::create(['name' => 'eliminarInfoPersonal'])->syncRoles([$Cliente, $Proveedor, $Vinculado, $Practicante, $Auxiliar]);
    }
}
