<?php

namespace App\Http\Controllers;

use App\BankAccount;
use App\BankAccountType;
use App\Http\Requests\BankAccounts\BankAccountsCreateFormRequest;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class BankAccountController extends Controller
{
    public function __construct()
    {
        return $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('modules.bank-accounts.index');
    }

    public function list()
    {
        $query = BankAccount::query()
            ->with('bankAccountType');

        return DataTables::eloquent($query)->toJson();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('modules.bank-accounts.register')
            ->with('accountTypes', BankAccountType::get())
            ->with('typeForm', 'create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BankAccountsCreateFormRequest $request)
    {
        // dd($request->input());
        $create = new BankAccount([
            'bank_name' => $request->input('bank_name'),
            'bank_account_type_id' => $request->input('account_type'),
            'account_num' => $request->input('account_num'),
            'description' => $request->input('description'),
            'budget_account' => $request->input('budget_account'),
            'accounting_account' => $request->input('accounting_account'),
        ]);
        $create->save();

        return redirect('settings/bank-accounts')->withSuccess('¡Cuenta bancaria agregada!');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\BankAccount  $bankAccount
     * @return \Illuminate\Http\Response
     */
    public function show(BankAccount $bankAccount)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\BankAccount  $bankAccount
     * @return \Illuminate\Http\Response
     */
    public function edit(BankAccount $bankAccount)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\BankAccount  $bankAccount
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BankAccount $bankAccount)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\BankAccount  $bankAccount
     * @return \Illuminate\Http\Response
     */
    public function destroy(BankAccount $bankAccount)
    {
        $bankAccount->delete();
    }
}
