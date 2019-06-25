<?php

namespace Shahnewaz\Redprint\Http\Controllers;

use DB;
use Redprint;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Shahnewaz\Redprint\Services\BuilderService;
use Shahnewaz\Redprint\Services\MigratorService;
use Shahnewaz\Redprint\Http\Requests\BuilderRequest;

class BuilderController extends Controller
{
    public function index () {
        $dataTypes = Redprint::dataTypes();
        return view('redprint::redprint.builder.index')->withDataTypes($dataTypes);
    }

    public function build (BuilderRequest $request) {
        $builder = new BuilderService($request);
        $response = $builder->buildFromRequest($request);
        return response()->json(['route' => '/backend/'.$response]);
    }

    public function buildVerbose (Request $request) {
        $builder = new BuilderService($request);
        $response = $builder->buildFromRequest($request);
    }

    public function rollback(Request $request)
    {
        $migrator = new MigratorService($request);
        $response = $migrator->rollback();
        return response()->json(['rollback' => true, 'response' => $response]);
    }
}
