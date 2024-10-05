<?php

namespace App\Http\Controllers\Admin;

use App\Repositories\Bank\BankRepository;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\BankRequest;
use Yajra\DataTables\DataTables;

class BankController extends Controller
{
    private static BankRepository $BankRepository;

    public function __construct(BankRepository $BankRepository)
    {
        self::$BankRepository = $BankRepository;
    }

    public function index()
    {
        $breadcrumbs = [
            ['link' => 'admin_dashboard', 'name' => "Dashboard"],
            ['name' => "Banks"]
        ];
        return view('admin.bank.index')
            ->with("breadcrumbs", $breadcrumbs);
    }

    public function result($from_date = 0, $to_date = 0, $status = 2, $export = 0)
    {
        $where = [];

        if ($from_date != 0) {
            $from_date = date("Y-m-d", strtotime($from_date));
            $where[] = ["banks.created_at", ">=", $from_date];
        }
        if ($to_date != 0) {
            $to_date = date("Y-m-d", strtotime("+1 day", strtotime($to_date)));
            $where[] = ["banks.created_at", "<=", $to_date];
        }
        if ($status != 2) {
            $where[] = ["banks.is_active", "=", $status];
        }

        if ($export == 1) {
            set_time_limit(0);
            ini_set('max_execution_time', 100000);
            ini_set('memory_limit','512m');

            $filename = "Banks_Documents_" . time() . ".csv";
            header('Content-Type: text/csv; charset=utf-8');
            header("Content-Disposition: attachment; filename={$filename}");

            $output = fopen('php://output', 'w');
            fputcsv($output, array(
                'SL.NO',
                'Unique ID',
                'Name',
                'Description',
                'Status',
                'Date',
            ));

            $take = 5000;
            $skip = 0;
            $sl = 0;
            while (true) {
                $results = self::$BankRepository->dataTable([], $where)->take($take)->skip($skip)->get();
                if (count($results) == 0) {
                    break;
                }
                $skip += $take;
                foreach ($results as $result) {
                    $sl++;
                    $row = [];
                    $row[] = $sl;
                    $row[] = $result->unique_id;
                    $row[] = $result->name;
                    $row[] = $result->description;
                    $row[] = status($result->is_active);
                    $row[] = date("d/m/Y", strtotime($result->created_at));;
                    fputcsv($output, $row);
                }
                die();
            }
        }

        $results = self::$BankRepository->dataTable([], $where);
        return DataTables::of($results)
            ->editColumn('created_at', function ($result) {
                return date("d/m/Y", strtotime($result->created_at));
            })
            ->addColumn('status', function ($result) {
                return status($result->is_active);
            })
            ->addColumn('action', function ($result) {
                $buttons = [];
                if (auth()->user()->role->hasPermission("bank_update")) {
                    $buttons = [
                        "edit" => route('admin_bank_create_update', [$result->id]),
                        "status" => [
                            "id" => $result->id,
                            "status" => $result->is_active,
                            "datatable_id" => "datatable",
                        ]
                    ];
                }
                if (auth()->user()->role->hasPermission("bank_delete")) {
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
            ['link' => 'admin_bank_index', 'name' => "Banks"],
            ['name' => empty($obj->id) ? 'New Bank' : 'Update Bank']
        ];
        if ($id==0) {
            $obj = self::$BankRepository->getDummy();
        } else {
            $obj = self::$BankRepository->all([
                ["id",$id]
            ]);
            if (is_null($obj)) {
                return redirect()->route('admin_bank_index')->with('error', returnMsg('404'));
            }
        }
        return view('admin.bank.createUpdate')
            ->with("obj", $obj)
            ->with("breadcrumbs", $breadcrumbs);
    }

    public function createUpdatePost(BankRequest $request)
    {
        $data = $request->all();
        $obj = null;

        if ($data["id"] !=0) {
            $obj = self::$BankRepository->all([
                ["id",$data["id"]]
            ]);
            if (is_null($obj)) {
                return redirect()->route('admin_bank_index')->with('error', returnMsg('404'));
            }
        }

        if (is_null($obj)) {
            self::$BankRepository->create($data);
            return redirect()->route('admin_bank_index')->with('success', returnMsg('201'));
        } else {
            self::$BankRepository->update($data, [["id", $obj->id]]);
            return redirect()->route('admin_bank_create_update', [$obj->id])->with('success', returnMsg());
        }
    }

    public function action($id, $status)
    {
        $id = Clean($id);
        $status = clean($status);

        if (in_array($status, [0,1])) {
            self::$BankRepository->enableDisable($id, $status);
        } elseif (in_array($status, [2])) {
            self::$BankRepository->delete([["id", $id]]);
        }

        return json_encode(['response' => 'success', 'message' =>  returnMsg()]);
    }
}
