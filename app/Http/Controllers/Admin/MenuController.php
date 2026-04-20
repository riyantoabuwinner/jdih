<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use App\Models\Page;
use App\Models\NewsCategory;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index(Request $request)
    {
        $location = $request->get('location', 'main');
        $menus = Menu::where('location', $location)
            ->whereNull('parent_id')
            ->with('children')
            ->orderBy('order')
            ->get();

        $pages = Page::orderBy('title')->get();
        $categories = NewsCategory::orderBy('name')->get();
        
        $locations = [
            'top' => 'Top Menu',
            'main' => 'Main Menu',
            'secondary' => 'Secondary Menu',
            'footer' => 'Footer Menu',
            'last' => 'Last Menu'
        ];

        return view('admin.menus.index', compact('menus', 'location', 'locations', 'pages', 'categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'label' => 'required',
            'location' => 'required'
        ]);

        $data = $request->only(['label', 'url', 'type', 'model_id', 'location', 'target']);
        $data['order'] = Menu::where('location', $request->location)->max('order') + 1;

        Menu::create($data);

        return back()->with('success', 'Menu berhasil ditambahkan.');
    }

    public function update(Request $request, Menu $menu)
    {
        $request->validate([
            'label' => 'required',
        ]);

        $menu->update($request->only(['label', 'url', 'target']));

        return back()->with('success', 'Menu berhasil diperbarui.');
    }

    public function updateOrder(Request $request)
    {
        $hierarchy = json_decode($request->hierarchy, true);
        
        $this->saveHierarchy($hierarchy, null);

        return response()->json(['status' => 'success']);
    }

    private function saveHierarchy($items, $parentId)
    {
        foreach ($items as $index => $item) {
            $menu = Menu::find($item['id']);
            if ($menu) {
                $menu->update([
                    'parent_id' => $parentId,
                    'order' => $index
                ]);

                if (isset($item['children'])) {
                    $this->saveHierarchy($item['children'], $menu->id);
                }
            }
        }
    }

    public function destroy(Menu $menu)
    {
        $menu->delete();
        return back()->with('success', 'Menu berhasil dihapus.');
    }
}
