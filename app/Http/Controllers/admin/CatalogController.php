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
    public function create(): never
    {
        abort(404);
    }

    /**
     * Store the newly created resource in storage.
     */
    public function store(Request $request): never
    {
        abort(404);
    }

    /**
     * Display the resource.
     */
    public function show($ctg)
    {
        $listado="";
        $catalogo="";
        if($ctg==1){
            $catalogo="Marca";
            $listado = Brand::paginate(10);
        }else if($ctg==2){
            $catalogo="Gramaje";
            $listado = Grammage::paginate(10);

        }else if($ctg==3){
            $catalogo="Presentación";
            $listado = Presentation::paginate(10);

        }else if($ctg==4){
            $catalogo="Iva";
            $listado = Iva::paginate(10);

        }else if($ctg==5){
            $catalogo="IEPS";
            $listado = Ieps::paginate(10);

        }else{
            return view('admin.catalogs');
        }
        return view('admin.catalogs.show', ['listado'=>$listado, 'catalogo'=>$catalogo]);

    }

    /**
     * Show the form for editing the resource.
     */
    public function edit()
    {
        //
    }

    /**
     * Update the resource in storage.
     */
    public function update(Request $request)
    {
        //
    }

    /**
     * Remove the resource from storage.
     */
    public function destroy(): never
    {
        abort(404);
    }
}
