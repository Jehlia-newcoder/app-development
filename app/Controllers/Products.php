<?php

namespace App\Controllers;

class Products extends BaseController
{
    public function index(): string
    {
        return view('products/index', [
            'products' => db_connect()->table('products_info')
                ->orderBy('product_id', 'DESC')
                ->get()
                ->getResultArray(),
        ]);
    }

    public function createForm(): string
    {
        return view('products/form', ['product' => null]);
    }

    public function create()
    {
        $data = $this->productInput();
        $rules = [
            'product_name' => 'required|max_length[255]',
            'price'        => 'required|decimal|greater_than_equal_to[0]',
            'quantity'     => 'required|integer|greater_than_equal_to[0]',
        ];

        if (! $this->validateData($data, $rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        db_connect()->table('products_info')->insert($data);

        return redirect()->to(site_url('products'))->with('success', 'Product added.');
    }

    public function edit(int $id): string|\CodeIgniter\HTTP\RedirectResponse
    {
        $product = db_connect()->table('products_info')->where('product_id', $id)->get()->getRowArray();
        if ($product === null) {
            return redirect()->to(site_url('products'))->with('error', 'Product not found.');
        }

        return view('products/form', ['product' => $product]);
    }

    public function update(int $id)
    {
        $builder = db_connect()->table('products_info');
        if ($builder->where('product_id', $id)->countAllResults() === 0) {
            return redirect()->to(site_url('products'))->with('error', 'Product not found.');
        }

        $data = $this->productInput();
        $rules = [
            'product_name' => 'required|max_length[255]',
            'price'        => 'required|decimal|greater_than_equal_to[0]',
            'quantity'     => 'required|integer|greater_than_equal_to[0]',
        ];

        if (! $this->validateData($data, $rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        db_connect()->table('products_info')->where('product_id', $id)->update($data);

        return redirect()->to(site_url('products'))->with('success', 'Product updated.');
    }

    public function delete(int $id)
    {
        $deleted = db_connect()->table('products_info')->where('product_id', $id)->delete();

        return redirect()->to(site_url('products'))->with(
            $deleted ? 'success' : 'error',
            $deleted ? 'Product deleted.' : 'Product not found.'
        );
    }

    private function productInput(): array
    {
        return [
            'product_name' => trim((string) $this->request->getPost('product_name')),
            'price'        => $this->request->getPost('price'),
            'quantity'     => $this->request->getPost('quantity'),
        ];
    }
}
