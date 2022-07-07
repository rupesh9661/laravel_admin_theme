<nav class="pcoded-navbar" id="hide_ag">
    <div class="pcoded-inner-navbar">
        <ul class="pcoded-item">
            @if (isset($modules) && count($modules) >0)
                @foreach ($modules as $module)
                    @if (\Auth::user()->hasModuleAccess($module->id))
                    <li class="pcoded-hasmenu">
                        <a href="javascript:void(0)" class="waves-effect waves-dark">
                            <span class="pcoded-micon"><i class=" {{ $module->icon }}"></i></span>
                            <span class="pcoded-mtext">{{ $module->module_name }}</span>
                        </a>
                        @if (count($module->childs) >0)
                        <ul class="pcoded-submenu">
                        @foreach ($module->childs as $child)
                            @if (\Auth::user()->hasModuleAccessChild($child->id))
                                @if($child->view == '1' || $child->view != 1)
                                    <li class="">
                                        <a  href="{{ url($child->route_name) }}" class="slide-item waves-effect waves-dark ">
                                            <span class="pcoded-mtext">{{ $child->module_name }}</span>
                                        </a>
                                    </li>
                                @endif
                            @endif
                        @endforeach
                        </ul>
                        @endif
                    </li>
                    @endif
                @endforeach   
            @endif
        </ul>
    </div>
</nav>
