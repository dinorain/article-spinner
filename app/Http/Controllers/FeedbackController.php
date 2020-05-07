<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Kamaln7\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\DB;

use App\Model\Feedback;

use App\Mail\Feedback as FeedbackMail;


class FeedbackController extends Controller
{
    public function index()
    {

    }

    public function create(Request $request)
    {

        try {
            DB::beginTransaction();
            // request validation
            $this->validate($request, [
                'name' => 'required',
                'email' => 'required|email',
                'message' => 'required',
            ]);

            $feedback = new Feedback();
            $feedback->name = ucwords($request->name);
            $feedback->email = strtolower($request->email);
            $feedback->message = $request->message;
            $feedback->subscribed = ($request->subscribed === 'on' ? true : false);
            $feedback->save();

            $name_arr = explode(' ',trim($feedback->name));

            Mail::to($request->email)->send(new FeedbackMail($feedback, $name_arr[0]));
            DB::commit();
        } catch (\Exception $error) {
            DB::rollBack();
            Toastr::error('Something went wrong. Please try again!', 'Error');
        }

        return redirect()->route('thank', ['name' => $name_arr[0]]);
    }

    public function update(Request $request, $id)
    {

    }

    public function destroy($id)
    {

    }
}
