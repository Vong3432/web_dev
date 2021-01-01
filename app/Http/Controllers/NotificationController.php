<?php

namespace App\Http\Controllers;

use App\Models\Notifications;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index() {
        return Notifications::orderBy('created_at', 'DESC')->get();
    }
}
