<?php

namespace App\Http\Controllers;

use App\Models\CategoryRelatedServices;
use App\Models\Client;
use App\Models\PortfolioItem;
use Illuminate\Http\Request;
use function unlink;
use Illuminate\Validation\Rule;

class ClientsController extends Controller
{
    //Store Data
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required | string | max: 200',
            'image' => 'required',
            'url' => 'required',
            'precedence' => 'required',
            'newposition' => 'required'
        ]);
        $clients = new Client();
        $clients->name = $request->name;
        $clients->image = $request->image;
        $clients->url = $request->url;
        $clients->precedence = $request->precedence;
        $clients->newposition = $request->newposition;
        if ($request->hasFile('image')) {
            $path = 'images/clients/';
            if (!is_dir($path)) {
                mkdir($path, 0755, true);
            }

            $image = $request->image;
            $imageName = rand(100, 1000) . $image->getClientOriginalName();
            $image->move($path, $imageName);
            $clients->image = $path . $imageName;
        }

        $exits = Client::where('precedence', $request->precedence)
            ->where('newposition', '=', $request->newposition)->first();

        if ($exits) {
            return response()->json([
                'errorMessage' => "Change the Precendence!"
            ]);
        } else {
            $clients->save();
            return response()->json([
                'clients' => $clients,
                'message' => "Data Inserted Successfully!"
            ]);
        }
    }

    //Edit Data
    public function edit($id)
    {
        $clients = Client::find($id);
        return response()->json($clients);
    }


    //Update Data
    public function updated(Request $request)
    {
        $request->validate([
            'name' => 'required | string | max: 200',
            'url' => 'required',
            'precedence' => 'required',
            'newposition' => 'required'
        ]);
        $clients = Client::find($request->category_id);
        $clients->name = $request->name;
        $clients->url = $request->url;

        if ($request->hasFile('image')) {
            $path = 'images/clients/';
            @unlink($clients->icon);
            if (!is_dir($path)) {
                mkdir($path, 0755, true);
            }

            $image = $request->image;
            $imageName = rand(100, 1000) . $image->getClientOriginalName();

            $image->move($path, $imageName);
            $clients->image = $path . $imageName;
        }
        $clients->save();
        return response()->json([
            'clients' => $clients,
            'message' => "Data Updated Successfully!"
        ]);
        $exists = Client::where('precedence', $request->precedence)
            ->where('newposition', '=', $request->newposition)->first();

        if ($exists) {
            $clients->save();
            return response()->json([
                'clients' => $clients,
                'message' => "Data Updated Successfully!"
            ]);

        } else {
            $clients->precedence = $request->precedence;
            $clients->newposition = $request->newposition;
            $clients->save();
            return response()->json([
                'clients' => $clients,
                'message' => "Data Updated Successfully!"
            ]);
        }
    }

    //Delete Data
    public function destroy(Request $request)
    {
        $clients = Client::find($request->id);
        $clients->delete();
        return response()->json('clients');
    }

    public function clientPosition($id)
    {
        $setPosition = Client::where('precedence', '=', $id)->max('newposition');
        return response()->json($setPosition);
        $setPosition = CategoryRelatedServices::where('portfolio_category_id', '=', $id)->max('position');
        return response()->json($setPosition);
    }

    public function clientPositionUpdate($id)
    {
        $setPosition = Client::where('precedence', '=', $id)->max('newposition');
        return response()->json($setPosition);
    }

    public function quickPass($id, $value)
    {
        $inputVal = $id;
        $dropDownVal = $value;
        $result = Client::where('precedence', $dropDownVal)->where('newposition', '=', $inputVal)->first();
        if ($result) {
            return response()->json([
                'result' => $result,
                'message' => "Already positioned,use another!"
            ]);
        }
    }

    public function quickPassUpdate($id, $value)
    {
        $inputVal = $id;
        $dropDownVal = $value;
        $result = Client::where('precedence', $dropDownVal)->where('newposition', '=', $inputVal)->first();
        if ($result) {
            return response()->json([
                'result' => $result,
                'message' => "Already positioned,use another!"
            ]);
        }
    }

}
