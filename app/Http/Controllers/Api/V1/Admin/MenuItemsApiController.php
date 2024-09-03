<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreMenuItemRequest;
use App\Http\Requests\UpdateMenuItemRequest;
use App\Http\Resources\Admin\MenuItemResource;
use App\Models\MenuItem;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class MenuItemsApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('menu_item_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new MenuItemResource(MenuItem::all());
    }

    public function store(StoreMenuItemRequest $request)
    {
        $menuItem = MenuItem::create($request->all());

        return (new MenuItemResource($menuItem))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(MenuItem $menuItem)
    {
        abort_if(Gate::denies('menu_item_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new MenuItemResource($menuItem);
    }

    public function update(UpdateMenuItemRequest $request, MenuItem $menuItem)
    {
        $menuItem->update($request->all());

        return (new MenuItemResource($menuItem))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(MenuItem $menuItem)
    {
        abort_if(Gate::denies('menu_item_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $menuItem->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
