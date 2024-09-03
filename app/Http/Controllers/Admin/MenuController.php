<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;
use Wecodelaravel\Menu\Models\Menus;
use Wecodelaravel\Menu\Models\MenuItems;
use Wecodelaravel\Menu\Facades\Menu;

class MenuController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('menu_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.menu.index');
    }
}
