<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18">{{ $title ?? 'Dashboard' }}</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item">
                        <a href="{{ $breadcrumbHomeUrl ?? 'javascript:void(0);' }}">
                            {{ $breadcrumbHome ?? 'Dashboard' }}
                        </a>
                    </li>
                    @if(isset($breadcrumbItems) && is_array($breadcrumbItems))
                        @foreach($breadcrumbItems as $breadcrumb)
                            <li class="breadcrumb-item {{ $loop->last ? 'active' : '' }}">
                                @if(!$loop->last)
                                    <a href="{{ $breadcrumb['url'] ?? '#' }}">{{ $breadcrumb['name'] }}</a>
                                @else
                                    {{ $breadcrumb['name'] }}
                                @endif
                            </li>
                        @endforeach
                    @endif
                </ol>
            </div>
        </div>
    </div>
</div>