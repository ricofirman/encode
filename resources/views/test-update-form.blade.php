<!DOCTYPE html>
<html>
<head>
    <title>Test Update Form</title>
</head>
<body>
    <h2>Test Update Product ID: {{ $product->id }}</h2>
    
    <form method="POST" action="/test-update-handler/{{ $product->id }}" enctype="multipart/form-data">
        @csrf
        
        <div>
            <label>Name:</label>
            <input type="text" name="name" value="{{ $product->name }}" required>
        </div>
        
        <div>
            <label>Price:</label>
            <input type="number" name="price" value="{{ $product->price }}" required>
        </div>
        
        <div>
            <label>Stock:</label>
            <input type="number" name="stock" value="{{ $product->stock }}" required>
        </div>
        
        <div>
            <label>Category:</label>
            <select name="category" required>
                <option value="jacket" {{ $product->category == 'jacket' ? 'selected' : '' }}>Jacket</option>
                <option value="shirt" {{ $product->category == 'shirt' ? 'selected' : '' }}>Shirt</option>
                <option value="t-shirt" {{ $product->category == 't-shirt' ? 'selected' : '' }}>T-Shirt</option>
            </select>
        </div>
        
        <div>
            <label>Image (optional):</label>
            <input type="file" name="image">
        </div>
        
        <div>
            <label>
                <input type="checkbox" name="is_active" value="1" {{ $product->is_active ? 'checked' : '' }}>
                Active
            </label>
        </div>
        
        <button type="submit">Test Update</button>
    </form>
    
    <hr>
    
    <h3>Current Product Data:</h3>
    <p>ID: {{ $product->id }}</p>
    <p>Name: {{ $product->name }}</p>
    <p>Image: {{ $product->image }}</p>
    <p>Updated At: {{ $product->updated_at }}</p>
    
    <p>
        <a href="{{ route('admin.products.edit', $product->id) }}">Edit via Admin Panel</a> | 
        <a href="{{ route('admin.products') }}">Back to Products</a>
    </p>
</body>
</html>