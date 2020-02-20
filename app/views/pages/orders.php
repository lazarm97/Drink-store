
        
        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
          <h2 class="mb-md-3"><?= $title ?></h2>
          <div class="table-responsive">
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
              <p></p>
            </div>
            <table id="tableOrders" class="table table-striped table-sm">
              <thead>
                <tr>
                  <th></th>
                  <th>Product</th>
                  <th>Customer</th>
                  <th>Quantity</th>
                  <th>Date</th>
                  <th>Price per liter</th>
                </tr>
              </thead>
              <tbody id="bodyOrders">
                <?php foreach($orders as $order): ?>
                  <tr class="order-tr <?php if($order->delivered == 1){echo "delivered-success";}?>" data-id=<?= $order->Id ?>>
                    <td><input type="checkbox" class="chbOrders" data-id=<?= $order->Id ?>></td>
                    <td><?= $order->Products ?></td>
                    <td><?= $order->Customer ?></td>
                    <td><?= $order->Quantity ?></td>
                    <td><?= $order->Date ?></td>
                    <td><?= $order->Price ?></td>
                  </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
            
            <button type="button" id="btnDeliveredOrder" class="btn btn-success">Success delivered</button>
            <button type="button" id="btnNoDelivredOrder" class="btn btn-danger">Not delivered</button>
          </div>
        </main>



      </div>
    </div>