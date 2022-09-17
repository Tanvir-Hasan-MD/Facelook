<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\User;
use App\Model\UserRole;
use App\Model\UserPost;
use Illuminate\Support\Facades\Hash;
use Auth;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $data['post'] = UserPost::with('user')->orderBy('id','DESC')->get();
        $data['user'] = User::find(Auth::user()['id']);
        // dd( $data['post']->toArray() );
        return view('backend.home')->with($data);
    }
    public function postAdd(Request $request)
    {
        $data = $request->all();
        $data['created_by'] = User::find(Auth::User()['id'])['id'];
        // dd($data);
        UserPost::create($data);
        return redirect()->back()->with('success','Your post have been created.');

    }

    public function postDelete(Request $request)
    {
        // dd('hello');
        $ticket = UserPost::find($request->id);
        $ticket->delete();
        $status = 'closed';
        // dd($status);
        return response()->json($status);
    }

}
