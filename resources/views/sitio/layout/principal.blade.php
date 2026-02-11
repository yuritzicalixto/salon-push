<!DOCTYPE html>
<html lang="es">
<head>
     @include('sitio.includes.head')
</head>
<body>

  <!-- ═══════════════════════════════════════════════════════════════════════
       HEADER
       ═══════════════════════════════════════════════════════════════════════ -->
  <header class="header" id="header">
    @include('sitio.includes.menu')
  </header>

  <main>
    @yield('contenido')
  </main>

  <!-- ═══════════════════════════════════════════════════════════════════════
       FOOTER
       ═══════════════════════════════════════════════════════════════════════ -->
  <footer class="footer">
    @include('sitio.includes.footer')
  </footer>

  <!-- ═══════════════════════════════════════════════════════════════════════
       CART DRAWER
       ═══════════════════════════════════════════════════════════════════════ -->
  <div id="cartOverlay" class="drawer-overlay"></div>
  <aside id="cartDrawer" class="drawer">
    <div class="drawer__header">
      <h2 class="drawer__title">Tu Carrito</h2>
      <button type="button" id="closeCartBtn" class="modal__close">✕</button>
    </div>
    <div class="drawer__body" id="cartItems">
      <div class="drawer__empty" id="cartEmpty">
        <svg xmlns="http://www.w3.org/2000/svg" width="60" height="60" fill="none" viewBox="0 0 24 24" stroke="currentColor" style="margin: 0 auto 15px; opacity: 0.3;">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
        </svg>
        <p>Tu carrito está vacío</p>
        <a href="#productos" class="btn btn--sm btn--outline" style="margin-top: 15px;" onclick="closeCart()">Ver productos</a>
      </div>
      <!-- Cart items will be inserted here by JS -->
    </div>
    <div class="drawer__footer">
      <div class="drawer__total">
        <span>Total</span>
        <strong id="cartTotal">$0.00</strong>
      </div>
      <div class="drawer__actions">
        <button type="button" class="btn btn--dark" id="clearCartBtn" style="flex: 1;">Vaciar carrito</button>
        <button type="button" class="btn btn--primary" id="checkoutBtn" style="flex: 1;">Reservar</button>
      </div>
    </div>
  </aside>


    <script>
        window.isAuthenticated = {{ auth()->check() ? 'true' : 'false' }};
        window.loginUrl = "{{ route('login') }}";
        window.reservationCreateUrl = "/client/reservations/create";
    </script>
       <!-- JavaScript -->
  @include('sitio.includes.scripts')
</body>
</html>
