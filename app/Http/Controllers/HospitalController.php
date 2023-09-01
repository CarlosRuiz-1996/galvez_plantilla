<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Hospital;
use App\Models\UserHospital;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rule;

class HospitalController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    //
    public function index()
    {

//             $user = \App\Models\User::where('email', 'test@test.com')->first();
//         $roles = $user->getRoleNames();
//         dd($roles);
        
// die;
        $hospitales = Hospital::orderBy('id', 'desc')->paginate(9);
        // var_dump($images);
        return view('admin.hospitals.index', ['hospitales' => $hospitales]);
    }

    public function detalle($id)
    {
        $hospital = Hospital::find($id);
        // var_dump($images);
        return view('admin.hospitals.detalle', ['hospital' => $hospital]);
    }


    public function editar($id)
    {
        $hospital = Hospital::find($id);


        return view('admin.hospitals.editar', ['hospital' => $hospital]);
    }


    public function update(Request $request)
    {

        $id = $request->input('id');

        $hospital = Hospital::findOrFail($id);


        //validacion del form
        $validate = $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string'],
            'phone' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'max:255'],
            'contact_name' => ['required', 'string', 'max:255'],
            'contact_phone' => ['required', 'string', 'max:255'],
            'contact_email' => ['required', 'string', 'max:255'],
        ]);




        //recoger valores del form
        $nombre = $request->input('name');
        $direccion = $request->input('address');
        $telefono = $request->input('phone');
        $correo = $request->input('email');
        $contacto_nombre = $request->input('contact_name');
        $contacto_telefono = $request->input('contact_phone');
        $contacto_correo = $request->input('contact_email');

        // $hospital = new Hospital();

        $hospital->name = $nombre;
        $hospital->address = $direccion;
        $hospital->phone = $telefono;
        $hospital->phone = $correo;
        $hospital->contact_name = $contacto_nombre;
        $hospital->contact_phone = $contacto_telefono;
        $hospital->contact_email = $contacto_correo;
        //subir img
        // $image_path = $request->file('image_path');
        // var_dump($hospital);
        //         die();

        $hospital->update();

        return Redirect::route('admin.hospitals')->with('status', 'Hospital actualizado correctamente');
    }

    public function eliminar($id)
    {
        $hospital = Hospital::findOrFail($id);

        // Eliminar el hospital
        $hospital->delete();

        return redirect()->route('admin.hospitals')->with('status', 'Hospital eliminado correctamente');
    }

    public function list()
    {
        $hospitales = Hospital::all();
        // var_dump($images);
        return view('hospitals.asignar', ['hospitales' => $hospitales]);
    }


    public function asignar(Request $request)
    {
        // Asegúrate de que el usuario esté autenticado.
        $validate = $this->validate($request, [
            'id' => ['required']
        ]);
        // Obtiene el ID del usuario autenticado
        $userId = auth()->user()->id;

        // Obtiene el ID del hospital seleccionado en el formulario
        $hospitalId = $request->input('id');

        // var_dump($hospitalId);
        // var_dump($userId);
        // die;
        // Verifica si la relación ya existe en la tabla user_hospital
        $relacionExistente = UserHospital::where('user_id', $userId)
            ->where('hospital_id', $hospitalId)
            ->exists();

        if (!$relacionExistente) {
            // Crea un nuevo registro en la tabla user_hospital
            UserHospital::create([
                'hospital_id' => $hospitalId,
                'user_id' => $userId,
            ]);
        }



        return redirect()->route('dashboard')->with('status', 'Hospital asignado exitosamente, Bienvenido.');
    }
}
