<?php

namespace App\Http\Controllers;

use App\Models\Picture;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PictureController extends Controller
{
    public function index()
    {

        $myPictures = Picture::all()->where('user_id', Auth::user()->id);
        $pictures = Picture::all();

        return view('home', compact('pictures', 'myPictures'));
    }

    public function create()
    {
        return view('picture.create');
    }

    public function store(Request $request)
    {

        $request->validate([
            'title' => 'required',
            'image' => 'required|image|max:2048',
            'user_id' => 'required',
        ]);

        $picture = $request->all();

        if ($image = $request->file('image')) {
            $rutaGuardarImg = 'pictures/';
            $pictureName = "picture" . date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($rutaGuardarImg, $pictureName);
            $picture['image'] = "$pictureName";
        }

        $image = new Picture;

        $image->title = $picture['title'];
        $image->image = $picture['image'];
        $image->user_id = $picture['user_id'];

        $image->save();

        return redirect()->route('home')->with('info', 'La imagen se agrego con exito!');

    }


    public function show(Picture $picture)
    {
        return view('picture.show', compact('picture'));
    }


    public function edit(Picture $picture)
    {
        return view('picture.edit', compact('actor'));
    }

    public function update(Request $request, picture $picture)
    {

        $request->validate([
            'title' => 'required',
            'image' => 'required|image|max:2048',
        ]);

        $act = $request->all();

        $pic = $request->all();

        if ($image = $request->file('image')) {
            $rutaGuardarImg = 'pictures/';
            $pictureName = "picture" . date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($rutaGuardarImg, $pictureName);
            $pic['image'] = "$pictureName";
        } else {
            unset($picture['foto']);
        }

        $picture->update($pic);

        return redirect()->route('admin.actors.edit', compact('actor'))->with('info', 'La imagen se actualizo con exito!');
    }

    public function destroy(Picture $picture)
    {
        $picture->delete();
        return redirect()->route('home')->with('info', 'La imagen se elimino con exito!');
    }
}
