<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Auth\Events\Verified;
use Illuminate\Http\Request;

class VerificationController extends GenesisController
{
    //
    public function verifyAndRedirect(Request $request, $id, $hash)
    {
        $user = User::findOrFail($id);

        if (! hash_equals((string) $hash, sha1($user->getEmailForVerification()))) {
            abort(403);
        }

        if ($user->hasVerifiedEmail()) {
            return redirect()->route('login.index')->with('already_verified', true);
        }

        $user->markEmailAsVerified();

        event(new Verified($user));

        return redirect()->route('login.index')->with('verified', true);
    }
}
