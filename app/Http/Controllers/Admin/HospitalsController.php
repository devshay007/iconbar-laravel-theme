<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Hospital\MassDestroyHospitalRequest;
use App\Http\Requests\Hospital\StoreHospitalRequest;
use App\Http\Requests\Hospital\UpdateHospitalRequest;
use Illuminate\Http\Request;
use Gate;
use Symfony\Component\HttpFoundation\Response;
use DataTables;
use App\Models\Hospital;

class HospitalsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
       // abort_if(Gate::denies('user_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if($request->ajax()) {
            $data=Hospital::all();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('select_row', function ($row) {
                    return '';
                })
                ->addColumn('action', function ($row) {
                    $url = url('admin/hospitals/' . $row->hospid);
                    $btn  = "";
                    $btn .= '<a href="' . $url . '/edit" class="btn btn-primary btn-xs">Edit</a> ';
                    return $btn;
                })->editColumn('status', function ($row) {
                    if($row->status==1)
                        return '<span class="badge badge-success ml-1">Active</span>';
                    else
                        return '<span class="badge badge-secondary ml-1">InActive</span>';
                })
                ->rawColumns(['action','status'])
                ->make(true);
        }

        return view('admin.hospitals.index');
    }

    public function create()
    {
        return view('admin.hospitals.create');
    }

    public function store(StoreHospitalRequest $request)
    {

        $hospital = Hospital::create($request->all());

        return redirect()->route('admin.hospitals.index')->with('message', 'Hospital added successfully.');

    }

    public function edit(Hospital $hospital)
    {
        $hospital = Hospital::find($hospital->hospid);

        return view('admin.hospitals.edit', compact('hospital'));
    }

    public function update(UpdateHospitalRequest $request, hospital $hospital)
    {
        $hospital->update($request->all());

        return redirect()->route('admin.hospitals.index')->with('message', 'hospital updated successfully.');
    }

    public function show(User $user)
    {
        $user->load('roles');

        return view('admin.hospitals.show', compact('user'));
    }

    public function destroy(User $user)
    {
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

    /* public function massDestroy(MassDestroyUserRequest $request)
    {
        Hospital::whereIn('id', request('ids'))->delete();
        return response(null, Response::HTTP_NO_CONTENT);
    } */
}
