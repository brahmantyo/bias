@foreach($items as $item)
  <li@lm-attrs($item) @if($item->hasChildren())class ="treeview"@endif @lm-endattrs>
    @if($item->link)
      @if($item->hasChildren())
          <a@lm-attrs($item->link) 
                class="treeview" data-toggle="dropdown" 
                href="{!! $item->url() !!}"
              @lm-endattrs>
            {!! $item->title !!}
            @if($item->hasChildren()) <b class="caret"></b> @endif
          </a>
      @else
          <a@lm-attrs($item->link) href="{!! $item->url() !!}"  @lm-endattrs>{!! $item->title !!}</a>
      @endif
    @else
      {!! $item->title !!}
    @endif
    @if($item->hasChildren())
      <ul class="treeview-menu">
        @include(config('laravel-menu.views.bootstrap-items'), array('items' => $item->children()))
      </ul> 
    @endif
  </li>
  @if($item->divider)
  	<li{{!! Lavary\Menu\Builder::attributes($item->divider) !!}}></li>
  @endif
@endforeach