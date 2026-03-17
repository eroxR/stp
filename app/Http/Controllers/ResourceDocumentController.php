<?php

namespace App\Http\Controllers;

use App\Models\ResourceDocument;
use App\Http\Requests\StoreResourceDocumentRequest;
use App\Http\Requests\UpdateResourceDocumentRequest;
use Illuminate\Support\Facades\Auth;

class ResourceDocumentController extends Controller
{
    public function store(StoreResourceDocumentRequest $request)
    {
        $data = $request->validated();
        $user = Auth::user();

        // Lógica para asignar empresa/sucursal del usuario actual
        // Ajusta los valores por defecto (1, 'DEF') según tu seed de base de datos
        $data['company_id'] = $user->company_id ?? 1;
        $data['branch_id'] = $user->branch_id ?? 1;
        // Asumiendo que el usuario tiene relación con company para sacar el código
        $data['code_company'] = $user->company->code ?? 'DEF';

        ResourceDocument::create($data);
        return redirect()->back()->with('success', 'Documento de recurso creado correctamente.');
    }

    public function update(UpdateResourceDocumentRequest $request, ResourceDocument $resourceDocument)
    {
        $resourceDocument->update($request->validated());
        return redirect()->back()->with('success', 'Documento de recurso actualizado correctamente.');
    }

    public function destroy(ResourceDocument $resourceDocument)
    {
        // Opcional: Validar si tiene seguimientos antes de borrar
        // if($resourceDocument->documentTrackings()->exists()) { ... }

        $resourceDocument->delete();
        return redirect()->back()->with('success', 'Documento de recurso eliminado correctamente.');
    }

}
