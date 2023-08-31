<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Grammage;
use App\Models\Ieps;
use App\Models\Iva;
use App\Models\Presentation;
use Illuminate\Http\Request;

class CatalogController extends Controller
{
    /**
     * Show the form for creating the resource.
     */
    public function index()
    {
        return view('admin.catalogs.index');
    }
    public function create($ctg)
    {

        return view('admin.catalogs.create', ['catalogo' => $ctg]);
    }

    /**
     * Store the newly created resource in storage.
     */
    public function store(Request $request, $ctg)
    {

        $validate = $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
        ]);
        $name = $request->input('name');
        $catalogo = "";
        //creo nuevo model
        if ($ctg == "Marca") {
            $catalogo = new Brand();
            $ctg = 1;
        } else if ($ctg == "Gramaje") {
            $catalogo = new Grammage();
            $ctg = 2;
        } else if ($ctg == "Presentación") {
            $catalogo = new Presentation();
            $ctg = 3;
        } else if ($ctg == "Iva") {
            $catalogo = new Iva();
            $ctg = 4;
        } else if ($ctg == "IEPS") {
            $catalogo = new Ieps();
            $ctg = 5;
        }

        //asignar nuevos valores al objeto catalogo
        $catalogo->name = $name;
        //guardo el nuevo catg
        $catalogo->save();
        return redirect()->route('admin.catalogs.show', $ctg)->with('status', 'Guardado exitosamente.');
    }

    /**
     * Display the resource.
     */
    public function show($ctg)
    {
        $listado = "";
        $catalogo = "";
        if ($ctg == 1) {
            $catalogo = "Marca";
            $listado = Brand::orderBy('id', 'desc')->paginate(10);
        } else if ($ctg == 2) {
            $catalogo = "Gramaje";
            $listado = Grammage::orderBy('id', 'desc')->paginate(10);
        } else if ($ctg == 3) {
            $catalogo = "Presentación";
            $listado = Presentation::orderBy('id', 'desc')->paginate(10);
        } else if ($ctg == 4) {
            $catalogo = "Iva";
            $listado = Iva::orderBy('id', 'desc')->paginate(10);
        } else if ($ctg == 5) {
            $catalogo = "IEPS";
            $listado = Ieps::orderBy('id', 'desc')->paginate(10);
        } else {
            return view('admin.catalogs');
        }
        return view('admin.catalogs.show', ['listado' => $listado, 'catalogo' => $catalogo]);
    }

    /**
     * Show the form for editing the resource.
     */
    public function edit($ctg, $id)
    {

        $listado = "";
        $catalogo = "";
        if ($ctg == "Marca") {
            $catalogo = "Marca";
            $listado = Brand::findOrFail($id);
        } else if ($ctg == "Gramaje") {
            $catalogo = "Gramaje";
            $listado = Grammage::findOrFail($id);
        } else if ($ctg == "Presentación") {
            $catalogo = "Presentación";
            $listado = Presentation::findOrFail($id);
        } else if ($ctg == "Iva") {
            $catalogo = "Iva";
            $listado = Iva::findOrFail($id);
        } else if ($ctg == "IEPS") {
            $catalogo = "IEPS";
            $listado = Ieps::findOrFail($id);
        } else {
            return view('admin.catalogs.show');
        }
        return view('admin.catalogs.create', ['listado' => $listado, 'catalogo' => $catalogo]);
    }

    /**
     * Update the resource in storage.
     */
    public function update(Request $request, $ctg)
    {

        $validate = $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
        ]);
        $name = $request->input('name');
        $id = $request->input('id');

        $catalogo = "";
        //creo nuevo model
        if ($ctg == "Marca") {
            $catalogo = Brand::findOrFail($id);
            $ctg = 1;
        } else if ($ctg == "Gramaje") {
            $catalogo = Grammage::findOrFail($id);
            $ctg = 2;
        } else if ($ctg == "Presentación") {
            $catalogo = Presentation::findOrFail($id);
            $ctg = 3;
        } else if ($ctg == "Iva") {
            $catalogo = Iva::findOrFail($id);
            $ctg = 4;
        } else if ($ctg == "IEPS") {
            $catalogo = Ieps::findOrFail($id);
            $ctg = 5;
        }

        //asignar nuevos valores al objeto catalogo
        $catalogo->name = $name;


        //guardo el catg actualiado
        $catalogo->update();
        return redirect()->route('admin.catalogs.show', $ctg)->with('status', 'Guardado exitosamente.');
    }

    /**
     * Remove the resource from storage.
     */
    public function destroy($ctg, $id)
    {
        //creo nuevo model
        if ($ctg == "Marca") {
            $catalogo = Brand::findOrFail($id);
            $ctg = 1;
        } else if ($ctg == "Gramaje") {
            $catalogo = Grammage::findOrFail($id);
            $ctg = 2;
        } else if ($ctg == "Presentación") {
            $catalogo = Presentation::findOrFail($id);
            $ctg = 3;
        } else if ($ctg == "Iva") {
            $catalogo = Iva::findOrFail($id);
            $ctg = 4;
        } else if ($ctg == "IEPS") {
            $catalogo = Ieps::findOrFail($id);
            $ctg = 5;
        }

        // Eliminar el hospital
        $catalogo->status = 0;
        $catalogo->update();
        return redirect()->route('admin.catalogs.show',$ctg)->with('status', 'Catalogo se dio de baja');
    }


    public function reactivar($ctg, $id)
    {
        //creo nuevo model
        if ($ctg == "Marca") {
            $catalogo = Brand::findOrFail($id);
            $ctg = 1;
        } else if ($ctg == "Gramaje") {
            $catalogo = Grammage::findOrFail($id);
            $ctg = 2;
        } else if ($ctg == "Presentación") {
            $catalogo = Presentation::findOrFail($id);
            $ctg = 3;
        } else if ($ctg == "Iva") {
            $catalogo = Iva::findOrFail($id);
            $ctg = 4;
        } else if ($ctg == "IEPS") {
            $catalogo = Ieps::findOrFail($id);
            $ctg = 5;
        }

        // Eliminar el hospital
        $catalogo->status = 1;
        $catalogo->update();
        return redirect()->route('admin.catalogs.show',$ctg)->with('status', 'Catalogo se restauro');
    }
}
