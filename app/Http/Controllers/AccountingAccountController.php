<?php

namespace App\Http\Controllers;

use App\AccountingAccount;
use Illuminate\Http\Request;

class AccountingAccountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return response()->json(AccountingAccount::query());  
        }

        return view('modules.accounting-accounts.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('modules.accounting-accounts.register');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\AccountingAccount  $accountingAccount
     * @return \Illuminate\Http\Response
     */
    public function show(AccountingAccount $accountingAccount)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\AccountingAccount  $accountingAccount
     * @return \Illuminate\Http\Response
     */
    public function edit(AccountingAccount $accountingAccount)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\AccountingAccount  $accountingAccount
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AccountingAccount $accountingAccount)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\AccountingAccount  $accountingAccount
     * @return \Illuminate\Http\Response
     */
    public function destroy(AccountingAccount $accountingAccount)
    {
        //
    }
}
