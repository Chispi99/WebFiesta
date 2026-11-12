<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ResortAccessControlTest extends TestCase
{
    use RefreshDatabase;

    protected User $admin;
    protected User $adult;
    protected User $minor;

    protected function setUp(): void
    {
        parent::setUp();

        // Creamos los tres perfiles de prueba
        $this->admin = User::create([
            'name' => 'Admin Test',
            'email' => 'admin@test.com',
            'password' => bcrypt('password'),
            'is_admin' => true,
            'age' => 40,
        ]);

        $this->adult = User::create([
            'name' => 'Adult Test',
            'email' => 'adult@test.com',
            'password' => bcrypt('password'),
            'is_admin' => false,
            'age' => 25,
        ]);

        $this->minor = User::create([
            'name' => 'Minor Test',
            'email' => 'minor@test.com',
            'password' => bcrypt('password'),
            'is_admin' => false,
            'age' => 16,
        ]);
    }

    // ==========================================
    // FASE 3 & 1: RUTAS PÚBLICAS
    // ==========================================

    public function test_home_page_is_publicly_accessible(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);
        $response->assertSee('Bienvenido a Resort Paradiso');
    }

    public function test_login_page_is_publicly_accessible(): void
    {
        $response = $this->get('/login');
        $response->assertStatus(200);
        $response->assertSee('Inicio de Sesión en el Resort');
    }

    public function test_register_page_is_publicly_accessible(): void
    {
        $response = $this->get('/register');
        $response->assertStatus(200);
        $response->assertSee('Registro de Huésped en el Resort');
    }

    // ==========================================
    // FASE 2: MIDDLEWARE DE AUTENTICACIÓN (CheckAuth)
    // ==========================================

    public function test_unauthenticated_user_cannot_access_panel_and_is_redirected_to_login(): void
    {
        $response = $this->get('/panel');
        $response->assertRedirect('/login');
    }

    public function test_unauthenticated_user_cannot_access_casino_and_is_redirected_to_login(): void
    {
        $response = $this->get('/casino');
        $response->assertRedirect('/login');
    }

    public function test_unauthenticated_user_cannot_access_admin_and_is_redirected_to_login(): void
    {
        $response = $this->get('/admin');
        $response->assertRedirect('/login');
    }

    public function test_authenticated_user_can_access_panel(): void
    {
        $response = $this->actingAs($this->adult)->get('/panel');
        $response->assertStatus(200);
        $response->assertSee('¡Bienvenido a tu Habitación, Adult Test!');
    }

    // ==========================================
    // FASE 2: MIDDLEWARE DE EDAD (CheckAge)
    // ==========================================

    public function test_adult_user_can_access_casino(): void
    {
        $response = $this->actingAs($this->adult)->get('/casino');
        $response->assertStatus(200);
        $response->assertSee('Sala de Juegos — Casino Real Paradiso');
    }

    public function test_minor_user_is_denied_access_to_casino_and_redirected_to_panel_with_error(): void
    {
        $response = $this->actingAs($this->minor)->get('/casino');
        $response->assertRedirect('/panel');
        $response->assertSessionHas('error', 'Acceso denegado: Debes ser mayor de edad');
    }

    // ==========================================
    // FASE 2: MIDDLEWARE DE ADMINISTRADOR (CheckAdmin)
    // ==========================================

    public function test_admin_user_can_access_admin_office(): void
    {
        $response = $this->actingAs($this->admin)->get('/admin');
        $response->assertStatus(200);
        $response->assertSee('Oficina de Dirección del Resort');
    }

    public function test_regular_adult_user_is_denied_access_to_admin_office_with_403(): void
    {
        $response = $this->actingAs($this->adult)->get('/admin');
        $response->assertStatus(403);
    }

    public function test_minor_user_is_denied_access_to_admin_office_with_403(): void
    {
        $response = $this->actingAs($this->minor)->get('/admin');
        $response->assertStatus(403);
    }
}

