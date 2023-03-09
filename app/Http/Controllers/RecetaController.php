<?php

namespace App\Http\Controllers;

use App\Models\Receta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

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

        $receta = Receta::with(['ingredients', 'images', 'comments'])
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
            ->route('recetas.index', ['receta' => $receta])
            ->with('success','Receta created successfully.');
    }

    protected function update(Request $request, string $id): view
    {

        $request->validate([
            'title' => 'required|min:1|max:70',
            'description' => 'required|min:5|max:255',
            'instruction' => 'required|min:10',
            'minutes' => 'required|min:1|max:4000',
            "ingredients" => "required|array",
            "ingredients.*" => "required|min:5|max:70|string",
        ]);

        $receta = auth()
            ->user()
            ->profile
            ->recetas()
            ->update($request->except('ingredients'));

        if($receta) {
            $receta->ingredients()->createMany(
                array_map(
                    fn($description): array => ["description" => $description],
                    $request->ingredients
                )
            );
        }

        return redirect()
        ->route('recetas.index', ['receta' => $receta])
        ->with('success','Receta updated successfully.');
    }

    protected function destroy(Request $request, string $id)
    {

        Receta::where('id', $id)->delete();

        return redirect()
            ->route('recetas.index')
            ->withSuccess(__('Receta deleted successfully.'));
    }

    public function editImages (Request $request, Id $id): View
    {

        return view('recetas.images', ['recetaId' => $receta->id]);
    }

    protected function updateImages(Request $request)
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
      
        return redirect()->route('recetas.index')
            ->with('success','You have successfully upload images/image.');
    }
}
