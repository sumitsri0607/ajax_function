<form action="{{ route('add')}}" method="post" enctype="multipart/form-data">
        @csrf
    <div class="row">
        <label  for="name">Name</label>
        <input type="text" class="form-control" id="name" name="name" >
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
        <input type="text" class=" form-control" id="contact_no" name="contact_no" >
        @error('contact_no')
                <div class="error">{{ $message }}</div>
            @enderror
    </div>
    <div class="row mt-2">
        <label  for="contact_no">Hobby</label>
        <div class="row mt-5">
            <input type="checkbox" id="hobby_1" name="hobby[]" value="Programming">
            <label for="hobby_1"> Programming</label><br>
            <input type="checkbox" id="hobby_2" name="hobby[]" value="Playing Games">
            <label for="hobby_2"> Playing Games</label><br>
            <input type="checkbox" id="hobby_3" name="hobby[]" value="Reading books">
            <label for="hobby_3"> Reading books</label><br>
            <input type="checkbox" id="hobby_4" name="hobby[]" value="Photography">
            <label for="hobby_4"> Photography</label><br>
            <input type="checkbox" id="hobby_5" name="hobby[]" value="Singing">
            <label for="hobby_5"> Singing</label><br>  
        </div>
    </div>
    <div class="row mt-2">
        <label  for="category_id">Category</label>
            <select class=" form-control custom-select dark" id="category_id" name="category_id" focus>
                <option value="" disabled selected>Select Category</option>        
                @foreach($category as $status)
                <option value="{{$status->id}}">{{ $status->name }}</option>
                @endforeach
            </select>
            @error('category_id')
                <div class="error">{{ $message }}</div>
            @enderror
    </div>
    <div class="row mt-2">
        <label  for="profile_pic">Profile pic</label>
        <input type="file" class=" form-control" id="profile_pic" name="profile_pic" >
            @error('profile_pic')
                <div class="error">{{ $message }}</div>
            @enderror
    </div>
    <div class="row mt-2">
        <button type="submit" class="btn btn-primary">Save</button>
    </div>
</form>