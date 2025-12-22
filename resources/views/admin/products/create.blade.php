@extends('admin.layout')

@section('title', 'Add New Product - ENCODE')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3 mb-0">Add New Product</h1>
    <a href="{{ route('admin.products') }}" class="btn btn-outline-secondary">
        <i class="bi bi-arrow-left me-2"></i> Back to Products
    </a>
</div>

<div class="card">
    <div class="card-body">
        <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class="row">
                <div class="col-md-8">
                    <div class="mb-3">
                        <label class="form-label">Product Name *</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Description</label>
                        <textarea name="description" class="form-control" rows="3"></textarea>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Price (Rp) *</label>
                                <input type="number" name="price" class="form-control" min="0" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Stock *</label>
                                <input type="number" name="stock" class="form-control" min="0" value="0" required>
                            </div>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Category *</label>
                        <select name="category" class="form-select" required>
                            <option value="">Select Category</option>
                            <option value="t-shirt">T-Shirt</option>
                            <option value="shirt">Shirt</option>
                            <option value="jacket">Jacket/Sweater</option>
                        </select>
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="mb-3">
                        <label class="form-label">Product Image *</label>
                        <input type="file" name="image" class="form-control" accept="image/*" required>
                        <small class="text-muted">Upload product photo (max 2MB)</small>
                    </div>
                    
                    <div class="mb-3">
                        <div class="form-check">
                            <input type="checkbox" name="is_active" class="form-check-input" value="1" checked>
                            <label class="form-check-label">Active Product</label>
                        </div>
                        <small class="text-muted">Uncheck to hide from store</small>
                    </div>
                </div>
            </div>
            
            <div class="d-flex justify-content-end mt-3">
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-save me-2"></i>Save Product
                </button>
            </div>
        </form>
    </div>
</div>
@endsection