<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Macrofiesta — La Noche Que No Olvidarás</title>
    <meta name="description" content="Compra tu entrada para la Macrofiesta. Entrada normal 15€, entrada con menú 25€. Pago fácil por Bizum.">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;800;900&display=swap" rel="stylesheet">
    <link href="{{ asset('css/macrofiesta.css') }}" rel="stylesheet">
</head>
<body>
    <!-- Partículas de fondo animadas -->
    <div class="particles" aria-hidden="true">
        <span></span><span></span><span></span><span></span><span></span>
        <span></span><span></span><span></span><span></span><span></span>
    </div>

    <!-- Hero / Cabecera -->
    <header class="hero">
        <div class="hero-content">
            <span class="hero-badge">🎉 Evento Exclusivo</span>
            <h1 class="hero-title">MACRO<span class="text-gradient">FIESTA</span></h1>
            <p class="hero-subtitle">La noche que no olvidarás. Música, ambiente y una experiencia épica. Compra tu entrada y ayuda a que esta fiesta sea realidad.</p>
            <div class="hero-details">
                <div class="hero-detail-item">
                    <span class="hero-detail-icon">📅</span>
                    <span>Próximamente</span>
                </div>
                <div class="hero-detail-item">
                    <span class="hero-detail-icon">📍</span>
                    <span>Mesón Posada de Millán — C. la Granja, 88, 11204 Algeciras, Cádiz</span>
                </div>
                <div class="hero-detail-item">
                    <span class="hero-detail-icon">🎶</span>
                    <span>DJ en vivo</span>
                </div>
            </div>
            <a href="#reserva" class="hero-cta">Consigue tu Entrada ↓</a>
        </div>
    </header>

    <!-- Sección de precios -->
    <section class="pricing-section" id="reserva">
        <h2 class="section-title">Elige tu Entrada</h2>
        <p class="section-subtitle">Dos opciones para vivir la noche a tu manera</p>
        
        <div class="pricing-cards">
            <div class="pricing-card" id="card-normal" onclick="selectTipo('normal')">
                <div class="pricing-card-badge">Popular</div>
                <h3 class="pricing-card-title">Normal</h3>
                <div class="pricing-card-price">15<span>€</span></div>
                <ul class="pricing-card-features">
                    <li>✓ Acceso al evento</li>
                    <li>✓ Zona de fiesta</li>
                    <li>✓ Música en vivo</li>
                </ul>
            </div>
            <div class="pricing-card pricing-card--featured" id="card-menu" onclick="selectTipo('menu')">
                <div class="pricing-card-badge">Recomendado</div>
                <h3 class="pricing-card-title">Menú</h3>
                <div class="pricing-card-price">25<span>€</span></div>
                <ul class="pricing-card-features">
                    <li>✓ Todo lo de Normal</li>
                    <li>✓ Menú completo</li>
                    <li>✓ Bebida incluida</li>
                    <li>✓ Acceso preferente</li>
                </ul>
            </div>
        </div>
    </section>

    <!-- Formulario de reserva -->
    <section class="form-section">
        <div class="form-card">
            <h2 class="form-title">Completa tu Reserva</h2>
            
            @if ($errors->any())
                <div class="alert-error">
                    @foreach ($errors->all() as $error)
                        <p>⚠ {{ $error }}</p>
                    @endforeach
                </div>
            @endif

            <form action="{{ route('checkout.store') }}" method="POST">
                @csrf
                <input type="hidden" name="tipo_entrada" id="tipo_entrada" value="normal">

                <div class="form-group">
                    <label for="nombre" class="form-label">Nombre completo</label>
                    <input type="text" name="nombre" id="nombre" required class="form-input" placeholder="Ej: Carlos García" value="{{ old('nombre') }}">
                </div>

                <div class="form-group">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" id="email" required class="form-input" placeholder="tu@email.com" value="{{ old('email') }}">
                </div>

                <div class="form-group">
                    <label for="telefono" class="form-label">Teléfono</label>
                    <input type="tel" name="telefono" id="telefono" required class="form-input" placeholder="600 00 00 00" value="{{ old('telefono') }}">
                </div>

                <div class="form-group">
                    <label class="form-label">Entrada seleccionada</label>
                    <div class="selected-ticket" id="selected-ticket-display">
                        <span class="selected-ticket-type">Normal</span>
                        <span class="selected-ticket-price">15€</span>
                    </div>
                    <p class="form-hint">Puedes cambiarla arriba en las tarjetas de precio</p>
                </div>

                <div class="form-group">
                    <label class="form-label">¿A qué número quieres enviar el Bizum?</label>
                    <div class="bizum-options">
                        <label class="bizum-option">
                            <input type="radio" name="telefono_cobro" value="634 46 90 24" checked>
                            <span class="bizum-option-content">
                                <span class="bizum-option-number">634 46 90 24</span>
                            </span>
                        </label>
                        <label class="bizum-option">
                            <input type="radio" name="telefono_cobro" value="671 78 40 16">
                            <span class="bizum-option-content">
                                <span class="bizum-option-number">671 78 40 16</span>
                            </span>
                        </label>
                    </div>
                </div>

                <button type="submit" class="btn-submit">
                    <span>🎟️ Reservar Entrada</span>
                </button>
            </form>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <p>&copy; {{ date('Y') }} Macrofiesta. Todos los derechos reservados.</p>
    </footer>

    <script>
        function selectTipo(tipo) {
            document.getElementById('tipo_entrada').value = tipo;

            // Actualizar visual de las tarjetas
            document.getElementById('card-normal').classList.toggle('pricing-card--active', tipo === 'normal');
            document.getElementById('card-menu').classList.toggle('pricing-card--active', tipo === 'menu');

            // Actualizar display
            const display = document.getElementById('selected-ticket-display');
            if (tipo === 'menu') {
                display.querySelector('.selected-ticket-type').textContent = 'Menú';
                display.querySelector('.selected-ticket-price').textContent = '25€';
            } else {
                display.querySelector('.selected-ticket-type').textContent = 'Normal';
                display.querySelector('.selected-ticket-price').textContent = '15€';
            }
        }

        // Seleccionar Normal por defecto al cargar
        document.addEventListener('DOMContentLoaded', () => selectTipo('normal'));
    </script>
</body>
</html>
