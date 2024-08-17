<?php
include 'db.php';

$sql = "SELECT name FROM category";
$result = $conn->query($sql);

$categories = array();
while($row = $result->fetch_assoc()) {
    $categories[] = $row['name'];
}

$conn->close();
?>


<!-- Modals -->
<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                <button class="close text-white" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <a class="btn btn-danger" href="login.php">Logout</a>
            </div>
        </div>
    </div>
</div>
<!-- Add Sale Modal-->
<div class="modal fade" id="addSaleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="exampleModalLabel">
                    <i class="fa fa-money"></i>
                    Add New Sale
                </h5>
                <button class="close text-white" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form class="">
                <div class="modal-body">
                    <div class="form-group">
                        <label>Select Product</label>
                        <select class="form-control text-primary" required>
                            <option disabled selected><sub>Please select a product</sub></option>
                            <option disabled><sub>Speakers &amp; MICs</sub></option>
                            <option>Audionic MIC AM-20</option>
                            <option>USB Sound Card</option>
                            <option>Audionic Headphones AHT-11</option>
                            <option disabled><sub>Mice &amp; Accessories</sub></option>
                            <option>Razer Mousepad</option>
                            <option>Blue Mousepad</option>
                            <option>Apple Mouse Wireless A11</option>
                            <option>DELL Mouse Wireless D232</option>
                            <option>Razer Mousepad</option>
                            <option>Razer Mousepad</option>
                            <option>Razer Mousepad</option>
                            <option>Razer Mousepad</option>
                            <option>Razer Mousepad</option>
                            <option>Razer Mousepad</option>
                            <option>Razer Mousepad</option>
                            <option disabled><sub>Mice &amp; Accessories</sub></option>
                            <option>Razer Mousepad</option>
                            <option>Razer Mousepad</option>
                            <option>Razer Mousepad</option>
                            <option>Razer Mousepad</option>
                            <option>Razer Mousepad</option>
                            <option>Razer Mousepad</option>
                            <option disabled><sub>Mice &amp; Accessories</sub></option>
                            <option>Razer Mousepad</option>
                            <option>Razer Mousepad</option>
                            <option>Razer Mousepad</option>
                        </select>
                        <small class="float-right">Product not listed here? <a href="#" data-toggle="modal"
                                data-target="#addProductModal">Add new</a> </small>
                    </div>
                    <div class="form-group">
                        <label for="">Product Price</label>
                        <input type="number" class="form-control" name="" value=""
                            placeholder="Enter product price here..." required>
                    </div>
                    <div class="form-group">
                        <label for="">Description <small class="text-muted">(Optional)</small></label>
                        <textarea name="name" class="form-control" rows="8" cols="80"
                            placeholder="Add some note or description about this sale..."></textarea>
                    </div>
                    <small class="text-muted"><em>Please double check information before submitting.</em></small>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <input type="submit" class="btn btn-primary" value="Add Sale">
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Add Product Modal -->
<div class="modal fade" id="addProductModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="exampleModalLabel">
                    <i class="fa fa-tag"></i>
                    Add New Product
                </h5>
                <button class="close text-white" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form action="add_product.php" method="POST">
                <div class="modal-body">
                    <div class="form-group">
                        <label>Product Category</label>
                        <select class="form-control text-primary" name="product_category" required>
                            <option disabled selected><sub>Please select a product Category</sub></option>
                            <?php
                            foreach ($categories as $category) {
                                echo "<option>{$category}</option>";
                            }
                            ?>
                        </select>
                        <small class="float-right">Products Category not listed here? <a href="#" data-toggle="modal"
                                data-target="#addProductBrandModal">Add new</a> </small>
                    </div>
                    <div class="form-group">
                        <label>Warranty</label>
                        <select class="form-control text-primary" name="warranty" required>
                            <option disabled selected><sub>Please select a warranty</sub></option>
                            <option>No warranty</option>
                            <option>3 month</option>
                            <option>6 month</option>
                            <option>1 year</option>
                            <option>2 year</option>
                            <option>3 year</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Product Name</label>
                        <input type="text" class="form-control" name="product_name" 
                            required>
                        <!-- <small class="text-muted">Be more specific with product names. Make sure it's unique.</small> -->
                    </div>

                    <div class="form-group">
                        <label for="">Product Cost Price <small class="text-muted"></small> </label>
                        <input type="number" class="form-control" name="product_cost_price"
                             required>
                    </div>

                    <!-- <div class="form-group">
                        <label for="">Product Wholesale Price <small class="text-muted">(Wholesale Price)</small>
                        </label>
                        <input type="number" class="form-control" name="product_wholesale_price"
                            placeholder="Enter Wholesale price per item..." required>
                    </div> -->

                    <div class="form-group">
                        <label for="">Product Price <small class="text-muted"></small> </label>
                        <input type="number" class="form-control" name="product_price"
                             required>
                    </div>

                    <div class="form-group">
                        <label for="">Product Selling Price <small class="text-muted"></small> </label>
                        <input type="number" class="form-control" name="product_selling_price"
                            required>
                    </div>
                    <div class="form-group">
                        <label for="">Product Stock <small></small> </label>
                        <input type="number" class="form-control" name="product_stock"
                            required>
                        <!-- <small class="text-muted">This will be used as product quantity in stock keeping unit.</small> -->
                    </div>

                    <!-- Discount Prices for 3 Products -->
                    <!-- <h6>Discounts for Quantities</h6>
                    <div class="form-group">
                        <label for="quantity1">Quantity 1</label>
                        <input type="number" id="quantity1" class="form-control" name="quantity1"
                            placeholder="Enter quantity">
                        <label for="price1">Price 1</label>
                        <input type="number" id="price1" class="form-control" name="price1" placeholder="Enter price">
                    </div>
                    <div class="form-group">
                        <label for="quantity2">Quantity 2</label>
                        <input type="number" id="quantity2" class="form-control" name="quantity2"
                            placeholder="Enter quantity">
                        <label for="price2">Price 2</label>
                        <input type="number" id="price2" class="form-control" name="price2" placeholder="Enter price">
                    </div>
                    <div class="form-group">
                        <label for="quantity3">Quantity 3</label>
                        <input type="number" id="quantity3" class="form-control" name="quantity3"
                            placeholder="Enter quantity">
                        <label for="price3">Price 3</label>
                        <input type="number" id="price3" class="form-control" name="price3" placeholder="Enter price">
                    </div> -->

                    <!-- <small class="text-muted"><em>Please double check information before submitting.</em></small> -->
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <input type="submit" class="btn btn-primary" value="Add Product">
                </div>
            </form>
        </div>
    </div>
</div>



<!-- Add Product Type-->
<div class="modal fade" id="addProductTypeModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="exampleModalLabel">
                    <i class="fa fa-tags"></i>
                    Add Product Type
                </h5>
                <button class="close text-white" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form class="">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">Product Type</label>
                        <input type="text" class="form-control" name="" value="" placeholder="Enter product type..."
                            required>
                        <!-- <small class="text-muted">Example: Mousepads, Headphones or Keyboards etc</small> -->
                    </div>
                    <div class="form-group">
                        <label for="">Description <small class="text-muted">(Optional)</small></label>
                        <textarea name="name" class="form-control" rows="8" cols="80"
                            placeholder="Add some note or description about this product type..."></textarea>
                    </div>
                    <!-- <small class="text-muted"><em>Please double check information before submitting.</em></small> -->
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <input type="submit" class="btn btn-primary" value="Add Product Type">
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Add Product Category-->
<div class="modal fade" id="addProductBrandModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="exampleModalLabel">
                    <i class="fa fa-industry"></i>
                    Add Product Category
                </h5>
                <button class="close text-white" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form class="" action="add-category.php" method="POST">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">Product Category</label>
                        <input type="text" class="form-control" name="category_name" value=""
                            placeholder="Enter Category name here..." required>
                        <!-- <small class="text-muted">Example: Speakers, Subwoofer or Head light etc</small> -->
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <input type="submit" class="btn btn-primary" value="Add Category">
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Add Product Vendor -->
<div class="modal fade" id="addProductVendorModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="exampleModalLabel">
                    <i class="fa fa-user"></i>
                    Add Products Vendor
                </h5>
                <button class="close text-white" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form class="">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">Vendor Name</label>
                        <input type="text" class="form-control" name="" value=""
                            placeholder="Enter vendor's name here..." required>
                        <small class="text-muted">Example: Anees Ahmad, Faisal Hayat or Shahzaib Khan etc</small>
                    </div>
                    <div class="form-group">
                        <label for="">Phone Number</label>
                        <input type="text" class="form-control" name="" value=""
                            placeholder="Enter vendor's phone number here...">
                        <small class="text-muted">Example: 555-665-123</small>
                    </div>
                    <div class="form-group">
                        <label for="">Email Address</label>
                        <input type="email" class="form-control" name="" value=""
                            placeholder="Enter vendor's email here...">
                        <small class="text-muted">Example: ahmadanees02@gmail.com</small>
                    </div>
                    <div class="form-group">
                        <label for="">Description <small class="text-muted">(Optional)</small></label>
                        <textarea name="name" class="form-control" rows="8" cols="80"
                            placeholder="Add some note or description about this vendor..."></textarea>
                    </div>
                    <small class="text-muted"><em>Please double check information before submitting.</em></small>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <input type="submit" class="btn btn-primary" value="Add Vendor">
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Add Expense Account Modal -->
<div class="modal fade" id="addExpenseAccountModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="exampleModalLabel">
                    <i class="fa fa-dollar"></i>
                    Add Expense Account
                </h5>
                <button class="close text-white" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form class="">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">Account Title</label>
                        <input type="text" class="form-control" name="" value=""
                            placeholder="Enter account title here..." required>
                        <small class="text-muted">Example: Akhtar Hotel, Mian Tea Stall or My Personal Account
                            etc</small>
                    </div>
                    <div class="form-group">
                        <label for="">How much are you depositing?</label>
                        <input type="email" class="form-control" name="" value=""
                            placeholder="Enter the amount you are despositing...">
                    </div>
                    <div class="form-group">
                        <label for="">Description <small class="text-muted">(Optional)</small></label>
                        <textarea name="name" class="form-control" cols="80"
                            placeholder="Add some note or description about this vendor..."></textarea>
                    </div>
                    <small class="text-muted"><em>Please double check information before submitting.</em></small>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <input type="submit" class="btn btn-primary" value="Add Account">
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Product Modal -->
<div class="modal fade" id="editProductModal" tabindex="-1" role="dialog" aria-labelledby="editProductLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="editProductLabel">
                    <i class="fa fa-tag"></i>
                    Edit Product
                </h5>
                <button class="close text-white" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form action="product-edit.php" method="POST">
                <div class="modal-body">
                    <!-- Hidden input for the product ID -->
                    <input type="hidden" id="editProductId" name="id">

                    <!-- Display the Product ID -->
                    <div class="form-group">
                        <label id="editProductIdLabel" for="editProductName">Product ID: <span id="editProductId"></span></label>
                    </div>

                    <!-- Product Name -->
                    <div class="form-group">
                        <label for="editProductName">Product Name</label>
                        <input type="text" id="editProductName" class="form-control" name="name" required>
                    </div>

                    <!-- Cost Price -->
                    <div class="form-group">
                        <label for="editCostPrice">Cost Price</label>
                        <input type="number" id="editCostPrice" class="form-control" name="cost_price" required>
                    </div>

                    <!-- Wholesale Price -->
                    <!-- <div class="form-group">
                        <label for="editWholesalePrice">Wholesale Price</label>
                        <input type="number" id="editWholesalePrice" class="form-control" name="wholesale_price"
                            required>
                    </div> -->

                    <!-- Price -->
                    <div class="form-group">
                        <label for="editPrice">Price</label>
                        <input type="number" id="editPrice" class="form-control" name="price" required>
                    </div>

                    <!-- Selling Price -->
                    <div class="form-group">
                        <label for="editSellingPrice">Selling Price</label>
                        <input type="number" id="editSellingPrice" class="form-control" name="selling_price" required>
                    </div>

                    <!-- Warranty -->
                    <div class="form-group">
                        <label for="editWarranty">Warranty</label>
                        <select id="editWarranty" class="form-control" name="warranty" required>
                            <option value="" disabled>Select Warranty</option>
                            <option>No warranty</option>
                            <option>3 month</option>
                            <option>6 month</option>
                            <option>1 year</option>
                            <option>2 year</option>
                            <option>3 year</option>
                        </select>
                    </div>

                    <!-- Stock -->
                    <div class="form-group">
                        <label for="editStock">Stock</label>
                        <input type="number" id="editStock" class="form-control" name="stock" required>
                    </div>

                    <!-- Discount Quantities and Prices -->
                    <!-- <h6>Discounts for Quantities</h6>
                    
                    <div class="form-group">
                        <label for="quantity1">Quantity 1</label>
                        <input type="number" id="quantity1" class="form-control" name="quantity1"
                            placeholder="Enter quantity">
                        <label for="price1">Price 1</label>
                        <input type="number" id="price1" class="form-control" name="price1" placeholder="Enter price">
                    </div>
                    <div class="form-group">
                        <label for="quantity2">Quantity 2</label>
                        <input type="number" id="quantity2" class="form-control" name="quantity2"
                            placeholder="Enter quantity">
                        <label for="price2">Price 2</label>
                        <input type="number" id="price2" class="form-control" name="price2" placeholder="Enter price">
                    </div>
                    <div class="form-group">
                        <label for="quantity3">Quantity 3</label>
                        <input type="number" id="quantity3" class="form-control" name="quantity3"
                            placeholder="Enter quantity">
                        <label for="price3">Price 3</label>
                        <input type="number" id="price3" class="form-control" name="price3" placeholder="Enter price">
                    </div>
                </div> -->
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <input type="submit" class="btn btn-primary" value="Save Changes">
                </div>
            </form>
        </div>
    </div>
</div>






