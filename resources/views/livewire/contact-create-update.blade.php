<div class="p-5">
    <h1>Contact List</h1>

    <form class="w-100" wire:submit.prevent="save">

        <div class="d-flex flex-row w-100 gap-4">
            <div class="flex-grow-1">
                <div class="form-group">
                    <label for="exampleFormControlInput1">Full Name</label>
                    <input type="input" wire:model="name" class="form-control">
                    @error('name') <span class="error">The Full name is required.</span> @enderror
                </div>

                <div class="form-group">
                    <label for="exampleFormControlInput1">Email</label>
                    <input type="email" wire:model="email" class="form-control">
                    @error('email') <span class="error">The Email is required.</span> @enderror
                </div>

                <div class="form-group">
                    <label for="exampleFormControlInput1">Contact Number</label>
                    <input type="input" wire:model="contactnumber" class="form-control">
                    @error('contactnumber') <span class="error">The Contact Number is required.</span> @enderror
                </div>

                <div class="form-group">
                    <label for="exampleFormControlTextarea1">Address</label>
                    <textarea class="form-control" wire:model="address" id="exampleFormControlTextarea1" rows="3"></textarea>
                    @error('address') <span class="error">The Contact Number is required</span> @enderror
                </div>

                <div class="form-group">
                    <label for="exampleFormControlTextarea1">Notes</label>
                    <textarea class="form-control" wire:model="notes" id="exampleFormControlTextarea1" rows="3"></textarea>
                    @error('address') <span class="error">The Address is required</span> @enderror
                </div>

                <button type="submit" class="btn btn-primary">Save</button>
                <button type="button" class="btn btn-secondary">Cancel</button>
            </div>


            <div class="form-group d-flex flex-column justify-content-center align-items-center">
                <label for="image">Select Image</label>
                <input type="file" wire:model="image" class="form-control-file" id="image">
                @error('image') <span class="text-danger">{{ $message }}</span> @enderror
                <div class="mt-2" style="height: 200px; width: 300px;">
                    @if($imagePreviewUrl)
                    <img class="w-100 h-100" style="object-fit: cover; object-position:center;" src="{{ $imagePreviewUrl }}" alt="Image">
                    @endif
                </div>
            </div>

        </div>



    </form>





</div>