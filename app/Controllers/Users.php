<?php

namespace App\Controllers;

class Users extends BaseController
{
    public function index(): string
    {
        return view('users/index', [
            'users' => db_connect()->table('user_info')
                ->select('user_id, username')
                ->orderBy('user_id', 'DESC')
                ->get()
                ->getResultArray(),
        ]);
    }

    public function createForm(): string
    {
        return view('users/form', ['user' => null]);
    }

    public function create()
    {
        $data = $this->userInput();
        $rules = [
            'username' => 'required|min_length[3]|max_length[100]',
            'password' => 'required|min_length[8]|max_length[255]',
        ];

        $valid = $this->validateData($data, $rules);
        $usernameExists = $this->usernameExists($data['username']);
        if (! $valid || $usernameExists) {
            $errors = $this->validator->getErrors();
            if ($usernameExists) {
                $errors['username'] = 'That username is already in use.';
            }

            return redirect()->back()->withInput()->with('errors', $errors);
        }

        db_connect()->table('user_info')->insert([
            'username' => $data['username'],
            'password' => password_hash($data['password'], PASSWORD_DEFAULT),
        ]);

        return redirect()->to(site_url('users'))->with('success', 'User added.');
    }

    public function edit(int $id): string|\CodeIgniter\HTTP\RedirectResponse
    {
        $user = db_connect()->table('user_info')
            ->select('user_id, username')
            ->where('user_id', $id)
            ->get()
            ->getRowArray();
        if ($user === null) {
            return redirect()->to(site_url('users'))->with('error', 'User not found.');
        }

        return view('users/form', ['user' => $user]);
    }

    public function update(int $id)
    {
        $builder = db_connect()->table('user_info');
        $user = $builder->where('user_id', $id)->get()->getRowArray();
        if ($user === null) {
            return redirect()->to(site_url('users'))->with('error', 'User not found.');
        }

        $data = $this->userInput();
        $rules = [
            'username' => 'required|min_length[3]|max_length[100]',
            'password' => 'permit_empty|min_length[8]|max_length[255]',
        ];

        $valid = $this->validateData($data, $rules);
        $usernameExists = $this->usernameExists($data['username'], $id);
        if (! $valid || $usernameExists) {
            $errors = $this->validator->getErrors();
            if ($usernameExists) {
                $errors['username'] = 'That username is already in use.';
            }

            return redirect()->back()->withInput()->with('errors', $errors);
        }

        $update = ['username' => $data['username']];
        if ($data['password'] !== '') {
            $update['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
        }

        db_connect()->table('user_info')->where('user_id', $id)->update($update);
        if ((int) session()->get('user_id') === $id) {
            session()->set('username', $data['username']);
        }

        return redirect()->to(site_url('users'))->with('success', 'User updated.');
    }

    public function delete(int $id)
    {
        if ((int) session()->get('user_id') === $id) {
            return redirect()->to(site_url('users'))->with('error', 'You cannot delete the account you are currently using.');
        }

        $db = db_connect();
        if ($db->table('user_info')->countAllResults() <= 1) {
            return redirect()->to(site_url('users'))->with('error', 'The last user account cannot be deleted.');
        }

        $deleted = $db->table('user_info')->where('user_id', $id)->delete();

        return redirect()->to(site_url('users'))->with(
            $deleted ? 'success' : 'error',
            $deleted ? 'User deleted.' : 'User not found.'
        );
    }

    private function userInput(): array
    {
        return [
            'username' => trim((string) $this->request->getPost('username')),
            'password' => (string) $this->request->getPost('password'),
        ];
    }

    private function usernameExists(string $username, ?int $exceptId = null): bool
    {
        $builder = db_connect()->table('user_info')->where('username', $username);
        if ($exceptId !== null) {
            $builder->where('user_id !=', $exceptId);
        }

        return $builder->countAllResults() > 0;
    }
}
