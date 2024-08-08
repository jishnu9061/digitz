@extends('layouts.admin-dashboard')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title sub-title">Edit</h3>
                </div>
                <form action="{{ route('admin.product.update', $product->id) }}" method="POST" role="form"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        <div class="form-row">
                            <div class="col-md-6 form-group">
                                <label for="name">Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="name" id="name"
                                    value="{{ $product->name }}" placeholder="Enter Name">
                                @error('name')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-12 form-group">
                                <label for="description">Description</label>
                                <textarea class="form-control" name="description" id="description" rows="4" placeholder="Enter Description">{{ $product->description }}</textarea>
                                @error('description')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="category_id">Category <span class="text-danger">*</span></label>
                                <select class="form-control" name="category_id" id="category_id">
                                    <option value="">Select Category</option>
                                    @foreach ($categories as $id => $name)
                                        <option value="{{ $id }}"
                                            {{ $product->category_id == $id ? 'selected' : '' }}>
                                            {{ $name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="image">Image</label>
                                <input type="file" class="form-control-file" name="image" id="image">
                                @error('image')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                                @if ($product->image)
                                    <img src="{{ ProductHelper::getProductImagePath($product->image) }}"
                                        alt="Product Image" style="max-width: 100px;">
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('.select2').select2();
        });
    </script>
@endpush
