@extends('layout')

@section('content')
<!-- 
    Product Management Index
    Description: Lists all products with Search, Filter, and Categories.
    Allows Admin to Add, Edit, or Delete products.
-->
<div class="container my-5 pb-5">
    <!-- Page Header -->
    <div class="card bg-dark-card border border-secondary mb-5">
        <div class="card-body p-4 d-flex justify-content-between align-items-center">
            <div>
                <h2 class="fw-bold text-white mb-1">Product Management</h2>
                <p class="text-muted mb-0">Manage your inventory and product details</p>
            </div>
            <a href="{{ route('products.create') }}" class="btn btn-primary d-flex align-items-center gap-2">
                <i class="fas fa-plus"></i> Create New Product
            </a>
        </div>
    </div>

    <!-- Search & Filter -->
    <div class="card bg-dark-card border border-secondary mb-4 overflow-visible" style="position: relative; z-index: 50;">
        <div class="card-body p-3">
             <div class="row g-3">
                  <div class="col-md-7 position-relative">
                      <input type="text" id="searchInput" class="form-control bg-dark border-secondary text-white" placeholder="Search by name..." autocomplete="off">
                      {{-- Autocomplete Dropdown --}}
                      <div id="searchDropdown" class="list-group position-absolute w-100 shadow-lg" style="display:none; z-index: 1050; top: 100%; left: 0; background: #0F1219; border: 1px solid rgba(255,255,255,0.1); max-height: 300px; overflow-y: auto;"></div>
                  </div>
                  <div class="col-md-5">
                      <select id="categoryFilter" class="form-select bg-dark border-secondary text-white">
                          <option value="">All Categories</option>
                          @foreach($categories as $cat)
                            <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                          @endforeach
                      </select>
                  </div>
              </div>
        </div>
    </div>

    <!-- Success Message -->
    @if ($message = Session::get('success'))
        <div class="alert alert-success d-flex align-items-center mb-4" role="alert">
            <i class="fas fa-check-circle me-2"></i>
            <div>{{ $message }}</div>
        </div>
    @endif

    <!-- Products Table -->
    <div class="card bg-dark-card border border-secondary overflow-hidden">
        <div class="table-responsive">
            <table class="table table-dark table-hover align-middle mb-0">
                <thead class="border-bottom border-secondary">
                    <tr>
                        <th class="py-3 ps-4">ID</th>
                        <th class="py-3">Image</th>
                        <th class="py-3">Name</th>
                        <th class="py-3">Description</th>
                        <th class="py-3">Category</th>
                        <th class="py-3">Price</th>
                        <th class="py-3">Stock</th>
                        <th class="py-3 text-center">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-700" id="productsTableBody">
                    @foreach ($products as $product)
                    <tr>
                        <td class="ps-4 fw-bold text-muted">#{{ $product->id }}</td>
                        <td>
                            <img src="{{ filter_var($product->image, FILTER_VALIDATE_URL) ? $product->image : '/images/' . $product->image }}" 
                                 class="rounded border border-secondary" 
                                 style="width: 60px; height: 60px; object-fit: cover;" 
                                 alt="{{ $product->name }}">
                        </td>
                        <td class="fw-bold text-white">{{ $product->name }}</td>
                        <td class="text-muted" style="max-width: 200px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                            {{ $product->description }}
                        </td>
                        <td>
                            <span class="badge bg-secondary text-white border border-secondary">
                                {{ $product->category->name ?? $product->category ?? 'Uncategorized' }}
                            </span>
                        </td>
                        <td class="text-primary fw-bold">Rs {{ number_format($product->price) }}</td>
                        <td>
                            <span class="badge {{ $product->stock > 10 ? 'bg-success' : ($product->stock > 0 ? 'bg-warning text-dark' : 'bg-danger') }}">
                                {{ $product->stock }} units
                            </span>
                        </td>
                        <td class="text-center">
                            <form id="delete-product-{{ $product->id }}" action="{{ route('products.destroy',$product->id) }}" method="POST">
                                <a href="{{ route('products.edit',$product->id) }}" class="btn btn-sm btn-primary me-2">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                @csrf
                                @method('DELETE')
                                <button type="button" class="btn btn-sm btn-danger" onclick="confirmDelete('delete-product-{{ $product->id }}')">
                                    <i class="fas fa-trash"></i> Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    function confirmDelete(formId) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes, delete it!',
            background: '#1f2937', 
            color: '#fff'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById(formId).submit();
            }
        })
    }

    $(document).ready(function() {
        
        // AJAX Search Functionality
        // Filters products by Name and Category
        function performSearch() {
            let query = $('#searchInput').val();
            let category = $('#categoryFilter').val();

            $.ajax({
                url: "{{ route('products.search') }}",
                type: "GET",
                data: { query: query, category: category },
                success: function(response) {
                    console.log("[Admin] Search Response:", response);
                    // 1. Update Dropdown
                    let dropdownHtml = '';
                    if(query.length > 0 && response.length > 0) {
                         response.forEach(product => {
                            let imageUrl = product.image ? product.image : 'placeholder.jpg';
                            if (product.image && !product.image.startsWith('http')) {
                                imageUrl = '/images/' + product.image;
                            } else if (!product.image) {
                                imageUrl = '/images/placeholder.jpg';
                            }
                            dropdownHtml += `
                                <a href="/products/${product.id}/edit" class="list-group-item list-group-item-action d-flex align-items-center gap-3 text-white" style="background: #0F1219; border-color: rgba(255,255,255,0.1);">
                                    <img src="${imageUrl}" class="rounded" style="width: 40px; height: 40px; object-fit: cover;">
                                    <div>
                                        <h6 class="mb-0 fw-bold">${product.name}</h6>
                                        <small class="text-muted">Rs ${product.price}</small>
                                    </div>
                                </a>
                            `;
                        });
                        $('#searchDropdown').html(dropdownHtml).show();
                    } else {
                        $('#searchDropdown').hide();
                    }

                    // 2. Update Table Body
                    let tableHtml = '';
                    if(response.length > 0) {
                        response.forEach(product => {
                            let imageUrl = product.image ? product.image : 'placeholder.jpg';
                            if (product.image && !product.image.startsWith('http')) {
                                imageUrl = '/images/' + product.image;
                            } else if (!product.image) {
                                imageUrl = '/images/placeholder.jpg';
                            }
                            
                            // Stock Badge Logic
                            let stockBadgeClass = product.stock > 10 ? 'bg-success' : (product.stock > 0 ? 'bg-warning text-dark' : 'bg-danger');

                             // Handle Category Object vs String
                            let catName = (typeof product.category === 'object' && product.category !== null) ? product.category.name : (product.category || 'Uncategorized');

                            tableHtml += `
                            <tr>
                                <td class="ps-4 fw-bold text-muted">#${product.id}</td>
                                <td>
                                    <img src="${imageUrl}" class="rounded border border-secondary" style="width: 60px; height: 60px; object-fit: cover;" alt="${product.name}">
                                </td>
                                <td class="fw-bold text-white">${product.name}</td>
                                <td class="text-muted" style="max-width: 200px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                                    ${product.description || ''}
                                </td>
                                <td>
                                    <span class="badge bg-secondary text-white border border-secondary">
                                        ${catName}
                                    </span>
                                </td>
                                <td class="text-primary fw-bold">Rs ${new Intl.NumberFormat().format(product.price)}</td>
                                <td>
                                    <span class="badge ${stockBadgeClass}">
                                        ${product.stock} units
                                    </span>
                                </td>
                                <td class="text-center">
                                    <form id="delete-product-${product.id}" action="/products/${product.id}" method="POST">
                                        <a href="/products/${product.id}/edit" class="btn btn-sm btn-primary me-2">
                                            <i class="fas fa-edit"></i> Edit
                                        </a>
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <button type="button" class="btn btn-sm btn-danger" onclick="confirmDelete('delete-product-${product.id}')">
                                            <i class="fas fa-trash"></i> Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            `;
                        });
                    } else {
                        tableHtml = '<tr><td colspan="8" class="text-center text-muted py-5">No products found matching your criteria.</td></tr>';
                    }
                    $('#productsTableBody').html(tableHtml);
                },
                error: function(xhr, status, error) {
                     console.error("[Admin] Search Error:", error);
                     console.log(xhr.responseText);
                }
            });
        }

        $('#searchInput').on('keyup', performSearch);
        $('#categoryFilter').on('change', performSearch);

        // Hide dropdown when clicking outside
        $(document).on('click', function(e) {
            if (!$(e.target).closest('#searchInput').length && !$(e.target).closest('#searchDropdown').length) {
                $('#searchDropdown').hide();
            }
        });
    });
</script>
@endsection
