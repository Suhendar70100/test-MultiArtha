<?php

namespace App\Http\Controllers\API;

use Exception;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Requests\ProductRequest;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        return view('product.index');
    }


    public function dataTable(): JsonResponse
    {
        $data = Product::query()->get();

        return DataTables::of($data)
            ->addColumn('aksi', function ($row) {
                return " <a href='#' data-id='$row->id' class='mdi mdi-pencil text-warning btn-edit'></a>
                            <a href='#' data-id='$row->id' class='mdi mdi-trash-can text-primary btn-delete'></a>";
            })
            ->rawColumns(['aksi'])
            ->toJson();
    }

    public function store(ProductRequest $request): JsonResponse
    {
        try {
            $data = $request->validated();

            if ($request->hasFile('poster')) {
                $imageName = time() . '.' . $request->poster->extension();
                $request->poster->storeAs('images', $imageName, 'public');
                $data['poster'] = url('storage/images/' . $imageName);
            }

            Product::query()->create($data);

            return response()->json(['message' => 'Data berhasil di tambahkan'], 201);
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function show($id): JsonResponse
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json(['message' => 'Data perangkat tidak ditemukan'], 404);
        }

        return response()->json($product);
    }

    public function update(ProductRequest $request, $id): JsonResponse
    {
        try {
            $product = Product::find($id);

            if (!$product) {
                return response()->json(['message' => 'Data tidak ditemukan'], 404);
            }

            $data = $request->validated();

            if ($request->hasFile('poster')) {
                if ($product->poster) {
                    $oldImageName = basename($product->poster);
                    Storage::disk('public')->delete('images/' . $oldImageName);
                }

                $imageName = time() . '.' . $request->poster->extension();
                $request->poster->storeAs('images', $imageName, 'public');
                $data['poster'] = url('storage/images/' . $imageName);
            }

            $product->update($data);

            return response()->json(['message' => 'Produk berhasil diubah'], 200);
        } catch (Exception $exception) {
            throw new Exception($exception->getMessage());
        }
    }


    public function delete($id): JsonResponse
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }

        if ($product->poster) {
            $imageName = basename($product->poster);
            Storage::disk('public')->delete('images/' . $imageName);
        }

        $product->delete();

        return response()->json(['message' => 'Data berhasil dihapus'], 200);
    }
}
