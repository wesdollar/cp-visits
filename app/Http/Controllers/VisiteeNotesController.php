<?php

namespace App\Http\Controllers;

use App\Visitee;
use Illuminate\Http\Request;

use App\Http\Requests;

class VisiteeNotesController extends Controller
{
    public function index($visiteeId) {

        $visitee = Visitee::findOrFail($visiteeId);
        $header = 'Visitor Notes';

        return view('visitees.notes', compact('visitee', 'header'));
    }
}
