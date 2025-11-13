<?php
namespace App\Controllers;

use App\Models\Club;

class ClubController extends Controller
{
    public function index(): void
    {
        $clubs = Club::all();
        $this->view('clubs/index', ['clubs' => $clubs]);
    }
}
