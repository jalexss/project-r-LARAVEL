<?php

namespace App\Http\Controllers;

use App\Models\Receta;
use App\Models\Ingredient; 
use App\Models\Image; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules\File;

class RecetaController extends Controller
{
     /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function index(): view
    {
        $recetas = Receta::all();
 
        return view('recetas.index', ['recetas' => $recetas]);
    }

    public function create()
    {
        return view('recetas.create');
    }
    
    public function edit(Request $request, string $id): View
    {

        $receta = Receta::with(['ingredients'])
            ->findOrFail($id);


        return view('recetas.edit', ["receta" => $receta]);
    }

    public function show(Request $request, string $id): View
    {

        $receta = Receta::with(['ingredients', 'images', 'comments', 'profile'])
            ->findOrFail($id);

        return view('recetas.show', ['receta' => $receta]);
    }

    protected function store(Request $request)
    {
        $request->validate([
            'title' => 'required|min:1|max:70',
            'description' => 'required|min:5|max:255',
            'instruction' => 'required|min:10',
            'minutes' => 'required|min:1|max:4000',
            "ingredients" => "required|array|max:" . config('custom.recetas.max_ingredients'),
            "ingredients.*" => "required|min:5|max:70|string",
        ]);

        $receta = auth()
            ->user()
            ->profile
            ->recetas()
            ->create($request->except('ingredients'));

        if ($receta) {
            $receta->ingredients()->createMany(
                array_map(
                    fn($description): array => ["description" => $description],
                    $request->ingredients
                )
            );
         }
   
        return redirect()
            ->route('recetas.images', ['id' => $receta->id ])
            ->withSuccess('Receta created successfully.');
    }

    public function update(Request $request, string $id)
    {

        $request->validate([
            'title' => 'required|min:1|max:70',
            'description' => 'required|min:5|max:255',
            'instruction' => 'required|min:10',
            'minutes' => 'required|min:1|max:4000',
            "ingredients" => "required|array",
            "ingredients.*" => "required|min:5|max:70|string",
        ]);

        $receta = Receta::find($id)->update([
            'title' => $request->title,
            'description' => $request->description,
            'instruction' => $request->instruction,
            'minutes' => $request->minutes,
        ]);

        Ingredient::where('receta_id', $id)->delete();

        $ingredients = Ingredient::where('receta_id', $id)->upsert(
            array_map(
                fn($description): array => [
                    "description" => $description,
                    "receta_id" => $id,
                    "id" => null
                ],
                $request->ingredients
            ), ['id']
        );

        return redirect()
            ->route('recetas.index')
            ->withSuccess('Receta updated successfully.');
    }

    protected function destroy(Request $request, string $id)
    {

        Receta::find($id)->delete();

        return redirect()
            ->route('recetas.index')
            ->withSuccess(__('Receta deleted successfully.'));
    }

    public function editImages (Request $request, string $recetaId):View
    {
        $receta = Receta::with(['images'])->findOrFail($recetaId);

        return view('recetas.images', ['receta' => $receta]);
    }

    protected function updateImages(Request $request, string $recetaId)
    {
        request()->validate([
            'images' => 'required|array|min:1|max:6',
            'images.*' => File::image()
                ->min(1)
                ->max(3900),
        ]);
        
        $receta = Receta::with(['images', 'profile'])->findOrFail($recetaId);
        $directory = "users/" . $receta->profile->user_id . "/recetas/" . $recetaId;
        $imageMaxCount = count($receta->images) + count($request->file('images'));

        if( $imageMaxCount > 6 )
        {
            return redirect()
                ->back()
                ->withErrors(['You exceed the maximum capacity for images (6). Please, try again']);
        }

        if($request->hasfile('images'))
        {
            $imagesPath = []; 
            
            foreach($request->file('images') as $image)
            {
                $name =  Str::uuid() . '.' . $image->extension();
                $image = Storage::putFileAs('public/'. $directory, $image, $name);
                $imagesPath[] = $directory . '/' . $name;
            }

            $receta->images()->createMany(
                array_map(
                    fn($imagesPath): array => ["path" => $imagesPath],
                    $imagesPath
                )
            );
        }

        return redirect()->route('recetas.show', ['id' => $receta->id ])
            ->withSuccess('You have successfully upload images/image.');
    }

    protected function deleteImages(Request $request, string $imageId)
    {
        $image = Image::findOr($imageId, function () {
            return redirect()->back()->withErrors(['Image not found.']);
        });
        $isSuccessDelete = $image->delete();
        
        if($isSuccessDelete)
        {
            Storage::delete('public/' . $image->path);
        }

        return redirect()->back()->withSuccess('Image deleted successfully!');
    }
}
