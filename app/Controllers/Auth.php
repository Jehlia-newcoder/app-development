<?php

namespace App\Controllers;

class Auth extends BaseController
{
    public function login(): string|\CodeIgniter\HTTP\RedirectResponse
    {
        if (session()->has('user_id')) {
            return redirect()->to(site_url('dashboard'));
        }

        return view('auth/login');
    }

    public function attempt()
    {
        $username = trim((string) $this->request->getPost('username'));
        $password = (string) $this->request->getPost('password');
        $user = db_connect()->table('user_info')
            ->where('username', $username)
            ->get()
            ->getRowArray();

        if ($user === null || ! $this->passwordIsValid($password, (string) $user['password'])) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'The username or password is incorrect.');
        }

        if (password_get_info((string) $user['password'])['algo'] === null
            || password_needs_rehash((string) $user['password'], PASSWORD_DEFAULT)) {
            db_connect()->table('user_info')
                ->where('user_id', $user['user_id'])
                ->update(['password' => password_hash($password, PASSWORD_DEFAULT)]);
        }

        session()->regenerate(true);
        session()->set([
            'user_id'  => (int) $user['user_id'],
            'username' => (string) $user['username'],
        ]);

        return redirect()->to(site_url('dashboard'));
    }

    public function logout()
    {
        session()->destroy();

        return redirect()->to(site_url('login'));
    }

    private function passwordIsValid(string $password, string $storedPassword): bool
    {
        if (password_verify($password, $storedPassword)) {
            return true;
        }

        return password_get_info($storedPassword)['algo'] === null
            && hash_equals($storedPassword, $password);
    }
}
