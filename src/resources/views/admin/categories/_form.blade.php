<div class="form-group mb-3">
    <label class="form-label" for="name">
        @lang('categories.attributes.name')
    </label>

    <input
        type="text"
        id="name"
        name="name"
        @class(['form-control', 'is-invalid' => $errors->has('name')])
        required
        value="{{ old('name', $category ?? null) }}"
    >

    @error('name')
        <span class="invalid-feedback">{{ $message }}</span>
    @enderror
</div>

<div class="form-group mb-3">
    <label class="form-label" for="description">
        @lang('categories.attributes.description')
    </label>

    <textarea
        name="description"
        id="description"
        cols="50"
        rows="10"
        @class(['form-control trumbowyg-form', 'is-invalid' => $errors->has('description')])
    >{{ old('description', $category ?? null) }}</textarea>

    @error('description')
        <span class="invalid-feedback">{{ $message }}</span>
    @enderror
</div>