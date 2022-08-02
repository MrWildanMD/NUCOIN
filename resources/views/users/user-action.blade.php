<div class="modal-content">
    <form id="formAction" action="{{ $user->id ? route('users.update', $user->id) : route('users.store') }}"
        method="POST">
        @if ($user->id)
            @method('PUT')
        @endif
        <div class="modal-header bg-success">
            <h5 class="modal-title white" id="myModalLabel110">
                {{ $user->id ? 'Edit User' : 'Add User' }}
            </h5>
            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                <i data-feather="x"></i>
            </button>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="username">User Name</label>
                        <input type="text" class="form-control" value="{{ $user->name }}" name="name"
                            id="username" placeholder="User Name">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" value="{{ $user->email }}" name="email"
                            id="email" placeholder="Email">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" value="{{ $user->password }}" name="password"
                            id="password" placeholder="Password">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="addressArea" class="form-label">Address</label>
                        <textarea class="form-control" name="address" id="addressArea" rows="3">{{ $user->address }}
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
                <span class="d-none d-sm-block">{{ $user->id ? 'Save Changes' : 'Submit' }}</span>
            </button>
        </div>
    </form>
</div>
