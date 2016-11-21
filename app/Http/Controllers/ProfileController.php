<?php

namespace Chatty\Http\Controllers;

use Auth;
use Chatty\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function getProfile($username){
		$user = User::where('username', $username)->firstOrFail();

		return view('profile.index')
			->withUser($user);
	}

	public function getEdit(){
		return view('profile.edit');
	}

	public function postEdit(Request $request){
		$this->validate($request, [
			'firstname'	=> 'alpha|max:40',
			'lastname' 	=> 'alpha|max:40',
			'location' 	=> 'max:20',
		]);

		Auth::user()->update([
			'firstname'	=> $request->firstname,
			'lastname' 	=> $request->lastname,
			'location' 	=> $request->location,
		]);

		return redirect()
			->route('profile.edit')
			->withAlert('Your profile has been updated.');
	}
}
