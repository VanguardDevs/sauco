<?php

namespace App\Http\Controllers;

use App\Models\AccountingAccount;
use Illuminate\Http\Request;

class AccountingAccountController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:super-admin')
            ->only('destroy');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = AccountingAccount::latest()
            ->withCount('concepts');
        $results = $request->perPage;

        if ($request->has('filter')) {
            $filters = $request->filter;

            if (array_key_exists('name', $filters)) {
                $query->whereLike('name', $filters['name']);
            }
        }

        return $query->paginate($results);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $accountingAccount = AccountingAccount::create($request->input());

        return $accountingAccount;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\AccountingAccount  $accountingAccount
     * @return \Illuminate\Http\Response
     */
    public function show(AccountingAccount $accountingAccount)
    {
        return $accountingAccount;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\AccountingAccount  $accountingAccount
     * @return \Illuminate\Http\Response
     */
    public function update(AccountingAccountsValidateRequest $request, AccountingAccount $accountingAccount)
    {
        $accountingAccount->update($request->input());

        return $accountingAccount;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\AccountingAccount  $accountingAccount
     * @return \Illuminate\Http\Response
     */
    public function destroy(AccountingAccount $accountingAccount)
    {
        $accountingAccount->delete();

        return $accountingAccount;
    }
}
