@extends('layout')

@section('content')
<!-- 
    Home Page
    Description: Landing page with Hero section, Services highlight, and Featured Products.
-->
<section class="hero-section text-center d-flex align-items-center justify-content-center">
  <div class="container position-relative z-2">
    <h1 class="display-3 mb-4 fw-bold text-white">Keep Your Ride in <span class="text-accent">Perfect Shape</span></h1>
    <p class="lead mb-5 text-light" style="max-width: 600px; margin: 0 auto;">Professional bike maintenance, custom repairs, and premium parts you can trust.</p>
    <div class="d-flex justify-content-center gap-3">
        <a href="{{ url('/services') }}" class="btn btn-primary btn-lg px-5">Book Service</a>
        <a href="{{ url('/parts') }}" class="btn btn-outline-primary btn-lg px-5">Buy Parts</a>
    </div>
  </div>
</section>

<section class="container my-5 py-5">
  <div class="text-center mb-5">
    <h2 class="fw-bold display-5 mb-3">Why Choose <span class="text-primary">AutoFix</span>?</h2>
    <p class="text-muted lead">We offer expert services, high-quality parts, and passionate professionals.</p>
  </div>

  <div class="row g-4 text-center">
    <div class="col-md-4">
      <div class="card h-100 p-4">
        <div class="card-body">
          <div class="mb-3 text-primary">
            <!-- Icon placeholder -->
            <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" fill="currentColor" class="bi bi-tools" viewBox="0 0 16 16">
              <path d="M1 0 0 1l2.2 3.081a1 1 0 0 0 .815.419h.07a1 1 0 0 1 .708.293l2.675 2.675-2.617 2.654A3.003 3.003 0 0 0 0 13a3 3 0 1 0 5.878-.851l2.654-2.617.968.968-.305.914a1 1 0 0 0 .242 1.023l3.356 3.356a1 1 0 0 0 1.414 0l1.586-1.586a1 1 0 0 0 0-1.414l-3.356-3.356a1 1 0 0 0-1.023-.242L10.5 5.5l-.96-.96 2.68-2.643A3.005 3.005 0 0 0 16 3c0-.269-.035-.53-.102-.777l-2.14 2.141L12 4l-.364-1.757L13.777.102a3 3 0 0 0-3.675 3.68L7.462 6.46 4.793 3.793a1 1 0 0 1-.293-.707v-.071a1 1 0 0 0-.419-.814L1 0Zm9.646 10.646a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708M3 11l.471.242.529.026.287.445.445.287.026.529L5 13l-.242.471-.026.529-.445.287-.287.445-.529.026L3 15l-.471-.242-.529-.026-.287-.445-.445-.287-.026-.529L1 13l.242-.471.026-.529.445-.287.287-.445.529-.026L3 11Z"/>
            </svg>
          </div>
          <h4 class="card-title mb-3">Expert Mechanics</h4>
          <p class="card-text">Our experienced staff ensures your bike gets the care it deserves with precision tools.</p>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card h-100 p-4">
        <div class="card-body">
          <div class="mb-3 text-accent">
            <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" fill="currentColor" class="bi bi-gear-wide-connected" viewBox="0 0 16 16">
              <path d="M7.068.727c.243-.97 1.62-.97 1.864 0l.071.286a.96.96 0 0 0 1.622.434l.205-.211c.695-.719 1.888-.03 1.613.931l-.08.284a.96.96 0 0 0 1.187 1.187l.283-.081c.96-.275 1.65.918.931 1.613l-.211.205a.96.96 0 0 0 .434 1.622l.286.071c.97.243.97 1.62 0 1.864l-.286.071a.96.96 0 0 0-.434 1.622l.211.205c.719.695.03 1.888-.931 1.613l-.284-.08a.96.96 0 0 0-1.187 1.187l.081.283c.275.96-.918 1.65-1.613.931l-.205-.211a.96.96 0 0 0-1.622.434l-.071.286c-.243.97-1.62.97-1.864 0l-.071-.286a.96.96 0 0 0-1.622-.434l-.205.211c-.695.719-1.888.03-1.613-.931l.08-.284a.96.96 0 0 0-1.186-1.187l-.284.081c-.96.275-1.65-.918-.931-1.613l.211-.205a.96.96 0 0 0-.434-1.622l-.286-.071c-.97-.243-.97-1.62 0-1.864l.286-.071a.96.96 0 0 0 .434-1.622l-.211-.205c-.719-.695-.03-1.888.931-1.613l.284.08a.96.96 0 0 0 1.187-1.186l-.081-.284c-.275-.96.918-1.65 1.613-.931l.205.211a.96.96 0 0 0 1.622-.434l.071-.286zM12.973 8.5H8.25l-2.834 3.779A4.998 4.998 0 0 0 12.973 8.5zm0-1.067A4.998 4.998 0 0 0 5.416 3.721L8.25 7.433h4.723zM12 6.432v3.136l-3.321-2.903L12 6.432z"/>
            </svg>
          </div>
          <h4 class="card-title mb-3">Genuine Parts</h4>
          <p class="card-text">We use only original and certified parts for every service to ensure longevity.</p>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card h-100 p-4">
        <div class="card-body">
          <div class="mb-3 text-primary">
            <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" fill="currentColor" class="bi bi-wallet2" viewBox="0 0 16 16">
              <path d="M12.136.326A1.5 1.5 0 0 1 14 1.78V3h.5A1.5 1.5 0 0 1 16 4.5v9a1.5 1.5 0 0 1-1.5 1.5h-13A1.5 1.5 0 0 1 0 13.5v-9a1.5 1.5 0 0 1 1.432-1.499L12.136.326zM5.562 3H13V1.78a.5.5 0 0 0-.621-.484L5.562 3zM1.5 4a.5.5 0 0 0-.5.5v9a.5.5 0 0 0 .5.5h13a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5h-13z"/>
            </svg>
          </div>
          <h4 class="card-title mb-3">Best Prices</h4>
          <p class="card-text">Top-quality service doesn’t have to come with a high price tag. Fair pricing for all.</p>
        </div>
      </div>
    </div>
  </div>
</section>

{{-- 🛠 Services Section --}}
<section class="container my-5 py-5">
  <div class="text-center mb-5">
    <h2 class="fw-bold display-5 mb-3">Our <span class="text-accent">Services</span></h2>
    <p class="text-muted lead">Professional maintenance and repairs for top performance.</p>
  </div>

  <div class="row g-4 justify-content-center">
    @foreach($services as $service)
      <div class="col-md-4 col-sm-6">
        <div class="card h-100 product-card border-0">
          <div class="position-relative overflow-hidden">
             @if(filter_var($service->image, FILTER_VALIDATE_URL))
                <img src="{{ $service->image }}" class="card-img-top w-100" alt="{{ $service->name }}" style="height:250px; object-fit:cover;">
             @else
                <img src="/images/{{ $service->image }}" class="card-img-top w-100" alt="{{ $service->name }}" style="height:250px; object-fit:cover;">
             @endif
          </div>
          
          <div class="card-body text-center p-4">
            <h5 class="card-title fw-bold mb-2">{{ $service->name }}</h5>
            <p class="text-muted small mb-3">{{ Str::limit($service->description, 50) }}</p>
            <p class="text-primary fw-bold fs-5 mb-3">Rs {{ number_format($service->price) }}</p>
            <a href="{{ route('book', ['service' => $service->name]) }}" class="btn btn-outline-primary w-100">
               Book Now
            </a>
          </div>
        </div>
      </div>
    @endforeach
  </div>

  <div class="text-center mt-5">
    <a href="{{ url('/services') }}" class="btn btn-primary px-4 py-2">View All Services</a>
  </div>
</section>

{{-- 🔧 Product Listing Section --}}
<section class="container my-5 pb-5">
  <div class="text-center mb-5">
    <h2 class="fw-bold display-5 mb-3">Popular <span class="text-accent">Bike Parts</span></h2>
    <p class="text-muted lead">Check out our top-selling, high-quality parts for your ride.</p>
  </div>

  <div class="row g-4 justify-content-center">
    @foreach($products as $product)
      <div class="col-md-4 col-sm-6">
        <div class="card h-100 product-card border-0">
          <div class="position-relative overflow-hidden">
            <a href="{{ route('product.detail', $product->id) }}">
                @if(filter_var($product->image, FILTER_VALIDATE_URL))
                  <img src="{{ $product->image }}" class="card-img-top w-100" alt="{{ $product->name }}" style="height:250px; object-fit:cover;">
                @else
                  <img src="/images/{{ $product->image }}" class="card-img-top w-100" alt="{{ $product->name }}" style="height:250px; object-fit:cover;">
                @endif
            </a>
            <div class="d-none position-absolute top-0 end-0 p-2">
                <span class="badge bg-primary">New</span>
            </div>
          </div>
          
          <div class="card-body text-center p-4">
            <a href="{{ route('product.detail', $product->id) }}" class="text-decoration-none">
              <h5 class="card-title fw-bold mb-2">{{ $product->name }}</h5>
            </a>
            <p class="text-primary fw-bold fs-5 mb-3">Rs {{ number_format($product->price) }}</p>
            <button class="btn btn-outline-primary w-100" onclick="addToCart('{{ $product->name }}', {{ $product->price }})">
               Add to Cart
            </button>
          </div>
        </div>
      </div>
    @endforeach
  </div>

  <div class="text-center mt-5">
    <a href="{{ url('/parts') }}" class="btn btn-primary px-4 py-2">View All Parts</a>
  </div>
</section>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
function addToCart(name, price) {
  let cart = JSON.parse(localStorage.getItem('cart')) || [];
  cart.push({ name: name, price: price });
  localStorage.setItem('cart', JSON.stringify(cart));
  Swal.fire({
    title: "Added To Cart!",
    text: `${name} of RS.${price} added to cart!`,
    icon: "success"
  });
}
</script>
@endsection
