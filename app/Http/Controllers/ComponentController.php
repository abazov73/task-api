<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreComponentRequest;
use App\Models\Characteristic;
use App\Models\Component;
use App\Services\CharacteristicService;
use App\Services\ComponentService;
use App\Services\ProtocolService;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class ComponentController extends Controller
{
    public function index()
    {
        
    }

    public function show(Component $component)
    {

    }

    public function store(StoreComponentRequest $request)
    {
        $component = ComponentService::createWithoutSaving(Arr::except($request->validated(), ['characteristics']));
        
        $characteristics = [];
        $protocols = [];

        foreach ($request->validated('characteristics') as $characteristicData)
        {
            $characteristic = CharacteristicService::createWithoutSaving($characteristicData, $component->id);
            foreach($characteristicData['protocols'] as $protocolsData)
            {
                $protocols[] = ProtocolService::createWithoutSaving($protocolsData, $characteristic->id);
            }
            $characteristics[] = $characteristic;
        }

        $component->save();
        foreach ($characteristics as $characteristic)
        {
            $characteristic->save();
        }
        foreach ($protocols as $protocol)
        {
            $protocol->save();
        }

        return response('success');
    }

    public function update(Component $component, StoreComponentRequest $request)
    {
        $now = now();
        $characteristics = [];
        $protocols = [];

        foreach ($request->validated('characteristics') as $characteristicData)
        {
            $characteristic = CharacteristicService::createWithoutSaving($characteristicData, $component->id);
            foreach($characteristicData['protocols'] as $protocolsData)
            {
                $protocols[] = ProtocolService::createWithoutSaving($protocolsData, $characteristic->id);
            }
            $characteristics[] = $characteristic;
        }

        $component->characteristics->each(function (Characteristic $item, int $key) {
            $item->protocols()->delete();
        });
        $component->characteristics()->where('created_at', '<', $now)->delete();

        $component->update(Arr::except($request->validated(), ['characteristics']));

        foreach ($characteristics as $characteristic)
        {
            $characteristic->save();
        }
        foreach ($protocols as $protocol)
        {
            $protocol->save();
        }
    }

    public function destroy(Component $component)
    {
        ComponentService::destroy($component);
        return response('success');
    }
}
