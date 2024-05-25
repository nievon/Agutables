<?php

namespace App\Http\Controllers;

use App\Exports\BookExport;
use App\Imports\BookImport;
use App\Models\Tables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class ExcelController extends Controller
{
    public function index()
    {
        // Импортируем данные из Excel файла
        $tables = Tables::all();
        if (!Storage::exists('book1.xlsx')) {
            abort(404, 'File not found');
        }

        $data = Excel::toArray(new BookImport, 'book1.xlsx');
        return view('Tables.excel', ['data' => $data[0]], compact('tables'));
    }


    public function update(Request $request)
    {
        $data = $request->input('data');

        // Преобразуем данные обратно в массив для экспорта
        $formattedData = [];
        foreach ($data as $rowIndex => $row) {
            $formattedData[] = array_values($row);
        }

        Excel::store(new BookExport($formattedData), 'book1.xlsx');
        return response()->json(['message' => 'Data updated successfully']);
    }
    public function updateCell(Request $request)
    {
        $row = $request->input('row');
        $col = $request->input('col');
        $value = $request->input('value');

        // Получаем текущие данные из файла
        $data = Excel::toArray(new BookImport, 'book1.xlsx')[0];

        // Обновляем значение ячейки
        $data[$row][$col] = $value;

        // Экспортируем обновленные данные обратно в файл
        Excel::store(new BookExport($data), 'book1.xlsx');

        return response()->json(['message' => '']);
    }
}
