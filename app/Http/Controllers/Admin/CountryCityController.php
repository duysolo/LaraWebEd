<?php

namespace App\Http\Controllers\Admin;

use App\Models\City;
use App\Models\Country;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;

class CountryCityController extends BaseAdminController
{

    public $bodyClass = 'country-city-controller', $routeLink = 'countries-cities';
    public function __construct()
    {
        parent::__construct();

        $this->middleware('is_admin');

        $this->_setPageTitle('Countries', 'manage countries');
        $this->_setBodyClass($this->bodyClass);

        $this->_loadAdminMenu($this->routeLink);
    }

    public function getIndex(Request $request)
    {
        $this->_setBodyClass($this->bodyClass . ' countries-list-page');
        return $this->_viewAdmin('countries-cities.index');
    }

    public function postIndex(Request $request, Country $object)
    {
        /**
         * Paging
         **/
        $offset = $request->get('start', 0);
        $limit = $request->get('length', 10);
        $paged = ($offset + $limit) / $limit;
        Paginator::currentPageResolver(function () use ($paged) {
            return $paged;
        });

        $records = [];
        $records["data"] = [];

        /*Group actions*/
        if ($request->get('customActionType', null) == 'group_action') {
            $records["customActionStatus"] = "danger";
            $records["customActionMessage"] = "Group action did not completed. Some error occurred.";
            $ids = (array) $request->get('id', []);
            $result = $object->updateMultiple($ids, [
                'status' => $request->get('customActionValue', 0),
            ], true);
            if (!$result['error']) {
                $records["customActionStatus"] = "success";
                $records["customActionMessage"] = "Group action has been completed.";
            }
        }

        /*
         * Sortable data
         */
        $orderBy = $request->get('order')[0]['column'];
        switch ($orderBy) {
            case 1:
                {
                    $orderBy = 'id';
                }
                break;
            case 2:
                {
                    $orderBy = 'country_name';
                }
                break;
            case 3:
                {
                    $orderBy = 'country_2_code';
                }
                break;
            case 4:
                {
                    $orderBy = 'country_3_code';
                }
                break;
            case 5:
                {
                    $orderBy = 'total_city';
                }
                break;
            case 6:
                {
                    $orderBy = 'status';
                }
                break;
            default:
                {
                    $orderBy = 'country_name';
                }
                break;
        }
        $orderType = $request->get('order')[0]['dir'];

        $getByFields = [];
        if ($request->get('country_name', null) != null) {
            $getByFields['country_name'] = ['compare' => 'LIKE', 'value' => $request->get('country_name')];
        }
        if ($request->get('country_2_code', null) != null) {
            $getByFields['country_2_code'] = ['compare' => 'LIKE', 'value' => $request->get('country_2_code')];
        }
        if ($request->get('country_3_code', null) != null) {
            $getByFields['country_3_code'] = ['compare' => 'LIKE', 'value' => $request->get('country_3_code')];
        }
        if ($request->get('status', null) != null) {
            $getByFields['status'] = ['compare' => '=', 'value' => $request->get('status')];
        }

        $items = $object->searchBy($getByFields, [$orderBy => $orderType], true, $limit);

        $iTotalRecords = $items->count();
        $sEcho = intval($request->get('sEcho'));

        foreach ($items as $key => $row) {
            $status = '<span class="label label-success label-sm">Activated</span>';
            if ($row->status != 1) {
                $status = '<span class="label label-danger label-sm">Disabled</span>';
            }
            /*Edit link*/
            $link = asset($this->adminCpAccess . '/' . $this->routeLink . '/details/' . $row->id);

            $records["data"][] = array(
                '<input type="checkbox" name="id[]" value="' . $row->id . '">',
                $row->id,
                $row->country_name,
                $row->country_2_code,
                $row->country_3_code,
                $row->total_city,
                $status,
                '<a class="fast-edit" title="Fast edit">Fast edit</a>',
                '<a href="' . $link . '" class="btn btn-outline green btn-sm"><i class="icon-eye"></i></a>',
            );
        }

        $records["sEcho"] = $sEcho;
        $records["iTotalRecords"] = $iTotalRecords;
        $records["iTotalDisplayRecords"] = $iTotalRecords;

        return response()->json($records);
    }

    public function postFastEdit(Request $request, Country $object)
    {
        $data = [
            'id' => $request->get('args_0', null),
            'country_name' => $request->get('args_1', null),
            'country_2_code' => $request->get('args_2', null),
            'country_3_code' => $request->get('args_3', null),
            'total_city' => $request->get('args_4', null),
        ];

        $result = $object->fastEdit($data, false, true);
        return response()->json($result, $result['response_code']);
    }

    public function getDetails(Request $request, Country $object, $countryId)
    {
        $country = $object->find($countryId);
        if (!$country) {
            $this->_setFlashMessage('Country not found', 'error');
            $this->_showFlashMessages();
            return redirect()->back();
        }
        $dis['object'] = $country;
        $this->_setPageTitle('Cities', 'manage cities');
        $this->_setBodyClass($this->bodyClass . ' cities-list-page');
        return $this->_viewAdmin('countries-cities.details', $dis);
    }

    public function postDetails(Request $request, Country $object, City $objectCity, $countryId)
    {
        /**
         * Paging
         **/
        $offset = $request->get('start', 0);
        $limit = $request->get('length', 10);
        $paged = ($offset + $limit) / $limit;
        Paginator::currentPageResolver(function () use ($paged) {
            return $paged;
        });

        $records = [];
        $records["data"] = [];

        /*Group actions*/
        if ($request->get('customActionType', null) == 'group_action') {
            $records["customActionStatus"] = "danger";
            $records["customActionMessage"] = "Group action did not completed. Some error occurred.";
            $ids = (array) $request->get('id', []);
            $result = $object->updateMultiple($ids, [
                'status' => $request->get('customActionValue', 0),
            ], true);
            if (!$result['error']) {
                $records["customActionStatus"] = "success";
                $records["customActionMessage"] = "Group action has been completed.";
            }
        }

        /*
         * Sortable data
         */
        $orderBy = $request->get('order')[0]['column'];
        switch ($orderBy) {
            case 1:
                {
                    $orderBy = 'id';
                }
                break;
            case 2:
                {
                    $orderBy = 'city_name';
                }
                break;
            case 3:
                {
                    $orderBy = 'latitude';
                }
                break;
            case 4:
                {
                    $orderBy = 'longitude';
                }
                break;
            default:
                {
                    $orderBy = 'city_name';
                }
                break;
        }
        $orderType = $request->get('order')[0]['dir'];

        $getByFields = [
            'country_id' => [
                'compare' => '=',
                'value' => $countryId,
            ],
        ];
        if ($request->get('city_name', null) != null) {
            $getByFields['city_name'] = ['compare' => 'LIKE', 'value' => $request->get('city_name')];
        }

        $items = $objectCity->searchBy($getByFields, [$orderBy => $orderType], true, $limit);

        $iTotalRecords = $items->count();
        $sEcho = intval($request->get('sEcho'));

        foreach ($items as $key => $row) {
            $records["data"][] = array(
                '<input type="checkbox" name="id[]" value="' . $row->id . '">',
                $row->id,
                $row->city_name,
                $row->latitude,
                $row->longitude,
                '<a class="fast-edit" title="Fast edit">Fast edit</a>',
            );
        }

        $records["sEcho"] = $sEcho;
        $records["iTotalRecords"] = $iTotalRecords;
        $records["iTotalDisplayRecords"] = $iTotalRecords;

        return response()->json($records);
    }

    public function postFastEditCity(Request $request, City $object, $countryId)
    {
        $data = [
            'id' => $request->get('args_0', null),
            'city_name' => $request->get('args_1', null),
            'latitude' => $request->get('args_2', null),
            'longitude' => $request->get('args_3', null),
        ];

        $result = $object->fastEdit($data, false, true);
        return response()->json($result, $result['response_code']);
    }
}
