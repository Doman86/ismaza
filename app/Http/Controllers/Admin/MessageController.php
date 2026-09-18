<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreMessageRequest;
use App\Http\Requests\UpdateMessageRequest;
use App\Models\Message;

class MessageController extends Controller
{
    /**
     * Daftar semua pesan.
     */
    public function index()
    {
        return view('admin.messages.index', [
            'messages' => Message::latest()->paginate(10),
        ]);
    }

    /**
     * Form tambah pesan.
     */
    public function create()
    {
        return view('admin.messages.create');
    }

    /**
     * Simpan pesan baru.
     */
    public function store(StoreMessageRequest $request)
    {
        Message::create($request->only(['title', 'content']));

        return redirect()
            ->route('admin.messages.index')
            ->with('success', 'Pesan berhasil ditambahkan.');
    }

    /**
     * Form edit pesan.
     */
    public function edit(Message $message)
    {
        return view('admin.messages.edit', [
            'message' => $message,
        ]);
    }

    /**
     * Update pesan.
     */
    public function update(UpdateMessageRequest $request, Message $message)
    {
        $message->update($request->only(['title', 'content']));

        return redirect()
            ->route('admin.messages.index')
            ->with('success', 'Pesan berhasil diperbarui.');
    }

    /**
     * Hapus pesan.
     */
    public function destroy(Message $message)
    {
        $message->delete();

        return redirect()
            ->route('admin.messages.index')
            ->with('success', 'Pesan berhasil dihapus.');
    }
}
