<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Language;
use Illuminate\Http\Request;

class LanguageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $languages = Language::paginate(5); // Paginate with 10 per page
        return view('admin.languages.index', compact('languages'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.languages.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:languages,name|max:255',
        ]);

        Language::create($request->only('name'));

        return redirect()->route('languages.index')
                         ->with('success', 'Language added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Language $language)
    {
        return view('admin.languages.show', compact('language'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Language $language)
    {
        return view('admin.languages.edit', compact('language'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Language $language)
    {
        $request->validate([
            'name' => 'required|max:255|unique:languages,name,' . $language->id,
        ]);

        $language->update($request->only('name'));

        return redirect()->route('languages.index')
                         ->with('success', 'Language updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Language $language)
    {
        $language->delete();

        return redirect()->route('languages.index')
                         ->with('success', 'Language deleted successfully.');
    }
}