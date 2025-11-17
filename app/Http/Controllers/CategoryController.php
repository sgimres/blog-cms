<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::user()->isAdmin()) {
            $categories = Category::with(['children', 'user'])
                ->withCount('posts')
                ->whereNull('parent_id')
                ->get();
        } else {
            $categories = Category::where('user_id', Auth::id())
                ->with('children')
                ->withCount('posts')
                ->whereNull('parent_id')
                ->get();
        }

        return view('categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (Auth::user()->isAdmin()) {
            $categories = Category::all();
        } else {
            $categories = Category::where('user_id', Auth::id())->get();
        }

        return view('categories.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'parent_id' => 'nullable|exists:categories,id',
        ]);

        Category::create([
            'user_id' => Auth::id(),
            'name' => $request->name,
            'parent_id' => $request->parent_id,
        ]);

        return redirect()->route('categories.index')->with('success', 'Category created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        $this->authorize('view', $category);

        return view('categories.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        $this->authorize('update', $category);

        if (Auth::user()->isAdmin()) {
            $categories = Category::where('id', '!=', $category->id)->get();
        } else {
            $categories = Category::where('user_id', Auth::id())->where('id', '!=', $category->id)->get();
        }

        return view('categories.edit', compact('category', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $this->authorize('update', $category);

        $request->validate([
            'name' => 'required|string|max:255',
            'parent_id' => 'nullable|exists:categories,id',
        ]);

        $category->update([
            'name' => $request->name,
            'parent_id' => $request->parent_id,
        ]);

        // Send notification if admin edited someone else's category
        if (Auth::user()->isAdmin() && $category->user_id !== Auth::id()) {
            Notification::create([
                'user_id' => $category->user_id,
                'type' => 'category_edited',
                'title' => 'Category Updated',
                'message' => "Your category \"{$category->name}\" has been updated by an administrator.",
                'data' => [
                    'category_name' => $category->name,
                    'edited_by' => Auth::user()->name,
                ],
            ]);
        }

        return redirect()->route('categories.index')->with('success', 'Category updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $this->authorize('delete', $category);

        // Send notification to category owner if admin is deleting someone else's category
        if (Auth::user()->isAdmin() && $category->user_id !== Auth::id()) {
            Notification::create([
                'user_id' => $category->user_id,
                'type' => 'category_deleted',
                'title' => 'Category Deleted',
                'message' => "Your category \"{$category->name}\" has been deleted by an administrator.",
                'data' => [
                    'category_name' => $category->name,
                    'deleted_by' => Auth::user()->name,
                ],
            ]);
        }

        $category->delete();

        return redirect()->route('categories.index')->with('success', 'Category deleted successfully.');
    }
}
