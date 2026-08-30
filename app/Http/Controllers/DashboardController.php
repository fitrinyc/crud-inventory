<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Training;
use App\Models\Certificate;

class DashboardController extends Controller {
    public function index($locale = 'id') {
        // dummy check
        return view('dashboard.index');
    }
}