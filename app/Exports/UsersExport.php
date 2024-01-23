<?php

namespace App\Exports;

use App\Models\Affiliation;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
// use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;

class UsersExport implements FromView
{
    use Exportable;
    private $destrict;
    private $search;

    public function __construct(string $destrict = null, string $search = null)
    {
        $this->destrict = $destrict;
        $this->search = $search;
    }

    public function view(): View
    {
        $members = User::query();
        if (Auth::user()->type == 3) {
            $destrict_auth = Auth::user()->affiliations;
            $members = $members->where("affiliations", "=", $destrict_auth)
                ->where(["type" => 1])->latest();
        }

        if (request('destrict') && request('destrict') != null) {
            $members = $members->where("affiliations", "=", $this->destrict);
        }

        if (request('search')) {
            $members = $members->where('name', 'LIKE', "%{$this->search}%")
                ->orWhere('father_name', 'LIKE', "%{$this->search}%")
                ->orWhere('city', 'LIKE', "%{$this->search}%");
        }
        
        return view('exports.users', [
            'users' => $members->get()
        ]);
    }

    public function query()
    {
    }
}
