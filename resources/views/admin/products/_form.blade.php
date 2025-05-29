@csrf
<div class="mb-3">
    <label for="name" class="form-label">Product Name</label>
    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $product->name ?? '') }}" required>
    @error('name')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label for="description" class="form-label">Description</label>
    <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="3" required>{{ old('description', $product->description ?? '') }}</textarea>
    @error('description')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label for="price" class="form-label">Price</label>
    <input type="number" step="0.01" min="0" class="form-control @error('price') is-invalid @enderror" id="price" name="price" value="{{ old('price', $product->price ?? '') }}" required>
    @error('price')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label for="image_url" class="form-label">Image URL (Optional)</label>
    <input type="url" class="form-control @error('image_url') is-invalid @enderror" id="image_url" name="image_url" value="{{ old('image_url', $product->image_url ?? '') }}">
    @error('image_url')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
    @if (isset($product) && $product->image_url)
        <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="img-thumbnail mt-2" style="max-height: 100px;">
    @endif
</div>

<div class="d-flex justify-content-end">
    <a href="{{ route('admin.products.index') }}" class="btn btn-secondary me-2">Cancel</a>
    <button type="submit" class="btn btn-primary">{{ $submitButtonText ?? 'Submit' }}</button>
</div> 