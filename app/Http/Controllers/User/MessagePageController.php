<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Message;
use App\Models\SiteSetting;

class MessagePageController extends Controller
{
    /**
     * Halaman pesan-pesan khusus (read-only untuk Ismaza).
     */
    public function index()
    {
        return view('user.messages', [
            'ismazaName' => SiteSetting::get('ismaza_name', 'ISMAZA'),
            'messages'   => Message::orderBy('created_at')->get(),
        ]);
    }
}
