@extends('layouts.admin-dashboard')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <form id="productForm" action="{{ route('user.product.store') }}" method="POST" role="form" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <h5><strong>Create Product</strong></h5>
                        <div class="form-row">
                            <div class="col-md-6 form-group">
                                <label for="name">Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="name" id="name"
                                    value="{{ old('name') }}" placeholder="Enter Name">
                                @error('name')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-12 form-group">
                                <label for="description">Description</label>
                                <textarea class="form-control" name="description" id="description" rows="4" placeholder="Enter Description">{{ old('description') }}</textarea>
                                @error('description')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="price">Price <span class="text-danger">*</span></label>
                                <input type="number" class="form-control" name="price" id="price" min="0"
                                    value="{{ old('price') }}" placeholder="Enter Price">
                                @error('price')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div id="imageInputContainer" class="col-md-12 form-group">
                                <label for="images">Images</label>
                                <input type="file" name="images[]" id="filepond" multiple>
                                @if ($errors->has('images'))
                                    <div class="text-danger">{{ $errors->first('images') }}</div>
                                @endif
                                @foreach ($errors->get('images.*') as $error)
                                    <div class="text-danger">{{ $error[0] }}</div>
                                @endforeach
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
<script src="https://unpkg.com/filepond/dist/filepond.js"></script>
<script src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.js"></script>
<script src="https://unpkg.com/filepond-plugin-file-validate-size/dist/filepond-plugin-file-validate-size.js"></script>
<script src="https://unpkg.com/filepond-plugin-image-exif-orientation/dist/filepond-plugin-image-exif-orientation.js"></script>
<script src="https://unpkg.com/filepond-plugin-image-edit/dist/filepond-plugin-image-edit.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        FilePond.registerPlugin(
            FilePondPluginImagePreview,
            FilePondPluginImageExifOrientation,
            FilePondPluginFileValidateSize,
            FilePondPluginImageEdit
        );

        const inputElement = document.getElementById('filepond');

        const pond = FilePond.create(inputElement, {
            allowMultiple: true
        });

        const form = document.getElementById('productForm');

        form.addEventListener('submit', function(event) {
            event.preventDefault();
            const formData = new FormData(form);

            const files = pond.getFiles();
            files.forEach((file, index) => {
                formData.append(`images[${index}]`, file.file);
            });

            axios.post(form.action, formData, {
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
            })
            .then(response => {
                console.log('Product saved successfully:', response);
                window.location.href = response.data.route;
            })
            .catch(error => {
                console.error('Error saving product:', error);
                if (error.response && error.response.data && error.response.data.errors) {
                    const errors = error.response.data.errors;
                    for (const [key, messages] of Object.entries(errors)) {
                        const field = document.getElementById(key);
                        if (field) {
                            field.classList.add('is-invalid');
                            const errorContainer = document.createElement('div');
                            errorContainer.classList.add('text-danger');
                            errorContainer.textContent = messages.join(', ');
                            field.parentNode.appendChild(errorContainer);
                        }
                    }
                }
            });
        });
    });
</script>
@endpush
