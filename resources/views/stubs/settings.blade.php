<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">General Setting</h3>
                    </div>

                    <form>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="appName">App Display Name</label>
                                <input type="text" class="form-control" id="appName" placeholder="Enter app display name">
                            </div>
                            <div class="form-group">
                                <label for="dateFormat">Date Format</label>
                                <select class="form-control">
                                    <option value="MM/DD/YYYY">MM/DD/YYYY</option>
                                    <option value="DD/MM/YYYY">DD/MM/YYYY</option>
                                    <option value="YYYY-MM-DD">YYYY-MM-DD</option>
                                    <option value="Month DD, YYYY">Month DD, YYYY</option>
                                    <option value="DD Month YYYY">DD Month YYYY</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="paginationLimit">Pagination Limit</label>
                                <input type="text" class="form-control" id="paginationLimit" placeholder="Enter pagination limit">
                            </div>
                        </div>

                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-save mr-1"></i>Save Changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
