<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\User\UserRepositoryInterface;
use App\Repositories\Role\RoleRepositoryInterface;
use App\Traits\FlashMessageTraits;

class UserController extends Controller
{
    use FlashMessageTraits;

    protected
        $PAGE_LIMIT,
        $PASS_REGEX
    ;

    function __construct(
        UserRepositoryInterface $userRepo,
        RoleRepositoryInterface $roleRepo
    ) {
        $this->userRepo     = $userRepo;
        $this->roleRepo     = $roleRepo;
        $this->PASS_REGEX   = config('setting.pass.regex');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data = $this->userRepo->pagination(10);
        return
            view('backend.user.index')
            ->with('users', $data->datas)
            ->with('status', $data->status)
        ;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return
            view('backend.user.create')
            ->with('roles', $this->roleRepo->get())
        ;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'role_id' => 'required',
            'name' => 'required|string|max:191',
            'email' => 'required|string|email|max:191|unique:users',
            'password' => 'required|string|min:8|confirmed|'.$this->PASS_REGEX,
        ]);
        $response = $this->userRepo->store($request);
        $this->message($response->level, $response->message);
        return redirect()->route('backend.user.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        return
            view('backend.user.edit')
            ->with('detail', $this->userRepo->find($id))
            ->with('roles', $this->roleRepo->get())
        ;
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
        //
        $request->validate([
            'role_id' => 'required',
            'name' => 'required|string|max:191',
            'email' => 'required|string|email|max:191|unique:users,email,'.$id,
            'password' => 'string|min:8|confirmed|'.$this->PASS_REGEX,
        ]);
        
        $response = $this->userRepo->update($id, $request);
        $this->message($response->level, $response->message);
        return redirect()->route('backend.user.index');
    }

    public function toggle(Request $request)
    {
        //
        $response = $this->userRepo->toggle($request);
        $this->message($response->level, $response->message);
        return back();
    }

}
