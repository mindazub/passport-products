<?php

declare(strict_types = 1);

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Role;
use App\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

/**
 * Class UserController
 * @package App\Http\Controllers
 */
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index(): View
    {
        $roles = Role::all();
        $users = User::query()->paginate();

        return view('users.index', compact('users', 'roles'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return View
     */
    public function edit(int $id): View
    {

        $roles = Role::all();
        $user = User::query()->findOrFail($id);

        return view('users.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UserRequest $request
     * @param  int $id
     * @return RedirectResponse
     */
    public function update(UserRequest $request, $id): RedirectResponse
    {
        $user = User::findOrFail($id);
        $user->update($request->toArray());

        $user->roles()->sync($request->getRoleIds());

        return redirect()->route('user.index')
            ->with('status', 'User updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return RedirectResponse
     * @throws \Exception
     */
    public function destroy($id): RedirectResponse
    {
        User::query()->findOrFail($id)->delete();

        return redirect()->route('user.index')
            ->with('status', 'User deleted successfully!');
    }
}
