@if (count($user_category) > 0)
    @foreach($user_category as $k=> $u)
        <li class="dropdown-submenu">
            <a id="dropdownMenu{{$k}}" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">{{$u['name']}}</a>
            <ul aria-labelledby="dropdownMenu{{$k}}" class="dropdown-menu border-0 shadow">
                <h3>{{$write}}</h3>
                @if (empty($u['childNodes']))
                    <li><a class="dropdown-item" tabindex="-1" href="#">{{$u['name']}}</a></li>
                @else
                    @include('partial.category_partial', ['user_category'=>$u['childNodes'],"write"=>"Expertise"])
                @endif
            </ul>
        </li>
    @endforeach
@endif
