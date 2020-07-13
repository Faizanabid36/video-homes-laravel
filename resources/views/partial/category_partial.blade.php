@if (count($user_category) > 0)
    @foreach($user_category as $u)
        <li class="dropdown-submenu">
            <a class="btn btn-link test text-capitalize" tabindex="-1" href="#">{{$u['name']}} <span class="fa fa-caret-right"></span></a>
            <ul class="dropdown-menu">
                <h3>{{$write}}</h3>
                @if (empty($u['childNodes']))
                    <li><a class="btn btn-link text-capitalize" tabindex="-1" href="#">{{$u['name']}}</a></li>
                @else
                    @include('partial.category_partial', ['user_category'=>$u['childNodes'],"write"=>"Expertise"])
                @endif
            </ul>
        </li>
    @endforeach
@endif
