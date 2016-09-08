<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Event;
use App\Category;
use App\EventType;

class AdminController extends Controller {

	/**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    public function index() {
        $data['tasks'] = [
                [
                        'name' => 'Design New Dashboard',
                        'progress' => '87',
                        'color' => 'danger'
                ],
                [
                        'name' => 'Create Home Page',
                        'progress' => '76',
                        'color' => 'warning'
                ],
                [
                        'name' => 'Some Other Task',
                        'progress' => '32',
                        'color' => 'success'
                ],
                [
                        'name' => 'Start Building Website',
                        'progress' => '56',
                        'color' => 'info'
                ],
                [
                        'name' => 'Develop an Awesome Algorithm',
                        'progress' => '10',
                        'color' => 'success'
                ]
        ];
        return view('admin/test')->with($data);
    }

}