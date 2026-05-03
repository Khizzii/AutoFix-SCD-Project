<!-- 
    Layout: Master Template
    Description: Defines the common structure for all pages (Header, Navbar, Footer).
    Includes Bootstrap 5, Custom CSS, and Google Fonts.
-->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Autofix</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom Fonts (Outfit) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" defer></script>
</head>
<body>
  <header>
  <nav class="navbar navbar-expand-lg fixed-top">
    <div class="container">
      <a class="navbar-brand" href="{{ url('/') }}">Auto<span>Fix</span></a>

      <!-- Hamburger button for mobile -->
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" 
              aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <!-- Navbar links -->
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto align-items-center">
          <li class="nav-item"><a class="nav-link" href="{{ url('/') }}">Home</a></li>
          <li class="nav-item"><a class="nav-link" href="{{ url('/services') }}">Services</a></li>
          <li class="nav-item"><a class="nav-link" href="{{ url('/parts') }}">Parts</a></li>
          <li class="nav-item"><a class="nav-link" href="{{ url('/contact') }}">Contact</a></li>
          
          @if(Auth::check() && (Auth::user()->usertype == 'admin' || Auth::user()->usertype == 'Admin'))
            <li class="nav-item"><a class="nav-link" href="{{ route('dashboard') }}">Admin</a></li>
          @endif

          
          <li class="nav-item"><a class="nav-link" href="{{ route('cart') }}">Cart</a></li>
          
           @auth
               @if(Auth::user()->usertype == 'admin' || Auth::user()->usertype == 'Admin')
                   <li class="nav-item ms-lg-3">
                       <a href="{{ route('dashboard') }}" class="btn btn-outline-light btn-sm me-2">Dashboard</a>
                   </li>
               @endif
               <li class="nav-item ms-2">
                   <a href="{{ route('orders.index') }}" class="nav-link">My Orders</a>
               </li>
               <li class="nav-item">
                   <form method="POST" action="{{ route('logout') }}" class="d-inline">
                       @csrf
                       <button type="submit" class="btn btn-outline-primary btn-sm">Logout</button>
                   </form>
               </li>
           @else
               <li class="nav-item ms-lg-3"><a class="btn btn-primary btn-sm" href="{{ route('login') }}">LOGIN</a></li>
                <li class="nav-item ms-2"><a class="btn btn-outline-light btn-sm" href="{{ route('register') }}">REGISTER</a></li>
           @endauth

        </ul>
      </div>
    </div>
  </nav>
</header>
<div style="height: 80px;"></div> <!-- Spacer for fixed navbar -->

    <main>
        @yield('content')
    </main>

   <footer class="mt-auto py-5" style="background-color: #020208; border-top: 1px solid rgba(255,255,255,0.05);">
    <div class="container">
      <div class="row gy-4">
        <!-- Brand & About -->
        <div class="col-lg-4 col-md-6">
          <h4 class="mb-3 text-white fw-bold">Auto<span class="text-primary">Fix</span></h4>
          <p class="text-muted small">Your trusted partner for premium bike maintenance, repairs, and genuine parts. We ensure your ride stays in perfect shape.</p>
          <div class="d-flex gap-3 mt-3">
             <a href="https://www.facebook.com/khizzi.786" target="_blank" class="text-muted hover-accent"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-facebook" viewBox="0 0 16 16"><path d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951"/></svg></a>
             <a href="https://www.instagram.com/khizzii_/" target="_blank" class="text-muted hover-accent"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-instagram" viewBox="0 0 16 16"><path d="M8 0C5.829 0 5.556.01 4.703.048 3.85.088 3.269.222 2.76.42a3.9 3.9 0 0 0-1.417.923A3.9 3.9 0 0 0 .42 2.76C.222 3.268.087 3.85.048 4.7.01 5.555 0 5.827 0 8.001c0 2.172.01 2.444.048 3.297.04.852.174 1.433.372 1.942.205.526.478.972.923 1.417.444.445.89.719 1.416.923.51.198 1.09.333 1.942.372C5.555 15.99 5.827 16 8 16s2.444-.01 3.298-.048c.851-.04 1.434-.174 1.943-.372a3.9 3.9 0 0 0 1.416-.923c.445-.445.718-.891.923-1.417.197-.509.332-1.09.372-1.942C15.99 10.445 16 10.173 16 8s-.01-2.445-.048-3.299c-.04-.851-.175-1.433-.372-1.941a3.9 3.9 0 0 0-.923-1.417A3.9 3.9 0 0 0 13.24.42c-.51-.198-1.092-.333-1.943-.372C10.443.01 10.172 0 7.998 0h.003zm-.717 1.442h.718c2.136 0 2.389.007 3.232.046.78.035 1.204.166 1.486.275.373.145.64.319.92.599.28.28.453.546.598.92.11.281.24.705.275 1.485.039.843.047 1.096.047 3.231s-.008 2.389-.047 3.232c-.035.78-.166 1.203-.275 1.485a2.47 2.47 0 0 1-.599.919c-.28.28-.546.453-.92.598-.281.11-.705.24-1.485.276-.843.038-1.096.047-3.232.047s-2.39-.009-3.233-.047c-.78-.036-1.203-.166-1.485-.276a2.478 2.478 0 0 1-.92-.598 2.48 2.48 0 0 1-.6-.92c-.109-.281-.24-.705-.275-1.485-.038-.843-.047-1.096-.047-3.232 0-2.136.009-2.388.047-3.231.036-.78.166-1.204.276-1.486.145-.373.319-.64.599-.92.28-.28.546-.453.92-.598.282-.11.705-.24 1.485-.276.738-.034 1.024-.044 2.515-.045v.002zm4.988 1.328a.96.96 0 1 0 0 1.92.96.96 0 0 0 0-1.92zm-4.27 1.122a4.109 4.109 0 1 0 0 8.217 4.109 4.109 0 0 0 0-8.217zm0 1.441a2.667 2.667 0 1 1 0 5.334 2.667 2.667 0 0 1 0-5.334"/></svg></a>
             <a href="https://www.linkedin.com/in/khizar-iqbal-fazil/" target="_blank" class="text-muted hover-accent"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-linkedin" viewBox="0 0 16 16"><path d="M0 1.146C0 .513.526 0 1.175 0h13.65C15.474 0 16 .513 16 1.146v13.708c0 .633-.526 1.146-1.175 1.146H1.175C.526 16 0 15.487 0 14.854V1.146zm4.943 12.248V6.169H2.542v7.225h2.401zm-1.2-8.212c.837 0 1.358-.554 1.358-1.248-.015-.709-.52-1.248-1.342-1.248-.822 0-1.359.54-1.359 1.248 0 .694.521 1.248 1.327 1.248h.015zm4.908 8.212V9.359c0-.216.016-.432.08-.586.173-.431.568-.878 1.232-.878.869 0 1.216.662 1.216 1.634v3.865h2.401V9.25c0-2.22-1.184-3.252-2.764-3.252-1.274 0-1.845.7-2.165 1.193v.025h-.016a5.54 5.54 0 0 1 .016-.025V6.169h-2.4c.03.678 0 7.225 0 7.225h2.4z"/></svg></a>
          </div>
        </div>

        <!-- Quick Links -->
        <div class="col-lg-2 col-md-6">
          <h5 class="text-white mb-3">Quick Links</h5>
          <ul class="list-unstyled">
            <li class="mb-2"><a href="{{ url('/') }}" class="text-muted text-decoration-none hover-white">Home</a></li>
            <li class="mb-2"><a href="{{ url('/services') }}" class="text-muted text-decoration-none hover-white">Services</a></li>
            <li class="mb-2"><a href="{{ url('/parts') }}" class="text-muted text-decoration-none hover-white">Parts</a></li>
            <li class="mb-2"><a href="{{ url('/contact') }}" class="text-muted text-decoration-none hover-white">Contact</a></li>
          </ul>
        </div>

        <!-- Working Hours -->
        <div class="col-lg-3 col-md-6">
          <h5 class="text-white mb-3">Working Hours</h5>
          <ul class="list-unstyled text-muted small">
            <li class="mb-2">Mon - Fri: 9:00 AM - 8:00 PM</li>
            <li class="mb-2">Saturday: 10:00 AM - 6:00 PM</li>
            <li class="mb-2">Sunday: Closed</li>
          </ul>
        </div>

        <!-- Contact Info -->
        <div class="col-lg-3 col-md-6">
          <h5 class="text-white mb-3">Contact Us</h5>
          <ul class="list-unstyled text-muted small">
             <li class="mb-3 d-flex"><span class="text-primary me-2">📍</span> Bike Market, Saddar, Karachi</li>
             <li class="mb-3 d-flex"><span class="text-primary me-2">📞</span> +92 300 1234567</li>
             <li class="mb-3 d-flex"><span class="text-primary me-2">✉️</span> info@autofix.com</li>
          </ul>
        </div>
      </div>
      
      <div class="text-center pt-4 mt-4 border-top border-secondary opacity-50">
        <p class="mb-0 text-muted small">&copy; {{ date('Y') }} AutoFix. All rights reserved.</p>
      </div>
    </div>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>
</html>
