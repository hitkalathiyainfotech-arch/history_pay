<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use App\Repositories\PlanRepository;
use App\Models\Query;
use App\Models\Message;
use App\Models\QueryResponse;

class QueryController extends AppBaseController
{
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Assuming the photo is uploaded as an image file
        ]);

        // Handle the photo upload (if any)
        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('query', 'public');
        } else {
            $photoPath = null;
        }

        // Create the item
        $query = Query::create([
            'user_id' => $request->input('user_id'),
            'app_id' => $request->input('app_id'),
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'photo' => $photoPath,
        ]);

        $message = Message::create([
            'user_id' => $request->input('user_id'),
            'app_id' => $request->input('app_id'),
            'query_id' => $query->id,
            'num' => 1,
            'message' => $request->input('description'),
        ]);

        // dd($message);

        return response()->json(['message' => 'Item created successfully', 'data' => $query], 201);
    }

    public function show(Request $request)
    {
        $queryResponse = QueryResponse::where('query_id', $request->query_id)->get();

        if (!$queryResponse) {
            return $this->sendError('Plan not found.');
        }
        return $this->sendResponse(
            $queryResponse,
            'get responce successfully'
        );
    }
}
