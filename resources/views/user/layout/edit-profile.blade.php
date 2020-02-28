<form method="POST" action="{{url("test/profile")}}">
    @csrf
    @include("bootstrap.form.select", ['name'=>'contry','label'=>'Pays','list'=>App\Services\Liste::GetContry(),'value' => $user->profile->location ?? 'default'])
    @include('bootstrap.form.select',array('name'=>'sexe','label'=>'Gendre','list'=>App\Services\Liste::GetSexe(),'value' => $user->profile->sexe))
    <div class="form-group">
        <label for="inputAddress">Address</label>
        <input name="inputAddress" type="text" class="form-control" id="inputAddress" placeholder="1234 Main St">
    </div>
    <div class="form-group">
        <label for="inputAddress2">Address 2</label>
        <input name="inputAddress2" type="text" class="form-control" id="inputAddress2"
               placeholder="Apartment, studio, or floor">
    </div>
    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="inputCity">City</label>
            <input name="inputCity" type="text" class="form-control" id="inputCity">
        </div>
        <div class="form-group col-md-4">
            <label for="inputState">State</label>
            <select name="inputState" id="inputState" class="form-control">
                <option selected>Choose...</option>
                <option value="alpha">alpha</option>
                <option value="beta">beta</option>
                <option value="omega">omega</option>
            </select>
        </div>
        <div class="form-group col-md-2">
            <label for="inputZip">Zip</label>
            <input name="inputZip" type="text" class="form-control" id="inputZip">
        </div>
    </div>
    <div class="form-group">
        <div class="form-check">
            <input name="gridCheck" class="form-check-input" type="checkbox" id="gridCheck">
            <label class="form-check-label" for="gridCheck">
                Check me out
            </label>
        </div>
    </div>
    <button type="submit" class="btn btn-primary">Sign in</button>
</form>
