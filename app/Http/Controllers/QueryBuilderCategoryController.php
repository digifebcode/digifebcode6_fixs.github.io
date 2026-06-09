<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class QueryBuilderCategoryController extends Controller
{
    // READ Data
    public function index()
    {
        $categories = DB::table('categories')->orderBy('created_at', 'desc')->get();
        return view('category.qb_index', compact('categories'));
    }

    // CREATE Data
    public function store(Request $request)
    {
        $request->validate([
            'id' => 'required|unique:categories,id',
            'name' => 'required',
            'description' => 'nullable'
        ]);

        DB::table('categories')->insert([
            'id' => $request->id,
            'name' => $request->name,
            'description' => $request->description,
            'created_at' => now()
        ]);

        return redirect()->route('qb-category.index')->with('success', 'Kategori sukses ditambahkan via Query Builder!');
    }

    // UPDATE Data
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'nullable'
        ]);

        DB::table('categories')->where('id', $id)->update([
            'name' => $request->name,
            'description' => $request->description
        ]);

        return redirect()->route('qb-category.index')->with('success', 'Kategori sukses diubah via Query Builder!');
    }

    // DELETE Data
    public function destroy($id)
    {
        DB::table('categories')->where('id', $id)->delete();
        return redirect()->route('qb-category.index')->with('success', 'Kategori sukses dihapus via Query Builder!');
    }
}