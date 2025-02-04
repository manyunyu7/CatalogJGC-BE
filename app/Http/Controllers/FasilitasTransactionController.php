<?php

namespace App\Http\Controllers;

use App\Models\FasilitasTransaction;
use Illuminate\Http\Request;
use App\Helper\Killa;
use Illuminate\Validation\ValidationException;

class FasilitasTransactionController extends Controller
{
    // Fetch all transactions
    public function index()
    {
        $transactions = FasilitasTransaction::with('fasilitas')->get();
        return Killa::responseSuccessWithMetaAndResult(200, 1, 'Success', $transactions);
    }

    // Fetch a single transaction by ID
    public function show($id)
    {
        $transaction = FasilitasTransaction::with('fasilitas')->find($id);

        if (!$transaction) {
            return Killa::responseErrorWithMetaAndResult(404, 0, 'Transaction not found', []);
        }

        return Killa::responseSuccessWithMetaAndResult(200, 1, 'Success', $transaction);
    }

    public function bulkUpdate(Request $request)
    {

        try {
            $validatedData = $request->validate([
                'parent_id' => 'nullable|uuid',
                'unit_facilities' => 'required|array',
                'unit_facilities.*' => 'required|exists:fasilitas,id',
            ]);

            $parentId = $validatedData['parent_id'] ?? null;
            $newFasilitasIds = $validatedData['unit_facilities'];

            // Remove existing records that are not in the new list
            FasilitasTransaction::where('parent_id', $parentId)
                ->whereNotIn('fasilitas_id', $newFasilitasIds)
                ->delete();

            $transactions = [];
            foreach ($newFasilitasIds as $fasilitas_id) {
                $transactions[] = [
                    'parent_id' => $parentId,
                    'fasilitas_id' => $fasilitas_id,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }

            FasilitasTransaction::insert($transactions);

            return Killa::responseSuccessWithMetaAndResult(201, count($transactions), 'Facilities Updated Successfully', $transactions);
        } catch (ValidationException $e) {
            return Killa::responseErrorWithMetaAndResult(422, 0, 'Validation error', $e->errors());
        }
    }


    // Create a new transaction
    public function store(Request $request)
    {
        try {
            // Validate the request data
            $validatedData = $request->validate([
                'parent_id' => 'nullable|integer',
                'fasilitas_id' => 'required|exists:fasilitas,id',
            ]);

            // Add the created_by field with the authenticated user's ID
            $validatedData['created_by'] = auth()->user()->id;

            // Create the transaction
            $transaction = FasilitasTransaction::create($validatedData);

            // Return a successful response
            return Killa::responseSuccessWithMetaAndResult(201, 1, 'Transaction created successfully', $transaction);
        } catch (ValidationException $e) {
            // Handle validation errors
            return Killa::responseErrorWithMetaAndResult(422, 0, 'Validation error', $e->errors());
        }
    }

    // Update an existing transaction
    public function update(Request $request, $id)
    {
        $transaction = FasilitasTransaction::find($id);

        if (!$transaction) {
            return Killa::responseErrorWithMetaAndResult(404, 0, 'Transaction not found', []);
        }

        try {
            // Validate the request data
            $validatedData = $request->validate([
                'parent_id' => 'nullable|integer',
                'fasilitas_id' => 'sometimes|exists:fasilitas,id',
            ]);

            // Add created_by only if it's not already set, preserving its value
            if (!$transaction->created_by) {
                $validatedData['created_by'] = auth()->user()->id;
            }

            // Update the transaction
            $transaction->update($validatedData);

            // Return a successful response
            return Killa::responseSuccessWithMetaAndResult(200, 1, 'Transaction updated successfully', $transaction);
        } catch (ValidationException $e) {
            // Handle validation errors
            return Killa::responseErrorWithMetaAndResult(422, 0, 'Validation error', $e->errors());
        }
    }

    // Soft Delete a transaction and set deleted_by field
    public function destroy($id)
    {
        $transaction = FasilitasTransaction::find($id);

        if (!$transaction) {
            return Killa::responseErrorWithMetaAndResult(404, 0, 'Transaction not found', []);
        }

        // Update deleted_by with the authenticated user ID
        $transaction->deleted_by = auth()->user()->id;
        $transaction->save(); // Save the change

        // Soft delete the transaction (set deleted_at timestamp)
        $transaction->delete();

        // Return success response
        return Killa::responseSuccessWithMetaAndResult(200, 1, 'Transaction deleted successfully', []);
    }
}
