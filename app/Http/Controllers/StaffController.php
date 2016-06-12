<?php


namespace App\Http\Controllers;
use App\User;
use App\Staff;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Validator;

class StaffController extends Controller
{
    protected $staffRules = [
        'name' => 'required|min:5|max:255',
        'telephone' => 'required|numeric',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|min:6|confirmed'
    ];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $staff = User::with('staff')->where('user_group', 'staff')->paginate(10);
        return view('admin-panel.staff.index', compact('staff'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin-panel.staff.create');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), $this->staffRules, []);
        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator);
        }
        $user = new User();
        $user->name = ucwords($request->name);
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->user_group = 'staff';
        $user->save();
        $staff = new Staff();
        $staff->user_id = $user->id;
        $staff->telephone = $request->telephone;
        $staff->save();
        return redirect()->back();
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::with('staff')->where('id', $id)->first();
        return view('admin-panel.staff.show', compact('user'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::with('staff')->where('id', $id)->first();
        return view('admin-panel.staff.edit', compact('user'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:5|max:255',
            'telephone' => 'required|numeric',
            'email' => 'required|email|unique:users,email,'.$id,
            'password' => 'min:6|confirmed'
        ]);
        if ($validator->fails()) {
            dd($validator);
            return redirect()->back()->withInput()->withErrors($validator);
        }
        $user = User::with('staff')->where('id', $id)->first();
        if(empty($request->password)) {
            $user->update([
                'name' => $request->name,
                'telephone' => $request->telephone,
            ]);
        } else {
            $user->update([
                'name' => $request->name,
                'password' => bcrypt($request->password),
                'telephone' => $request->telephone,
            ]);
        }
        return redirect(url('admin/staff', $user->id));
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::with('staff')->where('id', $id)->get();
        $user->delete();
    }
}
