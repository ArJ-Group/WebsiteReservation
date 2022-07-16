<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\CategoryService;
use App\Models\Service;
use Illuminate\Http\Request;

class MessageController extends Controller
{

    public function index(Request $request)
    {
        $search = $request->get('search');
        if ($request->get('search')) {
            $msg = Message::search(['name', 'email', 'title', 'messagetext'], $search)->get();
        } else {
            $msg = Message::all();
        }
        return view('admin.messageIndex', compact('msg'));
    }

    public function messageCustomer(){
        $msg = Message::where('show', 1)->get();
        return view('customer.message', compact('msg'));
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'title' => 'required',
            'messagetext' => 'required',
        ]);

        $msg = New Message;
        $msg->name = $request->get('name');
        $msg->email = $request->get('email');
        $msg->title = $request->get('title');
        $msg->messagetext = $request->get('messagetext');
        $msg->save();

        return redirect()->route('messageCustomer')
            ->with('success', 'Thank You For The Message!!');
    }


    public function show(Message $message)
    {
        //
    }


    public function edit(Message $message)
    {
        //
    }


    public function update(Request $request, $idm)
    {
        $request->validate([
            'show' => 'required',
        ]);

        $msg = Message::where('message_id', $idm)->first();
        $msg->show = $request->get('show');
        $msg->save();

        return redirect()->route('message.index')
            ->with('success', 'Message Successfully Updated');
    }

    public function destroy($idm)
    {
        $msg = Message::where('message_id', $idm)->first();
        $msg->delete();
        return redirect()->route('message.index')
            ->with('success', 'Message seccesfully Deleted');
    }
}
