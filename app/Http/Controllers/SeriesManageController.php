<?php

namespace App\Http\Controllers;

use App\Models\Serie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SeriesManageController extends Controller
{
    public static function testedBy()
    {
        return SeriesManageControllerTest::class;
    }

    public function index()
    {
        return view('series.manage.index',[
            'series' => Serie::all()
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:10240', // 10MB max
        ]);

        $imagePath = $request->file('image')->store('images', 'public');

        $serie = Serie::create([
            'title' => $request->title,
            'description' => $request->description,
            'image' => $imagePath,
            'teacher_name' => $request->teacher_name,
        ]);

        session()->flash('status', 'Successfully created');

        return redirect()->route('manage.series');
    }

    public function edit($id)
    {
        return view('series.manage.edit', ['serie' => Serie::findOrFail($id)]);
    }

    public function update(Request $request, $id)
    {
        $serie = Serie::findOrFail($id);

        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'teacher_name' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10240', // 10MB max
        ]);

        $serie->title = $request->title;
        $serie->description = $request->description;
        $serie->teacher_name = $request->teacher_name;

        if ($request->hasFile('image')) {
            if ($serie->image) {
                Storage::disk('public')->delete($serie->image);
            }
            $imagePath = $request->file('image')->store('images', 'public');
            $serie->image = $imagePath;
        }

        $serie->save();

        session()->flash('status', 'Successfully updated');

        return redirect()->route('manage.series');
    }

    public function destroy($id)
    {
        Serie::find($id)->delete();
        session()->flash('status', 'Successfully removed');
        return redirect()->route('manage.series');
    }
}
