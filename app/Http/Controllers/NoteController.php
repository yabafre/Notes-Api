<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class NoteController extends Controller
{
    public function index(Request $request)
    {
        $notes = $notes = $request->user()->notes()->orderBy('created_at', 'desc')->get();
        $notes->load('user');
        return response()->json($notes);
    }

    public function store(Request $request): \Illuminate\Http\JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'content' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 400);
        }

        $note = new Note;
        $note->content = $request->content;
        $note->user_id = $request->user()->id;
        $note->save();

        return response()->json($note, 201);
    }

    public function show(Request $request, $id)
    {
        $note = $request->user()->notes()->find($id);
        $note->load('user');
        if (!$note) {
            return response()->json([
                'message' => 'Note not found'
            ], 404);
        }
        return response()->json($note);
    }

    public function update(Request $request, $id): \Illuminate\Http\JsonResponse
    {
        $note = $request->user()->notes()->find($id);
        $note->load('user');
        if (!$note) {
            return response()->json([
                'message' => 'Note not found'
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'content' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 400);
        }

        $note->content = $request->input('content');
        $note->save();

        return response()->json($note);
    }

    public function destroy(Request $request, $id): \Illuminate\Http\JsonResponse
    {
        $note = $request->user()->notes()->find($id);
        if (!$note) {
            return response()->json([
                'message' => 'Note not found'
            ], 404);
        }

        $note->delete();

        return response()->json($note);
    }

}
