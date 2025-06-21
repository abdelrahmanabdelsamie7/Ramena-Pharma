<?php
namespace App\Http\Controllers\API;
use App\Models\Contact;
use Illuminate\Http\Request;
use App\Mail\{ReplyToContactMail, NewContactNotificationMail};
use App\traits\ResponseJsonTrait;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
class ContactController extends Controller
{
    use ResponseJsonTrait;
    public function __construct()
    {
        $this->middleware('auth:admins')->only(['index', 'show', 'reply', 'destroy']);
    }
    public function index()
    {
        $contacts = Contact::all();
        return $this->sendSuccess('Contacts retrieved successfully', $contacts);
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|regex:/^[a-zA-Z0-9._%+-]+@gmail\.com$/',
            'phone' => 'nullable|string|max:20',
            'message' => 'required|string',
        ]);
        $contact = Contact::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'message' => $request->message,
            'status' => 'pending',
        ]);
        Mail::to('abdelrhmanabdelsamie@gmail.com')->send(new NewContactNotificationMail($contact));
        return $this->sendSuccess('Contact message sent successfully', $contact);
    }
    public function show($id)
    {
        $contact = Contact::findOrFail($id);
        return $this->sendSuccess('Contact details retrieved successfully', $contact);
    }
    public function reply(Request $request, $id)
    {
        $request->validate([
            'admin_reply' => 'required|string',
        ]);
        $contact = Contact::findOrFail($id);
        $contact->update([
            'admin_reply' => $request->admin_reply,
            'status' => 'replied',
        ]);
        Mail::to($contact->email)->send(new ReplyToContactMail($contact->name, $contact->phone, $request->admin_reply));
        return $this->sendSuccess('Reply sent successfully', $contact);
    }
    public function destroy($id)
    {
        $contact = Contact::findOrFail($id);
        $contact->delete();
        return $this->sendSuccess('Contact message deleted successfully', []);
    }
}
