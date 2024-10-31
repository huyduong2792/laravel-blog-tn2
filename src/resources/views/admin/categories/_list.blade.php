<table class="table table-striped table-sm table-responsive-md">
    <caption>{{ trans_choice('categories.count', $categories->total()) }}</caption>
    <thead>
        <tr>
            <th>@lang('categories.attributes.name')</th>
            <th>@lang('categories.attributes.author')</th>
            <th>@lang('categories.attributes.created_at')</th>
            <th>@lang('categories.posts_count')</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach($categories as $category)
            <tr>
                <td>
                    <a href="{{ route('admin.categories.edit', $category) }}">
                        {{ $category->name }}
                    </a>
                </td>
                <td>
                    <a href="{{ route('admin.users.edit', $category->author) }}">
                        {{ $category->author->fullname }}
                    </a>
                </td>
                <td>@humanize_date($category->created_at, 'd/m/Y H:i:s')</td>
                <td><span class="badge rounded-pill bg-secondary">{{ $category->posts_count }}</span></td>
                <td>
                    <a href="{{ route('admin.categories.edit', $category) }}" class="btn btn-primary btn-sm">
                        <x-icon name="edit" />
                    </a>

                    <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" class="form-inline" data-confirm="@lang('forms.categories.delete')">
                        @method('DELETE')
                        @csrf

                        <button type="submit" name="submit" class="btn btn-outline-danger btn-sm">
                            <x-icon name="trash" />
                        </button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

<div class="d-flex justify-content-center">
    {{ $categories->links() }}
</div>
