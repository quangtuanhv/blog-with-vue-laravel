<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

abstract class AbstractController extends Controller
{
    protected $repositoryName;

    protected $user;

    protected $compacts = [];

    protected $view;

    protected $repository;

    protected $dataSelect = ['*'];

    protected $lang = [
        'prefix' => 'repositories.',
        'replacements' => [],
    ];

    public function __construct($repository = null)
    {
        $this->middleware(function ($request, $next) use ($repository) {
            $this->user = Auth::guard($this->getGuard())->user();

            if ($repository) {
                $this->repositorySetup($repository);
            }

            return $next($request);
        });
    }

    public function repositorySetup($repository = null)
    {
        $this->repository = $repository->setGuard($this->getGuard());
        $this->repositoryName = strtolower(class_basename($this->repository->model()));
    }

    protected function getGuard()
    {
        return property_exists($this, 'guard') ? $this->guard : null;
    }

    public function viewRender($data = [], $view = null)
    {
        $view = $view ?: $this->view;

        $compacts = array_merge($data, $this->compacts);

        return view($this->viewPrefix . $view, $compacts);
    }

    public function trans($str = null, $data = [])
    {
        $replacements = array_merge($data, $this->lang['replacements']);

        return trans($this->lang['prefix'] . $str, $replacements);
    }

    protected function responseSuccess($fields = [])
    {
        if (empty($this->compacts)) {
            $this->compacts['status'] = true;
        }

        $data = array_merge($fields, $this->compacts);

        return response()->json($data);
    }

    protected function responseFail()
    {
        return response()->json([
            'status' => false,
        ]);
    }
}
