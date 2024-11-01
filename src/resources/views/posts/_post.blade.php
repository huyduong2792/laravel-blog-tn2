<div class="col">
  <x-card class="border-0">
    {{-- @if ($post->hasThumbnail())
      <x-slot:image>
        <a href="{{ route('posts.show', $post)}}" data-turbo-frame="_top">
          <img src="{{ $post->thumbnail->getUrl('thumb') }}" alt="{{ $post->thumbnail->name }}" class="card-img-top rounded-4">
        </a>
      </x-slot>
    @endif --}}
    @php
      $images = [
        'https://anhdep99.com/wp-content/uploads/2023/07/nhung-thi-tran-tuyet-dep-nam-duoi-chan-nui-1-350x250.jpg',
        'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTyvH5guZih02KXTpy7-1lhZQAgSLv6Ikt6XQ&s',
        'https://top7vietnam.sgtiepthi.vn/wp-content/uploads/2024/10/mu-cang-chai-3-350x250.jpg',
        'https://aodaisago.com/wp-content/uploads/2023/08/cach-tao-dang-chup-anh-ao-dai-ST-350x250.jpg',
        'https://i.pinimg.com/originals/ae/6a/9e/ae6a9ef51f6e030575a1bcab08513981.jpg',
        'https://images.pexels.com/photos/691668/pexels-photo-691668.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500',
        'https://images.pexels.com/photos/147411/italy-mountains-dawn-daybreak-147411.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500',
        'https://top7vietnam.sgtiepthi.vn/wp-content/uploads/2024/10/doi-che-tan-uyen-350x250.jpg'
      ];
      $randomImage = $images[array_rand($images)];
    @endphp
    <img src="{{ $randomImage }}" class="card-img-top rounded-4">

    <small class="text-body-secondary">
      @humanize_date($post->posted_at)
    </small>

    <h4 class="card-title mt-1 mb-3">
      <a href="{{ route('posts.show', $post) }}" class="link-dark" data-turbo-frame="_top">
        {{ $post->title }}
      </a>
    </h4>

    <p class="card-text text-body-secondary">
      {{ Str::words(strip_tags($post->content), 10) }}
    </p>

    <p class="card-text">
      <small>
        <a href="{{ route('users.show', $post->author) }}" class="link-secondary" data-turbo-frame="_top">
          {{ $post->author->fullname }}
        </a>
      </small>
    </p>

    <div class="card-text">
      <small class="text-body-secondary">
        <x-icon name="comments" prefix="fa-regular" /> {{ $post->comments_count }}

        @include('likes/_likes')
      </small>
    </div>
  </x-card>
</div>
