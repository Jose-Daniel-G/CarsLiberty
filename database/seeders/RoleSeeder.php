<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    public function run()
    {
        // 1. Crear o recuperar Roles con guard explícito
        $superAdmin = Role::firstOrCreate(['name' => 'superAdmin', 'guard_name' => 'web']);
        $admin      = Role::firstOrCreate(['name' => 'admin', 'guard_name' => 'web']);
        $secretaria = Role::firstOrCreate(['name' => 'secretaria', 'guard_name' => 'web']);
        $profesor   = Role::firstOrCreate(['name' => 'profesor', 'guard_name' => 'web']);
        $cliente    = Role::firstOrCreate(['name' => 'cliente', 'guard_name' => 'web']);
        $espectador = Role::firstOrCreate(['name' => 'espectador', 'guard_name' => 'web']);

        // 2. Permisos Generales
        Permission::firstOrCreate(['name' => 'admin.home', 'guard_name' => 'web'])
            ->syncRoles([$superAdmin, $admin, $secretaria, $profesor, $cliente]);

        Permission::firstOrCreate(['name' => 'admin.index', 'guard_name' => 'web']);

        // 3. Permisos de Configuración
        $configPerms = ['admin.config.index', 'admin.config.create', 'admin.config.store', 'admin.config.show', 'admin.config.edit', 'admin.config.destroy'];
        foreach ($configPerms as $perm) {
            Permission::firstOrCreate(['name' => $perm, 'guard_name' => 'web'])->syncRoles([$superAdmin]);
        }

        // 4. Permisos de Secretarias
        $secPerms = ['admin.secretarias.index', 'admin.secretarias.create', 'admin.secretarias.store', 'admin.secretarias.show', 'admin.secretarias.edit', 'admin.secretarias.destroy'];
        foreach ($secPerms as $perm) {
            Permission::firstOrCreate(['name' => $perm, 'guard_name' => 'web'])->syncRoles([$superAdmin, $admin]);
        }

        // 5. Permisos de Clientes
        $cliPerms = ['admin.clientes.index', 'admin.clientes.create', 'admin.clientes.store', 'admin.clientes.show', 'admin.clientes.edit', 'admin.clientes.destroy'];
        foreach ($cliPerms as $perm) {
            Permission::firstOrCreate(['name' => $perm, 'guard_name' => 'web'])->syncRoles([$superAdmin, $admin, $secretaria]);
        }

        // 6. Permisos de Cursos
        $curPerms = ['admin.cursos.index', 'admin.cursos.create', 'admin.cursos.store', 'admin.cursos.show', 'admin.cursos.edit', 'admin.cursos.destroy'];
        foreach ($curPerms as $perm) {
            Permission::firstOrCreate(['name' => $perm, 'guard_name' => 'web'])->syncRoles([$superAdmin, $admin, $secretaria]);
        }

        // 7. Permisos de Profesores
        $proPerms = ['admin.profesores.index', 'admin.profesores.create', 'admin.profesores.store', 'admin.profesores.show', 'admin.profesores.edit', 'admin.profesores.destroy', 'admin.profesores.pdf', 'admin.profesores.reportes'];
        foreach ($proPerms as $perm) {
            Permission::firstOrCreate(['name' => $perm, 'guard_name' => 'web'])->syncRoles([$superAdmin, $admin, $secretaria]);
        }

        // 8. Permisos de Horarios
        $horPerms = ['admin.horarios.index', 'admin.horarios.create', 'admin.horarios.store', 'admin.horarios.show', 'admin.horarios.edit', 'admin.horarios.update', 'admin.horarios.destroy'];
        foreach ($horPerms as $perm) {
            Permission::firstOrCreate(['name' => $perm, 'guard_name' => 'web'])->syncRoles([$superAdmin, $admin, $secretaria]);
        }

        // 9. Permisos de Agendas
        Permission::firstOrCreate(['name' => 'admin.agendas.index', 'guard_name' => 'web'])->syncRoles([$superAdmin, $admin, $secretaria, $cliente]);
        Permission::firstOrCreate(['name' => 'admin.agendas.create', 'guard_name' => 'web'])->syncRoles([$superAdmin, $admin, $secretaria, $cliente]);
        Permission::firstOrCreate(['name' => 'admin.agendas.store', 'guard_name' => 'web'])->syncRoles([$superAdmin, $admin, $secretaria, $cliente]);
        Permission::firstOrCreate(['name' => 'admin.agendas.show', 'guard_name' => 'web'])->syncRoles([$superAdmin, $admin, $secretaria, $cliente]);
        Permission::firstOrCreate(['name' => 'admin.agendas.edit', 'guard_name' => 'web'])->syncRoles([$superAdmin, $admin, $secretaria]);
        Permission::firstOrCreate(['name' => 'admin.agendas.update', 'guard_name' => 'web'])->syncRoles([$superAdmin, $admin, $secretaria]);
        Permission::firstOrCreate(['name' => 'admin.agendas.destroy', 'guard_name' => 'web'])->syncRoles([$superAdmin, $admin, $secretaria]);

        // 10. Vehículos y Pico y Placa
        $vehPerms = ['admin.vehiculos.index', 'admin.vehiculos.create', 'admin.vehiculos.update', 'admin.vehiculos.pico_y_placa.index', 'admin.vehiculos.pico_y_placa.create', 'admin.vehiculos.pico_y_placa.update'];
        foreach ($vehPerms as $perm) {
            Permission::firstOrCreate(['name' => $perm, 'guard_name' => 'web'])->syncRoles([$superAdmin]);
        }

        // 11. Otros Permisos Específicos
        Permission::firstOrCreate(['name' => 'show_datos_cursos', 'guard_name' => 'web'])->syncRoles([$superAdmin, $admin, $secretaria, $cliente]);
        Permission::firstOrCreate(['name' => 'admin.horarios.show_reserva_profesores', 'guard_name' => 'web'])->syncRoles([$superAdmin, $admin, $secretaria]);
        Permission::firstOrCreate(['name' => 'admin.show_reservas', 'guard_name' => 'web'])->syncRoles([$superAdmin, $admin, $secretaria, $cliente]);
        Permission::firstOrCreate(['name' => 'admin.listUsers', 'guard_name' => 'web'])->syncRoles([$superAdmin, $admin, $secretaria]);
        Permission::firstOrCreate(['name' => 'admin.reservas.edit', 'guard_name' => 'web'])->syncRoles([$superAdmin, $admin, $secretaria]);
        Permission::firstOrCreate(['name' => 'admin.asistencias.index', 'guard_name' => 'web'])->syncRoles([$superAdmin, $admin, $secretaria, $profesor]);
        Permission::firstOrCreate(['name' => 'admin.asistencias.inasistencias', 'guard_name' => 'web'])->syncRoles([$superAdmin, $admin, $secretaria]);
        Permission::firstOrCreate(['name' => 'admin.horarios', 'guard_name' => 'web'])->syncRoles([$superAdmin, $admin, $secretaria]);

        // 12. Rutas de Gestión de Roles y Permisos
        $mgmtPerms = ['permissions.index', 'permissions.create', 'permissions.edit', 'permissions.delete', 'roles.index', 'roles.create', 'roles.edit', 'roles.destroy'];
        foreach ($mgmtPerms as $perm) {
            Permission::firstOrCreate(['name' => $perm, 'guard_name' => 'web'])->syncRoles([$superAdmin]);
        }
    }
}