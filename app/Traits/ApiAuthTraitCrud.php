<?php

namespace App\Traits;

use Illuminate\Http\Request;

trait ApiAuthTraitCrud
{
    public function index(Request $request)
    {
        $results = auth()->user()->{$this->relations}()->orderBy($this->column ?? '', $this->direction ?? '');

        if ($request->has('term')) {
            $results = $results->where($this->column, 'LIKE', "%". $request->get('term') ."%");
        }

        if ($request->has('paginate') && $request->paginate == 'true') {
        	$results = $results->with($this->relationships())->paginate($this->paginate ?? 10);
        } else {
        	$results = $results->with($this->relationships())->get();
        }

    	return response()->json(['data' => $results], 200);
    }

    public function store(Request $request)
    {
    	$this->validate($request, $this->rules ?? []);

    	$result = auth()->user()->{$this->relations}()->create($request->all());

    	return response()->json(['data' => $result, 'message' => 'Criado com sucesso'], 201);
    }

    public function show($id)
    {
    	$result = auth()->user()->{$this->relations}()->with($this->relationships())->findOrFail($id);

    	return response()->json(['data' => $result], 200);
    }

    public function update(Request $request, $id)
    {
    	$this->validate($request, $this->rules ?? []);

        $result = auth()->user()->{$this->relations}()->findOrFail($id);

        $result->update($request->all());

    	return response()->json(['data' => $result, 'message' => 'Atualizado com sucesso'], 200);
    }

    public function destroy($id)
    {
        $result = auth()->user()->{$this->relations}()->findOrFail($id);

        $result->delete();

        return response()->json(['message' => 'Deletado com sucesso'], 200);
    }

    protected function relationships()
    {
        if (isset($this->relationships)) {
            return $this->relationships;
        }

        return [];
    }
}
