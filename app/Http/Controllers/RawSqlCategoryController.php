<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RawSqlCategoryController extends Controller
{
    // READ Data
    public function index()
    {
        $categories = DB::select("SELECT * FROM categories ORDER BY created_at DESC");
        return view('category.raw_index', compact('categories'));
    }

    // CREATE Data
    public function store(Request $request)
    {
        $request->validate([
            'id' => 'required|unique:categories,id',
            'name' => 'required',
            'description' => 'nullable'
        ]);

        DB::insert("INSERT INTO categories (id, name, description, created_at) VALUES (?, ?, ?, ?)", [
            $request->id,
            $request->name,
            $request->description,
            now()
        ]);

        return redirect()->route('raw-category.index')->with('success', 'Kategori sukses ditambahkan via Raw SQL!');
    }

    // UPDATE Data
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'nullable'
        ]);

        DB::update("UPDATE categories SET name = ?, description = ? WHERE id = ?", [
            $request->name,
            $request->description,
            $id
        ]);

        return redirect()->route('raw-category.index')->with('success', 'Kategori sukses diubah via Raw SQL!');
    }

    // DELETE Data
    public function destroy($id)
    {
        DB::delete("DELETE FROM categories WHERE id = ?", [$id]);
        return redirect()->route('raw-category.index')->with('success', 'Kategori sukses dihapus via Raw SQL!');
    }
}