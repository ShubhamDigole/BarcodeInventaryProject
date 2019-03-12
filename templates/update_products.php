<!-- Modal -->
<div class="modal fade" id="form_products" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add new products</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="update_product_form" onsubmit="return false">
          <div class="form-row">
            <div class="form-group col-md-6">
              <input type="hidden" name="pid" id="pid" value=""/>
              <label>Date</label>
              <input type="text" class="form-control" name="added_date" id="added_date" value="<?php echo date("Y-m-d"); ?>" readonly/>
            </div>
            <div class="form-group col-md-6">
              <label>Product Name</label>
              <input type="text" class="form-control" name="update_product" id="update_product" placeholder="Enter Product Name" required>
            </div>
          </div>
          <div class="form-group">
            <label>Category</label>
            <select class="form-control" id="select_cat" name="select_cat" required/>
              

              
            </select>
          </div>
          <div class="form-group">
            <label>Brand</label>
            <select class="form-control" id="select_brand" name="select_brand" required/>
              

              
            </select>
          </div>
          <div class="form-group">
            <label>Product Price (MRP)</label>
            <input type="text" class="form-control" id="product_price" name="product_price" placeholder="Enter Price of Product" required/>
          </div>
          <div class="form-group">
            <label>Product Price (Sell)</label>
            <input type="text" class="form-control" id="product_price_sell" name="product_price_sell" placeholder="Enter Price of Product" required/>
          </div>
          <div class="form-group">
            <label>Change Quantity in Godown Stock</label>
            <input type="text" class="form-control" id="product_qty" name="product_qty" placeholder="Enter Quantity" required/>
          </div>
          <div class="form-group">
            <label>Change Quantity in Shop Stock</label>
            <input type="text" class="form-control" id="products_qty" name="products_qty" placeholder="Enter Quantity" required/>
          </div>
          <button type="submit" class="btn btn-success">Update Product</button>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="update_shop" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add new products</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="update_store_stock" onsubmit="return false">
          <div class="form-row">
            <div class="form-group col-md-6">
              <input type="hidden" name="pid" id="pid" value=""/>
              <label>Date</label>
              <input type="text" class="form-control" name="added_date" id="added_date" value="<?php echo date("Y-m-d"); ?>" readonly/>
            </div>
            <div class="form-group">
            <label>Add Quantity in Stock</label>
            <input type="text" class="form-control" id="psdata" name="psdata" placeholder="Enter Quantity" required/>
          </div>
          
            <input type="hidden" class="form-control" id="psdatao" name="psdatao" placeholder="Enter Quantity" required/>
          
         
         
            <input type="hidden" class="form-control" id="product_qty" name="product_qty" placeholder="Enter Quantity" required/>
         
           
            <input type="hidden" class="form-control" id="remain" name="remain" placeholder="Enter Quantity" required/>
          

          <button type="submit" class="btn btn-success">Update Product</button>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
</div>


<div class="modal fade" id="updates" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add new products</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="update_god_stock" onsubmit="return false">
          <div class="form-row">
            <div class="form-group col-md-6">
              <input type="hidden" name="pid" id="pid" value=""/>
              <label>Date</label>
              <input type="text" class="form-control" name="adate" id="added_date" value="<?php echo date("Y-m-d"); ?>" readonly/>
            </div>
            <div class="form-group">
            <label>Add Quantity in Stock</label>
            <input type="text" class="form-control" id="msdata" name="msdata" placeholder="Enter Quantity" required/>
          </div>
         
           
            <input type="hidden" class="form-control" id="msdatao" name="msdatao" placeholder="Enter Quantity" required/>
        
            <input type="hidden" class="form-control" id="id" name="id" placeholder="Enter Quantity" required/>
         
          
            <input type="hidden" class="form-control" id="stock" name="stock" placeholder="Enter Quantity" required/>
        

          <button type="submit" class="btn btn-success">Update Product</button>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>