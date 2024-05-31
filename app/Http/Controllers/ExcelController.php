<?php

namespace App\Http\Controllers;

use App\Exports\BookExport;
use App\Imports\BookImport;
use App\Models\Tables;
use App\Models\Book;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\File;



class ExcelController extends Controller
{
    // public function __construct()
    // {
    //     $this->authorizeResource(Book::class, 'book');
    // }

    public function index()
    {
        $books = Auth::user()->books;
        return view('books.index', compact('books'));
    }

    public function create()
    {
        return view('books.create');
    }

    public function download(Book $book)
    {
        $this->authorize('update', $book);
        return Storage::download($book->file_path);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'file' => 'nullable|file|mimes:xlsx,xls,csv'
        ]);

        if ($request->has('create_empty') && $request->create_empty) {
            // Путь к шаблону пустой книги
            $templatePath = storage_path('app/books/emptybook.xlsx');
            $fileName = 'books/' . uniqid() . '_empty_book.xlsx';

            // Проверяем, существует ли файл шаблона
            if (!File::exists($templatePath)) {
                return back()->with('error', 'Шаблон пустой книги не найден.');
            }

            // Копируем шаблон и создаем новый файл
            Storage::put($fileName, File::get($templatePath));
        } else {
            // Загружаем файл книги
            $filePath = $request->file('file')->store('books');
        }

        $book = Book::create([
            'user_id' => auth()->id(),
            'title' => $request->title,
            'author' => $request->author,
            'file_path' => $fileName ?? $filePath
        ]);

        return redirect()->route('books.index')->with('success', 'Книга успешно создана');
    }



    public function show(Book $book)
    {
        $this->authorize('view', $book);

        if (!Storage::exists($book->file_path)) {
            abort(404, 'File not found');
        }

        $data = Excel::toArray(new BookImport, $book->file_path);

        return view('books.show', ['data' => $data[0]], compact('book'));
    }

    public function edit(Book $book)
    {
        $this->authorize('update', $book);

        if (!Storage::exists($book->file_path)) {
            abort(404, 'File not found');
        }

        $data = Excel::toArray(new BookImport, $book->file_path);

        return view('books.edit', ['data' => $data[0]], compact('book'));
    }

    public function update(Request $request, Book $book)
    {
        $this->authorize('update', $book);

        $data = $request->input('data');

        // Преобразуем данные обратно в массив для экспорта
        $formattedData = [];
        foreach ($data as $rowIndex => $row) {
            $formattedData[] = array_values($row);
        }

        Excel::store(new BookExport($formattedData), $book->file_path);

        return response()->json(['message' => 'Data updated successfully']);
    }

    public function updateCell(Request $request, Book $book)
    {
        $this->authorize('update', $book);

        $row = $request->input('row');
        $col = $request->input('col');
        $value = $request->input('value');

        // Получаем текущие данные из файла
        $data = Excel::toArray(new BookImport, $book->file_path)[0];

        // Обновляем значение ячейки
        $data[$row][$col] = $value;

        // Экспортируем обновленные данные обратно в файл
        Excel::store(new BookExport($data), $book->file_path);

        return response()->json(['message' => 'Data updated successfully']);
    }

    public function destroy(Book $book)
    {
        $this->authorize('delete', $book);
        Storage::delete($book->file_path);
        $book->delete();
        return redirect()->route('books.index')->with('success', 'Книга успешно удалена');
    }

    public function share(Book $book)
    {
        if (Gate::denies('manageAccess', $book)) {
            return response()->view('errors.403', [], 403);
        }
        $users = User::where('id', '!=', Auth::id())->get();
        $sharedUsers = $book->users;
        return view('books.share', compact('book', 'users', 'sharedUsers'));
    }

    public function sharedWithMe()
    {
        $user = Auth::user();
        $books = $user->sharedBooks;
        return view('books.shared_with_me', compact('books'));
    }


    public function addUser(Request $request, Book $book)
    {
        $this->authorize('update', $book);

        $request->validate([
            'selectedUser' => 'required|exists:users,id',
            'role' => 'required|in:editor,viewer'
        ]);

        $book->users()->attach($request->selectedUser, ['role' => $request->role]);

        return redirect()->route('books.share', $book)->with('success', 'Пользователь успешно добавлен');
    }

    public function removeUser(Book $book, User $user)
    {
        $this->authorize('update', $book);

        $book->users()->detach($user->id);

        return redirect()->route('books.share', $book)->with('success', 'Пользователь успешно удален');
    }
    public function searchUsers(Request $request)
    {
        $searchTerm = $request->input('searchTerm');
        $users = User::where('name', 'LIKE', "%{$searchTerm}%")->get();
        return response()->json($users);
    }
}
