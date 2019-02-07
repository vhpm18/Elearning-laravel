<?php

namespace App\Http\Controllers;

use App\Entities\Role;
use App\Entities\Teacher;
use Illuminate\Support\Facades\DB;

class SolicitudeController extends Controller
{
    public function teacher()
    {
        $user = auth()->user();
        if (!$user->teacher) {
            try {
                DB::beginTransaction();
                $user->role_id = Role::TEACHER;
                Teacher::create(['user_id' => $user->id]);
                $success = true;
            } catch (Exception $e) {
                DB::rollback();
                $success = $e->getMessage();
            }
            if ($success === true) {
                DB::commit();
                auth()->logout();
                auth()->loginUsingId($user->id);
                return back()->with('message', ['success', __("Felicidades ya eres instructor en la plataforma")]);
            }
            return back()->with('message', ['danger', $success]);
        }
        return back()->with('message', ['danger', __("Algo ha fallado")]);

    }
}
