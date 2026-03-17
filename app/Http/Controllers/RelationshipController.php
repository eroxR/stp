<?php

namespace App\Http\Controllers;

use App\Models\Relationship;
use App\Http\Requests\StoreRelationshipRequest;
use App\Http\Requests\UpdateRelationshipRequest;

class RelationshipController extends Controller
{
    public function store(StoreRelationshipRequest $request)
    {
        Relationship::create($request->validated());
        return redirect()->back()->with('success', 'Parentesco creado correctamente.');
    }

    public function update(UpdateRelationshipRequest $request, Relationship $relationship)
    {
        $relationship->update($request->validated());
        return redirect()->back()->with('success', 'Parentesco actualizado correctamente.');
    }

    public function destroy(Relationship $relationship)
    {
        $relationship->delete();
        return redirect()->back()->with('success', 'Parentesco eliminado correctamente.');
    }

}
