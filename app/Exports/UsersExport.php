<?php

namespace App\Exports;

use App\Models\Affiliation;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;

class UsersExport implements FromView
{
    use Exportable;
    private $destrict;
    private $search;
    private $constituency;
    private $unioncouncil;
    private $ward; 

    public function __construct(string $destrict = null, string $search = null, string $constituency= null, string $unioncouncil = null, string $ward = null )
    {
        $this->destrict = $destrict;
        $this->search = $search;
        $this->constituency = $constituency;
        $this->unioncouncil = $unioncouncil;
        $this->ward = $ward; 
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
       
        if (request('constituency') && request('constituency') != null) {
            $members = $members->where("constituency", "=", $this->constituency);
        }
        if (request('unioncouncil') && request('unioncouncil') != null) {
            $members = $members->where("union_council", "=", $this->unioncouncil);
        }
        if (request('ward') && request('ward') != null) {
            $members = $members->where("ward", "=", $this->ward);
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
}
