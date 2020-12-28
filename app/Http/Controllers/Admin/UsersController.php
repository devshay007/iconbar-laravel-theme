<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\MassDestroyUserRequest;
use App\Http\Requests\User\StoreUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Models\Role;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use DataTables;

class UsersController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('user_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if($request->ajax()) {
            $data=User::all();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('select_row', function ($row) {
                    return '';
                })
                ->addColumn('action', function ($row) {
                    $url = url('admin/users/' . $row->id);
                    $btn  = "";
                    /*if(\Gate::allows('user_show')){
                        $btn .= '<a href="' . $url . '" class="btn btn-info btn-xs">View</a> ';
                    }*/
                    if(\Gate::allows('user_edit')){
                        $btn .= '<a href="' . $url . '/edit" class="btn btn-primary btn-xs">Edit</a> ';
                    }
                    if(\Gate::allows('user_delete')){
                        $btn .= '<a href="' . $url . '" class="delete_row btn btn-danger btn-xs ">Delete</a>';
                    }
                    return $btn;
                })->addColumn('roles', function ($row) {
                    $chkBox = "";
                    foreach ($row->roles AS $key){
                        $chkBox .= '<span class="badge badge-info ml-1 ">'.$key["title"].'</span>';
                    }
                    return $chkBox;
                })->editColumn('status', function ($row) {
                    if($row->status==1)
                        return '<span class="badge badge-success ml-1">Active</span>';
                    else
                        return '<span class="badge badge-secondary ml-1">InActive</span>';
                })
                ->rawColumns(['action','roles','status'])
                ->make(true);
        }

        return view('admin.users.index');
    }

    public function create()
    {
        abort_if(Gate::denies('user_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $roles = Role::all()->pluck('title', 'id');

        return view('admin.users.create', compact('roles'));
    }

    public function store(StoreUserRequest $request)
    {
        $user = User::create($request->all());
        $user->roles()->sync($request->input('roles', []));

        return redirect()->route('admin.users.index')->with('message', 'User added successfully.');

    }

    public function edit(User $user)
    {
        abort_if(Gate::denies('user_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $roles = Role::all()->pluck('title', 'id');

        $user->load('roles');

        return view('admin.users.edit', compact('roles','user'));
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        $user->update($request->all());
        $user->roles()->sync($request->input('roles', []));

        return redirect()->route('admin.users.index')->with('message', 'User updated successfully.');
    }

    public function show(User $user)
    {
        abort_if(Gate::denies('user_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $user->load('roles');

        return view('admin.users.show', compact('user'));
    }

    public function destroy(User $user)
    {
        abort_if(Gate::denies('user_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if($user->delete()){
            return response()->json([
                'status' => true,
                'message' => 'Record deleted successfully!',
            ]);
        }
        response()->json([
            'status' => false,
            'message' => 'Record not deleted successfully!',
        ]);
    }

    public function massDestroy(MassDestroyUserRequest $request)
    {
        User::whereIn('id', request('ids'))->delete();
        return response(null, Response::HTTP_NO_CONTENT);
    }
}
