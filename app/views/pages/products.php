
        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
          <h2 class="mb-md-3"><?= $title ?></h2>
          <div class="table-responsive">
            <div class="alert alert-primary alert-dismissible fade show" role="alert">
              <p></p>
            </div>
            <table class="table table-striped table-sm">
              <thead>
                <tr>
                  <th></th>
                  <th>Products</th>
                  <th>Stock</th>
                  <th>Price</th>
                </tr>
              </thead>
              <tbody id="bodyProducts">
                <?php foreach($products as $product): ?>
                  <tr class="product-tr" data-id=<?= $product->id ?>>
                    <td><input type="checkbox" class="chbProducts" data-id=<?= $product->id ?>></td>
                    <td><?= $product->name ?></td>
                    <td><?= $product->stock ?></td>
                    <td><?= $product->price ?></td>
                  </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
            
            <button type="button" id="btnInsertProduct" class="btn btn-primary">New product</button>
            <button type="button" id="btnUpdateProduct" class="btn btn-success">Edit product</button>
            <button type="button" id="btnDeleteProduct" class="btn btn-danger">Delete products</button>

            <form class="edit-form">
              <div class="form-group">
                <label for="productName">Product name</label>
                <input type="text" class="form-control" id="productName" placeholder="Enter product name" required>
              </div>
              <div class="form-group">
                <label for="productStock">Product stock</label>
                <input type="text" class="form-control" id="productStock" placeholder="Enter product stock" required>
              </div>
              <div class="form-group">
                <label for="productPrice">Product price</label>
                <input type="text" class="form-control" id="productPrice" placeholder="Enter product price in format 123,00" required>
              </div>
              <div class="form-group">
                <label for="productImage">Product image</label>
                <input type="file" id="productImage" name="productImage" onchange="uploadImg()">
                <span id="uploaded_img"></span>
              </div>
              <div class="form-group">
                <label for="productDescription">Product description</label>
                <textarea class="form-control" id="productDescription" rows="3" spellcheck="false" required></textarea>
              </div>
              <button type="button" class="btn btn-primary">Save product</button>
          </form>
          </div>
        </main>



      </div>
    </div>