<?php

namespace App\Http\Controllers;

use App\Models\Receta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RecetaController extends Controller
{
     /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }


    public function index(): view
    {
        $recetas = Receta::all();
 
        return view('receta.index', [$recetas]);
    }

    public function create()
    {
        return view('receta.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|min:1|max:70',
            'description' => 'required|min:5|max:255',
            'instruction' => 'required|min:10',
            'minutes' => 'required|min:1|max:4000',
            "ingredients" => "array",
            "ingredients.*" => "required|min:5|max:70|string",
        ]);
  
        $receta = Receta::create($request->except('ingredients'));

        if ($receta) {
            $receta->ingredients()->create($request->ingredients);
         }
   
        return redirect()
            ->route('receta.images', ['recetaId' => $receta -> id])
            ->with('success','Receta created successfully.');
    }

    public function uploadImages(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'images' => 'required|image|mimes:jpeg,png,jpg|size:2048|max:6|min:1',
        ]);

        $files = [];
        if($request->hasfile('images'))
        {
            // Storage::deleteDirectory($directory);
            foreach($request->file('images') as $file)
            {
                $name = time().rand(1,50).'image.'.$file->extension();
                $file->move(public_path('files'), $name);  
                $files[] = $name;
            }
        }

        $file= new File();
        $file->images = $files;
        $file->save();
      
        return redirect()->route('home.index')->with('success','You have successfully upload images/image.');
    }

    public function show(string $id): view
    {

        $receta = Receta::with(['ingredients', 'images', 'comments'])
            ->findOrFail($id);

        return view('receta.show', $receta);
    }
}
