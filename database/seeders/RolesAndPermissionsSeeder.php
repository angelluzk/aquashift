<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Limpa o cache de papéis e permissões
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // --- DEFINIÇÃO DAS PERMISSÕES ---
        // (Agrupadas por módulo para facilitar a leitura)

        // Módulo: Usuários
        Permission::create(['name' => 'manage users']);

        // Módulo: Filiais
        Permission::create(['name' => 'manage branches']); // CRUD de filiais, boxes, etc.

        // Módulo: Serviços
        Permission::create(['name' => 'manage services']); // CRUD de serviços

        // Módulo: Agendamentos
        Permission::create(['name' => 'view all bookings']);    // Ver agendamentos de todas filiais
        Permission::create(['name' => 'view branch bookings']); // Ver agendamentos da própria filial
        Permission::create(['name' => 'manage own bookings']);  // CRUD dos agendamentos do próprio cliente
        Permission::create(['name' => 'manage branch bookings']); // CRUD dos agendamentos da própria filial (remarcar, cancelar)

        // --- DEFINIÇÃO DOS PAPÉIS (ROLES) ---

        // Papel: Atendente (Atendente de filial)
        $attendantRole = Role::create(['name' => 'Atendente']);
        $attendantRole->givePermissionTo([
            'view branch bookings',
            'manage branch bookings',
        ]);

        // Papel: Gestor (Gestor de filial)
        $managerRole = Role::create(['name' => 'Gestor']);
        $managerRole->givePermissionTo([
            'view branch bookings',
            'manage branch bookings',
            'manage services', // Gestor pode editar serviços da sua filial (a lógica de multi-filial virá depois)
        ]);

        // Papel: Admin (Super Admin do Sistema)
        $adminRole = Role::create(['name' => 'Admin']);
        $adminRole->givePermissionTo(Permission::all()); // Admin pode tudo

        // Papel: Cliente (Usuário padrão do Breeze)
        $clientRole = Role::create(['name' => 'Cliente']);
        $clientRole->givePermissionTo([
            'manage own bookings',
        ]);
    }
}