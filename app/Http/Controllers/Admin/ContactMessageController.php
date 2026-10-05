<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use Illuminate\Http\Request;

class ContactMessageController extends Controller
{
    public function index(Request $request)
    {
        $query = ContactMessage::latest('id');

        // Status filter
        if ($request->filled('status')) {
            if ($request->status === 'unread') {
                $query->where('is_read', 0);
            } elseif ($request->status === 'read') {
                $query->where('is_read', 1);
            }
        }

        // Search filter
        if ($request->filled('search')) {
            $search = trim($request->search);
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('phone', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('subject', 'like', "%{$search}%")
                  ->orWhere('message', 'like', "%{$search}%");
            });
        }

        $messages = $query->paginate(15)->withQueryString();

        // Statistics
        $totalMessages = ContactMessage::count();
        $unreadMessages = ContactMessage::where('is_read', 0)->count();
        $readMessages = ContactMessage::where('is_read', 1)->count();
        $todayMessages = ContactMessage::whereDate('created_at', today())->count();

        return view('backend.contact-messages.index', compact(
            'messages',
            'totalMessages',
            'unreadMessages',
            'readMessages',
            'todayMessages'
        ));
    }

    public function show($id)
    {
        $message = ContactMessage::findOrFail($id);

        // Mark as read automatically when opened
        if (!$message->is_read) {
            $message->update(['is_read' => 1]);
        }

        return view('backend.contact-messages.show', compact('message'));
    }

    public function toggleRead($id)
    {
        $message = ContactMessage::findOrFail($id);
        $message->update([
            'is_read' => !$message->is_read,
        ]);

        $statusText = $message->is_read ? 'পঠিত হিসেবে চিহ্নিত করা হয়েছে।' : 'অপঠিত হিসেবে চিহ্নিত করা হয়েছে।';

        return redirect()->back()->with('success', $statusText);
    }

    public function destroy($id)
    {
        $message = ContactMessage::findOrFail($id);
        $message->delete();

        return redirect()->back()->with('success', 'বার্তাটি সফলভাবে মুছে ফেলা হয়েছে।');
    }
}
