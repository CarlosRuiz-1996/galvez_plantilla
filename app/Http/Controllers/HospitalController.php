<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Hospital;
// use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rule;

class HospitalController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')    ;
    }
    //
    public function index(){
        $hospitales = Hospital::orderBy('id', 'desc')->paginate(9);
        // var_dump($images);
        return view('admin.hospitals.index', ['hospitales'=>$hospitales]);
    }

    public function detalle($id){
        $hospital = Hospital::find($id);
        // var_dump($images);
        return view('admin.hospitals.detalle', ['hospital'=>$hospital]);
    }


    public function editar ($id){
        $hospital = Hospital::find($id);


        return view('admin.hospitals.editar',['hospital'=>$hospital]);

    }


    public function update(Request $request)
    {
        
        $id = $request->input('id');

        $hospital = Hospital::findOrFail($id);

       
        //validacion del form
        $validate = $this->validate($request, [
            'nombre' => ['required', 'string', 'max:255'],
            'direccion' => ['required', 'string'],
            'telefono' => ['required', 'string', 'max:255'],
            'correo' => ['required', 'string', 'max:255'],
            'contacto' => ['required', 'string', 'max:255'],
            'contacto_telefono' => ['required', 'string', 'max:255'],
            'contacto_correo' => ['required', 'string', 'max:255'],
        ]);

        
      
        
        //recoger valores del form
        $nombre = $request->input('nombre');
        $direccion = $request->input('direccion');
        $telefono = $request->input('telefono');
        $correo = $request->input('correo');
        $contacto_nombre = $request->input('contacto');
        $contacto_telefono = $request->input('contacto_telefono');
        $contacto_correo = $request->input('contacto_correo');

        // $hospital = new Hospital();

        $hospital->nombre= $nombre;
        $hospital->direccion= $direccion;
        $hospital->telefono= $telefono;
        $hospital->correo= $correo;
        $hospital->contacto_nombre= $contacto_nombre;
        $hospital->contacto_telefono= $contacto_telefono;
        $hospital->contacto_correo= $contacto_correo;
        //subir img
        // $image_path = $request->file('image_path');
        // var_dump($hospital);
        //         die();

        $hospital->update();

        return Redirect::route('admin.hospitals')->with('status', 'Hospital actualizado correctamente');
    }

    public function eliminar ($id){
        $hospital = Hospital::findOrFail($id);

        // Eliminar el hospital
        $hospital->delete();
    
        return redirect()->route('admin.hospitals')->with('status', 'Hospital eliminado correctamente');

    }


}
