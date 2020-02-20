
        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
          <h2 class="mb-md-3"><?= $title ?></h2>
          <div class="table-responsive">
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
              <p></p>
            </div>
            <table class="table table-striped table-sm">
              <thead>
                <tr>
                  <th></th>
                  <th>Name</th>
                  <th>Address</th>
                  <th>Phone</th>
                </tr>
              </thead>
              <tbody id="bodyCustomer">
                <?php foreach($customers as $customer): ?>
                  <tr class="customer-tr" data-id=<?= $customer->id ?>>
                    <td><input type="checkbox" class="chbCustomer" data-id=<?= $customer->id ?>></td>
                    <td><?= $customer->name ?></td>
                    <td><?= $customer->address ?></td>
                    <td><?= $customer->phone ?></td>
                  </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
            <button type="button" id="btnInsertCustomer" class="btn btn-primary">New customer</button>
            <button type="button" id="btnUpdateCustomer" class="btn btn-success">Edit customer</button>
            <button type="button" id="btnDeleteCustomer" class="btn btn-danger">Delete customer</button>

            <form class="edit-form">
              <div class="form-group">
                <label for="customerName">Customer name</label>
                <input type="text" class="form-control" id="customerName" placeholder="Enter customer name">
              </div>
              <div class="form-group">
                <label for="customerAddress">Customer address</label>
                <input type="text" class="form-control" id="customerAddress" placeholder="Enter customer address">
              </div>
              <div class="form-group">
                <label for="customerPhone">Customer phone</label>
                <input type="text" class="form-control" id="customerPhone" placeholder="Enter customer phone">
              </div>
              <button type="button" class="btn btn-primary">Save Customer</button>
          </form>
          </div>
        </main>



      </div>
    </div>