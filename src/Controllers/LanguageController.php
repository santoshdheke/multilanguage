<?php

namespace Ssgroup\Language\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Module\Common\ReturnArrayMessages;
use Ssgroup\ApiManager\Controllers\ApiBaseController;
use Ssgroup\Language\Models\Language;
use Ssgroup\Language\Trait\Publish;

class LanguageController extends LanguageBaseController
{

    public $base_route = 'admin.language';
    use Publish, ReturnArrayMessages;

    public function __construct(Language $model)
    {
        $this->model = $model;
    }

    public function index()
    {
        $data = [];
        $data['rows'] = $this->servicefilter($this->model)->where('locale', 'en')->paginate(10);

        return view(parent::__loadView('index'), compact('data'));
    }

    public function create()
    {
        return view(parent::__loadView('create'));
    }

    public function store(Request $request)
    {
        $request->validate($this->servicedataValidationArray());

        return $this->returnBack($this->servicesstore($request), $request);
    }

    public function dataValidationArray($data = [])
    {
        return [
            'key' => 'required|max:255|unique:languages,key',
            'en' => 'required|max:255',
            'np' => 'required|max:255',
        ];
    }

    public function show($id)
    {
        $row = $this->servicefindById($id)['data'];

        return view(parent::__loadView('show'), compact('row'));
    }

    public function edit($id)
    {
        $row = $this->servicefindById($id)['data'];

        return view(parent::__loadView('edit'), compact('row'));
    }

    public function update(Request $request, $id)
    {
        return $this->returnBack($this->serviceupdate($request, $id), $request);
    }

    public function destroy($id)
    {
        return $this->returnBack($this->servicedelete($id), request());
    }





    public function paginateData($count = 10)
    {
        return $this->returnData($this->servicefilter($this->model)->where('locale', 'en')->paginate($count));
    }

    public function servicesstore(Request $request)
    {
        DB::beginTransaction();
        try {
            $english = $this->servicefillable($request, 'en');
            $nepali = $this->servicefillable($request, 'np');
            $this->model->create($english);
            $this->model->create($nepali);
            DB::commit();

            return $this->createMessage('Language create successful');
        } catch (\Exception $e) {
            DB::rollBack();

            return $this->returnServerError();
        }
    }

    public function serviceupdate(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            $data = $this->servicefindById($id)['data'];

            if ($eng = $this->model->where([
                'key' => $data->key,
                'locale' => 'en',
            ])->first()) {
                $eng->update([
                    'value' => $request->en,
                ]);
            } else {
                $this->model->create([
                    'key ' => $data->key,
                    'locale' => 'en',
                    'value' => $request->en,
                ]);
            }

            if ($nep = $this->model->where([
                'key' => $data->key,
                'locale' => 'np',
            ])->first()) {
                $nep->update([
                    'value' => $request->np,
                ]);
            } else {
                $this->model->create([
                    'key ' => $data->key,
                    'locale' => 'np',
                    'value' => $request->np,
                ]);
            }

            DB::commit();

            return $this->updateMessage('Language update successful.');
        } catch (\Exception $e) {
            DB::rollBack();

            return $this->returnServerError();
        }
    }

    public function servicefindById($id)
    {
        return $this->returnData($this->model->findOrFail($id));
    }

    public function servicedelete($id)
    {
        DB::beginTransaction();
        try {
            $data = $this->servicefindById($id)['data'];
            $this->model->where('key', $data->key)->delete();
            DB::commit();

            return $this->deleteMessage('Language delete successful.');
        } catch (\Exception $e) {
            DB::rollBack();

            return $this->returnServerError();
        }
    }

    public function servicefilter($query)
    {
        if (request('key')) {
            $query = $query->where('key', 'like', '%'.request('key').'%');
        }

        if (request('english')) {
            $query = $query->where('value', 'like', '%'.request('english').'%');
        }

        if (request('nepali')) {
            $query = $query->where('value', 'like', '%'.request('nepali').'%');
        }

        return $query;
    }

    public function servicedataValidationArray($data = [])
    {
        return [
            'key' => 'required|max:255|unique:languages,key',
            'en' => 'required|max:255',
            'np' => 'required|max:255',
        ];
    }

    public function servicefillable(Request $request, $language = 'en', $row = null)
    {
        $all = $request->only(['key']);
        $all['locale'] = $language;
        $all['value'] = request($language);

        return $all;
    }
}
