<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\Admin\User\UserPasswordUpdateRequest;
use App\Http\Requests\Admin\UserRequest;
use App\Repositories\Role\RoleRepository;
use App\Repositories\User\UserRepository;
use Yajra\DataTables\DataTables;

class UsersController extends Controller
{
    private static UserRepository $UserRepository;
    private static RoleRepository $RoleRepository;

    public function __construct(UserRepository $UserRepository, RoleRepository $RoleRepository)
    {
        self::$UserRepository = $UserRepository;
        self::$RoleRepository = $RoleRepository;
    }

    public function index()
    {
        $breadcrumbs = [
            ['link' => 'admin_dashboard', 'name' => "Dashboard"],
            ['name' => "Users"]
        ];
        $roles = self::$RoleRepository->all([], false);

        return view('admin.user.index')
            ->with("breadcrumbs", $breadcrumbs)
            ->with("roles", $roles);
    }

    public function result($status = 2)
    {
        $where = [];

        if ($status != 2) {
            $where[] = ["users.is_active", "=", $status];
        }

        $results = self::$UserRepository->dataTable([], $where);
        return DataTables::of($results)
            ->addColumn('status', function ($result) {
                return status($result->is_active);
            })
            ->addColumn('action', function ($result) {
                $buttons = [];
                if (auth()->user()->role->hasPermission("user_update")) {
                    $buttons = [
                        "edit" => route('admin_user_create_update', [$result->id]),
                        "status" => [
                            "id" => $result->id,
                            "status" => $result->is_active,
                            "datatable_id" => "datatable",
                        ]
                    ];
                }
                if (auth()->user()->role->hasPermission("user_delete")) {
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
            ['link' => 'admin_user_index', 'name' => "Users"],
            ['name' => empty($obj->id) ? 'New User' : 'Update User']
        ];
        if ($id == 0) {
            $obj = self::$UserRepository->getDummy();
        } else {
            $obj = self::$UserRepository->all([
                ["id", $id]
            ]);
            if (is_null($obj)) {
                return redirect()->route('admin_user_index')->with('error', returnMsg('404'));
            }
        }

        $roles = self::$RoleRepository->all([], false);

        return view('admin.user.createUpdate')
            ->with("obj", $obj)
            ->with("breadcrumbs", $breadcrumbs)
            ->with("roles", $roles);
    }

    public function createUpdatePost(UserRequest $request)
    {
        $data = $request->all();
        $obj = null;

        if ($data["id"] != 0) {
            $obj = self::$UserRepository->all([
                ["id",$data["id"]]
            ]);
            if (is_null($obj)) {
                return redirect()->route('admin_user_index')->with('error', returnMsg('404'));
            }
        }

        if (is_null($obj)) {
            self::$UserRepository->create($data);
            return redirect()->route('admin_user_index')->with('success', returnMsg('201'));
        } else {
            self::$UserRepository->update($data, [["id", $obj->id]]);
            return redirect()->route('admin_user_create_update', [$obj->id])->with('success', returnMsg());
        }
    }

    public function action($id, $status)
    {
        $id = Clean($id);
        $status = clean($status);

        if (in_array($status, [0,1])) {
            self::$UserRepository->enableDisable($id, $status);
        } elseif (in_array($status, [2])) {
            self::$UserRepository->delete([["id", $id]]);
        }

        return json_encode(['response' => 'success', 'message' =>  returnMsg()]);
    }


    public function changeUserPassword()
    {
        $breadcrumbs = [
            ['link' => 'admin_dashboard', 'name' => "Dashboard"],
            ['name' => "Change Password"]
        ];
        return view('admin.user.changeUserPassword', compact('breadcrumbs'));
    }

    public function updateUserPassword(UserPasswordUpdateRequest $request)
    {
        $validator = Validator::make($request->all(), [], []);
        if ($request->has('current')) {
            if (!Hash::check($request->current, auth()->user()->password)) {
                $validator->getMessageBag()->add('current', "The current password is incorrect.");
                return redirect()->back()->withErrors($validator)->withInput();
            }
            if ($request->current == $request->password) {
                $validator->getMessageBag()->add('password', "New password must be different from current.");
                return redirect()->back()->withErrors($validator)->withInput();
            }
        }
        $data["password"] = $request->password;
        self::$UserRepository->update($data, [["id", $request->id]]);
        if ($request->has('current')) {
            return redirect()->route('admin_dashboard')->with('success', 'User password updated successfully');
        }
        return redirect()
            ->route('admin_user_list')
            ->with('success', 'User password updated successfully');
    }


































}
