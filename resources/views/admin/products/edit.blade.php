@extends('admin.layout')

@section('title', 'Edit Product - ENCODE')

@section('content')
<!-- Page Header -->
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3 mb-0">Edit Product</h1>
    <a href="{{ route('admin.products') }}" class="btn btn-outline-secondary">
        <i class="bi bi-arrow-left me-2"></i> Back to Products
    </a>
</div>

<!-- Edit Form -->
<div class="card">
    <div class="card-body">
        <!-- HANYA SATU FORM! -->
        <form id="editProductForm" action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <div class="row">
                <div class="col-md-8">
                    <!-- Product Name -->
                    <div class="mb-3">
                        <label for="name" class="form-label">Product Name *</label>
                        <input type="text" class="form-control" id="name" name="name" 
                               value="{{ old('name', $product->name) }}" required>
                    </div>
                    
                    <!-- Description -->
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" id="description" name="description" rows="4">{{ old('description', $product->description) }}</textarea>
                    </div>
                    
                    <!-- Price & Stock -->
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="price" class="form-label">Price *</label>
                                <div class="input-group">
                                    <span class="input-group-text">Rp</span>
                                    <input type="number" class="form-control" id="price" name="price" 
                                           value="{{ old('price', $product->price) }}" min="0" step="1000" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="stock" class="form-label">Stock *</label>
                                <input type="number" class="form-control" id="stock" name="stock" 
                                       value="{{ old('stock', $product->stock) }}" min="0" required>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Category -->
                    <div class="mb-3">
                        <label for="category" class="form-label">Category *</label>
                        <select class="form-select" id="category" name="category" required>
                            <option value="t-shirt" {{ $product->category == 't-shirt' ? 'selected' : '' }}>T-Shirt</option>
                            <option value="shirt" {{ $product->category == 'shirt' ? 'selected' : '' }}>Shirt</option>
                            <option value="jacket" {{ $product->category == 'jacket' ? 'selected' : '' }}>Jacket/Sweater</option>
                        </select>
                    </div>
                    
                    <!-- Status -->
                    <div class="mb-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="is_active" name="is_active" 
                                   value="1" {{ $product->is_active ? 'checked' : '' }}>
                            <label class="form-check-label" for="is_active">
                                Active Product
                            </label>
                        </div>
                        <small class="text-muted">If unchecked, product will be hidden from store</small>
                    </div>
                </div>
                
                <div class="col-md-4">
                    <!-- Current Image -->
                    <div class="mb-3">
                        <label class="form-label">Current Image</label>
                        @if($product->image)
                            <div class="text-center">
                                <img src="{{ asset('img/' . $product->image) }}" 
                                     alt="{{ $product->name }}" 
                                     class="img-fluid rounded" 
                                     style="max-height: 200px;">
                                <p class="text-muted small mt-2">{{ $product->image }}</p>
                            </div>
                        @else
                            <div class="text-center py-4 bg-light rounded">
                                <i class="bi bi-image display-6 text-muted"></i>
                                <p class="mt-2">No image uploaded</p>
                            </div>
                        @endif
                    </div>
                    
                    <!-- New Image -->
                    <div class="mb-3">
                        <label for="image" class="form-label">Change Image (Optional)</label>
                        <input type="file" class="form-control" id="image" name="image" accept="image/*">
                        <small class="text-muted">Max 2MB. Allowed: JPG, PNG, GIF</small>
                    </div>
                </div>
            </div>
            
            <!-- Action Buttons -->
            <div class="d-flex justify-content-between mt-4">
                <!-- Delete Form TERPISAH -->
                {{-- <form action="{{ route('admin.products.delete', $product->id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-outline-danger" onclick="return confirm('Delete this product?')">
                        <i class="bi bi-trash me-2"></i>Delete
                    </button>
                </form> --}}
                
                <div>
                    <a href="{{ route('admin.products') }}" class="btn btn-outline-secondary me-2">Cancel</a>
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-save me-2"></i>Update Product
                    </button>
                </div>
            </div>
        </form>
        <!-- AKHIR FORM -->
    </div>
</div>
@endsection

@section('scripts')
<script>
// Form submission with loading
document.getElementById('editProductForm').addEventListener('submit', function(e) {
    const submitBtn = this.querySelector('button[type="submit"]');
    submitBtn.disabled = true;
    submitBtn.innerHTML = '<i class="bi bi-hourglass-split me-2"></i>Updating...';
});
</script>
@endsection