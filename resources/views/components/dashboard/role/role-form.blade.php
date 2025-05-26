<form action="{{ route('roles.' . $route, ['role' => $role]) }}" method="POST" class="p-3">
    @csrf
    @method($method)
    <!-- Role Name -->
    <div class="mb-3">
        <label for="name" class="form-label">Role Name</label>
        <input type="text" name="name" id="name" class="form-control" value="{{ $role->name ?? old('name') }}"
            required>
        @error('name')
            <div class="invalid-feedback d-block">{{ $message }}</div>
        @enderror
    </div>

    <!-- Abilities with Radio Options -->
    <div class="mb-3">
        <label class="form-label">Abilities</label>
        <div class="table-responsive">
            <table class="table table-bordered align-middle">
                <thead>
                    <tr>
                        <th>Ability</th>
                        <th class="text-center">Allow</th>
                        <th class="text-center">Deny</th>
                        <th class="text-center">Inherit</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach (config('abilities') as $ability_key => $ability)
                        <tr>
                            <td>{{ ucfirst(str_replace('_', ' ', $ability)) }}</td>
                            <td class="text-center">
                                <input type="radio" name="abilities[{{ $ability_key }}]" value="allow"
                                    @checked(isset($abilites[$ability_key]) && $abilites[$ability_key] == 'allow')>
                            </td>
                            <td class="text-center">
                                <input type="radio" name="abilities[{{ $ability_key }}]" value="deny"
                                    @checked(isset($abilites[$ability_key]) && $abilites[$ability_key] == 'deny')>
                            </td>
                            <td class="text-center">
                                <input type="radio" name="abilities[{{ $ability_key }}]" value="inherit"
                                    @checked(isset($abilites[$ability_key]) && $abilites[$ability_key] == 'inherit')>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @error('abilities')
            <div class="invalid-feedback d-block">{{ $message }}</div>
        @enderror
    </div>

    <!-- Submit -->
    <div class="card-footer">
        <button type="submit" class="btn btn-primary">{{ $button }}</button>
    </div>
</form>
