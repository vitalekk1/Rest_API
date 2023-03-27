<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Record\IndexRequest;
use App\Http\Requests\Record\StoreRequest;
use App\Http\Resources\RecordResource;
use App\Models\Record;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;

class RecordController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return RecordResource::collection(Record::all());
    }

    public function indexPaginate(IndexRequest $request)
    {
        $data = $request->validated();

        return RecordResource::collection(Record::paginate($data['per_page'], ['*'], 'page', $data['page']));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        $data = $request->validated();

        $data['photo'] = Storage::disk('public')->put('/photos', $data['photo']);

        $created_record = Record::firstOrCreate($data);

        return new RecordResource($created_record);
    }

    /**
     * Display the specified resource.
     */
    public function show(Record $record)
    {
        return new RecordResource($record);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreRequest $request, Record $record)
    {
        $record->update($request->validated());

        return new RecordResource($record);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Record $record)
    {
        $record->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
