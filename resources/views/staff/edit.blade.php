<form action="{{ route('edit.save', $staffdetails->id)}}" method="post" enctype="multipart/form-data" >
        @csrf
        <input type="hidden" id="edit_id" value="{{$staffdetails->id}}">
    <div class="row">
        <label  for="name">Name</label>
        <input type="text" class="form-control" id="name" name="name" value="{{ $staffdetails->name }}" >
            <!-- @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror -->
            @error('name')
                <div class="error">{{ $message }}</div>
            @enderror
    </div>
    <div class="row mt-2">
        <label  for="contact_no">Contact no</label>
        <input type="text" class=" form-control" id="contact_no" name="contact_no" value="{{ $staffdetails->contact_no }}">
        @error('contact_no')
                <div class="error">{{ $message }}</div>
            @enderror
    </div>
    <div class="row mt-2">
        <label  for="contact_no">Hobby</label>
        <div class="row mt-5">
            <input type="checkbox" id="hobby_1" name="hobby[]" value="Programming" @foreach ($staffdetails->hobby as $ho)
            {{$ho->name=="Programming"?"checked":""}}
            @endforeach >
            <label for="hobby_1"> Programming</label><br>
            <input type="checkbox" id="hobby_2" name="hobby[]" value="Playing Games" @foreach ($staffdetails->hobby as $ho) {{$ho->name=="Playing Games"?"checked":""}}    @endforeach >
            <label for="hobby_2"> Playing Games</label><br>
            <input type="checkbox" id="hobby_3" name="hobby[]" value="Reading books" @foreach ($staffdetails->hobby as $ho) {{$ho->name=="Reading books"?"checked":""}} @endforeach>
            <label for="hobby_3"> Reading books</label><br>
            <input type="checkbox" id="hobby_4" name="hobby[]" value="Photography" @foreach ($staffdetails->hobby as $ho) {{$ho->name=="Photography"?"checked":""}} @endforeach>
            <label for="hobby_4"> Photography</label><br>
            <input type="checkbox" id="hobby_5" name="hobby[]" value="Singing" @foreach ($staffdetails->hobby as $ho) {{$ho->name=="Singing"?"checked":""}} @endforeach>
            <label for="hobby_5"> Singing</label><br>  
        </div>
    </div>
    <div class="row mt-2">
        <label  for="category_id">Category</label>
            <select class=" form-control custom-select dark" id="category_id" name="category_id" focus>
                <option value="" disabled selected>Select Category</option>        
                @foreach($category as $status)
                <option value="{{$status->id}}" {{ $staffdetails['category_id'] == $status['id'] ? 'selected' : ''}}>{{ $status->name }}</option>
                @endforeach
            </select>
            @error('category_id')
                <div class="error">{{ $message }}</div>
            @enderror
    </div>
    <div class="row mt-2">
        <label  for="profile_pic">Profile pic</label>
        <img src="{{ asset('storage/profile_pic/' . $staffdetails->profile_pic) }}" alt="Image" width="100px" hight="100px">
        <input type="file" class=" form-control" id="profile_pic" name="profile_pic" >
            @error('profile_pic')
                <div class="error">{{ $message }}</div>
            @enderror
    </div>
    <div class="row mt-2">
        <button type="submit" class="btn btn-primary">Save</button>
    </div>
</form>