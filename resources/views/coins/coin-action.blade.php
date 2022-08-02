<div class="modal-content">
    <form id="formAction" action="{{ $coin->id ? route('coins.update', $coin->id) : route('coins.store') }}"
        method="POST">
        @if ($coin->id)
            @method('PUT')
        @endif
        <div class="modal-header bg-success">
            <h5 class="modal-title white" id="myModalLabel110">
                {{ $coin->id ? 'Edit Coin' : 'Add Coin' }}
            </h5>
            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                <i data-feather="x"></i>
            </button>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-md-6">
                    <label>Coin Amount</label>
                    <div class="input-group">
                        <span class="input-group-text" id="amount">Rp.</span>
                        <input type="number" class="form-control" name="amount" value="{{ $coin->amount }}"
                            placeholder="Amount Rp." aria-label="amount" aria-describedby="amount" id="inputamount">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="coindate">Coin Date</label>
                        <input type="date" class="form-control" value="{{ $coin->coin_date }}" name="coin_date"
                            id="coindate" placeholder="Coin Date">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="user_id" class="form-label">From User</label>
                        <select class="choices form-select" name="user_id" id="user_id">
                            <option selected>--Select User--</option>
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="donator_id" class="form-label">Donator</label>
                        <select class="choices form-select" name="donator_id" id="donator_id">
                            <option selected>--Select Donator--</option>
                            @foreach ($donators as $donator)
                                <option value="{{ $donator->id }}">{{ $donator->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="mb-3">
                        <label for="formFile" class="form-label">Proof</label>
                        <input class="form-control" type="file" id="formFile" name="proof">
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
                <span class="d-none d-sm-block">{{ $coin->id ? 'Save Changes' : 'Submit' }}</span>
            </button>
        </div>
    </form>
</div>
