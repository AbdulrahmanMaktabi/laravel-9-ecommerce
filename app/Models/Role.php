<?php

namespace App\Models;

use App\Facades\Loggy;
use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class Role extends Model
{
    use HasFactory;

    protected $guarded = ['created_at', 'updated_at', 'id'];

    public static function createWithAbilities(Request $request)
    {
        $request->validate([
            'name'          => ['required', 'string'],
            'abilities'     => ['required', 'array']
        ]);

        DB::beginTransaction();

        $role = Role::create(['name'            => $request->input('name')]);

        try {

            foreach ($request->input('abilities') as $ability_key => $ability) {
                RoleAbility::create([
                    'role_id'       => $role->id,
                    'ability'       => $ability_key,
                    'type'          => $ability

                ]);
            }

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            Loggy::error($e->getMessage());
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function updateWithAbilities(Request $request)
    {
        $request->validate([
            'name'          => ['nullable', 'string'],
            'abilities'     => ['required', 'array']
        ]);

        DB::beginTransaction();

        if ($request->input('name'))
            $this->update(['name'           => $request->input('name')]);

        try {

            foreach ($request->input('abilities') as $ability_key => $ability) {
                RoleAbility::updateOrCreate([
                    'role_id'       => $this->id,
                    'ability'       => $ability_key
                ], ['type'          =>  $ability]);
            }

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            Loggy::error($e->getMessage());
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
