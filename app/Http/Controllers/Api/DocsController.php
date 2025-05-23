<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Docs;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;

class DocsController extends Controller
{
    public function index(): JsonResponse
    {
        $docs = Docs::with(['docsType', 'docsStatus', 'access', 'priority'])->get();
        return response()->json($docs);
    }

    public function store(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'docs_name' => 'required|string|max:32',
            'docs_type_id' => 'required|exists:docs_type,docs_type_id',
            'docs_status_id' => 'required|exists:docs_status,docs_status_id',
            'access_id' => 'required|exists:doc_acccess,access_id',
            'prioruty_id' => 'required|exists:priority_id,priority_id',
            'absctract' => 'nullable|string|max:256',
            'parent_docs_id' => 'nullable|exists:docs,docs_id',
            'deadline' => 'nullable|date',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $data = $request->all();
        $data['docs_hash'] = rand(100000, 999999); // Генеруємо випадковий хеш
        $data['date_created'] = now();
        $data['date_updated'] = now();

        $doc = Docs::create($data);

        return response()->json($doc, 201);
    }

    public function show(Docs $doc): JsonResponse
    {
        $doc->load(['docsType', 'docsStatus', 'access', 'priority', 'employees', 'files']);
        return response()->json($doc);
    }

    public function updateStatus(Request $request, Docs $doc): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'docs_status_id' => 'required|exists:docs_status,docs_status_id',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $doc->docs_status_id = $request->docs_status_id;
        $doc->date_updated = now();
        $doc->save();

        return response()->json($doc);
    }

    public function destroy(Docs $doc): JsonResponse
    {
        $doc->delete();
        return response()->json(null, 204);
    }
} 