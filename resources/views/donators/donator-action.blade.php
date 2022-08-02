<div class="modal-content">
    <form id="formAction" action="{{ $donator->id ? route('donators.update', $donator->id) : route('donators.store') }}"
        method="POST">
        @if ($donator->id)
            @method('PUT')
        @endif
        <div class="modal-header bg-success">
            <h5 class="modal-title white" id="myModalLabel110">
                {{ $donator->id ? 'Edit Donator' : 'Add Donator' }}
            </h5>
            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                <i data-feather="x"></i>
            </button>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="donatorName">Donator Name</label>
                        <input type="text" class="form-control" value="{{ $donator->name }}" name="name"
                            id="donatorName" placeholder="Donator Name">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="donatorPhone">Donator Phone</label>
                        <input type="number" class="form-control" value="{{ $donator->phone }}" name="phone"
                            id="donatorPhone" placeholder="Donator Phone">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="donatorAddress" class="form-label">Donator Address</label>
                        <textarea class="form-control" name="address" id="donatorAddress" rows="3">{{ $donator->address }}
                        </textarea>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                <i class="bx bx-x d-block d-sm-none"></i>
                <span class="d-none d-sm-block">Close</span>
            </button>

            <button type="submit" class="btn btn-success ml-1">
                <i class="bx bx-check d-block d-sm-none"></i>
                <span class="d-none d-sm-block">{{ $donator->id ? 'Save Changes' : 'Submit' }}</span>
            </button>
        </div>
    </form>
</div>
