@extends('layout')

@section('content')
<div class="container my-5">
  <h2 class="fw-bold mb-4 text-center">🧾 Checkout</h2>

  <form action="{{ route('checkout.submit') }}" method="POST" class="mx-auto" style="max-width: 600px;" onsubmit="return handleCheckout(event)">
    @csrf

    <div class="mb-4">
      @if(session('error'))
        <div class="alert alert-danger">
          {{ session('error') }}
        </div>
      @endif
      @if(session('success'))
        <div class="alert alert-success">
          {{ session('success') }}
        </div>
      @endif

      <h5 class="fw-bold mb-3">🛍️ Order Summary</h5>
      <table class="table table-bordered text-center align-middle">
        <thead class="table-light">
          <tr>
            <th>Product</th>
            <th>Price (Rs)</th>
            <th>Quantity</th>
            <th>Subtotal (Rs)</th>
          </tr>
        </thead>
        <tbody id="checkout-items"></tbody>
      </table>
      <h5 class="mt-3 text-end">Total: Rs <span id="checkout-total">0</span></h5>
    </div>

    <div class="mb-3">
      <label for="name" class="form-label">Full Name</label>
      <input type="text" class="form-control" id="name" name="name" required>
    </div>

    <div class="mb-3">
      <label for="email" class="form-label">Email</label>
      <input type="email" class="form-control" id="email" name="email" required>
    </div>

    <div class="mb-3">
      <label for="address" class="form-label">Delivery Address</label>
      <textarea class="form-control" id="address" name="address" rows="3" required></textarea>
    </div>

    <div class="mb-3">
      <label class="form-label">Payment Method</label>
      <select class="form-select" id="payment-method" name="payment" required onchange="toggleCardDetails()">
        <option value="">Select Payment Method</option>
        <option value="COD">Cash on Delivery</option>
        <option value="Card">Credit/Debit Card</option>
      </select>
    </div>

    <!-- Card Details Section -->
    <div id="card-details" style="display:none;">
      <div class="mb-3">
        <label for="card-number" class="form-label">Card Number</label>
        <input type="text" class="form-control" id="card-number" name="card_number" placeholder="xxxx-xxxx-xxxx-xxxx">
      </div>
      <div class="mb-3">
        <label for="expiry" class="form-label">Expiry Date</label>
        <input type="text" class="form-control" id="expiry" name="expiry" placeholder="MM/YY">
      </div>
      <div class="mb-3">
        <label for="cvv" class="form-label">CVV</label>
        <input type="text" class="form-control" id="cvv" name="cvv" placeholder="123">
      </div>
    </div>

    <input type="hidden" name="cart_data" id="cart_data">
    <button type="submit" class="btn btn-success mt-3 w-100">Place Order</button>
    <a href="{{ route('cart') }}" class="btn btn-outline-secondary mt-2 w-100">Back to Cart</a>
  </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
// Load checkout items and calculate total including quantity
function loadCheckoutTotal() {
  let cart = JSON.parse(localStorage.getItem('cart')) || [];
  let tableBody = document.getElementById('checkout-items');
  let total = 0;
  tableBody.innerHTML = '';

  if(cart.length === 0) {
    tableBody.innerHTML = `<tr><td colspan="4" class="text-center text-muted">Your cart is empty.</td></tr>`;
    document.getElementById('checkout-total').innerText = 0;
    return;
  }

  cart.forEach(item => {
    let quantity = item.quantity || 1;
    let subtotal = item.price * quantity;
    total += subtotal;

    tableBody.innerHTML += `
      <tr>
        <td>${item.name}</td>
        <td>${item.price}</td>
        <td>${quantity}</td>
        <td>${subtotal}</td>
      </tr>`;
  });

  document.getElementById('checkout-total').innerText = total;
}

function toggleCardDetails() {
  const paymentMethod = document.getElementById('payment-method').value;
  const cardSection = document.getElementById('card-details');
  if (paymentMethod === 'Card') {
    cardSection.style.display = 'block';
    document.getElementById('card-number').required = true;
    document.getElementById('expiry').required = true;
    document.getElementById('cvv').required = true;
  } else {
    cardSection.style.display = 'none';
    document.getElementById('card-number').required = false;
    document.getElementById('expiry').required = false;
    document.getElementById('cvv').required = false;
  }
}

function handleCheckout(event) {
  let cart = localStorage.getItem('cart');
  let cartObj = JSON.parse(cart) || [];
  
  if (cartObj.length === 0) {
    event.preventDefault();
    Swal.fire("Cart is empty!", "Please add items before checkout.", "warning");
    return false;
  }

  // Populate hidden input
  document.getElementById('cart_data').value = cart;
  
  // Clear cart ONLY if submission is successful? 
  // Actually, we should clear it after a successful redirect.
  // But since we are submitting a form, the page will reload.
  // We can clear it now, but if the server errors, the user loses their cart.
  // Correct approach: Don't clear here. Clear on the 'thank you' page using JS.
}

window.onload = loadCheckoutTotal;
</script>
@endsection
