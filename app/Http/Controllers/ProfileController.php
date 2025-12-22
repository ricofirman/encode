<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class ProfileController extends Controller
{
    // Show profile page
    public function index()
    {
        if (!Session::has('is_logged_in')) {
            return redirect('/login');
        }
        
        $user = User::find(Session::get('user_id'));
        return view('pages.profile', compact('user'));
    }
    
    // Change name
    public function changeName(Request $request)
    {
        if (!Session::has('is_logged_in')) {
            return response()->json(['success' => false, 'message' => 'Please login first']);
        }
        
        $request->validate([
            'name' => 'required|string|max:255'
        ]);
        
        $user = User::find(Session::get('user_id'));
        $oldName = $user->name;
        $user->name = $request->name;
        $user->save();
        
        // Update session
        Session::put('user_name', $user->name);
        
        return response()->json([
            'success' => true,
            'message' => 'Name changed from "' . $oldName . '" to "' . $user->name . '"',
            'new_name' => $user->name
        ]);
    }
    
    // Change password
    public function changePassword(Request $request)
    {
        if (!Session::has('is_logged_in')) {
            return response()->json(['success' => false, 'message' => 'Please login first']);
        }
        
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:6|confirmed'
        ]);
        
        $user = User::find(Session::get('user_id'));
        
        // Check current password
        if (!Hash::check($request->current_password, $user->password)) {
            return response()->json([
                'success' => false,
                'message' => 'Current password is incorrect'
            ]);
        }
        
        // Update password
        $user->password = Hash::make($request->new_password);
        $user->save();
        
        return response()->json([
            'success' => true,
            'message' => 'Password changed successfully'
        ]);
    }
}