<div class="modal-content">
    <form id="formAction" action="{{ $role->id ? route('roles.update', $role->id) : route('roles.store') }}"
        method="POST">
        @if ($role->id)
            @method('PUT')
        @endif
        <div class="modal-header bg-success">
            <h5 class="modal-title white" id="myModalLabel110">
                {{ $role->id ? 'Edit Role' : 'Add Role' }}
            </h5>
            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                <i data-feather="x"></i>
            </button>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="roleName">Role Name</label>
                        <input type="text" class="form-control" value="{{ $role->name }}" name="name"
                            id="roleName" placeholder="Role Name">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="guardName">Guard Name</label>
                        <input type="text" class="form-control" value="{{ $role->guard_name }}" name="guard_name"
                            id="guardName" placeholder="Guard Name">
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
                <span class="d-none d-sm-block">{{ $role->id ? 'Save Changes' : 'Submit' }}</span>
            </button>
        </div>
    </form>
</div>
