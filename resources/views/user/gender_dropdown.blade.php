{{-- Requires a \FriendsPlus\Models\User object called $user --}}

<select name="gender" class="form-control" id="gender">
  
  <option value="0">Choose Gender</option>
  
  @foreach($user->GenderOptions as $key => $value)
  <option value="{{ $key }}" {{ (old('gender') == $key) || ($user->gender == $key) ? 'selected' : '' }}>{{ $value }}</option>
  @endforeach

</select>