@php
    $posted_at = old('posted_at', (isset($post) ? $post->posted_at->format('Y-m-d\TH:i') : null));
@endphp

<div class="form-group mb-3">
    <label class="form-label" for="title">
        @lang('posts.attributes.title')
    </label>

    <input
        type="text"
        id="title"
        name="title"
        @class(['form-control', 'is-invalid' => $errors->has('title')])
        required
        value="{{ old('title', $post ?? null) }}"
    >

    @error('title')
        <span class="invalid-feedback">{{ $message }}</span>
    @enderror
</div>

<div class="row">
    <div class="form-group mb-3 col-md-6">
        <label class="form-label" for="author_id">
            @lang('posts.attributes.author')
        </label>

        <select name="author_id" id="author_id" @class(['form-control', 'is-invalid' => $errors->has('author_id')]) required>
            @foreach ($users as $id => $name)
                <option value="{{ $id }}" @selected(old('author_id', $post ?? null) == $id)>
                    {{ $name }}
                </option>
            @endforeach
        </select>

        @error('author_id')
            <span class="invalid-feedback">{{ $message }}</span>
        @enderror
    </div>

    <div class="form-group mb-3 col-md-6">
        <label class="form-label" for="posted_at">
            @lang('posts.attributes.posted_at')
        </label>

        <input
            type="datetime-local"
            name="posted_at"
            id="posted_at"
            @class(['form-control', 'is-invalid' => $errors->has('posted_at')])
            required
            value="{{ $posted_at }}"
        >

        @error('posted_at')
            <span class="invalid-feedback">{{ $message }}</span>
        @enderror
    </div>
</div>

<div class="row">
    <div class="form-group mb-3 col-md-6">
        <label class="form-label" for="category_id">
            @lang('posts.attributes.category')
        </label>

        <select name="category_id" id="category_id" @class(['form-control', 'is-invalid' => $errors->has('category_id')])>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}" @selected(old('category_id', $post ?? null) == $category->id)>
                    {{ $category->name }}
                </option>
            @endforeach
        </select>

        @error('author_id')
            <span class="invalid-feedback">{{ $message }}</span>
        @enderror
    </div>

    <div class="form-group mb-3 col-md-6">
        <label class="form-label" for="status">
            @lang('posts.attributes.status')
        </label>

        <select name="status" id="status" @class(['form-control', 'is-invalid' => $errors->has('status')])>
                <option value="draft" @selected(old('status', $post ?? null) == 'draft') >
                    Draft
                </option>
                <option value="review" @selected(old('status', $post ?? null) == 'review')>
                    Review
                </option>
                <option value="rejected" @selected(old('status', $post ?? null) == 'rejected')>
                    Reject (Only Admin, Editor)
                </option>
                <option value="published" @selected(old('status', $post ?? null) == 'published')>
                    Publish (Only Admin, Editor)
                </option>
                <option value="deleted" @selected(old('status', $post ?? null) == 'deleted')>
                    Delete (Only Admin, Editor)
                </option>
        </select>

        @error('author_id')
            <span class="invalid-feedback">{{ $message }}</span>
        @enderror
    </div>
</div>

<div class="form-group mb-3">
    <label class="form-label" for="thumbnail_id">
        @lang('posts.attributes.thumbnail')
    </label>

    <select name="thumbnail_id" id="thumbnail_id" @class(['form-control', 'is-invalid' => $errors->has('thumbnail_id')])>
        <option value="">
            @lang('posts.placeholder.thumbnail')
        </option>

        @foreach ($media as $id => $name)
            <option value="{{ $id }}" @selected(old('thumbnail_id', $post ?? null) == $id)>
                {{ $name }}
            </option>
        @endforeach
    </select>

    @error('thumbnail_id')
        <span class="invalid-feedback">{{ $message }}</span>
    @enderror
</div>


<div class="form-group mb-3">
    <label class="form-label" for="content">
        @lang('posts.attributes.content')
    </label>

    <textarea
        name="content"
        id="content"
        cols="50"
        rows="10"
        required
        @class(['form-control trumbowyg-form', 'is-invalid' => $errors->has('content')])
    >{{ old('content', $post ?? null) }}</textarea>

    @error('content')
        <span class="invalid-feedback">{{ $message }}</span>
    @enderror
</div>
