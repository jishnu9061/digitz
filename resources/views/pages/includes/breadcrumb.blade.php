@if (! empty($breadcrumbs))
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            @foreach ($breadcrumbs as $key => $url)
                @if ('home' != $key)
                    @if ($loop->first)
                        <li class="breadcrumb-item"><a href="{{ url($url) }}">{{ ucfirst(str_replace(['_', '-'], ' ', $key))  }}</a></li>
                    @elseif(! is_numeric($key))
                        <li class="breadcrumb-item active"><a href="{{ (! $loop->last)? url($url) : 'javascript:;' }}">{{ ucfirst(str_replace(['_', '-'], ' ', $key))  }}</a></li>
                    @endif
                @endif
            @endforeach
        </ol>
    </div>
@endif
