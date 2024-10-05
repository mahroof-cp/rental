<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\RoleRequest;
use App\Repositories\Permission\PermissionRepository;
use App\Repositories\Role\RoleRepository;
use Yajra\DataTables\DataTables;

class RoleController extends Controller
{
    private static RoleRepository $RoleRepository;
    private static PermissionRepository $PermissionRepository;

    public function __construct(RoleRepository $RoleRepository, PermissionRepository $PermissionRepository)
    {
        self::$RoleRepository = $RoleRepository;
        self::$PermissionRepository = $PermissionRepository;
    }

    public function index()
    {
        $breadcrumbs = [
            ['link' => 'admin_dashboard', 'name' => "Dashboard"],
            ['name' => "Roles"]
        ];
        return view('admin.role.index')
            ->with("breadcrumbs", $breadcrumbs);
    }

    public function result($status = 2)
    {
        $where = [];

        if ($status != 2) {
            $where[] = ["roles.is_active", "=", $status];
        }

        $results = self::$RoleRepository->dataTable([], $where);
        return DataTables::of($results)
            ->editColumn('created_at', function ($result) {
                return date("d/m/Y", strtotime($result->created_at));
            })
            ->addColumn('status', function ($result) {
                return status($result->is_active);
            })
            ->addColumn('action', function ($result) {
                $buttons = [];
                if (auth()->user()->role->hasPermission("role_update")) {
                    $buttons = [
                        "edit" => route('admin_role_create_update', [$result->id]),
                        "status" => [
                            "id" => $result->id,
                            "status" => $result->is_active,
                            "datatable_id" => "datatable",
                        ]
                    ];
                }
                if (auth()->user()->role->hasPermission("role_delete")) {
                    $buttons["delete"] = [
                        "id" => $result->id,
                        "datatable_id" => "datatable",
                    ];
                }
                return actionButtons($buttons);
            })
            ->addIndexColumn()
            ->escapeColumns([])
            ->setRowId('id')
            ->make(true);
    }


    public function createUpdate($id = 0)
    {
        $breadcrumbs = [
            ['link' => 'admin_dashboard', 'name' => "Dashboard"],
            ['link' => 'admin_role_index', 'name' => "Roles"],
            ['name' => empty($obj->id) ? 'New Role' : 'Update Role']
        ];
        $permissions_selected = [];

        if ($id == 0) {
            $obj = self::$RoleRepository->getDummy();
        } else {
            $obj = self::$RoleRepository->all([
                ["id",$id]
            ]);
            if (is_null($obj)) {
                return redirect()->route('admin_role_index')->with('error', returnMsg('404'));
            }
            $permissions_selected = $obj->permissionList();
        }

        $select = ['id', 'name'];
        $permissions = self::$PermissionRepository->all([], false, $select);


        return view('admin.role.createUpdate')
            ->with("obj", $obj)
            ->with("permissions_selected", $permissions_selected)
            ->with("permissions", $permissions)
            ->with("breadcrumbs", $breadcrumbs);
    }

    public function createUpdatePost(RoleRequest $request)
    {
        $data = $request->all();
        $obj = null;

        if ($data["id"] != 0) {
            $obj = self::$RoleRepository->all([
                ["id",$data["id"]]
            ]);
            if (is_null($obj)) {
                return redirect()->route('admin_role_index')->with('error', returnMsg('404'));
            }
        }

        if (is_null($obj)) {
            $res = self::$RoleRepository->create($data);
            if (count($data['permissions']) != 0) {
                $res->permissions()->sync($data['permissions']);
            }
            return redirect()->route('admin_role_index')->with('success', returnMsg('201'));
        } else {
            $res = self::$RoleRepository->update($data, [["id", $obj->id]]);
            if (count($data['permissions']) != 0) {
                $res->permissions()->sync($data['permissions']);
            }
            return redirect()->route('admin_role_create_update', [$obj->id])->with('success', returnMsg());
        }
    }

    public function action($id, $status)
    {
        $id = Clean($id);
        $status = clean($status);

        if (in_array($status, [0,1])) {
            self::$RoleRepository->enableDisable($id, $status);
        } elseif (in_array($status, [2])) {
            self::$RoleRepository->delete([["id", $id]]);
        }

        return json_encode(['response' => 'success', 'message' =>  returnMsg()]);
    }
}
